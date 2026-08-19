<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function follow_up_visit_count_by_id($incident_id,$cp_id,$cp_type){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_follow_up_visit_details')
        ->where(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type))
        ->get()->row_array();
        return ($query)?$query:array();
    }

    public function fresh_follow_up_visit_count_by_id($incident_id,$cp_id,$cp_type){
        // echo 123;die;
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_follow_up_visit_details')
        ->where('active_status' , 1)
        ->where(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type))
        ->where_not_in('fv_status',3)
        ->get()->row_array();
         //print_r($this->db->last_query());die;
        return ($query)?$query:array();
    }

    public function follow_up_visit_details_insert($insert_data=array()){
        $default = $this->load->database('default',TRUE);
        $default->insert('cm_follow_up_visit_details', $insert_data);
        //print $default->last_query();die();
        return $default->affected_rows();
    }
    public function follow_up_visit_update_by_sl_no($updateData,$sl_no){
        $default = $this->load->database('default',TRUE);
        $default->where('sl_no', $sl_no)->where('active_status' , 1)
           ->update('cm_follow_up_visit_details',$updateData);
        //print $default->last_query();die();
        return $default->affected_rows();
    }
    
    public function homwvisit_siblings_update_by_sl_no($updateData,$sl_no){
        $default = $this->load->database('default',TRUE);
        $default->where('sl_no', $sl_no)
           ->update('cm_incident_report_home_visit_siblings_details',$updateData);
        //print $default->last_query();die();
        return $default->affected_rows();
    }
    
    public function get_incident_cp_details($cp_id)
    {
         // $query = $this->db->select('cp_gender as gender, cp_age,cp_name,cp_district,cp_block,cp_ward_gp, block_location_master_description(cp_block) AS block_name,district_location_master_description(cp_district) as district_name,cp_phone_no,TO_CHAR(cp_dob, 'DD/MM/YYYY') AS "cp_dob",,cp_age AS inc_cp_age')
            $query = $this->db->select('cp_gender as gender, cp_age, cp_name, cp_district, cp_block, cp_ward_gp, cp_police_station,block_location_master_description(cp_block) AS block_name, district_location_master_description(cp_district) as district_name, cp_phone_no, TO_CHAR(cp_dob, \'DD/MM/YYYY\') AS cp_dob,cp_dob as cp_dob_new, cp_age AS inc_cp_age')
            ->from('cm_incident_report_contracting_parties')
            ->where('cp_id_pk' , $cp_id)
            ->get()->row();
        // echo $this->db->last_query();die;
        return $query;
    }

    public function insert_follow_up_visit_details($incident_id, $cp_type, $cp_id) 
    {
        // Follow Up Visit Details
        $upload_follow_up_visit_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $cp_id,
            'cp_type' => $cp_type,
            'mode_of_enquiry' => $this->input->post('mode_of_enquiry'),
            'gender' => $this->input->post('gender'),
            'education' => $this->input->post('education'),
            'education_frequency' => $this->input->post('education_frequency'),
            'kishori_group' => $this->input->post('kishori_group'),
            'kishori_group_frequency' => $this->input->post('kishori_group_frequency'),
            'paid_work' => $this->input->post('paid_work'),
            'paid_work_frequency' => $this->input->post('paid_work_frequency'),
            'parents_supported' => $this->input->post('parents_supported'),
            'family_elders_supported' => $this->input->post('family_elders_supported'),
            'peers_supported' => $this->input->post('peers_supported'),
            'neighbours_supported' => $this->input->post('neighbours_supported'),
            'others_supported' => $this->input->post('others_supported'),
            'minor_pregnant' => $this->input->post('minor_pregnant'),
            'stage_of_pregnancy' => $this->input->post('stage_of_pregnancy'),
            'remarks' => $this->input->post('remarks'),
            'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
            'entry_time' => date('Y-m-d H:i:s'),
            'entry_ip' => $_SERVER['REMOTE_ADDR']
        );
        $result = $this->db->insert('cm_follow_up_visit_details', $upload_follow_up_visit_details);
    }

    public function get_follow_up_visit_edit_details($follow_up_id)
    {
         $query = $this->db->select('fuvd.incident_id_fk,fuvd.cp_id_fk,fuvd.cp_type,fuvd.sl_no, fuvd.mode_of_enquiry, fuvd.gender, fuvd.education, fuvd.education_frequency, fuvd.kishori_group, fuvd.kishori_group_frequency, fuvd.paid_work, fuvd.paid_work_frequency, fuvd.parents_supported, fuvd.family_elders_supported, fuvd.peers_supported, fuvd.neighbours_supported, fuvd.others_supported, fuvd.minor_pregnant, fuvd.stage_of_pregnancy, fuvd.remarks,TO_CHAR(fuvd.followup_date, \'DD/MM/YYYY\') AS followup_date,fuvd.age_on_folllowup')
            ->from('cm_follow_up_visit_details AS fuvd')
            ->where('fuvd.sl_no' , $follow_up_id)
            ->get()->row();
        // print_r($this->db->last_query());die;
        return $query;
    }

    public function update_follow_up_visit_details($follow_up_id)
    {
        if($this->input->post('education') == 1){
            $education_frequency = $this->input->post('education_frequency');
        }else{
            $education_frequency = 0;
        }

        if($this->input->post('kishori_group') == 1){
            $kishori_group_frequency = $this->input->post('kishori_group_frequency');
        }else{
            $kishori_group_frequency = 0;
        }

        if($this->input->post('paid_work') == 1){
            $paid_work_frequency = $this->input->post('paid_work_frequency');
        }else{
            $paid_work_frequency = 0;
        }

        if($this->input->post('minor_pregnant') == 1){
            $stage_of_pregnancy = $this->input->post('stage_of_pregnancy');
        }else{
            $stage_of_pregnancy = 0;
        }
        
        $upload_follow_up_visit_details = array(
            'mode_of_enquiry' => $this->input->post('mode_of_enquiry'),
            'gender' => $this->input->post('gender'),
            'education' => $this->input->post('education'),
            'education_frequency' => $education_frequency,
            'kishori_group' => $this->input->post('kishori_group'),
            'kishori_group_frequency' => $kishori_group_frequency,
            'paid_work' => $this->input->post('paid_work'),
            'paid_work_frequency' => $paid_work_frequency,
            'parents_supported' => $this->input->post('parents_supported'),
            'family_elders_supported' => $this->input->post('family_elders_supported'),
            'peers_supported' => $this->input->post('peers_supported'),
            'neighbours_supported' => $this->input->post('neighbours_supported'),
            'others_supported' => $this->input->post('others_supported'),
            'minor_pregnant' => $this->input->post('minor_pregnant'),
            'stage_of_pregnancy' => $stage_of_pregnancy,
            'remarks' => $this->input->post('remarks'),
            'update_by' => $this->session->userdata('stake_holder_login_id_pk'),
            'update_time' => date('Y-m-d H:i:s'),
            'update_ip' => $_SERVER['REMOTE_ADDR']
        );
        $this->db->where('sl_no', $follow_up_id)->update('cm_follow_up_visit_details', $upload_follow_up_visit_details);
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
