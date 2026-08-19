<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_print_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function incident_list_print_details()
    {
        // echo 123;die;
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');

        if($this->session->userdata('stake_id_fk') == '4'){
            if($this->session->userdata('subdiv') != ''){
                $where = "(cmir.stake_holder_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_one_stake_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_two_stake_id_fk = '$stake_holder_id_fk' OR cmir.stake_holder_id_fk <> '$stake_holder_id_fk' AND cmir.district = '$district' AND cmir.block = '$block') AND cmir.incident_draft_status = '2' AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
            }elseif($this->session->userdata('subdiv') == ''){
                $where = "(cmir.stake_holder_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_one_stake_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_two_stake_id_fk = '$stake_holder_id_fk') AND cmir.incident_draft_status = '2' AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
            }
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $where = "cmir.stake_holder_id_fk = '$stake_holder_id_fk' OR (cmir.district = '$district' OR cmircpo.cp_one_district = '$district' OR cmircpt.cp_two_district = '$district') AND cmir.publish_status = '102' AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->select('cmir.district, cmir.block, lmb.district_id_fk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report AS cmir')
            ->join('rp_location_master_block AS lmb', 'cmir.district = lmb.district_id_fk AND cmir.block = lmb.block_id_pk')
            ->join('rp_location_master_subdiv AS lms', 'lmb.clucd = lms.schcd')
            ->where('lms.subdiv_id_pk', $this->session->userdata('subdiv'))
            ->get()->result();
            $district_id_fk = ($query)?$query[0]->district_id_fk:0;

            $where = "cmir.district = '".$district_id_fk."' AND cmir.forward_status = '102' AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $where = "(cmir.stake_holder_id_fk = '$stake_holder_id_fk' AND cmir.district = '$district' AND cmir.block = '$block' AND cmir.forward_status = '102') OR ((cmir.stake_holder_master_id_fk = '4' AND cmir.district = '$district' AND cmir.block = '$block' AND cmir.forward_status = '102')) AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
             if($district != ''){
                $where = "cmir.district = '$district' and cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
             }elseif($district == ''){
                $where = "cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
             }
        }
        
        $query = $this->db->query("SELECT cmir.incident_id_pk, cmir.stake_holder_id_fk, cmir.reporting_id, cmir.incident_date, block_location_master_description(cmir.block) AS block_name, cmir.cp_one_age, cmir.cp_two_age, cmir.forward_status, cmir.publish_status, cmir.home_visit_minor_status, cmir.home_visit_adult_status, cmir.follow_up_visit_status, cmir.deo_cp_one_stake_id_fk, cmir.deo_cp_two_stake_id_fk, cmir.cp_two_is_available, cmircpo.cp_one_name, cmircpo.cp_one_gender, cmircpo.cp_one_block AS cp_one_block_id, district_location_master_description(cmircpo.cp_one_district) AS cp_one_district, block_location_master_description(cmircpo.cp_one_block) AS cp_one_block, cmircpo.cp_one_state, cmircpo.cp_one_ward_gp, cmircpo.cp_one_address, cmircpo.cp_one_is_home_visit, cmircpo.cp_one_home_visit_minor_status, cmircpo.cp_one_is_followup_visit, cmircpo.cp_one_follow_up_visit_status, cmircpt.cp_two_name, cmircpt.cp_two_gender, cmircpt.cp_two_block AS cp_two_block_id, cmircpt.cp_two_ward_gp, cmircpt.cp_two_state, district_location_master_description(cmircpt.cp_two_district) AS cp_two_district, block_location_master_description(cmircpt.cp_two_block) AS cp_two_block, cmircpt.cp_two_address, cmircpt.cp_two_follow_up_visit_status, cmircpt.cp_two_is_home_visit, cmircpt.cp_two_is_followup_visit, cmircpt.cp_two_home_visit_minor_status FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cmircpo ON cmir.incident_id_pk=cmircpo.incident_id_fk LEFT JOIN cm_incident_report_contracting_party_two AS cmircpt ON cmir.incident_id_pk=cmircpt.incident_id_fk WHERE $where")->result();
        return $query;
    }

    public function incident_print_details($incident_id)
    {
        $query = $this->db->select('cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark, cmir.ward_gp, cmir.district AS incident_district_id, district_location_master_description(cmir.district) AS incident_district, cmir.block AS incident_block_id, block_location_master_description(cmir.block) AS incident_block, cmir.pin_code, cmir.police_station AS cmir_police_station, cmir.marriage_details, cmir.cp_one_age, cmir.cp_two_age, cmir.prevented_details, cmir.location_description, cmir.anonymous, cmir.identity_known_name, cmir.identity_street_landmark, cmir.identity_ward_gp, cmir.identity_district, cmir.identity_block, cmir.identity_pin_code, cmir.identity_police_station, cmir.identity_phone_no, cmir.information_received, cpo.cp_one_name, cpo.cp_one_street_landmark, cpo.cp_one_ward_gp, cpo.cp_one_district, cpo.cp_one_block, cpo.cp_one_pin_code, cpo.cp_one_police_station, cpo.cp_one_phone_no, cpo.cp_one_gender, cpo.cp_one_social_category, cpo.cp_one_religion, cpo.cp_one_dob, cpo.cp_one_dob_document_available, cpo.cp_one_dob_document_id, cpo.cp_one_dob_document_type, cpo.cp_one_identity_document_available, cpo.cp_one_identity_document_id, cpo.cp_one_identity_document_type, cpo.cp_one_highest_educational_attainment, cpo.cp_one_father_name, cpo.cp_one_father_mobile_no, cpo.cp_one_father_id, cpo.cp_one_father_id_type, cpo.cp_one_father_alive, cpo.cp_one_mother_name, cpo.cp_one_mother_mobile_no, cpo.cp_one_mother_id, cpo.cp_one_mother_id_type, cpo.cp_one_mother_alive, cpocwcd.minor_sent, cpocwcd.case_no, cpocwcd.case_date, cpocwcd.district AS cwc_district, cpocwcd.cci_details, cpocwcd.address, cpocwcd.remarks, cpocwcd.block AS cp_one_cwc_block, cpt.cp_two_name, cpt.cp_two_street_landmark, cpt.cp_two_ward_gp, cpt.cp_two_district, cpt.cp_two_block, cpt.cp_two_pin_code, cpt.cp_two_police_station, cpt.cp_two_phone_no, cpt.cp_two_gender, cpt.cp_two_social_category, cpt.cp_two_religion, cpt.cp_two_dob, cpt.cp_two_dob_document_available, cpt.cp_two_dob_document_id, cpt.cp_two_dob_document_type, cpt.cp_two_identity_document_available, cpt.cp_two_identity_document_id, cpt.cp_two_identity_document_type, cpt.cp_two_highest_educational_attainment, cpt.cp_two_father_name, cpt.cp_two_father_mobile_no, cpt.cp_two_father_id, cpt.cp_two_father_id_type, cpt.cp_two_father_alive, cpt.cp_two_mother_name, cpt.cp_two_mother_mobile_no, cpt.cp_two_mother_id, cpt.cp_two_mother_id_type, cpt.cp_two_mother_alive, cptcwcd.minor_sent AS cp_two_cwc_minor_sent, cptcwcd.case_no AS cp_two_cwc_case_no, cptcwcd.case_date AS cp_two_cwc_case_date, cptcwcd.district AS cp_two_cwc_district, cptcwcd.cci_details AS cp_two_cwc_cci_details, cptcwcd.address AS cp_two_cwc_address, cptcwcd.remarks AS cp_two_cwc_remarks, cptcwcd.block AS cp_two_cwc_block, pcd.gd_no, pcd.gd_date, pcd.fir_no, pcd.fir_date, pcd.police_station, pcd.district AS pc_district, pcd.block AS pc_block')
            ->from('cm_incident_report AS cmir')
            ->join('cm_incident_report_contracting_party_one AS cpo', 'cmir.incident_id_pk = cpo.incident_id_fk', 'left')
            ->join('cm_incident_report_cp_one_cwc_details AS cpocwcd', 'cmir.incident_id_pk = cpocwcd.incident_id_fk', 'left')
            ->join('cm_incident_report_contracting_party_two AS cpt', 'cmir.incident_id_pk = cpt.incident_id_fk', 'left')
            ->join('cm_incident_report_cp_two_cwc_details AS cptcwcd', 'cmir.incident_id_pk = cptcwcd.incident_id_fk', 'left')
            ->join('cm_incident_report_police_case AS pcd', 'cmir.incident_id_pk = pcd.incident_id_fk', 'left')
            ->where('cmir.incident_id_pk', $incident_id)
            ->get();
        return $query->result_array();
    }
}
?>
