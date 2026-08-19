<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function incident_list_reporting_details()
    {   
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
            $query = $this->db->select('cmir.district, cmir.block, lmb.district_id_fk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban, lms.subdiv_id_pk, lmb.block_id_pk')
            ->from('cm_incident_report AS cmir')
            ->join('rp_location_master_block AS lmb', 'cmir.district = lmb.district_id_fk AND cmir.block = lmb.block_id_pk')
            ->join('rp_location_master_subdiv AS lms', 'lmb.clucd = lms.schcd')
            ->where('lms.subdiv_id_pk', $this->session->userdata('subdiv'))
            ->get()->result();

            $district_id_fk = ($query)?$query[0]->district_id_fk:0;
            $subdiv_id_pk = ($query)?$query[0]->subdiv_id_pk:0;
            $block_id_pk = ($query)?$query[0]->block_id_pk:0;
            // echo $block_id_pk;die;
            
            $where = "cmir.district = '".$district_id_fk."' AND cmir.block = '".$block_id_pk."' AND cmir.forward_status = '102' AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $where = "(cmir.stake_holder_id_fk = '$stake_holder_id_fk' AND cmir.district = '$district' AND cmir.block = '$block' AND cmir.forward_status = '102') OR ((cmir.stake_holder_master_id_fk = '4' AND cmir.district = '$district' AND cmir.block = '$block' AND cmir.forward_status = '102')) AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
             if($district != ''){
                $where = "cmir.district = '$district' and cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
             }elseif($district == ''){
                $where = "cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
             }
        }

        $query = $this->db->query("SELECT cmir.stake_holder_id_fk, cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark, cmir.ward_gp, cmir.state, cmir.district, cmir.block, district_location_master_description(cmir.district) AS incident_district, block_location_master_description(cmir.block) AS incident_block, cmir.pin_code, cmir.police_station, cmir.marriage_details AS marriage_details, cmir.cp_one_age, cmir.cp_two_age, cmir.prevented_details AS prevented_details, cmir.location_description AS location_description, cmir.anonymous, cmir.identity_known_name, cmir.identity_street_landmark, cmir.identity_ward_gp, cmir.identity_block as identity_block_id, cmir.identity_state, district_location_master_description(cmir.identity_district) AS identity_district, block_location_master_description(cmir.identity_block) AS identity_block, cmir.identity_pin_code, cmir.identity_police_station, cmir.identity_phone_no, cmir.information_received AS information_received, cmir.forward_status, cmir.publish_status, cmir.deo_cp_one_stake_id_fk, cmir.deo_cp_two_stake_id_fk, cmir.home_visit_minor_status, cmir.home_visit_adult_status, cmir.follow_up_visit_status, cmir.reporting_id, cmircpo.cp_one_name, cmircpo.cp_one_street_landmark, cmircpo.cp_one_ward_gp, cmircpo.cp_one_state, state_master_description(cmircpo.cp_one_state) AS cp_one_state_name, district_location_master_description(cmircpo.cp_one_district) AS cp_one_district, block_location_master_description(cmircpo.cp_one_block) AS cp_one_block, cmircpo.cp_one_pin_code, cmircpo.cp_one_police_station, cmircpo.cp_one_phone_no, gender_master_description(cmircpo.cp_one_gender) AS cp_one_gender_value, cmircpo.cp_one_gender AS cp_one_gender, cmircpo.cp_one_social_category AS cp_one_social_category, cmircpo.cp_one_religion AS cp_one_religion, cmircpo.cp_one_dob, cmircpo.cp_one_dob_document_available, cmircpo.cp_one_dob_document_id, cmircpo.cp_one_identity_document_type AS cp_one_dob_document_type, cmircpo.cp_one_identity_document_available, cmircpo.cp_one_identity_document_id, cmircpo.cp_one_identity_document_type AS cp_one_identity_document_type, cmircpo.cp_one_highest_educational_attainment AS cp_one_highest_educational_attainment, cmircpo.cp_one_father_name, cmircpo.cp_one_father_mobile_no, cmircpo.cp_one_father_id, cmircpo.cp_one_father_id_type, cmircpo.cp_one_father_alive, cmircpo.cp_one_mother_name, cmircpo.cp_one_mother_mobile_no, cmircpo.cp_one_mother_id, cmircpo.cp_one_mother_id_type, cmircpo.cp_one_mother_alive, cmircpo.cp_one_district AS cp_one_district_id, cmircpo.cp_one_block AS cp_one_block_id, cmircpo.cp_one_is_home_visit, cmircpo.cp_one_is_followup_visit, cmircpo.cp_one_address, cmircpt.cp_two_name, cmircpt.cp_two_street_landmark, cmircpt.cp_two_ward_gp, cmircpt.cp_two_state, state_master_description(cmircpt.cp_two_state) AS cp_two_state_name, district_location_master_description(cmircpt.cp_two_district) AS cp_two_district, block_location_master_description(cmircpt.cp_two_block) AS cp_two_block, cmircpt.cp_two_pin_code, cmircpt.cp_two_police_station, cmircpt.cp_two_phone_no, gender_master_description(cmircpt.cp_two_gender) AS cp_two_gender_value, cmircpt.cp_two_gender AS cp_two_gender, cmircpt.cp_two_social_category AS cp_two_social_category, cmircpt.cp_two_religion AS cp_two_religion, cmircpt.cp_two_dob, cmircpt.cp_two_dob_document_available, cmircpt.cp_two_dob_document_id, cmircpt.cp_two_dob_document_type AS cp_two_dob_document_type, cmircpt.cp_two_identity_document_available, cmircpt.cp_two_identity_document_id, cmircpt.cp_two_identity_document_type AS cp_two_identity_document_type, cmircpt.cp_two_highest_educational_attainment AS cp_two_highest_educational_attainment, cmircpt.cp_two_father_name, cmircpt.cp_two_father_mobile_no, cmircpt.cp_two_father_id, cmircpt.cp_two_father_id_type, cmircpt.cp_two_father_alive, cmircpt.cp_two_mother_name, cmircpt.cp_two_mother_mobile_no, cmircpt.cp_two_mother_id, cmircpt.cp_two_mother_id_type, cmircpt.cp_two_mother_alive, cmircpt.cp_two_district AS cp_two_district_id, cmircpt.cp_two_block AS cp_two_block_id, cmircpt.cp_two_is_home_visit, cmircpt.cp_two_is_followup_visit, cmircpt.cp_two_address, cmir.cp_two_is_available, cmircpo.cp_one_home_visit_minor_status, cmircpt.cp_two_home_visit_minor_status, cmircpo.cp_one_follow_up_visit_status, cmircpt.cp_two_follow_up_visit_status FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk LEFT JOIN cm_incident_report_contracting_party_two AS cmircpt ON cmir.incident_id_pk = cmircpt.incident_id_fk WHERE $where")->result();
        // print_r($this->db->last_query());die;
        return $query;
    }
    
    public function forward_reporting_details_update($incident_id)
    {
        $data = array(
          'forward_status' => 102
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $data);

        $query = $this->db->select('cmir.district, cmir.block, lmb.district_id_fk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban, cmir.reporting_id')
        ->from('cm_incident_report AS cmir')
        ->join('rp_location_master_block AS lmb', 'cmir.district = lmb.district_id_fk AND cmir.block = lmb.block_id_pk')
        ->where('cmir.incident_id_pk' , $incident_id)
        ->get()->row();

        if($query->rural_urban == 'U'){
            $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district_id_fk)
            ->where('shl.subdiv' , $query->subdiv_id_fk)
            ->where('shl.stake_id_fk' , 6)
            ->get()->row();
        }else{
             $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.block' , $query->block)
            ->where('shl.stake_id_fk' , 2)
            ->get()->row();
        }

        $receiver_by = $query_2->stake_holder_login_id_pk;
        $message = 'Incident ID:'.$query->reporting_id.' '.'Forwarded by DEO';
        $page_link = base_url()."admin/reporting/incident/incident_list";

        $uploaded_notification_details = array(
          'sender_by' => $this->session->userdata('stake_holder_login_id_pk'),
          'receiver_by' => $receiver_by,
          'page_link' => $page_link,
          'message' => $message,
          'sending_time' => date('Y-m-d H:i:s'),
          'status' => 0
        );
        $result = $this->db->insert('cm_notification_details', $uploaded_notification_details);

        $uploaded_forward_track_details = array(
          'incident_id_fk' => $incident_id,
          'deo_stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
          'bdo_sdo_stake_id_fk' => $query_2->stake_holder_login_id_pk,
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        $result = $this->db->insert('cm_incident_report_forward_tracks_details', $uploaded_forward_track_details);

    }

    public function publish_incident_reporting_details_update($incident_id)
    {
        $cp_one_query = $this->db->select('cpo.cp_one_district, cpo.cp_one_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_party_one as cpo')
            ->join('rp_location_master_block as lmb', 'cpo.cp_one_district = lmb.district_id_fk AND cpo.cp_one_block = lmb.block_id_pk')
            ->where('cpo.incident_id_fk' , $incident_id)
            ->get()->row();

        if($cp_one_query->rural_urban == 'U'){
            $cp_one_stake_id_query = $this->db->select('shl.stake_holder_login_id_pk')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $cp_one_query->district_id_fk)
                ->where('shl.subdiv', $cp_one_query->subdiv_id_fk)
                ->where('shl.stake_holder_details' , 'DEO')
                ->get()->row();
        }else{
            $cp_one_stake_id_query = $this->db->select('shl.stake_holder_login_id_pk')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $cp_one_query->district_id_fk)
                ->where('shl.block', $cp_one_query->block_id_pk)
                ->where('shl.stake_holder_details' , 'DEO')
                ->get()->row();
        }

        $cp_two_query = $this->db->select('cpt.cp_two_district, cpt.cp_two_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_party_two as cpt')
            ->join('rp_location_master_block as lmb', 'cpt.cp_two_district = lmb.district_id_fk AND cpt.cp_two_block = lmb.block_id_pk')
            ->where('cpt.incident_id_fk' , $incident_id)
            ->get()->row();
        $cp_two_result_data = null; 
       if(!empty($cp_two_query))
       {
            if($cp_two_query->rural_urban == 'U'){
                $cp_two_stake_id_query = $this->db->select('shl.stake_holder_login_id_pk')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp_two_query->district_id_fk)
                    ->where('shl.subdiv', $cp_two_query->subdiv_id_fk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }else{
                $cp_two_stake_id_query = $this->db->select('shl.stake_holder_login_id_pk')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp_two_query->district_id_fk)
                    ->where('shl.block', $cp_two_query->block_id_pk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }
           
        $cp_two_result_data = !empty($cp_two_stake_id_query)? $cp_two_stake_id_query->stake_holder_login_id_pk : NULL;
        }
        $cp_one_result_data = !empty ($cp_one_stake_id_query)? $cp_one_stake_id_query->stake_holder_login_id_pk : NULL;

   

        $uploaded_incident_publish_track_details = array(
            'incident_id_fk' => $incident_id,
            'bdo_stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'deo_cp_one_stake_id_fk' => $cp_one_result_data,
            'deo_cp_two_stake_id_fk' => empty($cp_two_result_data) ? null : $cp_two_result_data,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );

        $update_incident_publish_details = array(
          'deo_cp_one_stake_id_fk' => $cp_one_result_data,
          'deo_cp_two_stake_id_fk' => empty($cp_two_result_data) ? null : $cp_two_result_data,
          'publish_status' => 102
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $update_incident_publish_details);

        $result = $this->db->insert('cm_incident_report_publish_track_details', $uploaded_incident_publish_track_details);

        $stake_id_array = array($cp_one_result_data, $cp_two_result_data);

        $incident_report = $this->db->select('reporting_id')
            ->from('cm_incident_report')
            ->where('incident_id_pk' , $incident_id)
            ->get()->row();

        if($this->session->userdata('stake_id_fk') == '2'){
           $message = 'Incident ID:'.$incident_report->reporting_id.' '.'Published by BDO';
        }elseif($this->session->userdata('stake_id_fk') == '6'){
           $message = 'Incident ID:'.$incident_report->reporting_id.' '.'Published by SDO';
        }elseif($this->session->userdata('stake_id_fk') == '3'){
           $message = 'Incident ID:'.$incident_report->reporting_id.' '.'Published by CMPO';
        }
        $page_link = base_url()."admin/reporting/incident/incident_list";

        if($cp_one_result_data != $cp_two_result_data){
            for ($i=0; $i < count($stake_id_array); $i++) { 
                $uploaded_notification_details = array(
                   'sender_by' => $this->session->userdata('stake_holder_login_id_pk'),
                   'receiver_by' => $stake_id_array[$i],
                   'page_link' => $page_link,
                   'message' => $message,
                   'sending_time' => date('Y-m-d H:i:s'),
                   'status' => 0
                );
                $result = $this->db->insert('cm_notification_details', $uploaded_notification_details);
            }
        }else{
            $uploaded_notification_details = array(
                'sender_by' => $this->session->userdata('stake_holder_login_id_pk'),
                'receiver_by' => $cp_two_result_data,
                'page_link' => $page_link,
                'message' => $message,
                'sending_time' => date('Y-m-d H:i:s'),
                'status' => 0
            );
            $result = $this->db->insert('cm_notification_details', $uploaded_notification_details);
        }
    }

    public function cp_one_gender_value($incident_id)
    {
        $query = $this->db->select('cpone.cp_one_gender')
            ->from('cm_incident_report_contracting_party_one AS cpone')
            ->where('cpone.incident_id_fk' , $incident_id)
            ->get()->row();
        return $query->cp_one_gender;
    }

    public function cp_two_gender_value($incident_id)
    {
        $query = $this->db->select('cptwo.cp_two_gender')
            ->from('cm_incident_report_contracting_party_two AS cptwo')
            ->where('cptwo.incident_id_fk', $incident_id)
            ->get()->row();
        return $query->cp_two_gender;
    }

    public function cp_cci_value($district_value, $cp_gender)
    {
        if($cp_gender == '1'){
          $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $district_value");
        }elseif($cp_gender == '2'){
          $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $district_value");
        }
        return $query->result_array(); 
    }

    public function Update_Transfer_CCI_Details($incident_id)
    {
        $upload = array(
            'transfer_status' => 102
        );
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_one_cwc_details', $upload);
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_two_cwc_details', $upload);

        $incident_details_query = $this->db->select('district, reporting_id')
        ->from('cm_incident_report')
        ->where('incident_id_pk' , $incident_id)
        ->get()->row();

        $query = $this->db->select('stake_holder_login_id_pk')
        ->from('cm_stake_holder_login')
        ->where('district', $incident_details_query->district)
        ->where('stake_id_fk' , 3)
        ->get()->row();

        $message = 'Incident ID:'.$incident_details_query->reporting_id.' '.'Child transfer request to CWC.';
        $page_link = base_url()."admin/reporting/incident/incident_list";
        $uploaded_notification_details = array(
           'sender_by' => $this->session->userdata('stake_holder_login_id_pk'),
           'receiver_by' => $query->stake_holder_login_id_pk,
           'page_link' => $page_link,
           'message' => $message,
           'sending_time' => date('Y-m-d H:i:s'),
           'status' => 0
        );
        $result = $this->db->insert('cm_notification_details', $uploaded_notification_details);
    }

    // public function incident_download_details($incident_id)
    // {
    //     $query = $this->db->query("SELECT cmir.stake_holder_id_fk, cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark, cmir.ward_gp, cmir.state, district_location_master_description(cmir.district) AS incident_district, block_location_master_description(cmir.block) AS incident_block, cmir.pin_code, cmir.police_station, marriage_details_master_description(cmir.marriage_details) AS marriage_details, cmir.cp_one_age, cmir.cp_two_age, prevented_master_description(cmir.prevented_details) AS prevented_details, location_description_master_description(cmir.location_description) AS location_description, cmir.anonymous, cmir.identity_known_name, cmir.identity_street_landmark, cmir.identity_ward_gp, cmir.identity_state, district_location_master_description(cmir.identity_district) AS identity_district, block_location_master_description(cmir.identity_block) AS identity_block, cmir.identity_pin_code, cmir.identity_police_station, cmir.identity_phone_no, information_received_master_description(cmir.information_received) AS information_received, cmir.forward_status, cmir.publish_status, cmir.deo_cp_one_stake_id_fk, cmir.deo_cp_two_stake_id_fk, cmir.home_visit_minor_status, cmir.home_visit_adult_status, cmir.follow_up_visit_status, cmir.reporting_id, cmircpo.cp_one_name, cmircpo.cp_one_street_landmark, cmircpo.cp_one_ward_gp, cmircpo.cp_one_state, district_location_master_description(cmircpo.cp_one_district) AS cp_one_district, block_location_master_description(cmircpo.cp_one_block) AS cp_one_block, cmircpo.cp_one_pin_code, cmircpo.cp_one_police_station, cmircpo.cp_one_phone_no, gender_master_description(cmircpo.cp_one_gender) AS cp_one_gender, social_category_master_description(cmircpo.cp_one_social_category) AS cp_one_social_category, religion_master_description(cmircpo.cp_one_religion) AS cp_one_religion, cmircpo.cp_one_dob, cmircpo.cp_one_dob_document_available, cmircpo.cp_one_dob_document_id, docyment_type_master_description(cmircpo.cp_one_identity_document_type) AS cp_one_dob_document_type, cmircpo.cp_one_identity_document_available, cmircpo.cp_one_identity_document_id, docyment_type_master_description(cmircpo.cp_one_identity_document_type) AS cp_one_identity_document_type, highest_educational_attainment_master_description(cmircpo.cp_one_highest_educational_attainment) AS cp_one_highest_educational_attainment, cmircpo.cp_one_father_name, cmircpo.cp_one_father_mobile_no, cmircpo.cp_one_father_id, cmircpo.cp_one_father_id_type, cmircpo.cp_one_father_alive, cmircpo.cp_one_mother_name, cmircpo.cp_one_mother_mobile_no, cmircpo.cp_one_mother_id, cmircpo.cp_one_mother_id_type, cmircpo.cp_one_mother_alive, cmircpo.cp_one_district AS cp_one_district_id, cmircpo.cp_one_block AS cp_one_block_id, cmircpt.cp_two_name, cmircpt.cp_two_street_landmark, cmircpt.cp_two_ward_gp, cmircpt.cp_two_state, district_location_master_description(cmircpt.cp_two_district) AS cp_two_district, block_location_master_description(cmircpt.cp_two_block) AS cp_two_block, cmircpt.cp_two_pin_code, cmircpt.cp_two_police_station, cmircpt.cp_two_phone_no, gender_master_description(cmircpt.cp_two_gender) AS cp_two_gender, social_category_master_description(cmircpt.cp_two_social_category) AS cp_two_social_category, religion_master_description(cmircpt.cp_two_religion) AS cp_two_religion, cmircpt.cp_two_dob, cmircpt.cp_two_dob_document_available, cmircpt.cp_two_dob_document_id, docyment_type_master_description(cmircpt.cp_two_dob_document_type) AS cp_two_dob_document_type, cmircpt.cp_two_identity_document_available, cmircpt.cp_two_identity_document_id, docyment_type_master_description(cmircpt.cp_two_identity_document_type) AS cp_two_identity_document_type, highest_educational_attainment_master_description(cmircpt.cp_two_highest_educational_attainment) AS cp_two_highest_educational_attainment, cmircpt.cp_two_father_name, cmircpt.cp_two_father_mobile_no, cmircpt.cp_two_father_id, cmircpt.cp_two_father_id_type, cmircpt.cp_two_father_alive, cmircpt.cp_two_mother_name, cmircpt.cp_two_mother_mobile_no, cmircpt.cp_two_mother_id, cmircpt.cp_two_mother_id_type, cmircpt.cp_two_mother_alive, cmircpt.cp_two_district AS cp_two_district_id, cmircpt.cp_two_block AS cp_two_block_id FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk LEFT JOIN cm_incident_report_contracting_party_two AS cmircpt ON cmir.incident_id_pk = cmircpt.incident_id_fk WHERE cmir.reporting_id = '$incident_id'")->result();
    //     // print_r($this->db->last_query());die;
    //     return $query;
    // }

    public function dateSearchBetweenDates($start_date, $end_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        if($this->session->userdata('stake_id_fk') == '4'){
            $where = "(cmir.stake_holder_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_one_stake_id_fk = '$stake_holder_id_fk' OR cmir.deo_cp_two_stake_id_fk = '$stake_holder_id_fk' OR cmir.stake_holder_id_fk <> '$stake_holder_id_fk' AND cmir.district = '$district' AND cmir.block = '$block') AND cmir.incident_draft_status = '2' AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
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
            $where = "cmir.district = '$district' AND cmir.block = '$block' AND cmir.forward_status = '102' AND cmir.incident_draft_status = 2 AND cmir.delete_status = '0' ORDER BY incident_id_pk DESC";
        }
       
        $query = $this->db->query("SELECT cmir.stake_holder_id_fk, cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark, cmir.ward_gp, cmir.state, cmir.district, cmir.block, district_location_master_description(cmir.district) AS incident_district, block_location_master_description(cmir.block) AS incident_block, cmir.pin_code, cmir.police_station, cmir.marriage_details AS marriage_details, cmir.cp_one_age, cmir.cp_two_age, cmir.prevented_details AS prevented_details, cmir.location_description AS location_description, cmir.anonymous, cmir.identity_known_name, cmir.identity_street_landmark, cmir.identity_ward_gp, cmir.identity_block as identity_block_id, cmir.identity_state, district_location_master_description(cmir.identity_district) AS identity_district, block_location_master_description(cmir.identity_block) AS identity_block, cmir.identity_pin_code, cmir.identity_police_station, cmir.identity_phone_no, cmir.information_received AS information_received, cmir.forward_status, cmir.publish_status, cmir.deo_cp_one_stake_id_fk, cmir.deo_cp_two_stake_id_fk, cmir.home_visit_minor_status, cmir.home_visit_adult_status, cmir.follow_up_visit_status, cmir.reporting_id, cmircpo.cp_one_name, cmircpo.cp_one_street_landmark, cmircpo.cp_one_ward_gp, cmircpo.cp_one_state, state_master_description(cmircpo.cp_one_state) AS cp_one_state_name, district_location_master_description(cmircpo.cp_one_district) AS cp_one_district, block_location_master_description(cmircpo.cp_one_block) AS cp_one_block, cmircpo.cp_one_pin_code, cmircpo.cp_one_police_station, cmircpo.cp_one_phone_no, gender_master_description(cmircpo.cp_one_gender) AS cp_one_gender_value, cmircpo.cp_one_gender AS cp_one_gender, cmircpo.cp_one_social_category AS cp_one_social_category, cmircpo.cp_one_religion AS cp_one_religion, cmircpo.cp_one_dob, cmircpo.cp_one_dob_document_available, cmircpo.cp_one_dob_document_id, cmircpo.cp_one_identity_document_type AS cp_one_dob_document_type, cmircpo.cp_one_identity_document_available, cmircpo.cp_one_identity_document_id, cmircpo.cp_one_identity_document_type AS cp_one_identity_document_type, cmircpo.cp_one_highest_educational_attainment AS cp_one_highest_educational_attainment, cmircpo.cp_one_father_name, cmircpo.cp_one_father_mobile_no, cmircpo.cp_one_father_id, cmircpo.cp_one_father_id_type, cmircpo.cp_one_father_alive, cmircpo.cp_one_mother_name, cmircpo.cp_one_mother_mobile_no, cmircpo.cp_one_mother_id, cmircpo.cp_one_mother_id_type, cmircpo.cp_one_mother_alive, cmircpo.cp_one_district AS cp_one_district_id, cmircpo.cp_one_block AS cp_one_block_id, cmircpo.cp_one_is_home_visit, cmircpo.cp_one_is_followup_visit, cmircpo.cp_one_address, cmircpt.cp_two_name, cmircpt.cp_two_street_landmark, cmircpt.cp_two_ward_gp, cmircpt.cp_two_state, state_master_description(cmircpt.cp_two_state) AS cp_two_state_name, district_location_master_description(cmircpt.cp_two_district) AS cp_two_district, block_location_master_description(cmircpt.cp_two_block) AS cp_two_block, cmircpt.cp_two_pin_code, cmircpt.cp_two_police_station, cmircpt.cp_two_phone_no, gender_master_description(cmircpt.cp_two_gender) AS cp_two_gender_value, cmircpt.cp_two_gender AS cp_two_gender, cmircpt.cp_two_social_category AS cp_two_social_category, cmircpt.cp_two_religion AS cp_two_religion, cmircpt.cp_two_dob, cmircpt.cp_two_dob_document_available, cmircpt.cp_two_dob_document_id, cmircpt.cp_two_dob_document_type AS cp_two_dob_document_type, cmircpt.cp_two_identity_document_available, cmircpt.cp_two_identity_document_id, cmircpt.cp_two_identity_document_type AS cp_two_identity_document_type, cmircpt.cp_two_highest_educational_attainment AS cp_two_highest_educational_attainment, cmircpt.cp_two_father_name, cmircpt.cp_two_father_mobile_no, cmircpt.cp_two_father_id, cmircpt.cp_two_father_id_type, cmircpt.cp_two_father_alive, cmircpt.cp_two_mother_name, cmircpt.cp_two_mother_mobile_no, cmircpt.cp_two_mother_id, cmircpt.cp_two_mother_id_type, cmircpt.cp_two_mother_alive, cmircpt.cp_two_district AS cp_two_district_id, cmircpt.cp_two_block AS cp_two_block_id, cmircpt.cp_two_is_home_visit, cmircpt.cp_two_is_followup_visit, cmircpt.cp_two_address FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk LEFT JOIN cm_incident_report_contracting_party_two AS cmircpt ON cmir.incident_id_pk = cmircpt.incident_id_fk WHERE cmir.incident_date BETWEEN '$start_date' AND '$end_date' AND $where")->result();
        // print_r($this->db->last_query());die;
        return $query;

    }
    
    public function delete_incident_list($incident_id)
    {
        $upload = array(
            'delete_status' => 1
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $upload);
    }
    
    public function us_date_format($uk_date=NULL)
    {
       if($uk_date != NULL){
          $date_array = explode('/', $uk_date);
          return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
       } else {
          return NULL;
       }
    }
}
?>
