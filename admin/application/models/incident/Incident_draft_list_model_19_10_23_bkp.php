<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_draft_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function incident_draft_list_reporting_details()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $query = $this->db->query("SELECT cmir.stake_holder_id_fk, cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark, cmir.ward_gp, cmir.state, cmir.district, cmir.block, district_location_master_description(cmir.district) AS incident_district, block_location_master_description(cmir.block) AS incident_block, cmir.pin_code, cmir.police_station, marriage_details_master_description(cmir.marriage_details) AS marriage_details, cmir.cp_one_age, cmir.cp_two_age, prevented_master_description(cmir.prevented_details) AS prevented_details, location_description_master_description(cmir.location_description) AS location_description, cmir.anonymous, cmir.identity_known_name, cmir.identity_street_landmark, cmir.identity_ward_gp, cmir.identity_state, district_location_master_description(cmir.identity_district) AS identity_district, block_location_master_description(cmir.identity_block) AS identity_block, cmir.identity_pin_code, cmir.identity_police_station, cmir.identity_phone_no, information_received_master_description(cmir.information_received) AS information_received, cmir.forward_status, cmir.publish_status, cmir.deo_cp_one_stake_id_fk, cmir.deo_cp_two_stake_id_fk, cmir.home_visit_minor_status, cmir.home_visit_adult_status, cmir.follow_up_visit_status, cmir.reporting_id, cmir.incident_draft_status, cmircpo.cp_one_name, cmircpo.cp_one_street_landmark, cmircpo.cp_one_ward_gp, cmircpo.cp_one_state, district_location_master_description(cmircpo.cp_one_district) AS cp_one_district, block_location_master_description(cmircpo.cp_one_block) AS cp_one_block, cmircpo.cp_one_pin_code, cmircpo.cp_one_police_station, cmircpo.cp_one_phone_no, gender_master_description(cmircpo.cp_one_gender) AS cp_one_gender, social_category_master_description(cmircpo.cp_one_social_category) AS cp_one_social_category, religion_master_description(cmircpo.cp_one_religion) AS cp_one_religion, cmircpo.cp_one_dob, cmircpo.cp_one_dob_document_available, cmircpo.cp_one_dob_document_id, docyment_type_master_description(cmircpo.cp_one_identity_document_type) AS cp_one_dob_document_type, cmircpo.cp_one_identity_document_available, cmircpo.cp_one_identity_document_id, docyment_type_master_description(cmircpo.cp_one_identity_document_type) AS cp_one_identity_document_type, highest_educational_attainment_master_description(cmircpo.cp_one_highest_educational_attainment) AS cp_one_highest_educational_attainment, cmircpo.cp_one_father_name, cmircpo.cp_one_father_mobile_no, cmircpo.cp_one_father_id, cmircpo.cp_one_father_id_type, cmircpo.cp_one_father_alive, cmircpo.cp_one_mother_name, cmircpo.cp_one_mother_mobile_no, cmircpo.cp_one_mother_id, cmircpo.cp_one_mother_id_type, cmircpo.cp_one_mother_alive, cmircpo.cp_one_district AS cp_one_district_id, cmircpo.cp_one_block AS cp_one_block_id, cmircpo.cp_one_address, cmircpt.cp_two_name, cmircpt.cp_two_street_landmark, cmircpt.cp_two_ward_gp, cmircpt.cp_two_state, district_location_master_description(cmircpt.cp_two_district) AS cp_two_district, block_location_master_description(cmircpt.cp_two_block) AS cp_two_block, cmircpt.cp_two_pin_code, cmircpt.cp_two_police_station, cmircpt.cp_two_phone_no, gender_master_description(cmircpt.cp_two_gender) AS cp_two_gender, social_category_master_description(cmircpt.cp_two_social_category) AS cp_two_social_category, religion_master_description(cmircpt.cp_two_religion) AS cp_two_religion, cmircpt.cp_two_dob, cmircpt.cp_two_dob_document_available, cmircpt.cp_two_dob_document_id, docyment_type_master_description(cmircpt.cp_two_dob_document_type) AS cp_two_dob_document_type, cmircpt.cp_two_identity_document_available, cmircpt.cp_two_identity_document_id, docyment_type_master_description(cmircpt.cp_two_identity_document_type) AS cp_two_identity_document_type, highest_educational_attainment_master_description(cmircpt.cp_two_highest_educational_attainment) AS cp_two_highest_educational_attainment, cmircpt.cp_two_father_name, cmircpt.cp_two_father_mobile_no, cmircpt.cp_two_father_id, cmircpt.cp_two_father_id_type, cmircpt.cp_two_father_alive, cmircpt.cp_two_mother_name, cmircpt.cp_two_mother_mobile_no, cmircpt.cp_two_mother_id, cmircpt.cp_two_mother_id_type, cmircpt.cp_two_mother_alive, cmircpt.cp_two_district AS cp_two_district_id, cmircpt.cp_two_block AS cp_two_block_id, cmircpt.cp_two_address FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk LEFT JOIN cm_incident_report_contracting_party_two AS cmircpt ON cmir.incident_id_pk = cmircpt.incident_id_fk WHERE ((cmir.incident_draft_status =1 AND cmir.stake_holder_id_fk = $stake_holder_id_fk AND cmir.delete_status = 0)) ORDER BY incident_id_pk DESC")->result();
        // print_r($this->db->last_query());die;
        return $query;
    }

    public function delete_incident_draft_list($incident_id)
    {
        $upload = array(
            'delete_status' => 1
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $upload);
    }    
}
?>
