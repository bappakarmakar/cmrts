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
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => $this->input->post('incident_district'),
            'block' => $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
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
            'active_status' => 1,
            'home_visit_minor_status' => 101,
            'home_visit_adult_status' => 101,
            'follow_up_visit_status' => 101,
            'incident_draft_status' => 2
        );
        if($this->session->userdata('stake_id_fk') == '3'){
            $cp_one_query = $this->db->select('cpo.cp_one_district, cpo.cp_one_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_party_one as cpo')
            ->join('rp_location_master_block as lmb', 'cpo.cp_one_district = lmb.district_id_fk AND cpo.cp_one_block = lmb.block_id_pk')
            ->where('cpo.cp_one_district', $this->input->post('cp_one_district'))
            ->where('cpo.cp_one_block', $this->input->post('cp_one_block'))
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
                ->where('cpt.cp_two_district', $this->input->post('cp_two_district'))
                ->where('cpt.cp_two_block', $this->input->post('cp_two_block'))
                ->get()->row();
           
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

            $cp_one_result_data = ($cp_one_stake_id_query)?$cp_one_stake_id_query->stake_holder_login_id_pk:NULL;

            $cp_two_result_data = ($cp_two_stake_id_query)?$cp_two_stake_id_query->stake_holder_login_id_pk:NULL;

            $status = array(
                'forward_status' => 102,
                'publish_status' => 102, 
                'deo_cp_one_stake_id_fk' => $cp_one_result_data,
                'deo_cp_two_stake_id_fk' => $cp_two_result_data, 
            );

        }elseif($this->session->userdata('stake_id_fk') == '4'){
            $status = array(
                'forward_status' => 101,
                'publish_status' => 101,  
            );
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $cp_one_query = $this->db->select('cpo.cp_one_district, cpo.cp_one_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_party_one as cpo')
            ->join('rp_location_master_block as lmb', 'cpo.cp_one_district = lmb.district_id_fk AND cpo.cp_one_block = lmb.block_id_pk')
            ->where('cpo.cp_one_district', $this->input->post('cp_one_district'))
            ->where('cpo.cp_one_block', $this->input->post('cp_one_block'))
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
                ->where('cpt.cp_two_district', $this->input->post('cp_two_district'))
                ->where('cpt.cp_two_block', $this->input->post('cp_two_block'))
                ->get()->row();
           
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

            $cp_one_result_data = ($cp_one_stake_id_query)?$cp_one_stake_id_query->stake_holder_login_id_pk:NULL;

            $cp_two_result_data = ($cp_two_stake_id_query)?$cp_two_stake_id_query->stake_holder_login_id_pk:NULL;
            
            $status = array(
                'forward_status' => 102,
                'publish_status' => 102, 
                'deo_cp_one_stake_id_fk' => $cp_one_result_data,
                'deo_cp_two_stake_id_fk' => $cp_two_result_data,  
            );
        }

        $uploaded_incident_details_data = array_merge($uploaded_incident_details, $status);
        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details_data);
        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = empty($LocalPersonsValue['local_person_gender'])? NULL : $LocalPersonsValue['local_person_gender'];
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
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => $this->input->post('cp_one_district'),
            'cp_one_block' => $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_one_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_one_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result4 = $this->db->insert('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party One CWC Details
        $uploaded_cp_one_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_one_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_one_cwc_case_date')),
            'state' => 19,
            'district' => $this->input->post('cp_one_cwc_district'),
            'block' => $this->input->post('cp_one_cwc_block'),
            'cci_details' => empty($this->input->post('cp_one_cwc_cci'))? NULL : $this->input->post('cp_one_cwc_cci'),
            'address' => $this->input->post('cp_one_cwc_address'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
              
        );
        $result5 = $this->db->insert('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party Two Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => $this->input->post('cp_two_district'),
            'cp_two_block' => $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
            'cp_two_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
            'cp_two_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result6 = $this->db->insert('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party Two CWC Details
        $uploaded_cp_two_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_two_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_two_cwc_case_date')),
            'state' => 19,
            'district' => $this->input->post('cp_two_cwc_district'),
            'block' => $this->input->post('cp_two_cwc_block'),
            'cci_details' => empty($this->input->post('cp_two_cwc_cci'))? NULL : $this->input->post('cp_two_cwc_cci'),
            'address' => $this->input->post('cp_two_cwc_address'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
         );
        $result7 = $this->db->insert('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);
    }

    public function insert_draft_incident_reporting_details_first($max_child_id)
    {
        // Incident Details
        $uploaded_incident_details = array(
            'reporting_id' => $max_child_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
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
            'incident_draft_status' => 1
        );
        $uploaded_incident_details_data = array_merge($uploaded_incident_details);
        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details_data);
        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = empty($LocalPersonsValue['local_person_gender'])? NULL : $LocalPersonsValue['local_person_gender'];
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
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),
            'cp_one_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_one_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_one_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result4 = $this->db->insert('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party One CWC Details
        $uploaded_cp_one_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_one_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_one_cwc_case_date')),
            'state' => 19,
            'district' => empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district'),
            'block' => empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block'),
            'cci_details' => empty($this->input->post('cp_one_cwc_cci'))? NULL : $this->input->post('cp_one_cwc_cci'),
            'address' => $this->input->post('cp_one_cwc_address'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
              
        );
        $result5 = $this->db->insert('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party Two Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),
            'cp_two_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
            'cp_two_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
            'cp_two_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
        );
        $result6 = $this->db->insert('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party Two CWC Details
        $uploaded_cp_two_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_two_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_two_cwc_case_date')),
            'state' => 19,
            'district' => empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district'),
            'block' => empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block'),
            'cci_details' => empty($this->input->post('cp_two_cwc_cci'))? NULL : $this->input->post('cp_two_cwc_cci'),
            'address' => $this->input->post('cp_two_cwc_address'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
         );
        $result7 = $this->db->insert('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);
    }

    public function insert_draft_incident_reporting_details_second($max_child_id)
    {
        // Incident Details
        $uploaded_incident_details = array(
            'reporting_id' => $max_child_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => empty($this->input->post('incident_district'))? NULL : $this->input->post('incident_district'),
            'block' => empty($this->input->post('incident_block'))? NULL : $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
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
            'incident_draft_status' => 0
        );
        $uploaded_incident_details_data = array_merge($uploaded_incident_details);
        $result = $this->db->insert('cm_incident_report', $uploaded_incident_details_data);
        $last_inst_id = $this->db->insert_id();

        //local person involved
        $Local_Persons_Involved_Details = $this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = empty($LocalPersonsValue['local_person_gender'])? NULL : $LocalPersonsValue['local_person_gender'];
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
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),
            'cp_one_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_dob_document_id' => $this->input->post('cp_one_dob_document_id'),
            'cp_one_dob_document_type' => $this->input->post('cp_one_dob_document_type'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_identity_document_id' => $this->input->post('cp_one_identity_document_id'),
            'cp_one_identity_document_type' => $this->input->post('cp_one_identity_document_type'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result4 = $this->db->insert('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party One CWC Details
        $uploaded_cp_one_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_one_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_one_cwc_case_date')),
            'state' => 19,
            'district' => empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district'),
            'block' => empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block'),
            'cci_details' => empty($this->input->post('cp_one_cwc_cci'))? NULL : $this->input->post('cp_one_cwc_cci'),
            'address' => $this->input->post('cp_one_cwc_address'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
              
        );
        $result5 = $this->db->insert('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party Two Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),
            'cp_two_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_dob_document_id' => $this->input->post('cp_two_dob_document_id'),
            'cp_two_dob_document_type' => $this->input->post('cp_two_dob_document_type'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_identity_document_id' => $this->input->post('cp_two_identity_document_id'),
            'cp_two_identity_document_type' => $this->input->post('cp_two_identity_document_type'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
        );
        $result6 = $this->db->insert('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party Two CWC Details
        $uploaded_cp_two_cwc_details = array(
            'incident_id_fk' => $last_inst_id,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'case_no' => $this->input->post('cp_two_cwc_case_no'),
            'case_date' => $this->us_date_format($this->input->post('cp_two_cwc_case_date')),
            'state' => 19,
            'district' => empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district'),
            'block' => empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block'),
            'cci_details' => empty($this->input->post('cp_two_cwc_cci'))? NULL : $this->input->post('cp_two_cwc_cci'),
            'address' => $this->input->post('cp_two_cwc_address'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
         );
        $result7 = $this->db->insert('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);
    }

    public function update_incident_reporting_draft_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk')
            ->from('cm_incident_report')
            ->where('reporting_id' , $incident_update_id)
            ->get()->row();

        $incident_id = $query->incident_id_pk;
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => $this->input->post('incident_district'),
            'block' => $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous')
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
        $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = empty($this->input->post('local_person_gender'))? NULL : $LocalPersonsValue['local_person_gender'];
            $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
            $local_person_details_count_query = $this->db->select('lpid.incident_id_fk')
             ->from('cm_incident_report_local_persons_involved_details AS lpid')
             ->where('lpid.incident_id_fk' , $incident_id)
             ->get()->num_rows();
            if($local_person_details_count_query == 0){
                if($local_person_name != '' && $local_person_gender != '' && $local_person_occupation_identity != ''){
                    $uploaded_local_persons_involved_details = array(
                        'incident_id_fk' => $incident_id,
                        'stake_holder_id_fk' => $stake_holder_login_id_pk,
                        'local_person_name' => $local_person_name,
                        'local_person_gender' => $local_person_gender,
                        'local_person_occupation_identity' => $local_person_occupation_identity
                    );
                  $this->db->insert('cm_incident_report_local_persons_involved_details', $uploaded_local_persons_involved_details); 
                }
             }
        }
       
        //Official involved
        $Officials_Involved_Details=$this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key=>$OfficialPersonsValue){
             $official_involved_name = $OfficialPersonsValue['official_involved_name'];
             $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
             $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
             $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];

             $officials_involved_details_count_query = $this->db->select('oid.incident_id_fk')
             ->from('cm_incident_report_officials_involved_details AS oid')
             ->where('oid.incident_id_fk' , $incident_id)
             ->get()->num_rows();
             if($officials_involved_details_count_query == 0){
                if($official_involved_name != '' && $officials_involved_designation != '' && $officials_involved_office != '' && $officials_involved_contact_no != ''){
                    $uploaded_officials_involved_details = array(
                        'incident_id_fk'=>$incident_id,
                        'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                        'official_involved_name'=>$official_involved_name,
                        'officials_involved_designation'=>$officials_involved_designation,
                        'officials_involved_office'=>$officials_involved_office,
                        'officials_involved_contact_no'=>$officials_involved_contact_no
                    );
                 $this->db->insert('cm_incident_report_officials_involved_details', $uploaded_officials_involved_details); 
                }
             }
        }
        // Contracting Party 1 Details
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),
            'cp_one_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive')
        );
        if($this->input->post('cp_one_dob_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_dob_document_id'] = $this->input->post('cp_one_dob_document_id');
            $uploaded_cp_one_details['cp_one_dob_document_type'] = $this->input->post('cp_one_dob_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_dob_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_one_identity_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_identity_document_id'] = $this->input->post('cp_one_identity_document_id');
            $uploaded_cp_one_details['cp_one_identity_document_type'] = $this->input->post('cp_one_identity_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_identity_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party 1 CWC Details
        $uploaded_cp_one_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_one_cwc_remarks')
        );
        if($this->input->post('cp_one_cwc_minor_sent_to') == '1' || $this->input->post('cp_one_cwc_minor_sent_to') == '2' || $this->input->post('cp_one_cwc_minor_sent_to') == '3'){
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = $this->input->post('cp_one_cwc_address');
            $uploaded_cp_one_cwc_details['cci_details'] = NULL;
            $uploaded_cp_one_cwc_details['case_no'] = NULL;
            $uploaded_cp_one_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_one_cwc_details['case_no'] = $this->input->post('cp_one_cwc_case_no');
            $uploaded_cp_one_cwc_details['case_date'] = empty($this->input->post('cp_one_cwc_case_date'))? NULL : $this->input->post('cp_one_cwc_case_date');
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = NULL;
            $uploaded_cp_one_cwc_details['cci_details'] = empty($this->input->post('cp_one_cwc_cci'))? NULL : $this->input->post('cp_one_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party 2 Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),
            'cp_two_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive')
        );
        if($this->input->post('cp_two_dob_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_dob_document_id'] = $this->input->post('cp_two_dob_document_id');
            $uploaded_cp_two_details['cp_two_dob_document_type'] = $this->input->post('cp_two_dob_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_dob_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_two_identity_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_identity_document_id'] = $this->input->post('cp_two_identity_document_id');
            $uploaded_cp_two_details['cp_two_identity_document_type'] = $this->input->post('cp_two_identity_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_identity_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party 2 CWC Details
        $uploaded_cp_two_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_two_cwc_remarks')
        );
        if($this->input->post('cp_two_cwc_minor_sent_to') == '1' || $this->input->post('cp_two_cwc_minor_sent_to') == '2' || $this->input->post('cp_two_cwc_minor_sent_to') == '3'){
            $uploaded_cp_two_cwc_details['district'] = empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['block'] = empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = $this->input->post('cp_two_cwc_address');
            $uploaded_cp_two_cwc_details['cci_details'] = NULL;
            $uploaded_cp_two_cwc_details['case_no'] = NULL;
            $uploaded_cp_two_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_two_cwc_details['case_no'] = $this->input->post('cp_two_cwc_case_no');
            $uploaded_cp_two_cwc_details['case_date'] = empty($this->input->post('cp_two_cwc_case_date'))? NULL : $this->input->post('cp_two_cwc_case_date');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['district'] = empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['block'] = empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = NULL;
            $uploaded_cp_two_cwc_details['cci_details'] = empty($this->input->post('cp_two_cwc_cci'))? NULL : $this->input->post('cp_two_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);
    }

    public function update_incident_reporting_draft_final_details($incident_update_id)
    {
        $query = $this->db->select('incident_id_pk')
            ->from('cm_incident_report')
            ->where('reporting_id' , $incident_update_id)
            ->get()->row();

        $incident_id = $query->incident_id_pk;
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => empty($this->input->post('ward_gp'))? NULL : $this->input->post('ward_gp'),
            'state' => 19,
            'district' => $this->input->post('incident_district'),
            'block' => $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'forward_status' => 101,
            'publish_status' => 101,
            'home_visit_minor_status' => 101,
            'home_visit_adult_status' => 101,
            'follow_up_visit_status' => 101,
            'incident_draft_status' => 2
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
        $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $local_person_name = $LocalPersonsValue['local_person_name'];
            $local_person_gender = empty($this->input->post('local_person_gender'))? NULL : $LocalPersonsValue['local_person_gender'];
            $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];

            $local_person_details_count_query = $this->db->select('lpid.incident_id_fk')
             ->from('cm_incident_report_local_persons_involved_details AS lpid')
             ->where('lpid.incident_id_fk' , $incident_id)
             ->get()->num_rows();
            if($local_person_details_count_query == 0){
                if($local_person_name != '' && $local_person_gender != '' && $local_person_occupation_identity != ''){
                    $uploaded_local_persons_involved_details = array(
                        'incident_id_fk' => $incident_id,
                        'stake_holder_id_fk' => $stake_holder_login_id_pk,
                        'local_person_name' => $local_person_name,
                        'local_person_gender' => $local_person_gender,
                        'local_person_occupation_identity' => $local_person_occupation_identity,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_ip' => $_SERVER['REMOTE_ADDR'],
                        'active_status' => 1
                    );
                  $result_insert = $this->db->insert('cm_incident_report_local_persons_involved_details', $uploaded_local_persons_involved_details);  
                } 
            } 
        }
       
        //Official involved
        $Officials_Involved_Details=$this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key => $OfficialPersonsValue){
            $official_involved_name = $OfficialPersonsValue['official_involved_name'];
            $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
            $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
            $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];

            $officials_involved_details_count_query = $this->db->select('oid.incident_id_fk')
             ->from('cm_incident_report_officials_involved_details AS oid')
             ->where('oid.incident_id_fk' , $incident_id)
             ->get()->num_rows();
            if($officials_involved_details_count_query == 0){
                if($official_involved_name != '' && $officials_involved_designation != '' && $officials_involved_office != '' && $officials_involved_contact_no != ''){
                    $uploaded_officials_involved_details = array(
                       'incident_id_fk' => $incident_id,
                       'stake_holder_id_fk' => $stake_holder_login_id_pk,
                       'official_involved_name' => $official_involved_name,
                       'officials_involved_designation' => $officials_involved_designation,
                       'officials_involved_office' => $officials_involved_office,
                       'officials_involved_contact_no' => $officials_involved_contact_no,
                       'created_at' => date('Y-m-d H:i:s'),
                       'created_ip' => $_SERVER['REMOTE_ADDR'],
                       'active_status' => 1
                    );
                  $result_insert = $this->db->insert('cm_incident_report_officials_involved_details', $uploaded_officials_involved_details); 
                }
            }
        }
        // Contracting Party 1 Details
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => empty($this->input->post('cp_one_district'))? NULL : $this->input->post('cp_one_district'),
            'cp_one_block' => empty($this->input->post('cp_one_block'))? NULL : $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        if($this->input->post('cp_one_dob_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_dob_document_id'] = $this->input->post('cp_one_dob_document_id');
            $uploaded_cp_one_details['cp_one_dob_document_type'] = $this->input->post('cp_one_dob_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_dob_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_one_identity_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_identity_document_id'] = $this->input->post('cp_one_identity_document_id');
            $uploaded_cp_one_details['cp_one_identity_document_type'] = $this->input->post('cp_one_identity_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_identity_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party 1 CWC Details
        $uploaded_cp_one_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
        );
        if($this->input->post('cp_one_cwc_minor_sent_to') == '1' || $this->input->post('cp_one_cwc_minor_sent_to') == '2' || $this->input->post('cp_one_cwc_minor_sent_to') == '3'){
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = $this->input->post('cp_one_cwc_address');
            $uploaded_cp_one_cwc_details['cci_details'] = NULL;
            $uploaded_cp_one_cwc_details['case_no'] = NULL;
            $uploaded_cp_one_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_one_cwc_details['case_no'] = $this->input->post('cp_one_cwc_case_no');
            $uploaded_cp_one_cwc_details['case_date'] = empty($this->input->post('cp_one_cwc_case_date'))? NULL : $this->input->post('cp_one_cwc_case_date');
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = empty($this->input->post('cp_one_cwc_district'))? NULL : $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = empty($this->input->post('cp_one_cwc_block'))? NULL : $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = NULL;
            $uploaded_cp_one_cwc_details['cci_details'] = empty($this->input->post('cp_one_cwc_cci'))? NULL : $this->input->post('cp_one_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party 2 Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => empty($this->input->post('cp_two_district'))? NULL : $this->input->post('cp_two_district'),
            'cp_two_block' => empty($this->input->post('cp_two_block'))? NULL : $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        if($this->input->post('cp_two_dob_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_dob_document_id'] = $this->input->post('cp_two_dob_document_id');
            $uploaded_cp_two_details['cp_two_dob_document_type'] = $this->input->post('cp_two_dob_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_dob_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_two_identity_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_identity_document_id'] = $this->input->post('cp_two_identity_document_id');
            $uploaded_cp_two_details['cp_two_identity_document_type'] = $this->input->post('cp_two_identity_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_identity_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party 2 CWC Details
        $uploaded_cp_two_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
        );
        if($this->input->post('cp_two_cwc_minor_sent_to') == '1' || $this->input->post('cp_two_cwc_minor_sent_to') == '2' || $this->input->post('cp_two_cwc_minor_sent_to') == '3'){
            $uploaded_cp_two_cwc_details['district'] = empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['block'] = empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = $this->input->post('cp_two_cwc_address');
            $uploaded_cp_two_cwc_details['cci_details'] = NULL;
            $uploaded_cp_two_cwc_details['case_no'] = NULL;
            $uploaded_cp_two_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_two_cwc_details['case_no'] = $this->input->post('cp_two_cwc_case_no');
            $uploaded_cp_two_cwc_details['case_date'] = empty($this->input->post('cp_two_cwc_case_date'))? NULL : $this->input->post('cp_two_cwc_case_date');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['district'] = empty($this->input->post('cp_two_cwc_district'))? NULL : $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['block'] = empty($this->input->post('cp_two_cwc_block'))? NULL : $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = NULL;
            $uploaded_cp_two_cwc_details['cci_details'] = empty($this->input->post('cp_two_cwc_cci'))? NULL : $this->input->post('cp_two_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);
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

    public function update_incident_reporting_details($incident_id)
    {  
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => $this->input->post('ward_gp'),
            'state' => 19,
            'district' => $this->input->post('incident_district'),
            'block' => $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
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
        $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $lpi_id = $LocalPersonsValue['lpi_id'];
            if(!empty($lpi_id)){
                $lpi_id = $LocalPersonsValue['lpi_id'];
                $local_person_name = $LocalPersonsValue['local_person_name'];
                $local_person_gender = $LocalPersonsValue['local_person_gender'];
                $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                $updateData = array(
                    'local_person_name' => $local_person_name,
                    'local_person_gender' => $local_person_gender,
                    'local_person_occupation_identity' => $local_person_occupation_identity,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_ip' => $_SERVER['REMOTE_ADDR']
                );
                $this->db->where('sl_no', $lpi_id);
                $this->db->update('cm_incident_report_local_persons_involved_details', $updateData);
            }else{
                $local_person_name = $LocalPersonsValue['local_person_name'];
                $local_person_gender = $LocalPersonsValue['local_person_gender'];
                $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                $insert_data = array(
                    'incident_id_fk'=>$incident_id,
                    'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                    'local_person_name'=>$local_person_name,
                    'local_person_gender'=>$local_person_gender,
                    'local_person_occupation_identity'=>$local_person_occupation_identity,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_ip' => $_SERVER['REMOTE_ADDR']
                );
              $result_insert = $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_data);    
            }
        }
       
        //Official involved
        $Officials_Involved_Details=$this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key=>$OfficialPersonsValue){
             $oi_id = $OfficialPersonsValue['ol_id'];
             if(!empty($oi_id)){
                 $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                 $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                 $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                 $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                 $updateData_oi = array(
                    'official_involved_name'=>$official_involved_name,
                    'officials_involved_designation'=>$officials_involved_designation,
                    'officials_involved_office'=>$officials_involved_office,
                    'officials_involved_contact_no'=>$officials_involved_contact_no,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_ip' => $_SERVER['REMOTE_ADDR']
                );
                 $this->db->where('sl_no', $oi_id);
                 $this->db->update('cm_incident_report_officials_involved_details', $updateData_oi);
             }else{
                $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                 $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                 $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                 $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                 $insert_data_oi = array(
                    'incident_id_fk'=>$incident_id,
                    'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                    'official_involved_name'=>$official_involved_name,
                    'officials_involved_designation'=>$officials_involved_designation,
                    'officials_involved_office'=>$officials_involved_office,
                    'officials_involved_contact_no'=>$officials_involved_contact_no,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_ip' => $_SERVER['REMOTE_ADDR']);
                    $result_insert = $this->db->insert('cm_incident_report_officials_involved_details', $insert_data_oi);       
             }
        }
        // Contracting Party 1 Details
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');
        $uploaded_cp_one_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => $this->input->post('cp_one_district'),
            'cp_one_block' => $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_dob_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_dob_document_id'] = $this->input->post('cp_one_dob_document_id');
            $uploaded_cp_one_details['cp_one_dob_document_type'] = $this->input->post('cp_one_dob_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_dob_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_one_identity_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_identity_document_id'] = $this->input->post('cp_one_identity_document_id');
            $uploaded_cp_one_details['cp_one_identity_document_type'] = $this->input->post('cp_one_identity_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_identity_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party 1 CWC Details
        $uploaded_cp_one_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_one_cwc_minor_sent_to') == '1' || $this->input->post('cp_one_cwc_minor_sent_to') == '2' || $this->input->post('cp_one_cwc_minor_sent_to') == '3'){
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = $this->input->post('cp_one_cwc_address');
            $uploaded_cp_one_cwc_details['cci_details'] = NULL;
            $uploaded_cp_one_cwc_details['case_no'] = NULL;
            $uploaded_cp_one_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_one_cwc_details['case_no'] = $this->input->post('cp_one_cwc_case_no');
            $uploaded_cp_one_cwc_details['case_date'] = $this->input->post('cp_one_cwc_case_date');
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = NULL;
            $uploaded_cp_one_cwc_details['cci_details'] = $this->input->post('cp_one_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party 2 Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => $this->input->post('cp_two_district'),
            'cp_two_block' => $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_two_dob_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_dob_document_id'] = $this->input->post('cp_two_dob_document_id');
            $uploaded_cp_two_details['cp_two_dob_document_type'] = $this->input->post('cp_two_dob_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_dob_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_two_identity_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_identity_document_id'] = $this->input->post('cp_two_identity_document_id');
            $uploaded_cp_two_details['cp_two_identity_document_type'] = $this->input->post('cp_two_identity_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_identity_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party 2 CWC Details
        $uploaded_cp_two_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($this->input->post('cp_two_cwc_minor_sent_to') == '1' || $this->input->post('cp_two_cwc_minor_sent_to') == '2' || $this->input->post('cp_two_cwc_minor_sent_to') == '3'){
            $uploaded_cp_two_cwc_details['district'] = $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['block'] = $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = $this->input->post('cp_two_cwc_address');
            $uploaded_cp_two_cwc_details['cci_details'] = NULL;
            $uploaded_cp_two_cwc_details['case_no'] = NULL;
            $uploaded_cp_two_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_two_cwc_details['case_no'] = $this->input->post('cp_two_cwc_case_no');
            $uploaded_cp_two_cwc_details['case_date'] = $this->input->post('cp_two_cwc_case_date');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['district'] = $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['block'] = $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = NULL;
            $uploaded_cp_two_cwc_details['cci_details'] = $this->input->post('cp_two_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);

        // Police Case Details
        // $uploaded_police_case_details = array(
        //     'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
        //     'gd_no' => $this->input->post('gd_no'),
        //     'gd_date' => $this->us_date_format($this->input->post('gd_date')),
        //     'fir_no' => $this->input->post('fir_no'),
        //     'fir_date' => $this->us_date_format($this->input->post('fir_date')),
        //     'police_station' => $this->input->post('pc_police_station'),
        //     'state' => 19,
        //     'district' => $this->input->post('police_case_district'),
        //     'block' => $this->input->post('police_case_block'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        //     'updated_ip' => $_SERVER['REMOTE_ADDR']
        // );
        // $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_police_case', $uploaded_police_case_details);
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
        $query = $this->db->select('identity_district,district')
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

    public function update_incident_draft_reporting_details($incident_id)
    {  
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk'); 
        //Incident Report Detaitls
        $uploaded_incident_details = array(
            'incident_date' => $this->us_date_format($this->input->post('incident_date')),
            'street_landmark' => $this->input->post('street_landmark'),
            'ward_gp' => $this->input->post('ward_gp'),
            'state' => 19,
            'district' => $this->input->post('incident_district'),
            'block' => $this->input->post('incident_block'),
            'pin_code' => $this->input->post('pin_code'),
            'police_station' => $this->input->post('police_station'),
            'marriage_details' => $this->input->post('marriage_details'),
            'cp_one_age' => $this->input->post('cp_one_age'),
            'cp_two_age' => $this->input->post('cp_two_age'),
            'prevented_details' => $this->input->post('prevented_details'),
            'location_description' => $this->input->post('location_description'),
            'anonymous' => $this->input->post('anonymous'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'home_visit_minor_status' => 101,
            'home_visit_adult_status' => 101,
            'follow_up_visit_status' => 101,
            'incident_draft_status' => 2,
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
        if($this->session->userdata('stake_id_fk') == '3'){
            $status=array(
                'forward_status' => 102,
                'publish_status' => 102,  
            );

        }else if($this->session->userdata('stake_id_fk') == '4'){
            $status=array(
                'forward_status' => 101,
                'publish_status' => 101,  
            );
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $status = array(
                'forward_status' => 102,
                'publish_status' => 102,  
            );
        }
        
        $uploaded_incident_details_data = array_merge($uploaded_incident_details, $status);
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $uploaded_incident_details_data);
        //local person involved
        $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
        foreach($Local_Persons_Involved_Details as  $key => $LocalPersonsValue){
            $lpi_id = $LocalPersonsValue['lpi_id'];
            if(!empty($lpi_id)){
                $local_person_name = $LocalPersonsValue['local_person_name'];
                $local_person_gender = $LocalPersonsValue['local_person_gender'];
                $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                $updateData = array(
                    'local_person_name'=>$local_person_name,
                    'local_person_gender'=>$local_person_gender,
                    'local_person_occupation_identity'=>$local_person_occupation_identity,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
                $this->db->where('sl_no', $lpi_id);
                $this->db->update('cm_incident_report_local_persons_involved_details', $updateData);
            }else{
                $local_person_name = $LocalPersonsValue['local_person_name'];
                $local_person_gender = $LocalPersonsValue['local_person_gender'];
                $local_person_occupation_identity = $LocalPersonsValue['local_person_occupation_identity'];
                $insert_data = array(
                    'incident_id_fk'=>$incident_id,
                    'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                    'local_person_name'=>$local_person_name,
                    'local_person_gender'=>$local_person_gender,
                    'local_person_occupation_identity'=>$local_person_occupation_identity,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
                $result_insert = $this->db->insert('cm_incident_report_local_persons_involved_details', $insert_data);    
            }
        }
        
        //Official involved
        $Officials_Involved_Details=$this->input->post('Officials_Involved_Details');
        foreach($Officials_Involved_Details as  $key => $OfficialPersonsValue){
             $oi_id = $OfficialPersonsValue['ol_id'];
             if(!empty($oi_id)){
                 $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                 $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                 $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                 $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];

                 $updateData_oi = array(
                    'official_involved_name'=>$official_involved_name,
                    'officials_involved_designation'=>$officials_involved_designation,
                    'officials_involved_office'=>$officials_involved_office,
                    'officials_involved_contact_no'=>$officials_involved_contact_no,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
                 $this->db->where('sl_no', $oi_id);
                 $this->db->update('cm_incident_report_officials_involved_details', $updateData_oi);
             }else{
                $official_involved_name = $OfficialPersonsValue['official_involved_name'];
                 $officials_involved_designation = $OfficialPersonsValue['officials_involved_designation'];
                 $officials_involved_office = $OfficialPersonsValue['officials_involved_office'];
                 $officials_involved_contact_no = $OfficialPersonsValue['officials_involved_contact_no'];
                 $insert_data_oi = array(
                    'incident_id_fk'=>$incident_id,
                    'stake_holder_id_fk'=>$stake_holder_login_id_pk,
                    'official_involved_name'=>$official_involved_name,
                    'officials_involved_designation'=>$officials_involved_designation,
                    'officials_involved_office'=>$officials_involved_office,
                    'officials_involved_contact_no'=>$officials_involved_contact_no,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_ip' => $_SERVER['REMOTE_ADDR'],
                    'active_status' => 1
                );
                    $result_insert = $this->db->insert('cm_incident_report_officials_involved_details', $insert_data_oi);       
             }
        }
        // Contracting Party 1 Details
        $cp_one_name = $this->input->post('cp_one_f_name')." ".$this->input->post('cp_one_m_name')." ".$this->input->post('cp_one_l_name');

        $uploaded_cp_one_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_one_name' => $cp_one_name,
            'cp_one_street_landmark' => $this->input->post('cp_one_street_landmark'),
            'cp_one_ward_gp' => $this->input->post('cp_one_ward_gp'),
            'cp_one_state' => 19,
            'cp_one_district' => $this->input->post('cp_one_district'),
            'cp_one_block' => $this->input->post('cp_one_block'),
            'cp_one_pin_code' => $this->input->post('cp_one_pin_code'),
            'cp_one_police_station' => $this->input->post('cp_one_police_station'),
            'cp_one_phone_no' => $this->input->post('cp_one_phone_no'),
            'cp_one_gender' => $this->input->post('cp_one_gender'),
            'cp_one_social_category' => $this->input->post('cp_one_social_category'),
            'cp_one_religion' => $this->input->post('cp_one_religion'),
            'cp_one_dob' => $this->us_date_format($this->input->post('cp_one_dob')),
            'cp_one_dob_document_available' => $this->input->post('cp_one_dob_document_available'),
            'cp_one_identity_document_available' => $this->input->post('cp_one_identity_document_available'),
            'cp_one_highest_educational_attainment' => $this->input->post('cp_one_highest_educational_attainment'),
            'cp_one_father_name' => $this->input->post('cp_one_father_name'),
            'cp_one_father_mobile_no' => $this->input->post('cp_one_father_mobile_no'),
            'cp_one_father_id' => $this->input->post('cp_one_father_id'),
            'cp_one_father_id_type' => $this->input->post('cp_one_father_id_type'),
            'cp_one_father_alive' => $this->input->post('cp_one_father_alive'),
            'cp_one_mother_name' => $this->input->post('cp_one_mother_name'),
            'cp_one_mother_mobile_no' => $this->input->post('cp_one_mother_mobile_no'),
            'cp_one_mother_id' => $this->input->post('cp_one_mother_id'),
            'cp_one_mother_id_type' => $this->input->post('cp_one_mother_id_type'),
            'cp_one_mother_alive' => $this->input->post('cp_one_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        if($this->input->post('cp_one_dob_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_dob_document_id'] = $this->input->post('cp_one_dob_document_id');
            $uploaded_cp_one_details['cp_one_dob_document_type'] = $this->input->post('cp_one_dob_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_dob_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_one_identity_document_available') == '1'){
            $uploaded_cp_one_details['cp_one_identity_document_id'] = $this->input->post('cp_one_identity_document_id');
            $uploaded_cp_one_details['cp_one_identity_document_type'] = $this->input->post('cp_one_identity_document_type');
        }else{
            $uploaded_cp_one_details['cp_one_identity_document_id'] = NULL;
            $uploaded_cp_one_details['cp_one_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $uploaded_cp_one_details);

        // Contracting Party 1 CWC Details
        $uploaded_cp_one_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_one_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_one_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
        );
        if($this->input->post('cp_one_cwc_minor_sent_to') == '1' || $this->input->post('cp_one_cwc_minor_sent_to') == '2' || $this->input->post('cp_one_cwc_minor_sent_to') == '3'){
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = $this->input->post('cp_one_cwc_address');
            $uploaded_cp_one_cwc_details['cci_details'] = NULL;
            $uploaded_cp_one_cwc_details['case_no'] = NULL;
            $uploaded_cp_one_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_one_cwc_details['case_no'] = $this->input->post('cp_one_cwc_case_no');
            $uploaded_cp_one_cwc_details['case_date'] = $this->input->post('cp_one_cwc_case_date');
            $uploaded_cp_one_cwc_details['state'] = 19;
            $uploaded_cp_one_cwc_details['district'] = $this->input->post('cp_one_cwc_district');
            $uploaded_cp_one_cwc_details['block'] = $this->input->post('cp_one_cwc_block');
            $uploaded_cp_one_cwc_details['address'] = NULL;
            $uploaded_cp_one_cwc_details['cci_details'] = $this->input->post('cp_one_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_one_cwc_details', $uploaded_cp_one_cwc_details);

        // Contracting Party 2 Details
        $cp_two_name = $this->input->post('cp_two_f_name')." ".$this->input->post('cp_two_m_name')." ".$this->input->post('cp_two_l_name');
        $uploaded_cp_two_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'cp_two_name' => $cp_two_name,
            'cp_two_street_landmark' => $this->input->post('cp_two_street_landmark'),
            'cp_two_ward_gp' => $this->input->post('cp_two_ward_gp'),
            'cp_two_state' => 19,
            'cp_two_district' => $this->input->post('cp_two_district'),
            'cp_two_block' => $this->input->post('cp_two_block'),
            'cp_two_pin_code' => $this->input->post('cp_two_pin_code'),
            'cp_two_police_station' => $this->input->post('cp_two_police_station'),
            'cp_two_phone_no' => $this->input->post('cp_two_phone_no'),
            'cp_two_gender' => $this->input->post('cp_two_gender'),
            'cp_two_social_category' => $this->input->post('cp_two_social_category'),
            'cp_two_religion' => $this->input->post('cp_two_religion'),
            'cp_two_dob' => $this->us_date_format($this->input->post('cp_two_dob')),
            'cp_two_dob_document_available' => $this->input->post('cp_two_dob_document_available'),
            'cp_two_identity_document_available' => $this->input->post('cp_two_identity_document_available'),
            'cp_two_highest_educational_attainment' => $this->input->post('cp_two_highest_educational_attainment'),
            'cp_two_father_name' => $this->input->post('cp_two_father_name'),
            'cp_two_father_mobile_no' => $this->input->post('cp_two_father_mobile_no'),
            'cp_two_father_id' => $this->input->post('cp_two_father_id'),
            'cp_two_father_id_type' => $this->input->post('cp_two_father_id_type'),
            'cp_two_father_alive' => $this->input->post('cp_two_father_alive'),
            'cp_two_mother_name' => $this->input->post('cp_two_mother_name'),
            'cp_two_mother_mobile_no' => $this->input->post('cp_two_mother_mobile_no'),
            'cp_two_mother_id' => $this->input->post('cp_two_mother_id'),
            'cp_two_mother_id_type' => $this->input->post('cp_two_mother_id_type'),
            'cp_two_mother_alive' => $this->input->post('cp_two_mother_alive'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        if($this->input->post('cp_two_dob_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_dob_document_id'] = $this->input->post('cp_two_dob_document_id');
            $uploaded_cp_two_details['cp_two_dob_document_type'] = $this->input->post('cp_two_dob_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_dob_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_dob_document_type'] = NULL;
        }

        if($this->input->post('cp_two_identity_document_available') == '1'){
            $uploaded_cp_two_details['cp_two_identity_document_id'] = $this->input->post('cp_two_identity_document_id');
            $uploaded_cp_two_details['cp_two_identity_document_type'] = $this->input->post('cp_two_identity_document_type');
        }else{
            $uploaded_cp_two_details['cp_two_identity_document_id'] = NULL;
            $uploaded_cp_two_details['cp_two_identity_document_type'] = NULL;
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $uploaded_cp_two_details);

        // Contracting Party 2 CWC Details
        $uploaded_cp_two_cwc_details = array(
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'minor_sent' => $this->input->post('cp_two_cwc_minor_sent_to'),
            'remarks' => $this->input->post('cp_two_cwc_remarks'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1,
            'transfer_status' => 101
        );
        if($this->input->post('cp_two_cwc_minor_sent_to') == '1' || $this->input->post('cp_two_cwc_minor_sent_to') == '2' || $this->input->post('cp_two_cwc_minor_sent_to') == '3'){
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['district'] = $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['block'] = $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = $this->input->post('cp_two_cwc_address');
            $uploaded_cp_two_cwc_details['cci_details'] = NULL;
            $uploaded_cp_two_cwc_details['case_no'] = NULL;
            $uploaded_cp_two_cwc_details['case_date'] = NULL;
        }else{
            $uploaded_cp_two_cwc_details['case_no'] = $this->input->post('cp_two_cwc_case_no');
            $uploaded_cp_two_cwc_details['case_date'] = $this->input->post('cp_two_cwc_case_date');
            $uploaded_cp_two_cwc_details['state'] = 19;
            $uploaded_cp_two_cwc_details['district'] = $this->input->post('cp_two_cwc_district');
            $uploaded_cp_two_cwc_details['block'] = $this->input->post('cp_two_cwc_block');
            $uploaded_cp_two_cwc_details['address'] = NULL;
            $uploaded_cp_two_cwc_details['cci_details'] = $this->input->post('cp_two_cwc_cci');
        }
        $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_cp_two_cwc_details', $uploaded_cp_two_cwc_details);

        // Police Case Details
        // $uploaded_police_case_details = array(
        //     'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
        //     'gd_no' => $this->input->post('gd_no'),
        //     'gd_date' => $this->us_date_format($this->input->post('gd_date')),
        //     'fir_no' => $this->input->post('fir_no'),
        //     'fir_date' => $this->us_date_format($this->input->post('fir_date')),
        //     'police_station' => $this->input->post('pc_police_station'),
        //     'state' => 19,
        //     'district' => $this->input->post('police_case_district'),
        //     'block' => $this->input->post('police_case_block'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        //     'updated_ip' => $_SERVER['REMOTE_ADDR']
        // );
        // $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_police_case', $uploaded_police_case_details);
    }    
}
?>
