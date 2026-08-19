<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Education_wise_mis_model extends CI_Model
{

    private $selection = "
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) AS male_count_never_attended, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) AS female_count_never_attended, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) AS male_count_5_to_8, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) AS female_count_5_to_8, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) AS male_count_11_to_12, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) AS female_count_11_to_12, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) AS male_count_upto_5, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) AS female_count_upto_5, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) AS male_count_9_to_10, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) AS female_count_9_to_10, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) AS male_count_above_12, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) AS female_count_above_12, 
      SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) AS male_count_not_report, 
      SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) AS female_count_not_report, 
      SUM(CASE WHEN ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS total_male_count, 
      SUM(CASE WHEN ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS total_female_count ";

    public function __construct()
    { 
      parent::__construct();
      $this->mis=$this->load->database('mis', TRUE); 
    }

    public function get_education_wise_child_dtls($data=array())
    {
        // echo "<pre>";print_r($data);die; 

        $this->db->from('cm_incident_report AS cmir');
        $this->db->join('cm_incident_report_contracting_parties AS ircpt', 'cmir.incident_id_pk = ircpt.incident_id_fk ','left');


        if(!empty($data['is_ward']))
        {
            $this->db->join('cm_ward_master AS wmstr', 'cmir.ward_gp = wmstr.ward_id_pk ','left');
        }
        if(!empty($data['is_gp']))
        {
            $this->db->join('cm_gp_master AS gpmstr', 'cmir.ward_gp = gpmstr.gp_id_pk ','left');
        }
        
        if(!empty($data['district']))
        {
            $this->db->where('cmir.district', $data['district']);
        }
        if(!empty($data['block']))
        {
            if($data['block']!=0)
            {
              $this->db->where('cmir.block', $data['block']);
            }

        } 
        if (!empty($data['subdiv'])) 
        {
            $subdiv = $data['subdiv'];
            $subquery = "(select block_id_pk from rp_location_master_block where subdiv_id_fk = '$subdiv' AND rural_urban = 'U')";
            $this->db->where("cmir.block IN $subquery", null, false);
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

    public function get_education_wise_child_dtls_test()
    {
      $query = $this->db->query("select cmir.district as district,cmir.district as district_id_pk,district_location_master_description(cmir.district) as district_name,

      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) AS male_count_never_attended,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=1 THEN 1 ELSE 0 END) AS female_count_never_attended,


      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) AS male_count_5_to_8,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=2 THEN 1 ELSE 0 END) AS female_count_5_to_8,



      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) AS male_count_11_to_12,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=3 THEN 1 ELSE 0 END) AS female_count_11_to_12,

      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) AS male_count_upto_5,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=4 THEN 1 ELSE 0 END) AS female_count_upto_5,

      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) AS male_count_9_to_10,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=5 THEN 1 ELSE 0 END) AS female_count_9_to_10,


      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) AS male_count_above_12,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment=6 THEN 1 ELSE 0 END) AS female_count_above_12,

      SUM(CASE WHEN ircpo.cp_gender = 1 AND ircpo.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 AND ircpt.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) AS male_count_not_report,

      SUM(CASE WHEN ircpo.cp_gender = 2 AND ircpo.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 AND ircpt.cp_highest_educational_attainment is NULL THEN 1 ELSE 0 END) AS female_count_not_report,

      SUM(CASE WHEN ircpo.cp_gender = 1 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS total_male_count,

      SUM(CASE WHEN ircpo.cp_gender = 2 THEN 1 ELSE 0 END) +SUM(CASE WHEN ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS total_female_count


      from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '2004-05-31' and '2024-06-05' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.district order by district_name")->result_array();

      return $query;


    }






}