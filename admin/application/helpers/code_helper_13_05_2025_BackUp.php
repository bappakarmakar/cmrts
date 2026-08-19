<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Get Intervention Full Address By Intervention_ID
function Get_Intervention_Full_Address($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT dm.district_id_pk, dm.district_name, bm.block_name , bm.rural_urban,
                CASE 
                     WHEN bm.rural_urban = 'U' THEN CONCAT('Ward ', CAST(wm.ward_no AS VARCHAR))
                     WHEN bm.rural_urban = 'R' THEN gm.gp_name
                END AS ward_gp_name 
                FROM cm_incident_report ir 
                JOIN rp_location_master_district dm ON dm.district_id_pk=ir.district
                JOIN rp_location_master_block bm ON bm.block_id_pk=ir.block
                LEFT JOIN cm_ward_master wm ON wm.ward_id_pk = ir.ward_gp AND bm.rural_urban = 'U'
                LEFT JOIN cm_gp_master gm ON gm.gp_id_pk = ir.ward_gp AND bm.rural_urban = 'R'
                WHERE ir.incident_id_pk='".$incident_id."' ")->row_array();
    // echo $ci->db->last_query();
    return $query;
}

// Get CP Full Address By CP_ID
function Get_CP_Full_Address($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT cp.cp_state, dm.district_name, bm.block_name, bm.rural_urban, 
                CASE 
                     WHEN cp.cp_state=1 AND bm.rural_urban = 'U' THEN CONCAT('Ward ', CAST(wm.ward_no AS VARCHAR))
                     WHEN cp.cp_state=1 AND bm.rural_urban = 'R' THEN gm.gp_name
                END AS ward_gp_name,
                CASE 
                    WHEN cp.cp_state = 2 THEN cp.cp_address
                    ELSE NULL 
                END AS cp_address
                FROM cm_incident_report_contracting_parties cp 
                LEFT JOIN rp_location_master_district dm ON dm.district_id_pk=cp.cp_district AND cp.cp_state = 1
                LEFT JOIN rp_location_master_block bm ON bm.block_id_pk=cp.cp_block AND cp.cp_state = 1
                LEFT JOIN cm_ward_master wm ON wm.ward_id_pk = cp.cp_ward_gp AND bm.rural_urban = 'U' AND cp.cp_state=1
                LEFT JOIN cm_gp_master gm ON gm.gp_id_pk = cp.cp_ward_gp AND bm.rural_urban = 'R' AND cp.cp_state=1
                WHERE cp.cp_id_pk='".$cp_id_fk."' ")->row_array();
    // echo $ci->db->last_query();die;
    return $query;
}

function get_user_name($notice_id){

    $ci=& get_instance(); 
    $ci->load->database();
    $ci->db->select('rec.*');
    $ci->db->from('cm_notice_received AS rec');
    $ci->db->where('rec.notice_id_fk' , $notice_id);
    $row_data = $ci->db->get()->result_array();
    
    foreach ($row_data as $value) {
        $ci->db->select('*');
        $ci->db->from('cm_stake_holder_master');
        $ci->db->where('stake_id_pk' , $value['stake_id_fk']);
        $user_name = $ci->db->get()->result_array();
        //echo $ci->db->last_query();
        if (!empty($user_name)) {
            $stakeholder_data[] = $user_name[0];
        }
    }
    return $stakeholder_data;
} 

