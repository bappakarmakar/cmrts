<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_downloads_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function cm_incident_id_by_reporting_id($reporting_id){
        $query = $this->db->select('incident_id_pk')
            ->from('cm_incident_report')
            ->where('reporting_id', $reporting_id)
            ->get()->row();
        return ($query)?$query->incident_id_pk:'';    
    }
    public function cm_incident_report_officials_involved_details($incident_id){
        $query = $this->db->select('sl_no as officials_involved_sl_no,official_involved_name as official_involved_name,officials_involved_designation as officials_involved_designation,officials_involved_office as officials_involved_office,officials_involved_contact_no as officials_involved_contact_no')
            ->from('cm_incident_report_officials_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result_array();
        if(empty($query)){
            $result = array();
        }else{
           $result = $query;
        }
        return $result;
    }
    public function cm_incident_report_local_persons_involved_details($incident_id){
        $query = $this->db->select('sl_no as local_person_sl_no,local_person_name as local_person_name,local_person_gender as local_person_gender,local_person_occupation_identity as local_person_occupation_identity')
            ->from('cm_incident_report_local_persons_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result_array();
        if(empty($query)){
            $result = array();
        }else{
           $result = $query;
        }
        return $result;
    }
    public function district_details($login_id)
    {
         if($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->select('shl.district, shl.subdiv, district_location_master_description(shl.district) AS district_name, subdiv_location_master_description(shl.subdiv) AS subdiv_name')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.login_id', $login_id)
            ->get();
         }else{
            $query = $this->db->select('shl.district, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, subdiv_location_master_description(shl.subdiv) AS subdiv_name')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.login_id', $login_id)
            ->get();
         }
        return $query->result_array();
    }
    public function incident_list_download_excel()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');

        $district = $this->session->userdata('district');

        $block = $this->session->userdata('block');

        $subdiv = $this->session->userdata('subdiv');

        if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2
            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            left join cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block = '".$block."' AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block = '".$block."' AND cmir.current_status in(3,4))

                    OR (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(1) AND cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            )")->result();
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2
            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' and cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    
                    OR (cmir.district = '".$district."' and cmir.current_status in(1) and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            )")->result();
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($district != ''){
                $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
                cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
                cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
                cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
                district_location_master_description(cp2.cp_district) AS cp_2_district,
                block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
                cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
                gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
                cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
                cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
                cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
                cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
                cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
                cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
                cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status!=1 and
                    (
                        (cmir.district = '".$district."' and cmir.current_status in(1,2,3,4)) 

                        OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    )
                )")->result();
             }elseif($district == ''){
                $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
                cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
                cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
                cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
                district_location_master_description(cp2.cp_district) AS cp_2_district,
                block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
                cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
                gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
                cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
                cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
                cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
                cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
                cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
                cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
                cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status!=1 and cmir.current_status in(1,2,3,4))")->result();
             }
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("select block_master.rural_urban, inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2

            left join rp_location_master_block as block_master on inc.block = block_master.block_id_pk

            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            left join cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk

            

            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(3,4))
                )
            )")->result();
        }
        // print_r($this->db->last_query());die;
        return $query;
    }

    public function incident_list_download_btwndate_excel($start_date,$end_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');

        $district = $this->session->userdata('district');

        $block = $this->session->userdata('block');

        $subdiv = $this->session->userdata('subdiv');

        if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2
            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            left join cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and cmir.incident_date between '".$start_date."' and '".$end_date."' and
                (
                    (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block = '".$block."' AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block = '".$block."' AND cmir.current_status in(3,4))

                    OR (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(1) AND cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            )")->result();
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2
            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and cmir.incident_date between '".$start_date."' and '".$end_date."' and
                (
                    (cmir.district = '".$district."' and cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    
                    OR (cmir.district = '".$district."' and cmir.current_status in(1) and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            )")->result();
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($district != ''){
                $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
                cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
                cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
                cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
                district_location_master_description(cp2.cp_district) AS cp_2_district,
                block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
                cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
                gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
                cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
                cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
                cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
                cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
                cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
                cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
                cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status!=1 and cmir.incident_date between '".$start_date."' and '".$end_date."' and
                    (
                        (cmir.district = '".$district."' and cmir.current_status in(1,2,3,4)) 

                        OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    )
                )")->result();
             }elseif($district == ''){
                $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
                inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
                block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
                inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
                inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
                inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
                inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
                block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
                inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
                inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
                cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
                cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
                cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
                cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
                cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
                district_location_master_description(cp2.cp_district) AS cp_2_district,
                block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
                cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
                gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
                cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
                cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
                cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
                cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
                cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
                cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
                cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status!=1 and cmir.incident_date between '".$start_date."' and '".$end_date."' and cmir.current_status in(1,2,3,4))")->result();
             }
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("select block_master.rural_urban, inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
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
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address
            from cm_incident_report inc
            left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            and cp1.cp_type = 1
            left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            and cp2.cp_type = 2

            left join rp_location_master_block as block_master on inc.block = block_master.block_id_pk

            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            left join cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk

            

            WHERE cmir.delete_status = '0' and cmir.incident_date between '".$start_date."' and '".$end_date."' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cmir.current_status in(3,4))
                )
            )")->result();
        }
        // print_r($this->db->last_query());die;
        return $query;
    }


    public function incident_download_details($incident_id)
    {
        
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,inc.identity_district AS identity_district_id,block_location_master_description(inc.identity_block) AS identity_block,inc.identity_block AS identity_block_id, inc.identity_pin_code,inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,inc.reporting_id, inc.cp_two_is_available, inc.current_status,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,district_location_master_description(cp1.cp_district) AS cp_1_district,cp1.cp_district AS cp_1_district_id,block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,cp1.cp_address AS cp_1_address,cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_1_mother_id_type,cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,district_location_master_description(cp2.cp_district) AS cp_2_district,cp2.cp_district AS cp_2_district_id,cp2.cp_address as cp_2_address,block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address from cm_incident_report inc left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk and cp1.cp_type = 1 left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk and cp2.cp_type = 2 where incident_id_pk in( SELECT incident_id_pk FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk WHERE(cmir.incident_id_pk = '$incident_id' ))")->result_array();
                if(empty($query)){
                    $result = array();
                }else{
                    $result = $query[0];
                }
                return $result;
    }

    public function get_document_type_details()
    {

        $this->db->select('cm_document_type_master_master_id_pk, description');
        $this->db->from('cm_document_type_master');
        $this->db->where('active_status=1');
        $query = $this->db->get();
        return $query->result();
    }
}
?>
