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

        $subdiv = $this->session->userdata('subdiv');

        // echo 123;die;
        if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
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
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
            FROM cm_incident_report inc
            LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            AND cp1.cp_type = 1
            LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            AND cp2.cp_type = 2
            WHERE incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            LEFT JOIN cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block = '".$block."' AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block = '".$block."' AND cmir.current_status in(3,4))

                    OR (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.current_status in(1) AND cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            )")->result();
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
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
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address,cp1.cp_district as cp1_dist, cp2.cp_district as cp2_dist, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
            FROM cm_incident_report inc
            LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            AND cp1.cp_type = 1
            LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            AND cp2.cp_type = 2
            where incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' and cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    
                    OR (cmir.district = '".$district."' and cmir.current_status in(1) and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                )
            ) ORDER BY inc.incident_id_pk DESC")->result();
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($district != ''){
                $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
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
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status !=1 and
                    (
                        (cmir.district = '".$district."' and cmir.current_status in(1,2,3,4)) 

                        OR (cmircpo.cp_district = '".$district."' and cmir.current_status in(3,4))
                    )
                )")->result();
             }elseif($district == ''){
                $query = $this->db->query("SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
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
                cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
                from cm_incident_report inc
                left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
                and cp1.cp_type = 1
                left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
                and cp2.cp_type = 2
                where incident_id_pk in(
                SELECT incident_id_pk FROM cm_incident_report AS cmir
                LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
                WHERE cmir.delete_status = '0' and cmir.current_status !=1 and cmir.current_status in(1,2,3,4))")->result();
             }
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("SELECT block_master.rural_urban, inc.stake_holder_id_fk, inc.incident_id_pk, inc.marriage_date, inc.incident_date, inc.street_landmark, inc.ward_gp,
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
            district_location_master_description(cp1.cp_district) AS cp_1_district,cp1.cp_district as cp1_dist,cp2.cp_district as cp2_dist,
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
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
            FROM cm_incident_report inc
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
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(3,4))
                )
            )")->result();
        }
        //print_r($this->db->last_query());die;
        return $query;
    }
    
    public function forward_reporting_details_update_old($incident_id)
    {
        // $data = array(
        //   'forward_status' => 102
        // );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', array("current_status" => 2));

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

    public function publish_incident_reporting_details_update_old($incident_id)
    {
        $cp_one_query = $this->db->select('cp1.cp_district, cp1.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp1')
            ->join('rp_location_master_block as lmb', 'cp1.cp_district = lmb.district_id_fk AND cp1.cp_block = lmb.block_id_pk')
            ->where('cp1.incident_id_fk' , $incident_id)
            ->where('cp1.cp_type' , 1)
            ->get()->row();

            // print_r($this->db->last_query());die;



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

        $cp_two_query = $this->db->select('cp2.cp_district, cp2.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp2')
            ->join('rp_location_master_block as lmb', 'cp2.cp_district = lmb.district_id_fk AND cp2.cp_block = lmb.block_id_pk')
            ->where('cp2.incident_id_fk' , $incident_id)
            ->where('cp2.cp_type' , 2)
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

        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', array("current_status" => 3));

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
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', array("current_status" => 4));

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
            WHERE cmir.incident_date BETWEEN '$start_date' AND '$end_date' and cmir.delete_status = '0' and cmir.created_at is not null and
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
            WHERE cmir.incident_date BETWEEN '$start_date' AND '$end_date' and cmir.delete_status = '0' and cmir.created_at is not null and
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
                WHERE cmir.incident_date BETWEEN '$start_date' AND '$end_date' and cmir.delete_status = '0' and cmir.created_at is not null and
                    (
                        (cmir.district = '".$district."' and cmir.current_status in(2,3,4)) 

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
                WHERE cmir.incident_date BETWEEN '$start_date' AND '$end_date' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status in(2,3,4))")->result();
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

            WHERE cmir.incident_date BETWEEN '$start_date' and '$end_date' and cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND block_master.rural_urban ='U') AND cmir.current_status in(3,4))
                )
            )")->result();
        }
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


    public function incident_list_reporting_details_by_incident_id($incident_id_pk)
    {   
        
        $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp, inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district, block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station, inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details, inc.location_description AS location_description, inc.anonymous, inc.identity_known_name, inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id, inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district, block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code, inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received, inc.reporting_id, inc.cp_two_is_available, inc.current_status,inc.delete_status, inc.created_at, cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name, district_location_master_description(cp1.cp_district) AS cp_1_district,block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id, cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station,cp1.cp_phone_no as cp_1_phone_no, gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender, cp1.cp_age as cp_1_age,cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion, cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available,cp1.cp_dob_document_id as cp_1_dob_document_id, cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type, cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment,cp1.cp_father_name as cp_1_father_name, cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type,cp1.cp_father_alive as cp_1_father_alive, cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id,cp1.cp_mother_id_type as cp_mother_id_type, cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address, cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type,cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark, cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,district_location_master_description(cp2.cp_district) AS cp_2_district, block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no, gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion, cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available,cp2.cp_dob_document_id as cp_2_dob_document_id, cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available, cp2.cp_identity_document_id as cp_2_identity_document_id,cp2.cp_identity_document_type AS cp_2_identity_document_type, cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address from cm_incident_report inc left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk and cp1.cp_type = 1 left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk and cp2.cp_type = 2 where inc.incident_id_pk=".$incident_id_pk)->row();
        //echo $this->db->last_query();die();
        return $query;
    }

    public function forward_reporting_details_update($incident_id)
    {
        $stake_holder_login_id = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');

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
            $forward_to_stake_id_fk = 6;
        }else{
             $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.block' , $query->block)
            ->where('shl.stake_id_fk' , 2)
            ->get()->row();
            $forward_to_stake_id_fk = 2;
        }
        $updateData['forward_by_ip'] = $_SERVER['REMOTE_ADDR'];
        $updateData['forward_by'] = $stake_holder_login_id;
        $updateData['forward_date'] = 'now()';
        $updateData['forward_by_stake_id_fk'] = $stake_id_fk;
        $updateData['forward_to_stake_id_fk'] = $forward_to_stake_id_fk;
        $updateData['forward_to'] = $query_2->stake_holder_login_id_pk;
        $updateData['current_status'] = 2;
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
        $this->db->trans_start();
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report',$updateData);
        $insert_forward_track_details = $this->db->affected_rows();
        $this->db->insert('cm_notification_details', $uploaded_notification_details);
        $insert_cm_notification_status = $this->db->affected_rows();
        $uploaded_forward_track_details = array(
          'incident_id_fk' => $incident_id,
          'deo_stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
          'bdo_sdo_stake_id_fk' => $query_2->stake_holder_login_id_pk,
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        $this->db->insert('cm_incident_report_forward_tracks_details', $uploaded_forward_track_details);
        $cm_incident_report_forward_tracks_status = $this->db->affected_rows();
        if($insert_forward_track_details>0 && $insert_cm_notification_status>0 && $cm_incident_report_forward_tracks_status>0){
            $this->db->trans_commit();
            return 1;
        }else{
            $this->db->trans_rollback();
            return 0;
        }

    }

    public function publish_incident_reporting_details_update($incident_id)
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
        if($stake_id_fk==3){
            $updateData['forward_by_ip'] = $_SERVER['REMOTE_ADDR'];
            $updateData['forward_to'] = $stake_holder_login_id_pk;
            $updateData['forward_date'] = 'now()';
            $updateData['forward_to_stake_id_fk'] = $stake_holder_login_id_pk;
            $updateData['publish_by_ip'] = $_SERVER['REMOTE_ADDR'];
            $updateData['publish_by'] = $stake_id_fk;
            $updateData['publish_date'] = 'now()';
            $updateData['publish_by_stake_id_fk'] = $stake_holder_login_id_pk;
            $updateData['current_status'] = 3;
        }else{
            $updateData['publish_by_ip'] = $_SERVER['REMOTE_ADDR'];
            $updateData['publish_by'] = $stake_id_fk;
            $updateData['publish_date'] = 'now()';
            $updateData['publish_by_stake_id_fk'] = $stake_holder_login_id_pk;
            $updateData['current_status'] = 3;
        }
        $cp_one_query = $this->db->select('cp1.cp_district, cp1.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp1')
            ->join('rp_location_master_block as lmb', 'cp1.cp_district = lmb.district_id_fk AND cp1.cp_block = lmb.block_id_pk')
            ->where('cp1.incident_id_fk' , $incident_id)
            ->where('cp1.cp_type' , 1)
            ->get()->row();

            // print_r($this->db->last_query());die;

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

        $cp_two_query = $this->db->select('cp2.cp_district, cp2.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp2')
            ->join('rp_location_master_block as lmb', 'cp2.cp_district = lmb.district_id_fk AND cp2.cp_block = lmb.block_id_pk')
            ->where('cp2.incident_id_fk' , $incident_id)
            ->where('cp2.cp_type' , 2)
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
        $incident_report = $this->db->select('reporting_id')
            ->from('cm_incident_report')
            ->where('incident_id_pk' , $incident_id)
            ->get()->row();
        $this->db->trans_start();
        
        $this->db->insert('cm_incident_report_publish_track_details', $uploaded_incident_publish_track_details);
        $insert_publish_track_details = $this->db->affected_rows();

        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $updateData);
        $update_incident_report_status = $this->db->affected_rows();

        $stake_id_array = array($cp_one_result_data, $cp_two_result_data);
        

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
                $this->db->insert('cm_notification_details', $uploaded_notification_details);
                $insert_cm_notification_status = $this->db->affected_rows();
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
            $this->db->insert('cm_notification_details', $uploaded_notification_details);
            $insert_cm_notification_status = $this->db->affected_rows();
        }
        if($insert_publish_track_details>0 && $update_incident_report_status>0 && $insert_cm_notification_status>0){
            $this->db->trans_commit();
            return 1;
        }else{
            $this->db->trans_rollback();
            return 0;
        }
    }

    public function fu_scheduler($incident_id) {  // created by soumen for create scheduler

    $this->db->select(' inc.stake_holder_id_fk, 
                        inc.incident_id_pk, 
                        inc.incident_date, 
                        inc.reporting_id ,
                        inc.marriage_date, 
                        cp1.cp_dob as cp_1_dob, 
                        cp2.cp_dob as cp_2_dob,
                        cp1.cp_type as cp_1_type, 
                        cp2.cp_type as cp_2_type,
                        cp1.cp_id_pk as cp_1_id_pk,
                        cp2.cp_id_pk AS cp_2_id_pk,
                        cp1.cp_gender as cp1_gender,
                        cp2.cp_gender as cp2_gender,
                        cp1.cp_name as cp_1_name,
                        cp2.cp_name as cp_2_name');
    $this->db->from('cm_incident_report inc');
    $this->db->join('cm_incident_report_contracting_parties AS cp1', 'inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1', 'left');
    $this->db->join('cm_incident_report_contracting_parties AS cp2', 'inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2', 'left');
    $this->db->where('inc.incident_id_pk', $incident_id); // Filter by incident_id_pk

    $query = $this->db->get();
    //echo $this->db->last_query();die;
    return $query->result();
    }

    public function view_scheduler($incident_id,$cp_type)  //created by soumen for view details of scheduler
    { 
    $this->db->select(' 
                        fusc.calculated_date,
                        fusc.fu_names,
                        fusc.scheduler_id,
                        fusc.active_status,
                        fusc.current_status as fusc_current_status, 
                        cp.current_status, 
                        fusc.cp_type, 
                        fusc.reporting_id, 
                        cp.incident_date, 
                        cp1.cp_age as cp_1_age, 
                        cp2.cp_age as cp_2_age, 
                        cp.incident_id_pk, 
                        cp1.cp_id_pk as cp1_id_pk, 
                        cp2.cp_id_pk as cp2_id_pk,
                        cp1.cp_dob as cp1_dob,
                        cp2.cp_dob as cp2_dob');

    $this->db->from('cm_follow_up_visit_minor_scheduler as fusc');
    $this->db->join('cm_incident_report_contracting_parties AS cp1', 'fusc.incident_id = cp1.incident_id_fk AND cp1.cp_type = 1', 'left');
    $this->db->join('cm_incident_report_contracting_parties AS cp2', 'fusc.incident_id = cp2.incident_id_fk AND cp2.cp_type = 2', 'left');
    $this->db->join('cm_incident_report AS cp', 'cp.incident_id_pk = fusc.incident_id ');
    // $this->db->join('cm_incident_report_home_visit AS he', 'CAST(fusc.scheduler_id AS VARCHAR) = he.scheduler_id_fk', 'left'); 
    // $this->db->join('cm_follow_up_visit_details AS fuv', 'CAST(fusc.scheduler_id AS INTEGER) = fuv.scheduler_id_fk', 'left'); 

    $this->db->where('fusc.incident_id', $incident_id);
    $this->db->where('fusc.cp_type', $cp_type);
    //$this->db->where('(he.active_status = 1 OR he.active_status IS NULL)'); // Added condition for he
    //$this->db->where('(fuv.active_status = 1 OR fuv.active_status IS NULL)'); // Added condition for he

    $this->db->order_by('fusc.scheduler_id');

    $query = $this->db->get();
    return $query->result();

    }
    public function insert_date_cp1($row) {  // created by soumen
    // print_r($row);die;   
    $incident_id_pk = $row->incident_id_pk;
    $incident_date = $row->incident_date;
    $marriage_date = $row->marriage_date;
    $reporting_id = $row->reporting_id;
    $cp_1_dob = $row->cp_1_dob;
    $cp_2_dob = $row->cp_2_dob;
    $cp_1_type = $row->cp_1_type;
    $cp_2_type = $row->cp_2_type;
    $cp_1_id_pk = $row->cp_1_id_pk;

    $dob_date = new DateTime($cp_1_dob);
    $today = new DateTime($incident_date);

    $dates_to_insert = [];
    $name = [];
    $a = 1;

    //$eighteen_years_date = $this->calculate_18_years($cp_1_dob);
    

    $cp1_he = $today->modify('+1 days');
    $dates_to_insert[] = $cp1_he->format('Y-m-d');
    $name[] = 0;

    for ($i = 1; $i <= 2; $i++) {
        $yesterday = $today->modify('+14 days');
        if ($this->check_age_limit($dob_date, $yesterday)) {
            $dates_to_insert[] = $yesterday->format('Y-m-d');
            $name[] = $a++;
        } else {
            break; 
        }
    }

    // Step 3: Add dates with a 1-month gap, 11 times
    for ($i = 1; $i <= 11; $i++) {
        $yesterday = $yesterday->modify('+30 days'); //+1 month
        if ($this->check_age_limit($dob_date, $yesterday)) {
            $dates_to_insert[] = $yesterday->format('Y-m-d');
            $name[] = $a++;
        } else {
            break; 
        }
    }

    // Step 4: Add dates with a 3-month gap until age 18
    $eighteen_years = ($dob_date)->modify('+18 years');
     // print_r($eighteen_years);die;
    // print_r($yesterday);die;
    while ($yesterday < $eighteen_years) {
        $yesterday = $yesterday->modify('+90 days');
        //echo $yesterday;
        //if ($this->check_age_limit($dob_date, $yesterday)) {
        if ($eighteen_years > $yesterday ) {
           //echo "if";
            $dates_to_insert[] = $yesterday->format('Y-m-d');
            //$arr = $dates_to_insert[] - 1
            $name[] = $a++;
        } else {
            break;
        }
    }
    //print_r(count($dates_to_insert));
    // echo "<pre>";
//print_r($dates_to_insert);
    for ($i = 0; $i < count($dates_to_insert); $i++) {
        $this->db->insert('cm_follow_up_visit_minor_scheduler', [
            'dob' => $cp_1_dob,
            'calculated_date' => $dates_to_insert[$i],
            'incident_id' =>  $incident_id_pk, // Add a unique ID for each insertion
            'fu_names' => $name[$i],
            'reporting_id' => $reporting_id,
            'cp_type' => $cp_1_type,
            'incident_date' => $incident_date,
            'cp_id_fk' => $cp_1_id_pk
        ]);
          
    }
}

public function insert_date_cp2($row) { // created by soumen
 //print_r($row);//die;   
    $incident_id_pk = $row->incident_id_pk;
    $incident_date = $row->incident_date;
    $marriage_date = $row->marriage_date;
    $reporting_id = $row->reporting_id;
    $cp_1_dob = $row->cp_1_dob;
    $cp_2_dob = $row->cp_2_dob;
    $cp_1_type = $row->cp_1_type;
    $cp_2_type = $row->cp_2_type;
    $cp_2_id_pk = $row->cp_2_id_pk;

    $dob_date2 = new DateTime($cp_2_dob);
    $today = new DateTime($incident_date);

    $dates_to_inserts = [];
    $names = [];
    $as = 1;

    //$eighteen_years_date = $this->calculate_18_years($cp_2_dob);
   
    $cp2_he = $today->modify('+1 days');
    $dates_to_inserts[] = $cp2_he->format('Y-m-d');
    $names[] = 0;

        for ($i = 1; $i <= 2; $i++) {
            $yesterday2 = $today->modify('+14 days');
            if ($this->check_age_limit($dob_date2, $yesterday2)) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d');
                $names[] = $as++;
            } else {
                break;
            }
        }

        // Step 3: Add dates with a 1-month gap, 11 times
        for ($i = 1; $i <= 11; $i++) {
            $yesterday2 = $yesterday2->modify('+30 days');
            if ($this->check_age_limit($dob_date2, $yesterday2)) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d');
                $names[] = $as++;
            } else {
                break;
            }
        }

        // Step 4: Add dates with a 3-month gap until age 18
        $eighteen_years = ($dob_date2)->modify('+18 years');
         // print_r($eighteen_years);die;
        while ($yesterday2 < $eighteen_years) {
            $yesterday2 = $yesterday2->modify('+90 days');
            if ($eighteen_years > $yesterday2) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d');
                $names[] = $as++;
            } else {
               
                break; 
            }
        }

        // Insert dates and names into the database
        for ($i = 0; $i < count($dates_to_inserts); $i++) {
            $this->db->insert('cm_follow_up_visit_minor_scheduler', [
                'dob' => $cp_2_dob,
                'calculated_date' => $dates_to_inserts[$i],
                'incident_id' =>  $incident_id_pk, 
                'fu_names' => $names[$i],
                'reporting_id' => $reporting_id,
                'cp_type' => $cp_2_type,
                'incident_date' => $incident_date,
                'cp_id_fk' => $cp_2_id_pk
            ]);   
        }
      //echo $this->db->last_query();
}

    private function check_age_limit($dob_date, $current_date) {
        $age = $dob_date->diff($current_date)->y;
        //echo $age;die();
        return $age < 18;
    }

    public function update_schd_status_inc_table($incident_id)
    {
        $cur_date = date('Y-m-d H:i:s');
        $query = $this->db->query("UPDATE cm_incident_report SET schd_status=1 , schd_generated_date= '".$cur_date."'  WHERE incident_id_pk = '".$incident_id."' ");
        // echo $this->db->last_query();die;
        return $query;
    }

}
?>
