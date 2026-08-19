<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    
    public function get_incident_details($incident_id)
    {
        $cp_one_query = $this->db->select('cpo.sl_no, cpo.cp_one_gender as gender, cpo.cp_one_district, cpo.cp_one_block, cmir.cp_one_age')
            ->from('cm_incident_report_contracting_party_one AS cpo')
            ->join('cm_incident_report AS cmir', 'cmir.incident_id_pk = cpo.incident_id_fk')
            ->where('incident_id_fk' , $incident_id)
            ->get()->row();

        $cp_two_query = $this->db->select('cpt.sl_no, cpt.cp_two_gender as gender, cpt.cp_two_district,  cpt.cp_two_block, cmir.cp_two_age')
            ->from('cm_incident_report_contracting_party_two AS cpt')
            ->join('cm_incident_report AS cmir', 'cmir.incident_id_pk = cpt.incident_id_fk')
            ->where('incident_id_fk' , $incident_id)
            ->get()->row();

        /*if($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_district == $this->session->userdata('district') && $cp_one_query->cp_one_block == $this->session->userdata('block')){
            return $cp_one_query;
        }else{
            return $cp_two_query;
        }*/
        if($cp_one_query->cp_one_age < 18)
        {
            return $cp_one_query;
        }
        elseif($cp_two_query->cp_two_age < 18)
        {
            return $cp_two_query;
        }
        elseif($cp_one_query->cp_one_age < 18 && $cp_two_query->cp_two_age < 18 )
        {
            return array_merge($cp_one_query, $cp_two_query);
        }
    }

    public function get_incident_details_new($incident_id)
    {
        $cp_one_query = $this->db->select('cpo.sl_no, cpo.cp_one_gender as gender, cpo.cp_one_district, cpo.cp_one_block, cmir.cp_one_age')
            ->from('cm_incident_report_contracting_party_one AS cpo')
            ->join('cm_incident_report AS cmir', 'cmir.incident_id_pk = cpo.incident_id_fk')
            ->where('incident_id_fk' , $incident_id)
            ->get()->row();

        $cp_two_query = $this->db->select('cpt.sl_no, cpt.cp_two_gender as gender, cpt.cp_two_district,  cpt.cp_two_block, cmir.cp_two_age')
            ->from('cm_incident_report_contracting_party_two AS cpt')
            ->join('cm_incident_report AS cmir', 'cmir.incident_id_pk = cpt.incident_id_fk')
            ->where('incident_id_fk' , $incident_id)
            ->get()->row();

        if(($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_district == $this->session->userdata('district') && $cp_one_query->cp_one_block == $this->session->userdata('block')) && ($cp_two_query->cp_two_age < 18 && $cp_two_query->cp_two_district == $this->session->userdata('district') && $cp_two_query->cp_two_block == $this->session->userdata('block')))
        {
            $cp_age=array($cp_one_query,$cp_two_query);
            return $cp_age;
        }  

        if($cp_one_query->cp_one_age < 18 && $cp_two_query->cp_two_age < 18)
        {
            if($cp_one_query->cp_one_block == $cp_two_query->cp_two_block)
            {
                echo "both from same place";exit;
            }
            //cp_one
            elseif($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_block == $this->session->userdata('block'))
            {
                return array($cp_one_query);
            }
            //cp_two
            elseif($cp_two_query->cp_two_age < 18 && $cp_two_query->cp_two_block == $this->session->userdata('block'))
            {
                return array($cp_two_query);
            }
        }  

        if($cp_one_query->cp_one_age < 18)
        {
            return $cp_one_query;
        }
        elseif($cp_two_query->cp_two_age < 18)
        {
            return $cp_two_query;
        }
        elseif($cp_one_query->cp_one_age < 18 && $cp_two_query->cp_two_age < 18 )
        {
            return array_merge($cp_one_query,$cp_two_query);
        }
    }

    public function insert_follow_up_visit_details($incident_id) 
    {
        // Follow Up Visit Details
        $upload_follow_up_visit_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $this->input->post('cp_id'),
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
            'entry_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result = $this->db->insert('cm_follow_up_visit_details', $upload_follow_up_visit_details);
        $last_inst_id = $this->db->insert_id();
        if($this->input->post('cp_type')==1)
        {
            $data1 = array(
                ' cp_one_follow_up_visit_status '=>1
              );
            $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $data1);  

        }
        //for cp_two
        elseif($this->input->post('cp_type')==2)
        {
            $data1 = array(
                ' cp_two_follow_up_visit_status '=>1
              );
            $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $data1);  

        }
        $data = array(
          'follow_up_visit_status' => 102
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $data);
    }

    public function get_follow_up_visit_edit_details($follow_up_id)
    {
         $query = $this->db->select('fuvd.sl_no, fuvd.mode_of_enquiry, fuvd.gender, fuvd.education, fuvd.education_frequency, fuvd.kishori_group, fuvd.kishori_group_frequency, fuvd.paid_work, fuvd.paid_work_frequency, fuvd.parents_supported, fuvd.family_elders_supported, fuvd.peers_supported, fuvd.neighbours_supported, fuvd.others_supported, fuvd.minor_pregnant, fuvd.stage_of_pregnancy, fuvd.remarks')
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
