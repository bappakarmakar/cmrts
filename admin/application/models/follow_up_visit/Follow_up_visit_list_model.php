<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function revertback_follow_up_isit_details($data = array(),$where=array())
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_follow_up_visit_details');

        // echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }
    public function follow_up_visits_details_update($data = array(),$where=array())
    {

        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_follow_up_visit_details');
        // echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }
    public function follow_up_visit_details_by_id($sl_no){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('*')
        ->from('cm_follow_up_visit_details')
        ->where(array('sl_no'=>$sl_no))
        ->get()->row();
        return $query;
    }
    public function update_scheduler_fu_publish($scheduler_id_fk) // ADDED BY SOUMEN
    {
        $this->db->set('active_status',1);
        $this->db->set('current_status',3);
        $this->db->where('scheduler_id',$scheduler_id_fk);
        $this->db->update('cm_follow_up_visit_minor_scheduler');
        return $this->db->affected_rows();

    }
    public function follow_up_visits_details_update_scheduler($data = array(),$where=array()) // ADDED BY SOUMEN
    {

        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_follow_up_visit_minor_scheduler');
        // echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }

    public function follow_up_visits_list_details_bak()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
            district_location_master_description(cp1.cp_district) AS cp_1_district,
            block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
            cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
            gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
            cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
            cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
            cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
            cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
            cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
            cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
            cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


            from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.entry_by=$stake_holder_id_fk order by follow.sl_no DESC")->result();
        return $query;
    }
    

    public function follow_up_visits_list_details_btndate_bak($start_date = null,$end_date = null)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
            district_location_master_description(cp1.cp_district) AS cp_1_district,
            block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
            cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
            gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
            cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
            cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
            cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
            cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
            cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
            cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
            cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


            from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.entry_by=$stake_holder_id_fk and inc.incident_date between '$start_date' and '$end_date' order by follow.sl_no DESC")->result();

        // echo $this->db->last_query();
        return $query;
    }




    public function follow_up_visits_list_details()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');

        if($this->session->userdata('stake_id_fk')==4)
        {
            $query = $this->db->query("SELECT follow.revert_reason, cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup, inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant, follow.stage_of_pregnancy, follow.remarks, follow.paid_work_frequency, follow.fv_status, follow.sl_no as follow_up_sl_no, follow.revert_time, follow.scheduler_id_fk, follow.cp_type, follow.incident_id_fk


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.entry_by=$stake_holder_id_fk order by follow.sl_no DESC")->result();
            return $query;
        }

        elseif ($this->session->userdata('stake_id_fk')==2) 
        {
            $query = $this->db->query("SELECT follow.revert_reason, cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup, inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no, follow.scheduler_id_fk, follow.cp_type, follow.incident_id_fk


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk WHERE follow.active_status = 1 and follow.fv_status in(2,3,4) AND cp1.cp_block = $block  ORDER BY follow.cp_id_fk")->result();
            return $query;
        }

        elseif ($this->session->userdata('stake_id_fk')==5 || $this->session->userdata('stake_id_fk')==1 || $this->session->userdata('stake_id_fk')==3) 
        {
            if($district !='')
            {
                $query = $this->db->query("SELECT follow.revert_reason, cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.fv_status in(3) AND cp1.cp_district = $district order by follow.sl_no DESC")->result();
                return $query;

            }
            else
            {
                $query = $this->db->query("SELECT follow.revert_reason, cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.fv_status in(3) order by follow.sl_no DESC")->result();
            return $query;


            }
        }elseif ($this->session->userdata('stake_id_fk')==6){
            $subdiv = $this->session->userdata('subdiv');
            $query = $this->db->query("SELECT follow.revert_reason, cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,district_location_master_description(cp1.cp_district) AS cp_1_district,block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no,follow.scheduler_id_fk, follow.cp_type, follow.incident_id_fk

                FROM cm_follow_up_visit_details AS follow LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON follow.incident_id_fk = cp1.incident_id_fk AND follow.cp_type = cp1.cp_type LEFT JOIN public.cm_incident_report AS inc ON follow.incident_id_fk = inc.incident_id_pk LEFT JOIN rp_location_master_block AS block on cp1.cp_block=block.block_id_pk WHERE follow.active_status = 1 and follow.fv_status in(2,3,4) AND block.subdiv_id_fk = $subdiv AND rural_urban='U'  ORDER BY follow.cp_id_fk")->result();
            return $query;
        }else{
            return array();
        }
    }



    public function follow_up_visits_list_details_btndate($start_date = null,$end_date = null)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');

        if($this->session->userdata('stake_id_fk')==4)
        {
            $query = $this->db->query("SELECT follow.revert_reason,cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.entry_by=$stake_holder_id_fk and inc.incident_date between '$start_date' and '$end_date' order by follow.sl_no DESC")->result();
            return $query;
        }

        elseif ($this->session->userdata('stake_id_fk')==2) 
        {
            $query = $this->db->query("SELECT follow.revert_reason,cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk WHERE follow.active_status = 1 and follow.fv_status in(2,3,4) AND cp1.cp_block = $block and inc.incident_date between '$start_date' and '$end_date' ORDER BY follow.cp_id_fk")->result();
            return $query;
        }

        elseif ($this->session->userdata('stake_id_fk')==5 || $this->session->userdata('stake_id_fk')==1 || $this->session->userdata('stake_id_fk')==3) 
        {
            if($district !='')
            {
                $query = $this->db->query("SELECT follow.revert_reason,cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.fv_status in(3) AND cp1.cp_district = $district and inc.incident_date between '$start_date' and '$end_date' order by follow.sl_no DESC")->result();
                return $query;

            }
            else
            {
                $query = $this->db->query("SELECT follow.revert_reason,cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
                district_location_master_description(cp1.cp_district) AS cp_1_district,
                block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
                cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
                gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
                cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
                cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
                cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
                cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
                cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
                cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
                cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no


                from cm_follow_up_visit_details as follow join cm_incident_report inc ON inc.incident_id_pk = follow.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON follow.cp_id_fk=cp1.cp_id_pk where follow.active_status = 1 and follow.fv_status in(3) and inc.incident_date between '$start_date' and '$end_date' order by follow.sl_no DESC")->result();
            return $query;


            }
        }elseif ($this->session->userdata('stake_id_fk')==6) {
            $subdiv = $this->session->userdata('subdiv');
            $query = $this->db->query("SELECT follow.revert_reason,cp1.cp_district,district_location_master_description(cp1.cp_district) AS cp_district_name,cp1.cp_block,block_location_master_description(cp1.cp_block) AS cp_block_name,follow.followup_date,follow.age_on_folllowup,inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,district_location_master_description(cp1.cp_district) AS cp_1_district,block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,follow.mode_of_enquiry,follow.gender as follow_gender,follow.education as follow_education,follow.kishori_group,follow.paid_work,follow.education_frequency,follow.kishori_group_frequency,follow.parents_supported,follow.family_elders_supported,follow.peers_supported,follow.neighbours_supported,follow.others_supported,follow.minor_pregnant,follow.stage_of_pregnancy,follow.remarks,follow.paid_work_frequency,follow.fv_status,follow.sl_no as follow_up_sl_no FROM cm_follow_up_visit_details AS follow LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON follow.incident_id_fk = cp1.incident_id_fk AND follow.cp_type = cp1.cp_type LEFT JOIN public.cm_incident_report AS inc ON follow.incident_id_fk = inc.incident_id_pk LEFT JOIN rp_location_master_block AS block on cp1.cp_block=block.block_id_pk WHERE follow.active_status = 1 and follow.fv_status in(2,3,4) AND block.subdiv_id_fk = $subdiv AND rural_urban='U' AND inc.incident_date between '$start_date' and '$end_date'   ORDER BY follow.cp_id_fk")->result();
            return $query;

        }else{
            return array();
        }
    }
}
?>
