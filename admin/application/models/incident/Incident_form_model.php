<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    
    public function insert_incident_reporting_details($max_child_id)
    {


        // Incident Details
        $uploaded_incident_details = array(
            'reporting_id' => $max_child_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'identity_known_name' => $this->input->post('identity_known_name'),
            'identity_street_landmark' => $this->input->post('identity_street_landmark'),
            'identity_ward_gp' => $this->input->post('identity_ward_gp'),
            'identity_state' => 19,
            'identity_district' => empty($this->input->post('identity_district'))? NULL : $this->input->post('identity_district'),
            'identity_block' => empty($this->input->post('identity_block'))? NULL : $this->input->post('identity_block'),
            'identity_pin_code' => $this->input->post('identity_pin_code'),
            'identity_police_station' => $this->input->post('identity_police_station'),
            'identity_phone_no' => $this->input->post('identity_phone_no'),
            'information_received' => $this->input->post('information_received'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'delete_status' => 0,
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'current_status' => 1,
            'stake_id_fk' => $this->session->userdata('stake_id_fk'),
            'inc_first_created_date' => 'now()'
        );
        // if($this->session->userdata('stake_id_fk') == '3'){
        //     $status = array(
        //         'current_status' => 2 
        //     );
        // }elseif($this->session->userdata('stake_id_fk') == '4'){
        //     $status = array(
        //         'current_status' => 1 
        //     );
        // }elseif($this->session->userdata('stake_id_fk') == '2'){
        //     $status = array(
        //         'current_status' => 2 
        //     );
        // }

        // $uploaded_incident_details_data = array_merge($uploaded_incident_details, $status);

        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details);

        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
            $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
            if($local_person_name != '' && $local_person_gender != '' && $local_person_occupation_identity != ''){
                $uploaded_local_persons_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'local_person_name' => $local_person_name,
                    'local_person_gender' => $local_person_gender,
                    'local_person_occupation_identity' => $local_person_occupation_identity,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
                $result2 = $this->db->insert('cm_incident_report_local_persons_involved_details', $uploaded_local_persons_involved_details);
            }      
        }

        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key => $OfficialPersonsValue){
            $official_involved_name = $OfficialPersonsValue['official_involved_name'];
            $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
            $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
            $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
            if($official_involved_name != '' && $officials_involved_designation != '' && $officials_involved_office != '' && $officials_involved_contact_no != ''){
                $uploaded_officials_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'official_involved_name' => $official_involved_name,
                    'officials_involved_designation' => $officials_involved_designation,
                    'officials_involved_office' => $officials_involved_office,
                    'officials_involved_contact_no' => $officials_involved_contact_no,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
            $result3 = $this->db->insert('cm_incident_report_officials_involved_details', $uploaded_officials_involved_details);    
            }
        }

        // Contracting Party One Details
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');

        $uploaded_cp_one_details = array(
            'reporting_id' => $max_child_id,
            'incident_id_fk' => $last_inst_id,
            'cp_type' => 1,
            'cp_name' => $cp_one_name,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );

        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => $this->input->post('cp_one_district'),
                'cp_block' => $this->input->post('cp_one_block'),
                'cp_ward_gp' => $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }

        $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_details, $cp_one_address_details);
        $result4 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);

        // Contracting Party Two Details
        if($this->input->post('cp_two_is_available') == '1'){
            
            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
            $uploaded_cp_two_details = array(
                'reporting_id' => $max_child_id,
                'incident_id_fk' => $last_inst_id,
                'cp_type' => 2,
                'cp_name' => $cp_two_name,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive'),
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => $this->input->post('cp_two_district'),
                    'cp_block' => $this->input->post('cp_two_block'),
                    'cp_ward_gp' => $this->input->post('cp_two_ward_gp') 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_details, $cp_two_address_details);
            $result6 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
        }
    }

    public function insert_draft_incident_reporting_details_first($max_child_id)
    {
        // Incident Details
        $uploaded_incident_details = array(
            'reporting_id' => $max_child_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'identity_known_name' => $this->input->post('identity_known_name'),
            'identity_street_landmark' => $this->input->post('identity_street_landmark'),
            'identity_state' => 19,
            'identity_district' =>  empty($this->input->post('identity_district'))? NULL : $this->input->post('identity_district'),
            'identity_block' => empty($this->input->post('identity_block'))? NULL : $this->input->post('identity_block'),
            'identity_ward_gp' => empty($this->input->post('identity_ward_gp'))? NULL : $this->input->post('identity_ward_gp'),
            'identity_pin_code' => $this->input->post('identity_pin_code'),
            'identity_police_station' => $this->input->post('identity_police_station'),
            'identity_phone_no' => $this->input->post('identity_phone_no'),
            'information_received' => $this->input->post('information_received'),
            'delete_status' => 0,
            'current_status' => 1,
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'stake_id_fk' => $this->session->userdata('stake_id_fk'),
            'inc_first_created_date' => 'now()'
            // 'created_at'=>date('Y-m-d H:i:s'),
            // 'created_ip'=>$_SERVER['REMOTE_ADDR']
        );
        $uploaded_incident_details_data = array_merge($uploaded_incident_details);
        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details_data);
        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
            $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
            if($local_person_name != '' && $local_person_gender != '' && $local_person_occupation_identity != ''){
                $uploaded_local_persons_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'local_person_name' => $local_person_name,
                    'local_person_gender' => $local_person_gender,
                    'local_person_occupation_identity' => $local_person_occupation_identity,
                );
              $result2 = $this->db->insert('cm_incident_report_local_persons_involved_details', $uploaded_local_persons_involved_details);   
            }
        }

        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key => $OfficialPersonsValue){
            $official_involved_name = $OfficialPersonsValue['official_involved_name'];
            $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
            $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
            $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
            if($official_involved_name != '' && $officials_involved_designation != '' && $officials_involved_office != '' && $officials_involved_contact_no != ''){
                $uploaded_officials_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'official_involved_name' => $official_involved_name,
                    'officials_involved_designation' => $officials_involved_designation,
                    'officials_involved_office' => $officials_involved_office,
                    'officials_involved_contact_no' => $officials_involved_contact_no,
                );
               $result3 = $this->db->insert('cm_incident_report_officials_involved_details', $uploaded_officials_involved_details);  
            }
        }

        // Contracting Party One Details
        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');

        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');

        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive')
        );

        $uploaded_cp_one_details = array(
            'reporting_id' => $max_child_id,
            'incident_id_fk' => $last_inst_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );

        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }

        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });

        if (!empty($filtered_cp_one_array)) {

            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;

            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            $result4 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
        } 

        

        // Contracting Party Two Details
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $max_child_id,
                'incident_id_fk' => $last_inst_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'),
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                $result6 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
            }
        }
    }

    public function insert_draft_incident_reporting_details_second($max_child_id)
    {
        // Incident Details
        $uploaded_incident_details = array(
            'reporting_id' => $max_child_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'identity_known_name' => $this->input->post('identity_known_name'),
            'identity_street_landmark' => $this->input->post('identity_street_landmark'),
            'identity_ward_gp' => $this->input->post('identity_ward_gp'),
            'identity_state' => 19,
            'identity_district' =>  empty($this->input->post('identity_district'))? NULL : $this->input->post('identity_district'),
            'identity_block' => empty($this->input->post('identity_block'))? NULL : $this->input->post('identity_block'),
            'identity_pin_code' => $this->input->post('identity_pin_code'),
            'identity_police_station' => $this->input->post('identity_police_station'),
            'identity_phone_no' => $this->input->post('identity_phone_no'),
            'information_received' => $this->input->post('information_received'),
            'delete_status' => 0,
            'current_status' => 1,
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'stake_id_fk' => $this->session->userdata('stake_id_fk'),
            'inc_first_created_date' => 'now()'
            // 'created_at'=>date('Y-m-d H:i:s'),
            // 'created_ip'=>$_SERVER['REMOTE_ADDR']
        );
        $uploaded_incident_details_data = array_merge($uploaded_incident_details);
        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details_data);
        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
            $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
            if($local_person_name != '' && $local_person_gender != '' && $local_person_occupation_identity != ''){
                $uploaded_local_persons_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'local_person_name' => $local_person_name,
                    'local_person_gender' => $local_person_gender,
                    'local_person_occupation_identity' => $local_person_occupation_identity,
                );
            $result2 = $this->db->insert('cm_incident_report_local_persons_involved_details', $uploaded_local_persons_involved_details);    
            }
        }

        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key => $OfficialPersonsValue){
            if ( !empty(array_filter($OfficialPersonsValue))) {
                $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                $uploaded_officials_involved_details = array(
                    'incident_id_fk' => $last_inst_id,
                    'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'official_involved_name' => $official_involved_name,
                    'officials_involved_designation' => $officials_involved_designation,
                    'officials_involved_office' => $officials_involved_office,
                    'officials_involved_contact_no' => $officials_involved_contact_no,
                );
                $result3 = $this->db->insert('cm_incident_report_officials_involved_details', $uploaded_officials_involved_details);
            }
        }

        // Contracting Party One Details
        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');

        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');

        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive') 
        );

        $uploaded_cp_one_details = array(
            'reporting_id' => $max_child_id,
            'incident_id_fk' => $last_inst_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );

        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }

        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });

        if (!empty($filtered_cp_one_array)) {
            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;
            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            $result4 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
        } 

        // Contracting Party Two Details
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $max_child_id,
                'incident_id_fk' => $last_inst_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'), 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                $result6 = $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
            }
        }
    }
    #### Biswajit Working Start ######
    public function cm_incident_report_local_persons_involved_details_by_incident_id($reporting_id){
        $incident_query = $this->db->select('incident_id_pk')
            ->from('cm_incident_report')
            ->where('reporting_id', $reporting_id)
            ->get()->row();
        $incident_id = ($incident_query)?$incident_query->incident_id_pk:'';    
        $query = $this->db->select('sl_no')
            ->from('cm_incident_report_local_persons_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result();
        if(empty($query)){
            $sl_no = array();
        }else{
           $sl_no = array_column($query, 'sl_no');
        }

        return $sl_no;
    }
    public function cm_incident_report_local_persons_involved_details($incident_id){
        $query = $this->db->select('sl_no as local_person_sl_no,local_person_name as local_person_name,local_person_gender as local_person_gender,local_person_occupation_identity as local_person_occupation_identity')
            ->from('cm_incident_report_local_persons_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result_array();
        if(empty($query)){
            $result[0] = array("local_person_name" => "","local_person_gender" => "","local_person_occupation_identity" => "","local_person_sl_no" => "");
        }else{
           $result = $query;
        }
        return $result;
    }
    public function cm_incident_report_officials_involved_details_by_incident_id($reporting_id){
        $incident_query = $this->db->select('incident_id_pk')
            ->from('cm_incident_report')
            ->where('reporting_id', $reporting_id)
            ->get()->row();
        $incident_id = ($incident_query)?$incident_query->incident_id_pk:'';    
        $query = $this->db->select('sl_no')
            ->from('cm_incident_report_officials_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result();
        if(empty($query)){
            $sl_no = array();
        }else{
           $sl_no = array_column($query, 'sl_no');
        }

        return $sl_no;
    }
    public function cm_incident_report_officials_involved_details($incident_id){
        $query = $this->db->select('sl_no as officials_involved_sl_no,official_involved_name as official_involved_name,officials_involved_designation as officials_involved_designation,officials_involved_office as officials_involved_office,officials_involved_contact_no as officials_involved_contact_no')
            ->from('cm_incident_report_officials_involved_details')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result_array();
        if(empty($query)){
            $result[0] = array("sl_no" =>0,"official_involved_name" => "","officials_involved_designation" => "","officials_involved_office" => "","officials_involved_contact_no"=>"","officials_involved_sl_no"=>"");
        }else{
           $result = $query;
        }
        return $result;
    }
    


    public function update_incident_reporting_draft_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk, reporting_id')
            ->from('cm_incident_report')
            ->where('reporting_id' , $incident_update_id)
            ->get()->row();
        $incident_id = ($query)?$query->incident_id_pk:'';
        $reporting_id = ($query)?$query->reporting_id:'';

        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_ip'=>$_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('anonymous') == '2'){
            $uploaded_incident_details['identity_known_name'] = $this->input->post('identity_known_name');
            $uploaded_incident_details['identity_street_landmark'] = $this->input->post('identity_street_landmark');
            $uploaded_incident_details['identity_ward_gp'] = $this->input->post('identity_ward_gp');
            $uploaded_incident_details['identity_state'] = 19;
            $uploaded_incident_details['identity_district'] = $this->input->post('identity_district');
            $uploaded_incident_details['identity_block'] = $this->input->post('identity_block');
            $uploaded_incident_details['identity_pin_code'] = $this->input->post('identity_pin_code');
            $uploaded_incident_details['identity_police_station'] = $this->input->post('identity_police_station');
            $uploaded_incident_details['identity_phone_no'] = $this->input->post('identity_phone_no');
            $uploaded_incident_details['information_received'] = $this->input->post('information_received');
        }else{
            $uploaded_incident_details['identity_known_name'] = NULL;
            $uploaded_incident_details['identity_street_landmark'] = NULL;
            $uploaded_incident_details['identity_ward_gp'] = NULL;
            $uploaded_incident_details['identity_state'] = NULL;
            $uploaded_incident_details['identity_district'] = NULL;
            $uploaded_incident_details['identity_block'] = NULL;
            $uploaded_incident_details['identity_pin_code'] = NULL;
            $uploaded_incident_details['identity_police_station'] = NULL;
            $uploaded_incident_details['identity_phone_no'] = NULL;
            $uploaded_incident_details['information_received'] = NULL;
        }
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $uploaded_incident_details);

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        if(!empty($Local_Persons_Involved_Details)){
            foreach($Local_Persons_Involved_Details as $key => $LocalPersonsValue){
                if ( !empty(array_filter($LocalPersonsValue))) {
                    $local_person_name = $LocalPersonsValue['local_person_name'];
                    $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
                    $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                    if(!empty($LocalPersonsValue['local_person_sl_no'])){
                        $sl_no = $LocalPersonsValue['local_person_sl_no'];
                        $updated_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_local_persons_involved_details', $updated_local_persons_involved_details);

                    }else{
                        $insert_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_local_persons_involved_details);
                    }
                }
            }
        }
       
        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        if(!empty($Officials_Involved_Details)){
            foreach($Officials_Involved_Details as $key => $OfficialPersonsValue){
                if ( !empty(array_filter($OfficialPersonsValue))) {
                    $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                    $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                    $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                    $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                    if(!empty($OfficialPersonsValue['officials_involved_sl_no'])){
                        $sl_no = $OfficialPersonsValue['officials_involved_sl_no'];
                        $updated_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_officials_involved_details', $updated_officials_involved_details);
                    }else{
                        $insert_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->insert('cm_incident_report_officials_involved_details', $insert_officials_involved_details);

                    }
                }
            }
        }
        // Contracting Party 1 Details
        $cp_one_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 1)
            ->get()->num_rows();

        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive')
        );
        $uploaded_cp_one_details = array(
            'reporting_id' => $reporting_id,
            'incident_id_fk' => $incident_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }
        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });
        if (!empty($filtered_cp_one_array)) {
            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;
            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            if($cp_one_count_query > 0){
                $update_array = array(
                    "incident_id_fk" => $incident_id,
                    "cp_type" => 1
                );
                $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }else{
                $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }

        } 

        // Contracting Party 2 Details

        $cp_two_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 2)
            ->get()->num_rows();
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $reporting_id,
                'incident_id_fk' => $incident_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'), 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                if($cp_two_count_query > 0){
                    $update_array = array(
                        "incident_id_fk" => $incident_id,
                        "cp_type" => 2
                    );
                    $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }else{
                    $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }
            }
        }
    }
    public function update_incident_reporting_draft_final_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk, reporting_id')
            ->from('cm_incident_report')
            ->where('reporting_id' , $incident_update_id)
            ->get()->row();
        $incident_id = ($query)?$query->incident_id_pk:'';
        $reporting_id = ($query)?$query->reporting_id:'';

        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_ip'=>$_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('anonymous') == '2'){
            $uploaded_incident_details['identity_known_name'] = $this->input->post('identity_known_name');
            $uploaded_incident_details['identity_street_landmark'] = $this->input->post('identity_street_landmark');
            $uploaded_incident_details['identity_ward_gp'] = $this->input->post('identity_ward_gp');
            $uploaded_incident_details['identity_state'] = 19;
            $uploaded_incident_details['identity_district'] = $this->input->post('identity_district');
            $uploaded_incident_details['identity_block'] = $this->input->post('identity_block');
            $uploaded_incident_details['identity_pin_code'] = $this->input->post('identity_pin_code');
            $uploaded_incident_details['identity_police_station'] = $this->input->post('identity_police_station');
            $uploaded_incident_details['identity_phone_no'] = $this->input->post('identity_phone_no');
            $uploaded_incident_details['information_received'] = $this->input->post('information_received');
        }else{
            $uploaded_incident_details['identity_known_name'] = NULL;
            $uploaded_incident_details['identity_street_landmark'] = NULL;
            $uploaded_incident_details['identity_ward_gp'] = NULL;
            $uploaded_incident_details['identity_state'] = NULL;
            $uploaded_incident_details['identity_district'] = NULL;
            $uploaded_incident_details['identity_block'] = NULL;
            $uploaded_incident_details['identity_pin_code'] = NULL;
            $uploaded_incident_details['identity_police_station'] = NULL;
            $uploaded_incident_details['identity_phone_no'] = NULL;
            $uploaded_incident_details['information_received'] = NULL;
        }
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $uploaded_incident_details);

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        if(!empty($Local_Persons_Involved_Details)){
            foreach($Local_Persons_Involved_Details as $key => $LocalPersonsValue){
                if ( !empty(array_filter($LocalPersonsValue))) {
                    $local_person_name = $LocalPersonsValue['local_person_name'];
                    $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
                    $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                    if(!empty($LocalPersonsValue['local_person_sl_no'])){
                        $sl_no = $LocalPersonsValue['local_person_sl_no'];
                        $updated_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_local_persons_involved_details', $updated_local_persons_involved_details);

                    }else{
                        $insert_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_local_persons_involved_details);
                    }
                }
            }
        }
       
        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        if(!empty($Officials_Involved_Details)){
            foreach($Officials_Involved_Details as $key => $OfficialPersonsValue){
                if ( !empty(array_filter($OfficialPersonsValue))) {
                    $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                    $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                    $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                    $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                    if(!empty($OfficialPersonsValue['officials_involved_sl_no'])){
                        $sl_no = $OfficialPersonsValue['officials_involved_sl_no'];
                        $updated_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_officials_involved_details', $updated_officials_involved_details);
                    }else{
                        $insert_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->insert('cm_incident_report_officials_involved_details', $insert_officials_involved_details);

                    }
                }
            }
        }
        // Contracting Party 1 Details
        $cp_one_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 1)
            ->get()->num_rows();

        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive')
        );
        $uploaded_cp_one_details = array(
            'reporting_id' => $reporting_id,
            'incident_id_fk' => $incident_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }
        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });
        if (!empty($filtered_cp_one_array)) {
            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;
            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            if($cp_one_count_query > 0){
                $update_array = array(
                    "incident_id_fk" => $incident_id,
                    "cp_type" => 1
                );
                $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }else{
                $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }

        } 

        // Contracting Party 2 Details

        $cp_two_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 2)
            ->get()->num_rows();
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $reporting_id,
                'incident_id_fk' => $incident_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'), 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                if($cp_two_count_query > 0){
                    $update_array = array(
                        "incident_id_fk" => $incident_id,
                        "cp_type" => 2
                    );
                    $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }else{
                    $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }
            }
        }
        unset($_SESSION['max_child_id']);
    }

    
    public function get_max_child_id($block,$cur_year)
    { 
        $child_code = $block.$cur_year;
        $max_child= $this->db->query("select max(reporting_id) as max_child_id from cm_incident_report where reporting_id like '$child_code%'")->row_array();
        $max_child_id = $max_child['max_child_id'];
        if($max_child_id != ''){
           $max_child_id = $max_child_id + 1;
        }else{
           $max_child_id = $child_code.'00001';
        }
       return $max_child_id ;
    }

    public function edit_incident_reporting_details($incident_id)
    {
        
            $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,inc.identity_district AS identity_district_id,block_location_master_description(inc.identity_block) AS identity_block,inc.identity_block AS identity_block_id, inc.identity_pin_code,inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,inc.reporting_id, inc.cp_two_is_available, inc.current_status,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,district_location_master_description(cp1.cp_district) AS cp_1_district,cp1.cp_district AS cp_1_district_id,block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,cp1.cp_address AS cp_1_address,cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_1_mother_id_type,cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,district_location_master_description(cp2.cp_district) AS cp_2_district,cp2.cp_district AS cp_2_district_id,cp2.cp_address as cp_2_address,block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address from cm_incident_report inc left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk and cp1.cp_type = 1 left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk and cp2.cp_type = 2 where incident_id_pk in( SELECT incident_id_pk FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk WHERE(cmir.incident_id_pk = '$incident_id' ))")->result_array();
                if(empty($query)){
                    $result = array();
                }else{
                    $result = $query[0];
                }
                return $result;
    }

    

    public function incident_details()
    {
        $query = $this->db->select('cmir.incident_id_pk, cmir.incident_date, cmir.street_landmark')
            ->from('cm_incident_report AS cmir')
            ->where('cmir.stake_holder_id_fk', $this->session->userdata('stake_holder_login_id_pk'))
            ->where('cmir.save_as_draft_status', 0)
            ->order_by("cmir.incident_id_pk", "DESC")
            ->limit(1)
            ->get()->row();
        // print_r($this->db->last_query());
        return $query;
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

    public function get_incident_details($incident_id)
    {
        $query = $this->db->select('identity_district,district,incident_date,marriage_date')
        ->from('cm_incident_report AS cmir')
        ->where('cmir.incident_id_pk', $incident_id)
        ->get()->row();
        return $query;
    }
    public function get_single_details($table_name='',$select=array(),$where=array())
    {
        $query = $this->db->select($select)
        ->from($table_name)
        ->where($where)
        ->get()->row();
        return $query;
    }
    public function update_incident_draft_reporting_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk, reporting_id')
            ->from('cm_incident_report')
            ->where('incident_id_pk' , $incident_update_id)
            ->get()->row();
        $incident_id = ($query)?$query->incident_id_pk:'';
        $reporting_id = ($query)?$query->reporting_id:'';

        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'created_at'=>date('Y-m-d H:i:s'),
            'created_ip'=>$_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('anonymous') == '2'){
            $uploaded_incident_details['identity_known_name'] = $this->input->post('identity_known_name');
            $uploaded_incident_details['identity_street_landmark'] = $this->input->post('identity_street_landmark');
            $uploaded_incident_details['identity_ward_gp'] = $this->input->post('identity_ward_gp');
            $uploaded_incident_details['identity_state'] = 19;
            $uploaded_incident_details['identity_district'] = $this->input->post('identity_district');
            $uploaded_incident_details['identity_block'] = $this->input->post('identity_block');
            $uploaded_incident_details['identity_pin_code'] = $this->input->post('identity_pin_code');
            $uploaded_incident_details['identity_police_station'] = $this->input->post('identity_police_station');
            $uploaded_incident_details['identity_phone_no'] = $this->input->post('identity_phone_no');
            $uploaded_incident_details['information_received'] = $this->input->post('information_received');
        }else{
            $uploaded_incident_details['identity_known_name'] = NULL;
            $uploaded_incident_details['identity_street_landmark'] = NULL;
            $uploaded_incident_details['identity_ward_gp'] = NULL;
            $uploaded_incident_details['identity_state'] = NULL;
            $uploaded_incident_details['identity_district'] = NULL;
            $uploaded_incident_details['identity_block'] = NULL;
            $uploaded_incident_details['identity_pin_code'] = NULL;
            $uploaded_incident_details['identity_police_station'] = NULL;
            $uploaded_incident_details['identity_phone_no'] = NULL;
            $uploaded_incident_details['information_received'] = NULL;
        }
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $uploaded_incident_details);

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        if(!empty($Local_Persons_Involved_Details)){
            foreach($Local_Persons_Involved_Details as $key => $LocalPersonsValue){
                if ( !empty(array_filter($LocalPersonsValue))) {
                    $local_person_name = $LocalPersonsValue['local_person_name'];
                    $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
                    $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                    if(!empty($LocalPersonsValue['local_person_sl_no'])){
                        $sl_no = $LocalPersonsValue['local_person_sl_no'];
                        $updated_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_local_persons_involved_details', $updated_local_persons_involved_details);

                    }else{
                        $insert_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_local_persons_involved_details);
                    }
                }
            }
        }
       
        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        if(!empty($Officials_Involved_Details)){
            foreach($Officials_Involved_Details as $key => $OfficialPersonsValue){
                if ( !empty(array_filter($OfficialPersonsValue))) {
                    $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                    $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                    $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                    $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                    if(!empty($OfficialPersonsValue['officials_involved_sl_no'])){
                        $sl_no = $OfficialPersonsValue['officials_involved_sl_no'];
                        $updated_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_officials_involved_details', $updated_officials_involved_details);
                    }else{
                        $insert_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->insert('cm_incident_report_officials_involved_details', $insert_officials_involved_details);

                    }
                }
            }
        }
        // Contracting Party 1 Details
        $cp_one_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 1)
            ->get()->num_rows();

        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive')
        );
        $uploaded_cp_one_details = array(
            'reporting_id' => $reporting_id,
            'incident_id_fk' => $incident_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }
        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });
        if (!empty($filtered_cp_one_array)) {
            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;
            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            if($cp_one_count_query > 0){
                $update_array = array(
                    "incident_id_fk" => $incident_id,
                    "cp_type" => 1
                );
                $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }else{
                $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }

        } 

        // Contracting Party 2 Details

        $cp_two_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 2)
            ->get()->num_rows();
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $reporting_id,
                'incident_id_fk' => $incident_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'), 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                if($cp_two_count_query > 0){
                    $update_array = array(
                        "incident_id_fk" => $incident_id,
                        "cp_type" => 2
                    );
                    $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }else{
                    $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }
            }
        }
    } 
    public function update_incident_reporting_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk, reporting_id')
            ->from('cm_incident_report')
            ->where('incident_id_pk' , $incident_update_id)
            ->get()->row();
        $incident_id = ($query)?$query->incident_id_pk:'';
        $reporting_id = ($query)?$query->reporting_id:'';

        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'marriage_date' => $this->us_date_format($this->input->post('marriage_date')),

            'street_landmark' => $this->input->post('street_landmark'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'cp_two_is_available' => empty($this->input->post('cp_two_is_available'))? NULL : $this->input->post('cp_two_is_available'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_ip'=>$_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('anonymous') == '2'){
            $uploaded_incident_details['identity_known_name'] = $this->input->post('identity_known_name');
            $uploaded_incident_details['identity_street_landmark'] = $this->input->post('identity_street_landmark');
            $uploaded_incident_details['identity_ward_gp'] = $this->input->post('identity_ward_gp');
            $uploaded_incident_details['identity_state'] = 19;
            $uploaded_incident_details['identity_district'] = $this->input->post('identity_district');
            $uploaded_incident_details['identity_block'] = $this->input->post('identity_block');
            $uploaded_incident_details['identity_pin_code'] = $this->input->post('identity_pin_code');
            $uploaded_incident_details['identity_police_station'] = $this->input->post('identity_police_station');
            $uploaded_incident_details['identity_phone_no'] = $this->input->post('identity_phone_no');
            $uploaded_incident_details['information_received'] = $this->input->post('information_received');
        }else{
            $uploaded_incident_details['identity_known_name'] = NULL;
            $uploaded_incident_details['identity_street_landmark'] = NULL;
            $uploaded_incident_details['identity_ward_gp'] = NULL;
            $uploaded_incident_details['identity_state'] = NULL;
            $uploaded_incident_details['identity_district'] = NULL;
            $uploaded_incident_details['identity_block'] = NULL;
            $uploaded_incident_details['identity_pin_code'] = NULL;
            $uploaded_incident_details['identity_police_station'] = NULL;
            $uploaded_incident_details['identity_phone_no'] = NULL;
            $uploaded_incident_details['information_received'] = NULL;
        }
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $uploaded_incident_details);

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        if(!empty($Local_Persons_Involved_Details)){
            foreach($Local_Persons_Involved_Details as $key => $LocalPersonsValue){
                if ( !empty(array_filter($LocalPersonsValue))) {
                    $local_person_name = $LocalPersonsValue['local_person_name'];
                    $local_person_gender = (isset($LocalPersonsValue['local_person_gender']))?$LocalPersonsValue['local_person_gender']:NULL;
                    $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                    if(!empty($LocalPersonsValue['local_person_sl_no'])){
                        $sl_no = $LocalPersonsValue['local_person_sl_no'];
                        $updated_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_local_persons_involved_details', $updated_local_persons_involved_details);

                    }else{
                        $insert_local_persons_involved_details = array(
                            'incident_id_fk' => $incident_id,
                            'stake_holder_id_fk' => $stake_holder_login_id_pk,
                            'local_person_name' => $local_person_name,
                            'local_person_gender' => $local_person_gender,
                            'local_person_occupation_identity' => $local_person_occupation_identity
                        );
                        $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_local_persons_involved_details);
                    }
                }
            }
        }
       
        //Official involved
        $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
        if(!empty($Officials_Involved_Details)){
            foreach($Officials_Involved_Details as $key => $OfficialPersonsValue){
                if ( !empty(array_filter($OfficialPersonsValue))) {
                    $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                    $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                    $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                    $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                    if(!empty($OfficialPersonsValue['officials_involved_sl_no'])){
                        $sl_no = $OfficialPersonsValue['officials_involved_sl_no'];
                        $updated_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->where('sl_no',$sl_no)->update('cm_incident_report_officials_involved_details', $updated_officials_involved_details);
                    }else{
                        $insert_officials_involved_details = array(
                            'incident_id_fk'=>$incident_id,
                            'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                            'official_involved_name'=>$official_involved_name,
                            'officials_involved_designation'=>$officials_involved_designation,
                            'officials_involved_office'=>$officials_involved_office,
                            'officials_involved_contact_no'=>$officials_involved_contact_no
                        );
                        $this->db->insert('cm_incident_report_officials_involved_details', $insert_officials_involved_details);

                    }
                }
            }
        }
        // Contracting Party 1 Details
        $cp_one_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 1)
            ->get()->num_rows();

        $cp_one_name_empty = $this->input->post('cp_one_f_name').$this->input->post('cp_one_m_name').$this->input->post('cp_one_l_name');
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_personal_details = array(
            'cp_name' => $cp_one_name_empty,
            'cp_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_state' => empty($this->input->post('cp_one_state'))? NULL : $this->input->post('cp_one_state'),
            'cp_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_police_station' => $this->input->post('cp_one_police_station'),
            'cp_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_gender' => $this->input->post('cp_one_gender'),
            'cp_social_category' => $this->input->post('cp_one_social_category'),
            'cp_religion' => $this->input->post('cp_one_religion'),
            'cp_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_age' => $this->input->post('cp_one_age'),
            'cp_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_father_name' => $this->input->post('cp_one_father_name'),
            'cp_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_father_id' => $this->input->post('cp_one_father_id'),
            'cp_father_id_type' => empty($this->input->post('cp_one_father_id_type'))? NULL : $this->input->post('cp_one_father_id_type'),
            'cp_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_mother_id_type' => empty($this->input->post('cp_one_mother_id_type'))? NULL : $this->input->post('cp_one_mother_id_type'),
            'cp_mother_alive' => $this->input->post('cp_one_mother_alive')
        );
        $uploaded_cp_one_details = array(
            'reporting_id' => $reporting_id,
            'incident_id_fk' => $incident_id,
            'cp_type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_state') == '1'){
            $cp_one_address_details = array(
                'cp_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),

                'cp_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),

                'cp_ward_gp' => empty($this->input->post('cp_one_ward_gp'))? NULL : $this->input->post('cp_one_ward_gp')
            );
        }else{
            $cp_one_address_details = array(
                'cp_district' => NULL,
                'cp_block' => NULL,
                'cp_ward_gp' => NULL,
                'cp_address' => $this->input->post('cp_one_address')
            );
        }
        $filtered_cp_one_array = array_filter($uploaded_cp_one_personal_details, function($element) {
            return !empty($element); 
        });
        if (!empty($filtered_cp_one_array)) {
            $uploaded_cp_one_personal_details['cp_name'] = $cp_one_name;
            $uploaded_cp_one_details_data = array_merge($uploaded_cp_one_personal_details, $uploaded_cp_one_details, $cp_one_address_details);

            if($cp_one_count_query > 0){
                $update_array = array(
                    "incident_id_fk" => $incident_id,
                    "cp_type" => 1
                );
                $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }else{
                $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_one_details_data);
            }

        } 

        // Contracting Party 2 Details

        $cp_two_count_query = $this->db->select('incident_id_fk')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->where('cp_type' , 2)
            ->get()->num_rows();
        if($this->input->post('cp_two_is_available') == '1'){

            $cp_two_name_empty = $this->input->post('cp_two_f_name').$this->input->post('cp_two_m_name').$this->input->post('cp_two_l_name');

            $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');

            $uploaded_cp_two_personal_details = array(
                'cp_name' => $cp_two_name_empty,
                'cp_street_landmark' => $this->input->post('cp_two_street_landmark'),
                'cp_state' => empty($this->input->post('cp_two_state'))? NULL : $this->input->post('cp_two_state'),
                'cp_pin_code' => $this->input->post('cp_two_pin_code'),
                'cp_police_station' => $this->input->post('cp_two_police_station'),
                'cp_phone_no' => $this->input->post('cp_two_phone_no'),
                'cp_gender' => $this->input->post('cp_two_gender'),
                'cp_social_category' => $this->input->post('cp_two_social_category'),
                'cp_religion' => $this->input->post('cp_two_religion'),
                'cp_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
                'cp_age' => $this->input->post('cp_two_age'),
                'cp_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
                'cp_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
                'cp_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
                'cp_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
                'cp_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
                'cp_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
                'cp_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
                'cp_father_name' => $this->input->post('cp_two_father_name'),
                'cp_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
                'cp_father_id' => $this->input->post('cp_two_father_id'),
                'cp_father_id_type' => empty($this->input->post('cp_two_father_id_type'))? NULL : $this->input->post('cp_two_father_id_type'),
                'cp_father_alive' => $this->input->post('cp_two_father_alive'),
                'cp_mother_name' => $this->input->post('cp_two_mother_name'),
                'cp_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
                'cp_mother_id' => $this->input->post('cp_two_mother_id'),
                'cp_mother_id_type' => empty($this->input->post('cp_two_mother_id_type'))? NULL : $this->input->post('cp_two_mother_id_type'),
                'cp_mother_alive' => $this->input->post('cp_two_mother_alive')
            );

            $uploaded_cp_two_details = array(
                'reporting_id' => $reporting_id,
                'incident_id_fk' => $incident_id,
                'cp_type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'created_ip' => $_SERVER['REMOTE_ADDR']
            );

            if($this->input->post('cp_two_state') == '1'){
                $cp_two_address_details = array(
                    'cp_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),

                    'cp_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),

                    'cp_ward_gp' => empty($this->input->post('cp_two_ward_gp'))? NULL : $this->input->post('cp_two_ward_gp'), 
                );
            }else{
                $cp_two_address_details = array(
                    'cp_district' => NULL,
                    'cp_block' => NULL,
                    'cp_ward_gp' => NULL,
                    'cp_address' => $this->input->post('cp_two_address')
                );
            }

            $filtered_cp_two_array = array_filter($uploaded_cp_two_personal_details, function($element) {
                return !empty($element); 
            });

            if (!empty($filtered_cp_two_array)) {
                $uploaded_cp_two_personal_details['cp_name'] = $cp_two_name;
                $uploaded_cp_two_details_data = array_merge($uploaded_cp_two_personal_details, $uploaded_cp_two_details, $cp_two_address_details);
                if($cp_two_count_query > 0){
                    $update_array = array(
                        "incident_id_fk" => $incident_id,
                        "cp_type" => 2
                    );
                    $this->db->where($update_array)->update('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }else{
                    $this->db->insert('cm_incident_report_contracting_parties', $uploaded_cp_two_details_data);
                }
            }
        }
    }   
}
?>
