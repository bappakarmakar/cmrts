<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_minor_form_model extends CI_Model
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

        /*if(($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_district == $this->session->userdata('district') && $cp_one_query->cp_one_block == $this->session->userdata('block')) && ($cp_two_query->cp_two_age < 18 && $cp_two_query->cp_two_district == $this->session->userdata('district') && $cp_two_query->cp_two_block == $this->session->userdata('block')))
        {
            $cp_age=array($cp_one_query,$cp_two_query);
            //print_r($cp_age[0]->gender);exit;
            //print_r($cp_age[0]);exit;
            return $cp_age;
        }  */  

        
        if($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_district == $this->session->userdata('district') && $cp_one_query->cp_one_block == $this->session->userdata('block')){
            return $cp_one_query;
        }else{
            return $cp_two_query;
        }
          
    }

    public function get_incident_details_new($incident_id)
    {
        //echo"hiiii";exit;
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
            //echo"hiiii";exit;
            $cp_age=array($cp_one_query,$cp_two_query);
            //print_r($cp_age[0]->gender);exit;
            //print_r($cp_age[0]);exit;
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

        
        if($cp_one_query->cp_one_age < 18 && $cp_one_query->cp_one_district == $this->session->userdata('district') && $cp_one_query->cp_one_block == $this->session->userdata('block')){
            //echo"kkk";exit;
            return $cp_one_query;
        }else{
            return $cp_two_query;
        }
          
    }

    public function insert_home_visit_minor_details($incident_id) 
    {
        //echo "hello".$this->input->post('cp_type');exit;
        // Home Visit Minor Details
        $upload_home_visit_minor_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $this->input->post('cp_id'),
            'mode_of_enquiry' => $this->input->post('mode_of_enquiry'),
            'gender' => $this->input->post('gender'),
            'family_income' => $this->input->post('family_income'),
            'nutritious_meals' => $this->input->post('nutritious_meals'),
            'neighbours_community' => $this->input->post('neighbours_community'),
            'emergencies' => $this->input->post('emergencies'),
            'disability' => $this->input->post('disability'),
            'type_of_disability' => implode(",",(array) $this->input->post('type_of_disability')) ,
            'disability_certificate' => $this->input->post('disability_certificate'),
            'disability_percent' => $this->input->post('disability_percent'),
            'estimated_severity' => $this->input->post('estimated_severity'),
            'education' => $this->input->post('education'),
            'education_frequency' => $this->input->post('education_frequency'),
            'kishori_group' => $this->input->post('kishori_group'),
            'kishori_group_frequency' => $this->input->post('kishori_group_frequency'),
            'paid_work' => $this->input->post('paid_work'),
            'paid_work_frequency' => $this->input->post('paid_work_frequency'),
            'kanyashree_id' => $this->input->post('kanyashree_id'),
            'parents_supported' => $this->input->post('parents_supported'),
            'family_elders_supported' => $this->input->post('family_elders_supported'),
            'peers_supported' => $this->input->post('peers_supported'),
            'neighbours_supported' => $this->input->post('neighbours_supported'),
            'others_supported' => $this->input->post('others_supported'),
            'minor_pregnant' => $this->input->post('minor_pregnant'),
            'stage_of_pregnancy' => $this->input->post('stage_of_pregnancy'),
            'remarks' => $this->input->post('remarks'),
            'minor_entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
            'entry_time' => date('Y-m-d H:i:s'),
            'entry_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );
        $result = $this->db->insert('cm_home_visit_minor_details', $upload_home_visit_minor_details);
        $last_inst_id = $this->db->insert_id();

        // Home Visit Minor Siblings Details
        $siblings=$this->input->post('siblings');
        if(!empty($siblings)){
            for($i = 0; $i < count($siblings); $i++){
                if($siblings[$i]['name'] != "" && $siblings[$i]['age'] != "" && $siblings[$i]['sex'] != ""){
                    $siblings_occupation = implode(",",(array)$siblings[$i]['occupation']);
                    $upload_home_visit_minor_siblings_details = [
                        'hvm_id_fk' => $last_inst_id,
                        'siblings_name' => $siblings[$i]['name'],
                        'siblings_age' => $siblings[$i]['age'],
                        'siblings_sex' => $siblings[$i]['sex'],
                        'siblings_occupation' => $siblings_occupation,
                        'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time' => date('Y-m-d H:i:s'),
                        'entry_ip' => $_SERVER['REMOTE_ADDR'],
                        'active_status' => 1
                    ];
                    $result2 = $this->db->insert('cm_home_visit_minor_siblings_details', $upload_home_visit_minor_siblings_details);
                }    
            }
        }
        //for cp_one
        //$data1=array();
        if($this->input->post('cp_type')==1)
        {
            $data1 = array(

                //'home_visit_minor_status' => 102
                ' cp_one_home_visit_minor_status '=>1
              );
            $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_one', $data1);  

        }
        //for cp_two
        elseif($this->input->post('cp_type')==2)
        {
            $data1 = array(

                //'home_visit_minor_status' => 102
                ' cp_two_home_visit_minor_status '=>1
              );
            $this->db->where('incident_id_fk', $incident_id)->update('cm_incident_report_contracting_party_two', $data1);  

        }

        $data = array(
          'home_visit_minor_status' => 102
        );
        $this->db->where('incident_id_pk', $incident_id)->update('cm_incident_report', $data);
    }

    public function get_home_visit_minor_details($home_visit_id)
    {
        $query = $this->db->select('hvmd.sl_no, hvmd.mode_of_enquiry, hvmd.gender, hvmd.family_income, hvmd.nutritious_meals, hvmd.neighbours_community, hvmd.emergencies, hvmd.disability, hvmd.type_of_disability, hvmd.disability_certificate, hvmd.disability_percent, hvmd.estimated_severity, hvmd.education, hvmd.education_frequency, hvmd.kishori_group, hvmd.kishori_group_frequency, hvmd.paid_work, hvmd.paid_work_frequency, hvmd.kanyashree_id, hvmd.parents_supported, hvmd.family_elders_supported, hvmd.peers_supported, hvmd.neighbours_supported, hvmd.others_supported, hvmd.minor_pregnant, hvmd.stage_of_pregnancy, hvmd.remarks')
            ->from('cm_home_visit_minor_details AS hvmd')
            ->where('hvmd.sl_no' , $home_visit_id)
            ->get()->row();
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
}
?>
