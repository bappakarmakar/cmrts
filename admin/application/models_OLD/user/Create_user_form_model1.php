<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Create_user_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function stake_holder_login_insert_batch($insert_batch_data=array()){
        $result = $this->db->insert_batch('cm_stake_holder_login', $insert_batch_data);
        return $this->db->affected_rows();
    }

    public function total_deo_user($subdiv)
    {
       $query = $this->db->query("SELECT count(stake_id_fk) AS total_deo FROM cm_stake_holder_login WHERE stake_id_fk = 4 AND subdiv = $subdiv");
       return $query->result();
    } 
    public function total_deo_user_check($subdiv)
    {
       $query = $this->db->query("SELECT block,login_id,subdiv FROM cm_stake_holder_login WHERE stake_id_fk = 4 AND subdiv = $subdiv");
       return $query->result_array();
    }

    public function subdiv_details($login_id)
    {
        $query = $this->db->select('subdiv_location_master_description(subdiv) AS subdiv_name')
            ->from('cm_stake_holder_login')
            ->where('login_id' , $login_id)
            ->get();
        return $query->result_array();
    }


    public function check_duplicate_mobile_no($mobile_no)
    {
        $this->db->where('mobile_no', $mobile_no);
        $query = $this->db->get('cm_stake_holder_login');
        $count_row = $query->num_rows();
        return $count_row;
    }
    public function check_duplicate_login_id($login_id)
    {
        $this->db->where('login_id', $login_id);
        $query = $this->db->get('cm_stake_holder_login');
        $count_row = $query->num_rows();
        return $count_row;
    }

    public function insert_user_details($uploaded)
    {
        $result = $this->db->insert('cm_stake_holder_login', $uploaded);
    }
}
?>
