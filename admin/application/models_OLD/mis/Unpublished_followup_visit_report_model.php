<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Unpublished_followup_visit_report_model extends CI_Model
{

    private $selection = "
      SUM(CASE WHEN follow.fv_status = 0  THEN 1 ELSE 0 END) AS draft_report, 
      SUM(CASE WHEN follow.fv_status = 1  THEN 1 ELSE 0 END) AS saved_report, 
      SUM(CASE WHEN follow.fv_status = 2  THEN 1 ELSE 0 END) AS forwarded_report, 
      SUM(CASE WHEN follow.fv_status = 3  THEN 1 ELSE 0 END) AS published_report, 
      SUM(CASE WHEN follow.fv_status = 4  THEN 1 ELSE 0 END) AS reverted_report, 
      SUM(CASE WHEN follow.fv_status in(1,2,3,4) THEN 1 ELSE 0 END) AS total_report,
      (COUNT(CASE WHEN cmir.delete_status = 0 THEN cmir.incident_id_pk ELSE NULL END) -
        COUNT(CASE WHEN follow.active_status = 1 THEN follow.incident_id_fk ELSE NULL END)) as home_enq_not_initiated";

    public function __construct()
    { 
      parent::__construct();
      $this->mis=$this->load->database('mis', TRUE); 
    }

    public function get_followup_visit_dtls($data=array())
    {
         
        $this->db->from('cm_incident_report AS cmir');
        
        $this->db->join('cm_follow_up_visit_details as follow', 'cmir.incident_id_pk = follow.incident_id_fk ','left');

        //$this->db->join('cm_incident_report_contracting_parties AS cp','cmir.incident_id_pk = cp.incident_id_fk','left');
        $this->db->join('cm_incident_report_contracting_parties AS cp','follow.cp_id_fk = cp.cp_id_pk','left');


        //$this->db->join('rp_location_master_district as district_master', 'cp.cp_district = district_master.district_id_pk','left');
        $this->db->join('rp_location_master_district as district_master', 'cp.cp_district = district_master.district_id_pk');


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
        if(!empty($data['active_status']))
        {
            $this->db->where('follow.active_status',$data['active_status']);
        }        

        if(!empty($data['field_selection']))
        {
            $this->db->select($data['field_selection']);
        }
        $this->db->select($this->selection);
        
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