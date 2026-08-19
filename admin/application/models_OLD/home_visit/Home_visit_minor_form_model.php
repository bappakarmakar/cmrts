<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_minor_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function home_visit_minor_delete_count_by_id($incident_id,$cp_id,$cp_type){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_incident_report_home_visit')
        ->where('active_status' , 1)
        ->where(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type))
        ->get()->num_rows();
        return $query;
    }



    public function home_visit_minor_count_by_id($incident_id,$cp_id,$cp_type){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_incident_report_home_visit')
        ->where('active_status' , 1)
        ->where(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type))
        ->get()->row_array();
        return ($query)?$query:array();
    }


    public function home_visit_minor_details_by_id($sl_no){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('*')
        ->from('cm_incident_report_home_visit')
        ->where('active_status' , 1)
        ->where(array('sl_no'=>$sl_no))
        ->get()->row_array();
        return ($query)?$query:array();
    }
    public function home_visit_minor_insert($insertData){
        $default = $this->load->database('default',TRUE);
        $default->insert('cm_incident_report_home_visit', $insertData);
        return $default->insert_id();
    }
    public function home_visit_minor_update($updateData,$sl_no){
        $default = $this->load->database('default',TRUE);
        $default->where('sl_no', $sl_no)->where('active_status' , 1)
           ->update('cm_incident_report_home_visit', $updateData);
        return $default->affected_rows();
    }
    public function home_visit_siblings_details_count_by_id($hv_id_fk){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_incident_report_home_visit_siblings_details')
        ->where(array('hv_id_fk'=>$hv_id_fk))
        ->get()->num_rows();
        return $query;
    }
    public function home_visit_siblings_details_delete_by_hv_id($hvm_id_fk){
        $default = $this->load->database('default',TRUE);
        $default->where('hvm_id_fk', $hvm_id_fk);
        $default->delete('cm_incident_report_home_visit_siblings_details');
        return $default->affected_rows();
    }
    public function home_visit_siblings_details_insert_batch($insert_batch_data=array()){
        $default = $this->load->database('default',TRUE);
        $default->insert_batch('cm_incident_report_home_visit_siblings_details', $insert_batch_data);
        return $default->affected_rows();
    }
    public function home_visit_siblings_details_update_batch($update_batch_data=array()){
        $default = $this->load->database('default',TRUE);
        $default->update_batch('cm_incident_report_home_visit_siblings_details', $update_batch_data,'sl_no');
        return $default->affected_rows();
    }



    public function get_homwvisit_siblings_dtls_by_hvm_id($where_array=array()){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('A.sl_no as sibling_sl_no, *')
        ->from('cm_incident_report_home_visit_siblings_details AS A')
        ->join('cm_incident_report_home_visit AS B', 'A.hv_id_fk = B.sl_no','left')
        ->where('B.active_status' , 1)
        ->where($where_array)
        ->get()->result_array();
         // print_r($this->db->last_query());die;
        return ($query)?$query:array();
    }

    public function homwvisit_siblings_dtls_count_by_hvm_id($where_array=array()){
        $default = $this->load->database('default',TRUE);
        $query = $default->select('sl_no')
        ->from('cm_incident_report_home_visit_siblings_details')
        ->where($where_array)
        ->get()->num_rows();
        return $query;
    }
    public function homwvisit_siblings_update_by_sl_no($updateData,$sl_no){
        $default = $this->load->database('default',TRUE);
        $default->where('sl_no', $sl_no)
           ->update('cm_incident_report_home_visit_siblings_details',$updateData);
        //print $default->last_query();die();
        return $default->affected_rows();
    }
    public function home_visit_siblings_details_insert($insert_data=array()){
        $default = $this->load->database('default',TRUE);
        $default->insert('cm_incident_report_home_visit_siblings_details', $insert_data);
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



    public function insert_home_visit_minor_details($incident_id, $cp_type, $cp_id) 
    {
        // Home Visit Minor Details
        $upload_home_visit_minor_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $cp_id,
            'cp_type' => $cp_type,
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
            'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
            'entry_time' => date('Y-m-d H:i:s'),
            'entry_ip' => $_SERVER['REMOTE_ADDR']
        );
        $result = $this->db->insert('cm_incident_report_home_visit', $upload_home_visit_minor_details);
        $last_inst_id = $this->db->insert_id();

        // Home Visit Minor Siblings Details
        $siblings=$this->input->post('siblings');
        if(!empty($siblings)){
            for($i = 0; $i < count($siblings); $i++){
                if($siblings[$i]['name'] != "" && $siblings[$i]['age'] != "" && $siblings[$i]['sex'] != ""){
                    $siblings_occupation = implode(",",(array)$siblings[$i]['occupation']);
                    $upload_home_visit_minor_siblings_details = [
                        'hv_id_fk' => $last_inst_id,
                        'siblings_name' => $siblings[$i]['name'],
                        'siblings_age' => $siblings[$i]['age'],
                        'siblings_sex' => $siblings[$i]['sex'],
                        'siblings_occupation' => $siblings_occupation,
                        'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time' => date('Y-m-d H:i:s'),
                        'entry_ip' => $_SERVER['REMOTE_ADDR']
                    ];
                    $result2 = $this->db->insert('cm_incident_report_home_visit_siblings_details', $upload_home_visit_minor_siblings_details);
                }    
            }
        }
    }



    public function get_homwvisit_dtls($data=array())
    {
        // echo "<pre>";print_r($data);die;

        $this->db->from('cm_incident_report_home_visit AS A', 'left');
        if(!empty($data['party_details']))
        {
            $this->db->join('cm_incident_report_contracting_parties AS B', 'A.incident_id_fk = B.incident_id_fk','left');
        }
        if(!empty($data['login_details']))
        {
            $this->db->join('public.cm_stake_holder_login AS C', 'B.stake_holder_id_fk = C.stake_holder_login_id_pk', 'left');
        }
        if(!empty($data['location_details']))
        {
            $this->db->join('public.rp_location_master_district AS D', 'B.district = D.district_id_pk', 'left');
        }
        if(!empty($data['silbings_details']))
        {
            $this->db->join('public.cm_incident_report_home_visit_siblings_details AS E', 'A.cp_id_fk = E.cp_id_fk', 'left');
        }
        if(!empty($data['hv_status_details']))
        {
            $this->db->join('public.cm_homevisit_status_master AS F', 'A.hv_status = F.code', 'left');
        }
        if(!empty($data['incident_details']))
        {
            $this->db->join('public.cm_incident_report AS G', 'A.incident_id_fk = G.incident_id_pk', 'left');
        }
        if(!empty($data['cp_gender_details']) && !empty($data['party_details']))
        {
            $this->db->join('public.cm_gender_master AS H', 'B.cp_gender = H.cm_gender_master_id_pk', 'left');
        }

        if(!empty($data['mode_of_enquiry_details']))
        {
            $this->db->join('public.cm_mode_of_enquiry_master AS I', 'A.mode_of_enquiry = I.sl_no', 'left');
        }
        if(!empty($data['estimated_severity_details']))
        {
            $this->db->join('public.cm_estimated_severity_master AS J', 'A.estimated_severity = J.sl_no', 'left');
        }


        

            
        // if(!empty($data['district']))
        // {
        //     $this->db->where('A.district', $data['district']);
        // }
        // if(!empty($data['block']) || $data['block']!=0)
        // {
        //     $this->db->where('A.block', $data['block']);
        // } 
        // if(!empty($data['subdiv']))
        // {
        //     $this->db->where('B.subdiv', $data['subdiv']);
        // }
        if(!empty($data['sl_no']))
        {
            $this->db->where('A.sl_no', $data['sl_no']);
        }
        if(!empty($data['sl_no']))
        {
            $this->db->where('A.sl_no', $data['sl_no']);
        }
        if(!empty($data['cp_id_fk']))
        {
            $this->db->where('A.cp_id_fk', $data['cp_id_fk']);
        }        
        if(!empty($data['cp_type']))
        {
            $this->db->where('A.cp_type', $data['cp_type']);
        }
        if(!empty($data['incident_id_fk']))
        {
            $this->db->where('A.incident_id_fk', $data['incident_id_fk']);
        }

        if(!empty($data['entry_by']))
        {
            $this->db->where('A.entry_by', $data['entry_by']);
        }

        // $this->db->group_start();
        // $this->db->group_start();
        // $this->db->group_end();

        // $this->db->group_end();
        if(!empty($data['selected_fields']))
        {
            $this->db->select($data['selected_fields']);
        }
        else
        {
            $this->db->select('A.*');
        }
        if(!empty($data['order_by']))
        {
            $this->db->order_by($data['order_by']);
        }
        else
        {
            $this->db->order_by('A.cp_id_fk');
        }
        if(!empty($data['group_by']))
        {
            $this->db->group_by($data['group_by']);
        }

        $query = $this->db->get();

        // echo $this->db->get_compiled_select();die;
        // echo $this->db->last_query();die;


        if(isset($data['get']))
        {
            return  $query->row_array();
        }
        else if(isset($data['get_as_obj'])) 
        {
            return  $query->result();
        }
        else
        {
            // echo 32323;die;
            // print_r($query->result_array());
            return  $query->result_array();
        }
            // }

            // $this->db->from('cm_incident_report_contracting_parties AS A');
            // $this->db->join('cm_incident_report AS B', 'A.incident_id_fk = A.incident_id_pk', 'inner');
            // $query = $this->db->get();

    }


     public function get_homwvisit_siblings_dtls($data=array())
    {

        $this->db->from('cm_incident_report_home_visit_siblings_details AS A', 'left');
        if(!empty($data['party_details']))
        {
            $this->db->join('cm_incident_report_contracting_parties AS B', 'A.incident_id_fk = B.incident_id_pk','left');
        }
        if(!empty($data['login_details']))
        {
            $this->db->join('public.cm_stake_holder_login AS C', 'B.stake_holder_id_fk = C.stake_holder_login_id_pk', 'left');
        }
        if(!empty($data['location_details']))
        {
            $this->db->join('public.rp_location_master_district AS D', 'B.district = D.district_id_pk', 'left');
        }
        if(!empty($data['silbings_details']))
        {
            $this->db->join('public.cm_incident_report_home_visit_siblings_details AS E', 'A.cp_id_fk = E.cp_id_fk', 'left');
        }
        

            
        // if(!empty($data['district']))
        // {
        //     $this->db->where('A.district', $data['district']);
        // }
        // if(!empty($data['block']) || $data['block']!=0)
        // {
        //     $this->db->where('A.block', $data['block']);
        // } 
        // if(!empty($data['subdiv']))
        // {
        //     $this->db->where('B.subdiv', $data['subdiv']);
        // }

        if(!empty($data['sl_no']))
        {
            $this->db->where('A.sl_no', $data['sl_no']);
        }
        if(!empty($data['cp_id_fk']))
        {
            $this->db->where('A.cp_id_fk', $data['cp_id_fk']);
        }        
        if(!empty($data['cp_type']))
        {
            $this->db->where('A.cp_type', $data['cp_type']);
        }
        if(!empty($data['incident_id_fk']))
        {
            $this->db->where('A.incident_id_fk', $data['incident_id_fk']);
        }

        if(!empty($data['selected_fields']))
        {
            $this->db->select($data['selected_fields']);
        }
        else
        {
            $this->db->select('A.*');
        }
        if(!empty($data['order_by']))
        {
            $this->db->order_by($data['order_by']);
        }
        else
        {
            $this->db->order_by('A.cp_id_fk');
        }
        if(!empty($data['group_by']))
        {
            $this->db->group_by($data['group_by']);
        }

        $query = $this->db->get();

        // echo $this->db->get_compiled_select();die;
        // echo $this->db->last_query();die;

        if(isset($data['get']))
        {
            return  $query->row_array();
        }
        else
        {
            // echo 32323;die;
            // print_r($query->result_array());
            return  $query->result_array();
        }

    }


    public function insert_home_visit_dtls($data=array())
    {
        $query = $this->db->insert('cm_incident_report_home_visit', $data);
        // echo $this->db->last_query();die;
        return $query;


    }

    public function update_cp_dtls($data=array(),$where=array())
    {
        // echo "<pre>";print_r($data);die;
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_incident_report_contracting_parties');
        // echo $this->db->last_query();die;
         return $this->db->affected_rows();
    }

    public function update_home_visit_dtls($data=array(),$where=array())
    {
        // echo "<pre>";print_r($data);die;
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_incident_report_home_visit');
        // echo $this->db->last_query();die;
         return $this->db->affected_rows();
    }

    public function insert_home_visit_sibling_dtls($data=array())
    {
        // echo '<pre>';print_r($data);die;
        $this->db->insert_batch('cm_incident_report_home_visit_siblings_details', $data);
        // echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }

    public function update_home_visit_sibling_dtls ($data=array(),$where=array())
    {
        //delete
        // echo "<pre>";print_r(expression)
        // $this->db->where('column3', 'value6');
        $this->db->where($where);
        $query = $this->db->delete('cm_incident_report_home_visit_siblings_details');
        // echo $this->db->last_query();die;
        $affected_rows = $this->db->affected_rows();

        if($affected_rows>0)
        {
            $this->db->insert_batch('cm_incident_report_home_visit_siblings_details', $data);
            // echo $this->db->last_query();die;
            return $this->db->affected_rows();
        }

        //insert

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

    public function get_block_dtls($district_id)
    {
       $query = $this->db->select("block.*")
       ->from("rp_location_master_block as block")
       ->join("rp_location_master_district as district", "block.district_id_fk = district.district_id_pk")
       ->where("block.district_id_fk", $district_id)
       ->order_by('block_name', 'asc')
       ->get();
       // echo $this->db->last_query();die;
       return $query->result_array(); 
    }

    // public function get_school_dtls($id)
    // {
    //     $query = $this->db->select("schcd")
    //    ->from("rp_location_master_block as block")
    //    ->where("block.block_id_pk", $id)
    //    ->order_by('block_name', 'asc')
    //    ->get();

    //    $schcd = $query->rows();
    //    // echo $this->db->last_query();die;

    //    echo $schcd; die;
    //     $query = $this->db->select("*")
    //    ->from("bs_school_master_kanyashree")
    //    ->like('schcd', $schcd, 'after')
    //    ->order_by('school_name', 'asc')
    //    ->get();

    //    return $query->result_array(); 
    // }
 
    public function get_school_dtls($id)
    {
        // echo $id;die;
        $query = $this->db->select("schcd")
            ->from("rp_location_master_block as block")
            ->where("block.block_id_pk", $id)
            ->order_by('block_name', 'asc')
            ->get();

        $result = $query->result(); // Using result() instead of rows()

        // Extracting schcd value from the result
        if (!empty($result)) 
        {
            $schcd = $result[0]->schcd;
            // echo $this->db->last_query();die;

            // Perform the second query using $schcd in like()
            $query = $this->db->select("schcd,school_name")
                ->from("bs_school_master_kanyashree")
                ->like('schcd', $schcd, 'after')
                ->order_by('school_name', 'asc')
                ->get();


                // echo "<pre>";print_r($query->result_array());
                // echo $this->db->last_query();die;

            return $query->result_array();
        } 
        else 
        {
            return array(); // Return empty array if no result found
        }
    }



}
?>