function cm_incident_report_by_incident_id($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('B.description as prevented_val ,C.description AS marriage_val,*');
    $ci->db->from('cm_incident_report AS A');
    $ci->db->join('cm_prevented_master AS B', 'A.prevented_details = B.cm_incident_report_details_master_id_pk', 'left');
    $ci->db->join('cm_marriage_details_master AS C', 'A.prevented_details = C.cm_marriage_master_id_pk', 'left');
    $ci->db->where('incident_id_pk' , $incident_id);
    $row = $ci->db->get()->row();
     return $row;
}
function contracting_parties_details_by_cp_id($cp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('cp_age');
    $ci->db->from('cm_incident_report_contracting_parties');
    $ci->db->where('cp_id_pk' , $cp_id);
    $row = $ci->db->get()->row();
     return ($row)?$row->cp_age:'';
}
function generateRandomPassword($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $maxIndex = strlen($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $maxIndex)];
    }
    
    return $password;
}
function get_school_name_by_id($schcd='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('school_name');
    $ci->db->from('bs_school_master_kanyashree');
    $ci->db->where('schcd' , $schcd);
    $row = $ci->db->get()->row();
    return ($row)?$row->school_name:''; 
}
function get_block_name_by_id($sl_no='')
{ 
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('block_name');
    $ci->db->from('rp_location_master_block');
    //$ci->db->where('sl_no' , $sl_no); // commend by bappa 
    $ci->db->where('block_id_pk' , $sl_no); // new for school and block mapping
    $row = $ci->db->get()->row();

    // echo $ci->db->last_query();die;

    return ($row)?$row->block_name:''; 
}
function get_district_name_by_id($district_id='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('district_name');
    $ci->db->from('rp_location_master_district');
    $ci->db->where('district_id_pk' , $district_id);
    $row = $ci->db->get()->row();
    return ($row)?$row->district_name:''; 
}
function get_estimated_severity_details_by_id($sl_no='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('description');
    $ci->db->from('cm_estimated_severity_master');
    $ci->db->where('sl_no' , $sl_no);
    $row = $ci->db->get()->row();
    return ($row)?$row->description:''; 
}
function get_disability_details_by_id($sl_no='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('description');
    $ci->db->from('cm_disability_master');
    $ci->db->where_in('sl_no' , $sl_no);
    $row = $ci->db->get()->result_array();
    return $row; 
}
function get_gender_details_by_id($sl_no='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('description');
    $ci->db->from('cm_gender_master');
    $ci->db->where('cm_gender_master_id_pk' , $sl_no);
    $row = $ci->db->get()->row();
    return ($row)?$row->description:''; 
}
function get_mode_of_enquiry_details_by_id($sl_no='')
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('description');
    $ci->db->from('cm_mode_of_enquiry_master');
    $ci->db->where('sl_no' , $sl_no);
    $row = $ci->db->get()->row();
    return ($row)?$row->description:''; 
}
########################
// Police Cases Reason Name
function get_police_cases_reason_name($sl_no){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('description');
    $ci->db->from('cm_police_case_reason_master');
    $ci->db->where('sl_no' , $sl_no);
    $row = $ci->db->get()->row();
    return ($row)?$row->description:'';
}
// Incident List CP One CWC Details
function get_cp_one_cwc_details($incident_id_pk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('minor_sent, transfer_status');
    $ci->db->from('cm_incident_report_cp_one_cwc_details');
    $ci->db->where('incident_id_fk' , $incident_id_pk);
    $ci->db->order_by("sl_no", "DESC");
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
}
// Incident List CP Two CWC Details
function get_cp_two_cwc_details($incident_id_pk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('minor_sent, transfer_status');
    $ci->db->from('cm_incident_report_cp_two_cwc_details');
    $ci->db->where('incident_id_fk' , $incident_id_pk);
    $ci->db->order_by("sl_no", "DESC");
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Local Person Details
function Get_Local_Person_Details($incident_id_pk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('local_person_name, local_person_gender, local_person_occupation_identity');
    $ci->db->from('cm_incident_report_local_persons_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id_pk);
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident List Officials Involved Details
function Get_Official_Involved_Details($incident_id_pk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('official_involved_name, officials_involved_designation, officials_involved_office, officials_involved_contact_no');
    $ci->db->from('cm_incident_report_officials_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id_pk);
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident List CP One Current Address Details
function Get_Cp_One_Address($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('state, district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, block as cp_1_address_block_id, street_landmark, pin_code, ward_gp, police_station, address, remarks');
    $ci->db->from('cm_incident_report_cp_address_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $ci->db->where('cp_type' , 1);
    $ci->db->order_by("sl_no", "DESC");
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident List CP Two Current Address Details
function Get_Cp_Two_Address($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('state, district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, block as cp_2_address_block_id, street_landmark, pin_code, ward_gp, police_station, address, remarks');
    $ci->db->from('cm_incident_report_cp_address_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $ci->db->where('cp_type' , 2);
    $ci->db->order_by("sl_no", "DESC");
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident Print Local Person Details
function Get_Print_Local_Person_Details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, local_person_name, local_person_gender, local_person_occupation_identity');
    $ci->db->from('cm_incident_report_local_persons_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->result_array();
    return $row;
} 
// Incident Print Officials_Involved Details
function Get_Print_Officials_Involved_Details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, official_involved_name, officials_involved_designation, officials_involved_office, officials_involved_contact_no');
    $ci->db->from('cm_incident_report_officials_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->result_array();
    return $row;
} 
// Home Visit Minor Details
function Get_Home_Visit_Minor_Details($cp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, incident_id_fk, cp_id_fk, mode_of_enquiry, gender, family_income, nutritious_meals, neighbours_community, emergencies, disability, type_of_disability, disability_certificate, disability_percent, estimated_severity, education, education_frequency, kishori_group, kishori_group_frequency, paid_work, paid_work_frequency, kanyashree_id, parents_supported, family_elders_supported, peers_supported, neighbours_supported, others_supported, minor_pregnant, stage_of_pregnancy, remarks, minor_entry_by');
    $ci->db->from('cm_home_visit_minor_details');
    $ci->db->where('cp_id_fk' , $cp_id);
    $row = $ci->db->get()->result();
    return $row;
}
// Home Visit Adult Details
function Get_Home_Visit_Adult_Details($cp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, incident_id_fk, cp_id_fk, mode_of_enquiry, gender, family_income, nutritious_meals, neighbours_community, emergencies, education, education_frequency, paid_work, paid_work_frequency, adult_entry_by');
    $ci->db->from('cm_home_visit_adult_details');
    $ci->db->where('cp_id_fk' , $cp_id);
    $row = $ci->db->get()->result();
    return $row;
} 
// Home Visit Minor Siblings Details
function Get_Home_Visit_Minor_Siblings_Details($sl_no){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, siblings_name, siblings_age, siblings_occupation, siblings_sex');
    $ci->db->from('cm_home_visit_minor_siblings_details');
    $ci->db->where('hvm_id_fk' , $sl_no);
    $row = $ci->db->get()->result();
    return $row;
}
// Home Visit Adult Siblings Details
function Get_Home_Visit_Adult_Siblings_Details($sl_no){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, siblings_name, siblings_age, siblings_occupation, siblings_sex');
    $ci->db->from('cm_home_visit_adult_siblings_details');
    $ci->db->where('hvm_id_fk' , $sl_no);
    $row = $ci->db->get()->result();
    return $row;
} 
// Follow Up Visit Details
function Get_Follow_Up_Visit_Details($cp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, incident_id_fk, cp_id_fk, mode_of_enquiry, gender, education, education_frequency, kishori_group, kishori_group_frequency, paid_work, paid_work_frequency, parents_supported, family_elders_supported, peers_supported, neighbours_supported, others_supported, minor_pregnant, stage_of_pregnancy, remarks');
    $ci->db->from('cm_follow_up_visit_details');
    $ci->db->where('cp_id_fk' , $cp_id);
    $ci->db->where('active_status' , 1);
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident Edit Local Person Involved Details
function Get_Local_Person_Edit_Details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no,local_person_name, local_person_gender, local_person_occupation_identity');
    $ci->db->from('cm_incident_report_local_persons_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->result();
    return $row;
} 
// Incident Edit Local Person Involved Details
function Get_Officials_Involved_Edit_Details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no, official_involved_name, officials_involved_designation, officials_involved_office, officials_involved_contact_no');
    $ci->db->from('cm_incident_report_officials_involved_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->result();
    return $row;
} 
// Address Change CWC CP One Details
function cp_one_cwc_details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('cponecwcd.minor_sent, cponecwcd.transfer_status');
    $ci->db->from('cm_incident_report_cp_one_cwc_details AS cponecwcd');
    $ci->db->where('cponecwcd.incident_id_fk' , $incident_id);
    $ci->db->order_by("sl_no", "DESC");
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Address Change CWC CP Two Details
function cp_two_cwc_details($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('cptwocwcd.minor_sent, cptwocwcd.transfer_status');
    $ci->db->from('cm_incident_report_cp_two_cwc_details AS cptwocwcd');
    $ci->db->where('cptwocwcd.incident_id_fk' , $incident_id);
    $ci->db->order_by("sl_no", "DESC");
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get CP One Block Details
function Get_Incident_List_CP_One_Block_Details($block_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('rural_urban');
    $ci->db->from('rp_location_master_block');
    $ci->db->where('block_id_pk' , $block_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get CP Two Block Details
function Get_Incident_List_CP_Two_Block_Details($block_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('rural_urban');
    $ci->db->from('rp_location_master_block');
    $ci->db->where('block_id_pk' , $block_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get CP One Ward Details
function Get_Incident_List_CP_One_Ward_Details($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as cp_one_ward_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Incident Ward Details
function Get_Incident_List_Incident_Ward_Details($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as incident_ward_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
}

// Get Block name 
function get_blocl_name($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as incident_word_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    // echo $this->db->last_query();die;
    return $row;
}
// Get GP name 
function get_gp_name($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as incident_word_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    // echo $this->db->last_query();die;
    return $row;
}

// Incident List Get CP One GP Details
function Get_Incident_List_CP_One_GP_Details($gp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as cp_one_ward_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $gp_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get CP One GP Details
function Get_Incident_List_Incident_GP_Details($gp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as incident_ward_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $gp_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
}
// Incident List Get CP Two Ward Details
function Get_Incident_List_CP_Two_Ward_Details($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as cp_two_ward_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get CP Two GP Details
function Get_Incident_List_CP_Two_GP_Details($gp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as cp_two_ward_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $gp_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Block Details
function Get_Incident_List_Block_Details($block_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('rural_urban');
    $ci->db->from('rp_location_master_block');
    $ci->db->where('block_id_pk' , $block_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Ward Details
function Get_Incident_List_Ward_Details($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as ward_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get GP Details
function Get_Incident_List_GP_Details($gp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as ward_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $gp_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Identity Block Details
function Get_Incident_List_Identity_Block_Details($block_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('rural_urban');
    $ci->db->from('rp_location_master_block');
    $ci->db->where('block_id_pk' , $block_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Identity Ward Details
function Get_Incident_List_Identity_Ward_Details($ward_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('ward_id_pk, ward_no as identity_ward_gp');
    $ci->db->from('cm_ward_master');
    $ci->db->where('ward_id_pk' , $ward_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident List Get Identity GP Details
function Get_Incident_List_Identity_GP_Details($gp_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('gp_id_pk, gp_name as identity_ward_gp');
    $ci->db->from('cm_gp_master');
    $ci->db->where('gp_id_pk' , $gp_id);
    $ci->db->limit(1);
    $row = $ci->db->get()->row();
    return $row;
} 
// Incident Current CP One Address Count Check 
function Get_CP_One_Current_Address_Count_Check($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_incident_report_cp_one_cwc_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->num_rows();
    return $row;
}
// Incident Current CP Two Address Count Check 
function Get_CP_Two_Current_Address_Count_Check($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_incident_report_cp_two_cwc_details');
    $ci->db->where('incident_id_fk' , $incident_id);
    $row = $ci->db->get()->num_rows();
    return $row;
}
// CP Current Status
function Get_CP_Current_Status($current_status){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('code, description');
    $ci->db->where('code' , $current_status);
    $row = $ci->db->get('cm_status_master')->row();
    $description = $row->description;
    return $description;
}
// Incident homevisit Count Check 
function Get_CP_Homevisit_Count($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_incident_report_home_visit');
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $ci->db->where('active_status' , 1);
    $row = $ci->db->get()->num_rows();
    return $row;
} 
function Get_CP_Homevisit_Details_Check($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no,hv_status');
    $ci->db->from('cm_incident_report_home_visit');
    $ci->db->where('active_status' , 1);
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $row = $ci->db->get()->row_array();
    return ($row)?$row:array();
}

function Get_CP_Not_Followup_published_Count($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_follow_up_visit_details');
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $ci->db->where('active_status' , 1);
    $ci->db->where_not_in('fv_status' , 3);
    $row = $ci->db->get()->num_rows();
    return $row;
}
function Get_CP_Followup_Count($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_follow_up_visit_details');
    $ci->db->where('active_status' , 1);
    $ci->db->where('cp_id_fk' , $cp_id_fk);

    $row = $ci->db->get()->num_rows();
    return $row;
}
function Get_CP_Followup_published_Count($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_follow_up_visit_details');
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $ci->db->where('active_status' , 1);
    $ci->db->where('fv_status' , 3);
    $row = $ci->db->get()->num_rows();
    return $row;
}

function Get_CP_Address_details_Count($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no');
    $ci->db->from('cm_incident_report_cp_address_details');
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $row = $ci->db->get()->num_rows();
    return $row;
}

function Get_CP_Address_details_block($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('district, block');
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $ci->db->order_by('sl_no', 'desc');
    $ci->db->limit(1);
    $row = $ci->db->get('cm_incident_report_cp_address_details')->row();
    $block = $row->block;
    return $block;
}



function Get_CP_Homevisit_state($cp_id_fk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('sl_no,hv_status,incident_id_fk');
    $ci->db->from('cm_incident_report_home_visit');
    $ci->db->where('active_status' , 1);
    $ci->db->where('cp_id_fk' , $cp_id_fk);
    $row = $ci->db->get()->row_array();
    // return $ci->db->last_query();
    if($row){
        return $row;
    }else{
        return null;
    }
}
//Get status for cp1 and cp2
function cp_status($current_status, $cp_id_fk, $cp_age)
{
    $status = '';

    $x = Get_CP_Homevisit_state($cp_id_fk);

     //echo "<pre>";echo $x['hv_status'].'---'.$cp_age.'</br>';//die;

    if($current_status == 3)
    {
        if(!empty($x))
        {
            // echo $x['hv_status'];
            if(isset($x['hv_status']) == 0)
            {
                if($cp_age >= 18)
                {
                    $status = "Adult Home Enquiry Pending";
                }
                else{
                    $status =  "Minor Home Enquiry Pending";
                }


                //$status = "Home Enquiry is in save as draft stage";
            }
            else if($x['hv_status'] == 1)
            {
                if($cp_age >= 18)
                {
                    $status = "Adult Home Enquiry Pending";
                }
                else{
                    $status =  "Minor Home Enquiry Pending....";
                    // $status =  "Home Enquiry Saved--";
                }
                //$status = "Home Enquiry is saved";
            }
            else if($x['hv_status'] == 2)
            {
                if($cp_age >= 18)
                {
                    $status = "Adult Home Enquiry Pending";
                }
                else{
                    $status =  "Minor Home Enquiry Pending";
                }
                //$status = "Home Enquiry is saved";
            }
            else if($x['hv_status'] == 3)
            {
                $status = "Home Enquiry is publised";
                if(Get_CP_Followup_published_Count($cp_id_fk) == 0 && $cp_age < 18)
                {
                    $status1 =  "<br>Follow-Up Visit Pending";
                    $status .=$status1;
                }
                else if(Get_CP_Followup_published_Count($cp_id_fk) > 0 && $cp_age < 18)
                {
                    $status1 =  "<br>Follow-Up Visit Conducted ".Get_CP_Followup_published_Count($cp_id_fk)." times";
                    $status .=$status1;
                }
            }
        }
        else
        {
            //echo 'ELSE ---'.$cp_age;
            if($cp_age >= 18)
            {
                $status = "Adult Home Enquiry Pending";
            }
            else{
                $status =  "Minor Home Enquiry Pending";
            }
        }
    }
    // if($current_status == 3){
    //     if(Get_CP_Homevisit_Count($cp_id_fk) == 0){
    //         if($cp_age >= 18){
    //             $status = "Adult Home Visit Pending";
    //         }
    //         else{
    //             $status =  "Minor Home Visit Pending";
    //         }
            
    //     }
    //     elseif(Get_CP_Homevisit_Count($cp_id_fk) > 0 && Get_CP_Followup_Count($cp_id_fk) == 0 && $cp_age < 18){
    //         $status =  "Home Visit Completed & Follow-Up Visit Pending";
    //     }
    //     elseif(Get_CP_Homevisit_Count($cp_id_fk) > 0 && Get_CP_Followup_Count($cp_id_fk) > 0 && $cp_age < 18){
    //         $status =  "Home Visit Completed & Follow-Up Visit Conducted ".Get_CP_Followup_Count($cp_id_fk)." times";
    //     }
    // }
    // return $status;
    // return $x;
    return $status;
}
function cp_status_OLD($current_status, $cp_id_fk, $cp_age)
{
    $status = '';

    $x = Get_CP_Homevisit_state($cp_id_fk);

    // echo "<pre>";print_r($x);

    if($current_status == 3)
    {
        if(!empty($x))
        {
            // echo $x['hv_status'];
            if($x['hv_status'] == 0)
            {
                $status = "Home Enquiry is in save as draft stage";
            }
            else if($x['hv_status'] == 1)
            {
                $status = "Home Enquiry is saved";
            }
            else if($x['hv_status'] == 2)
            {
                $status = "Home Enquiry is publised";
                if(Get_CP_Followup_Count($cp_id_fk) == 0 && $cp_age < 18)
                {
                    $status1 =  "<br>Follow-Up Visit Pending";
                    $status .=$status1;
                }
                else if(Get_CP_Followup_Count($cp_id_fk) > 0 && $cp_age < 18)
                {
                    $status1 =  "<br>Follow-Up Visit Conducted ".Get_CP_Followup_Count($cp_id_fk)." times";
                    $status .=$status1;
                }
            }
        }
        else
        {
            if($cp_age >= 18)
            {
                $status = "Adult Home Enquiry Pending";
            }
            else{
                $status =  "Minor Home Enquiry Pending";
            }
        }
    }
    // if($current_status == 3){
    //     if(Get_CP_Homevisit_Count($cp_id_fk) == 0){
    //         if($cp_age >= 18){
    //             $status = "Adult Home Visit Pending";
    //         }
    //         else{
    //             $status =  "Minor Home Visit Pending";
    //         }
            
    //     }
    //     elseif(Get_CP_Homevisit_Count($cp_id_fk) > 0 && Get_CP_Followup_Count($cp_id_fk) == 0 && $cp_age < 18){
    //         $status =  "Home Visit Completed & Follow-Up Visit Pending";
    //     }
    //     elseif(Get_CP_Homevisit_Count($cp_id_fk) > 0 && Get_CP_Followup_Count($cp_id_fk) > 0 && $cp_age < 18){
    //         $status =  "Home Visit Completed & Follow-Up Visit Conducted ".Get_CP_Followup_Count($cp_id_fk)." times";
    //     }
    // }
    // return $status;
    // return $x;
    return $status;
}

// Check Incident Exit ?
function get_incident_info($incident_id_pk,$current_status){
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('incident_id_pk,current_status,reporting_id');
    $ci1->db->from('cm_incident_report');
    $ci1->db->where('incident_id_pk' , $incident_id_pk);
    $ci1->db->where('current_status' , $current_status);
    $ci1->db->where('delete_status' , 0);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $row = $ci1->db->get()->row();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $row;
}

// Get marriage details 
function get_incident_marriage_details(){
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_marriage_master_id_pk,description');
    $ci1->db->from('cm_marriage_details_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $row = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $row;
}

function get_prevented_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_incident_report_details_master_id_pk,description');
    $ci1->db->from('cm_prevented_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}
function get_location_description_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_location_master_id_pk,description');
    $ci1->db->from('cm_location_description_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}
function get_social_category_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_social_category_master_id_pk,description');
    $ci1->db->from('cm_social_category_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}
function get_religion_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_religion_master_id_pk,description');
    $ci1->db->from('cm_religion_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}
function get_highest_educational_attainment_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_highest_educational_attainment_master_id_pk,description');
    $ci1->db->from('cm_highest_educational_attainment_master');
    $ci1->db->where('active_status' , 1);
    // $ci->db->order_by("sl_no", "DESC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}

function get_document_type_master()
{
    $ci1=& get_instance();
    $ci1->load->database();
    $ci1->db->select('cm_document_type_master_master_id_pk,description');
    $ci1->db->from('cm_document_type_master');
    $ci1->db->where('active_status' , 1);
    $ci1->db->order_by("cm_document_type_master_master_id_pk", "ASC");
    // $ci->db->limit(1);
    $result = $ci1->db->get()->result_array();

    // echo"<pre>";print_r($ci1->db->last_query());die;
    return $result;
}

function address_changes_details_by_id($where_array=array()){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from('cm_incident_report_cp_address_details');
    $ci->db->where($where_array);
    $result = $ci->db->get()->row();
    return $result;
}
function contracting_parties_details_by_incident_id($incident_id){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('cp_id_pk,cp_type');
    $ci->db->from('cm_incident_report_contracting_parties');
    $ci->db->where('incident_id_fk' , $incident_id);
    $result = $ci->db->get()->result();
    return $result;
}
function contracting_parties_archive_details_count($cp_id_pk){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('cp_id_pk');
    $ci->db->from('cm_incident_report_contracting_parties_archive');
    $ci->db->where('cp_id_pk' , $cp_id_pk);
    $result = $ci->db->get()->num_rows();
    return $result;
}
function get_full_year_HE_FUV($entry_date, $cp_dob){
    // echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';

    // Convert dates to DateTime objects
    $dob = new DateTime($cp_dob);
    $entry_date = new DateTime($entry_date);
    // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
    // Calculate the difference
    $age = $dob->diff($entry_date);
    // Display the age
    echo $age->y . " years, " . $age->m . " months, " . $age->d . " days";

}
function get_full_year_HE_FUV_excel_view($entry_date, $cp_dob){
    // echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';

    // Convert dates to DateTime objects
    $dob = new DateTime($cp_dob);
    $entry_date = new DateTime($entry_date);
    // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
    // Calculate the difference
    $age = $dob->diff($entry_date);
    // Display the age
    return $age->y . " years, " . $age->m . " months, " . $age->d . " days";

}
function get_full_year_HE_FUV_excel_view_for_he($entry_date, $cp_dob){
    // echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';

    // Convert dates to DateTime objects
    $dob = new DateTime($cp_dob);
    $entry_date = new DateTime($entry_date);
    // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
    // Calculate the difference
    $age = $dob->diff($entry_date);
    // Display the age
    return $age->y . " years, " . $age->m . " months, " . $age->d . " days";

}
function get_full_for_excel_view_for_he($entry_date, $cp_dob){
    // echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';
if($entry_date && $cp_dob){
    // Convert dates to DateTime objects
    $dob = new DateTime($cp_dob);
    $entry_date = new DateTime($entry_date);
    // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
    // Calculate the difference
    $age = $dob->diff($entry_date);
    // Display the age
    echo $age->y . " years, " . $age->m . " months, " . $age->d . " days";
}else{
    echo "";
}

}
function get_full_for_excel_dwn_for_he($entry_date, $cp_dob){
    // echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';

    // Convert dates to DateTime objects
    $dob = new DateTime($cp_dob);
    $entry_date = new DateTime($entry_date);
    // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
    // Calculate the difference
    $age = $dob->diff($entry_date);
    // Display the age
    return $age->y . " years, " . $age->m . " months, " . $age->d . " days";

}

function full_age_view($entry_date, $cp_dob){
     //echo 'PB>'.$entry_date.'</br>DOB>'.$cp_dob.'</br>';
    if($entry_date && $cp_dob){
            // Convert dates to DateTime objects
        $dob = new DateTime($cp_dob);
        $entry_date = new DateTime($entry_date);
        // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
        // Calculate the difference
        $age = $dob->diff($entry_date);
        // Display the age
        echo $age->y . " years, " . $age->m . " months, " . $age->d . " days";
    }else{
        echo "";
    }

}


function get_full_for_interv_exc_dwn($entry_date, $cp_dob){
        if($entry_date && $cp_dob){
            // Convert dates to DateTime objects
        $dob = new DateTime($cp_dob);
        $entry_date = new DateTime($entry_date);
        // $publish_date = new DateTime(substr($publish_date, 0, 19)); // Remove microseconds and create DateTime
        // Calculate the difference
        $age = $dob->diff($entry_date);
        // Display the age
        return $age->y . " years, " . $age->m . " months, " . $age->d . " days";
    }else{
        echo "";
    }



    // -------------------------SCHEDULER MIS FUNCTION START-----------------------------
function scheduler_days_overdue_show($dates) {
    date_default_timezone_set("Asia/Kolkata");
    
    $today = date('Y-m-d');
    $date = date('Y-m-d', strtotime($dates));

    if ($date > $today) {
        echo "Upcoming";
    }elseif($date == $today){
        echo "Due Today";
    }elseif($date < $today){
      $todayDate = new DateTime($today);
        $givenDate = new DateTime($date);

        $diff = $todayDate->diff($givenDate);
        echo $diff->format('%a');
    }
}

function scheduler_days_overdue_return_for_excl($dates) {
    date_default_timezone_set("Asia/Kolkata");
    
    $today = date('Y-m-d');
    $date = date('Y-m-d', strtotime($dates));

    if ($date > $today) {
        $Upcoming = "Upcoming";
        return $Upcoming;
    }elseif($date == $today){
        $due_today = "Due Today";
        return $due_today;
    }elseif($date < $today){
      $todayDate = new DateTime($today);
        $givenDate = new DateTime($date);

        $diff = $todayDate->diff($givenDate);
        return $diff->format('%a');
    }
}

function age_diff_echo($cp_dob, $date){
    // echo $cp_dob;die;

        $dob = new DateTime($cp_dob);
        $date = new DateTime($date);
        // Calculate the difference
        $age = $dob->diff($date);
        // Display the age
        echo $age->y . "y " . $age->m . "m " . $age->d . "d";
}
function age_diff_return($cp_dob, $date){

        $dob = new DateTime($cp_dob);
        $date = new DateTime($date);
        // Calculate the difference
        $age = $dob->diff($date);
        // Display the age
        return $age->y . "y " . $age->m . "m " . $age->d . "d";
}

// -------------------------SCHEDULER MIS FUNCTION END-----------------------------

}