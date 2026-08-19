<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class User_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function Get_All_Users_Details()
    {
        if($this->session->userdata('stake_id_fk') == '1'){
            $query = $this->db->select('shl.stake_holder_login_id_pk,shm.stake_details,shl.login_id, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, shl.status, subdiv_location_master_description(shl.subdiv) as subdiv_name,')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            //->where('shl.stake_id_fk' , 3)
            ->where('shl.stake_id_fk =3 OR ((shl.stake_id_fk =5 OR (shl.stake_id_fk =5 AND district IS NULL)))')
            ->where('shl.status' , 1)
            ->where('shm.active_status' , 1)
            ->order_by('shl.stake_holder_login_id_pk','desc')
            ->get();

            //print_r($this->db->last_query());die;
            return $query->result_array();
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->select('shl.stake_holder_login_id_pk,shm.stake_details,shl.login_id, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, shl.status, subdiv_location_master_description(shl.subdiv) as subdiv_name,')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.block' , $this->session->userdata('block'))
            ->where('shl.stake_id_fk' , 4)
            ->where_in('shl.status' , array(0,1))
            ->where_in('shm.active_status' , array(0,1))
            ->order_by('shl.stake_holder_login_id_pk','desc')
            ->get();
            return $query->result_array();
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->select('shl.stake_holder_login_id_pk,shm.stake_details,shl.login_id, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, subdiv_location_master_description(shl.subdiv) as subdiv_name, shl.status')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.subdiv' , $this->session->userdata('subdiv'))
            ->where('shl.stake_id_fk' , 4)
            ->where_in('shl.status' , array(0,1))
            ->where_in('shm.active_status' , array(0,1))
            ->order_by('shl.stake_holder_login_id_pk','desc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->select('shl.stake_holder_login_id_pk,shm.stake_details,shl.login_id, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, subdiv_location_master_description(subdiv) AS subdiv_name, shl.status')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where_in('shl.stake_id_fk', array(2,5,6))
            ->where_in('shl.status' , array(0,1))
            ->where_in('shm.active_status' , array(0,1))
            ->order_by('status', 'DESC')
            ->order_by('shl.stake_id_fk','desc')
            ->get();
            return $query->result_array();
        }elseif($this->session->userdata('stake_id_fk') == '5'){
            $query = $this->db->select('shl.stake_holder_login_id_pk,shm.stake_details,shl.login_id, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, shl.status, subdiv_location_master_description(shl.subdiv) as subdiv_name,')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.block' , $this->session->userdata('block'))
            ->where('shl.stake_id_fk' , 5)
            ->where('shl.status' , 1)
            ->where('shm.active_status' , 1)
            ->order_by('shl.stake_holder_login_id_pk','desc')
            ->get();
            return $query->result_array();
        }else{
           return array(); 
        }

    }
    public function downlod_excel()
    {
        $selected_field = 'shl.stake_holder_login_id_pk, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, subdiv_location_master_description(shl.subdiv) as subdiv_name,
            block_location_master_description(shl.block) as block_municipality_name, shl.status, shl.login_id, shl.base_password';

        $stake_id_fk = $this->session->userdata('stake_id_fk');
        

        if($stake_id_fk == '1')
        {
            $query = $this->db->select($selected_field)
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.stake_id_fk =3 OR ((shl.stake_id_fk =5 OR (shl.stake_id_fk =5 AND district IS NULL)))')
            ->where('shl.status' , 0)
            ->where('shl.active_status' , 0)
            ->order_by('shl.stake_holder_login_id_pk','asc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();

        }
        else if($stake_id_fk == '3')
        {
            $query = $this->db->select($selected_field)
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where_in('shl.stake_id_fk', array(2,5,6))
            ->where('shl.active_status' , 0)
            ->where('shl.status' , 0)
            //->order_by('shl.stake_holder_login_id_pk','asc')
            ->order_by('shl.stake_id_fk','desc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();
        }
        else if($stake_id_fk == '2')
        {
            $query = $this->db->select($selected_field)
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.block' , $this->session->userdata('block'))
            ->where('shl.stake_id_fk' , 4)
            ->where('shl.active_status' , 0)
            ->where('shl.status' , 0)
            ->order_by('shl.stake_holder_login_id_pk','asc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();

        }
        else if($stake_id_fk == '6')
        {
            $query = $this->db->select($selected_field)
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.subdiv' , $this->session->userdata('subdiv'))
            ->where('shl.stake_id_fk' , 4)
            ->where('shl.active_status' , 0)
            ->where('shl.status' , 0)
            ->order_by('shl.stake_holder_login_id_pk','asc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();
        }
        else 
        {

        }
    }

    public function activated_user_update($stake_holder_id)
    {
        $data = array(
          'active_status' => 1
        );
        $this->db->where('stake_holder_login_id_pk', $stake_holder_id)->update('cm_stake_holder_login', $data);
    }

    public function deactivated_user_update($stake_holder_id)
    {
        $data = array(
          'active_status' => 0
        );
        $this->db->where('stake_holder_login_id_pk', $stake_holder_id)->update('cm_stake_holder_login', $data);
    }

    public function Search_All_Type_Users($user_type, $district, $block)
    {
        if($user_type == 3){
            $this->db->select('district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, login_id, base_password');
            $this->db->from('cm_stake_holder_login');
            if(!empty($user_type)){
                $this->db->where('stake_id_fk', $user_type);
            }

            if(!empty($district)){
                $this->db->where('district', $district);
            }
            $this->db->where('active_status', 0);
            $this->db->where('status', 0);
            return $this->db->get()->result_array();
        }elseif($user_type == 6){
            $this->db->select('district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, login_id, base_password');
            $this->db->from('cm_stake_holder_login');
            if(!empty($user_type)){
                $this->db->where('stake_id_fk', $user_type);
            }

            if(!empty($district)){
                $this->db->where('district', $district);
            }
            $this->db->where('subdiv is NOT NULL', NULL, FALSE);
            $this->db->where('active_status', 0);
            $this->db->where('status', 0);
            return $this->db->get()->result_array();
        }elseif($user_type == 2){
            $this->db->select('district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, login_id, base_password');
            $this->db->from('cm_stake_holder_login');
            if(!empty($user_type)){
                $this->db->where('stake_id_fk', $user_type);
            }

            if(!empty($district)){
                $this->db->where('district', $district);
            }

            if(!empty($block)){
                $this->db->where('block', $block);
            }
            $this->db->where('active_status', 0);
            $this->db->where('status', 0);
            return $this->db->get()->result_array();
        }elseif($user_type == 4){
            $this->db->select('district_location_master_description(district) AS district_name, block_location_master_description(block) AS block_name, login_id, base_password');
            $this->db->from('cm_stake_holder_login');
            if(!empty($user_type)){
                $this->db->where('stake_id_fk', $user_type);
            }

            if(!empty($district)){
                $this->db->where('district', $district);
            }

            if(!empty($block)){
                $this->db->where('block', $block);
            }
            $this->db->where('subdiv is NULL');
            $this->db->not_like('login_id', 'Municipality');
            $this->db->where('active_status', 0);
            $this->db->where('status', 0);
            return $this->db->get()->result_array();
        }
    }

    public function Download_Excel_SDO_Level_DEO()
    {
        $query = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk, shl.active_status, shl.stake_holder_details, shl.name, shl.mobile_no, district_location_master_description(shl.district) AS district_name, subdiv_location_master_description(shl.subdiv) as subdiv_name, shl.status, shl.login_id, shl.base_password')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $this->session->userdata('district'))
            ->where('shl.subdiv' , $this->session->userdata('subdiv'))
            ->where('shl.stake_id_fk' , 4)
            ->where('shl.active_status' , 0)
            ->where('shl.status' , 0)
            ->order_by('shl.stake_holder_login_id_pk','asc')
            ->get();
            // print_r($this->db->last_query());die;
            return $query->result_array();
    }
}
?>
