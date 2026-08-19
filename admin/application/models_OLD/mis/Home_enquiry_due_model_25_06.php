<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_enquiry_due_model extends CI_Model
{


    public function __construct()
    { 
      parent::__construct();
      $this->mis=$this->load->database('mis', TRUE); 
    }

    public function get_home_enquiry_due_dtls($data=array())
    {
        // echo "<pre>";print_r($data);die; 

        $selection = "
        COUNT(CASE WHEN homeenq.incident_id_fk IS NULL THEN 1 END) AS no_matching_records,
        COUNT(CASE WHEN homeenq.incident_id_fk IS NOT NULL AND homeenq.hv_status <> 3 AND homeenq.active_status = 1 THEN 1 END) AS present_not_status_3_active,


        COUNT (1) AS total_due,

        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) BETWEEN 1 AND 7) AS pending_1_7_days,
        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) BETWEEN 8 AND 15) AS pending_8_15_days,
        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) BETWEEN 16 AND 30) AS pending_16_30_days,
        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) BETWEEN 31 AND 60) AS pending_31_60_days,
        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) BETWEEN 61 AND 90) AS pending_61_90_days,
        COUNT(cmir.incident_id_pk) FILTER (WHERE ('" . $data['to_date'] . "'::DATE - cmir.incident_date::DATE) > 90) AS pending_above_90_days ";


        $this->db->from('cm_incident_report AS cmir');
        $this->db->join('cm_incident_report_contracting_parties AS cp','cmir.incident_id_pk = cp.incident_id_fk','left');
        $this->db->join('cm_incident_report_home_visit as homeenq', 'cmir.incident_id_pk = homeenq.incident_id_fk and cp.cp_id_pk = homeenq.cp_id_fk and homeenq.active_status = 1','left');


        $this->db->join('rp_location_master_district as district_master', 'cp.cp_district = district_master.district_id_pk','left');
        $this->db->join('rp_location_master_block as block_master', 'cp.cp_block = block_master.block_id_pk','left');


        if(!empty($data['is_ward']))
        {
            $this->db->join('cm_ward_master AS wmstr', 'cp.cp_ward_gp = wmstr.ward_id_pk ','left');
        }
        if(!empty($data['is_gp']))
        {
            $this->db->join('cm_gp_master AS gpmstr', 'cp.cp_ward_gp = gpmstr.gp_id_pk ','left');
        }
        
        if(!empty($data['district']))
        {
            $this->db->where('cp.cp_district', $data['district']);
        }
        if(!empty($data['block']))
        {
            if($data['block']!=0)
            {
              $this->db->where('cp.cp_block', $data['block']);
            }

        }

        // if(!empty($data['district']))
        // {
        //     $this->db->where('cp.cp_district', $data['district']);
        // }
        // if(!empty($data['block']))
        // {
        //     if($data['block']!=0)
        //     {
        //       $this->db->where('cp.cp_block', $data['block']);
        //     }

        // } 
        if (!empty($data['subdiv'])) 
        {
            $subdiv = $data['subdiv'];
            $subquery = "(select block_id_pk from rp_location_master_block where subdiv_id_fk = '$subdiv' AND rural_urban = 'U')";
            $this->db->where("cp.cp_block IN $subquery", null, false);
        }


        if(!empty($data['from_date']))
        {
            $this->db->where('cmir.incident_date >=',$data['from_date']);
        }   
        if(!empty($data['to_date']))
        {
            $this->db->where('cmir.incident_date <=',$data['to_date']);
        }   

        if(!empty($data['current_status']))
        {
            $this->db->where('cmir.current_status',$data['current_status']);
        }        

        if(!empty($data['delete_status']))
        {
            $this->db->where('cmir.delete_status',$data['delete_status']);
        }

        if (!empty($data['cp_age_minor'])) 
        {
            $this->db->where("COALESCE(NULLIF(cp.cp_age, ''), '0')::INTEGER <", 18);
        } 

        if (!empty($data['cp_age_adult'])) 
        {
            $this->db->where("COALESCE(NULLIF(cp.cp_age, ''), '0')::INTEGER >=", 18);
        }
        $this->db->group_start();
            $this->db->where('homeenq.sl_no IS NULL');
            $this->db->or_where('homeenq.hv_status <>', 3);
        $this->db->group_end();
        

        // if(!empty($data['active_status']))
        // {
        //     $this->db->where('homeenq.active_status',$data['active_status']);
        // }        

        if(!empty($data['field_selection']))
        {
            $this->db->select($data['field_selection']);
        }
        $this->db->select($selection);
        
        if(!empty($data['order_by']))
        {
            $this->db->order_by($data['order_by']);
        }
        else
        {
            // $this->db->order_by('A.cp_id_fk');
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
            return  $query->result_array();
        }
        

    }

    





}