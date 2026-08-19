<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_adult_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    
    public function get_incident_home_visit_details($cp_id)
    {
        $query = $this->db->select('cp_gender as gender, cp_age')
            ->from('cm_incident_report_contracting_parties')
            ->where('cp_id_pk' , $cp_id)
            ->get()->row();
        //echo $this->db->last_query();die;
        return $query;
    }

    public function insert_home_visit_adult_details($incident_id, $cp_type, $cp_id) 
    {
        // Home Visit Adult Details
        $upload_home_visit_adult_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $cp_id,
            'cp_type' => $cp_type,
            'mode_of_enquiry' => $this->input->post('mode_of_enquiry'),
            'gender' => $this->input->post('gender'),
            'family_income' => $this->input->post('family_income'),
            'nutritious_meals' => $this->input->post('nutritious_meals'),
            'neighbours_community' => $this->input->post('neighbours_community'),
            'emergencies' => $this->input->post('emergencies'),
            'education' => $this->input->post('education'),
            'education_frequency' => $this->input->post('education_frequency'),
            'paid_work' => $this->input->post('paid_work'),
            'paid_work_frequency' => $this->input->post('paid_work_frequency'),
            'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
            'entry_time' => date('Y-m-d H:i:s'),
            'entry_ip' => $_SERVER['REMOTE_ADDR']
        );
        $result = $this->db->insert('cm_incident_report_home_visit', $upload_home_visit_adult_details);
        $last_inst_id = $this->db->insert_id();

        // Home Visit Adult Siblings Details
        $Siblings_Details = $this->input->post('Siblings_Details');
        foreach($Siblings_Details as  $key => $SiblingsValue){
            $siblings_name = $SiblingsValue['name'];
            $siblings_age = $SiblingsValue['age'];
            $siblings_sex = $SiblingsValue['sex'];
            $siblings_occupation = implode(",",(array)$SiblingsValue['occupation']);
            if($siblings_name != '' && $siblings_age != '' && $siblings_sex != '' && $siblings_occupation != ''){
                $upload_home_visit_minor_siblings_details = array(
                    'hv_id_fk' => $last_inst_id,
                    'siblings_name' => $siblings_name,
                    'siblings_age' => $siblings_age,
                    'siblings_sex' => $siblings_sex,
                    'siblings_occupation' => $siblings_occupation,
                    'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time' => date('Y-m-d H:i:s'),
                    'entry_ip' => $_SERVER['REMOTE_ADDR']
                );
            $result2 = $this->db->insert('cm_incident_report_home_visit_siblings_details', $upload_home_visit_minor_siblings_details);  
            }  
        }
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
