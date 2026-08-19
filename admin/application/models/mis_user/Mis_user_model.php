<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Mis_user_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
      $this->mis=$this->load->database('mis', TRUE);
    }

    public function get_sdo()
    {
        $query = $this->db->select('B.district_name,C.subdiv_name,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_subdiv AS C', 'A.subdiv = C.subdiv_id_pk','left')
                          ->where('stake_id_fk',6) 
                          ->order_by('B.district_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }

    public function get_bdo()
    {
        $query = $this->db->select('B.district_name,C.block_name,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_block AS C', 'A.block = C.block_id_pk','left')
                          ->where('stake_id_fk',2) 
                          ->order_by('B.district_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }

    public function get_sdo_deo()
    {
        $query = $this->db->select('B.district_name,C.subdiv_name,A.login_id as deo_login_id,E.block_name,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_subdiv AS C', 'A.subdiv = C.subdiv_id_pk','left')
                          // ->join('cm_stake_holder_login AS D', 'A.subdiv = D.subdiv and D.stake_id_fk = 6','inner')
                          ->join('rp_location_master_block AS E', 'A.block = E.block_id_pk','left')
                          ->where('A.stake_id_fk',4) 
                          ->where('A.subdiv is not null') 
                          ->order_by('B.district_name', 'asc')->order_by('C.subdiv_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }

    public function get_sdo_deo_bak()
    {
        $query = $this->db->select('B.district_name,C.subdiv_name,A.login_id as deo_login_id,D.login_id as sdo_login_id,E.block_name,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_subdiv AS C', 'A.subdiv = C.subdiv_id_pk','left')
                          ->join('cm_stake_holder_login AS D', 'A.subdiv = D.subdiv and D.stake_id_fk = 6','inner')
                          ->join('rp_location_master_block AS E', 'A.block = E.block_id_pk and D.stake_id_fk = 6','left')
                          ->where('A.stake_id_fk',4) 
                          ->where('A.subdiv is not null') 
                          ->order_by('B.district_name', 'asc')->order_by('C.subdiv_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }

    public function get_bdo_deo_bak()
    {
        $query = $this->db->select('B.district_name,C.block_name,A.login_id as deo_login_id,D.login_id as bdo_login_id,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_block AS C', 'A.block = C.block_id_pk','left')
                          ->join('cm_stake_holder_login AS D', 'A.block = D.block and D.stake_id_fk = 2','inner')
                          ->where('A.stake_id_fk',4) 
                          ->where('A.subdiv is null') 
                          ->order_by('B.district_name', 'asc')->order_by('C.block_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }


    public function get_bdo_deo()
    {
        $query = $this->db->select('B.district_name,C.block_name,A.login_id as deo_login_id,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_block AS C', 'A.block = C.block_id_pk','left')
                          // ->join('cm_stake_holder_login AS D', 'A.block = D.block and D.stake_id_fk = 2','inner')
                          ->where('A.stake_id_fk',4) 
                          ->where('A.subdiv is null') 
                          ->order_by('B.district_name', 'asc')->order_by('C.block_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
                          return $query;
    }

    public function get_mis_dist()
    {
        $query = $this->db->select('B.district_name,C.block_name,A.login_id as mis_login_id,*')
                          ->from('cm_stake_holder_login AS A')
                          ->join('rp_location_master_district AS B', 'A.district = B.district_id_pk','left')  
                          ->join('rp_location_master_block AS C', 'A.block = C.block_id_pk','left')
                          ->where('stake_id_fk',5) 
                          ->where('district is not null') 
                          ->order_by('B.district_name', 'asc')->get()->result(); 
        // echo $this->db->last_query();  
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
