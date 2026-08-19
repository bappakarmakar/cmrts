<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class User_change_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function insert_new_user_request($data = array())
    {

      $query = $this->db->insert('cm_change_user_request_log', $data);
      return $this->db->affected_rows();
    }

    public function check_request($data = array())
    {

      $query = $this->db->select('*')->from('cm_change_user_request_log')->where($data)->where('status =', 0)->get()->num_rows();

      // echo $this->db->last_query();die;
      return $query;
      // return $this->db->affected_rows();
    }

    public function get_request_list($data = array(),$stake = null,$stake_id = null)
    {
      // echo "<pre>";print_r($data);die;
    $query = $this->db->select('A.*,B.description,B.style,C.stake_details')
                  ->from('cm_change_user_request_log AS A')
                  ->join('cm_change_user_status_master AS B', 'B.code = A.status', 'left')
                  ->join('cm_stake_holder_master AS C', 'C.stake_id_pk = A.stake_id_fk', 'left')
                  ->where($data);

      if(empty($stake_id))
      {
        $query->where($stake);
      }
      else
      {
        $query->or_where($stake);
      }
        $query->order_by('A.requested_time','DESC');
        $result = $query->get()->result_array();
        return $result;

    // echo $this->db->last_query();die;
    // return $query;
    // return $this->db->affected_rows();
    }

    public function get_request_list_self($data = array(),$stake = null)
    {

    $query = $this->db->select('A.*,B.description,B.style,C.stake_details')
                  ->from('cm_change_user_request_log AS A')
                  ->join('cm_change_user_status_master AS B', 'B.code = A.status', 'left')
                  ->join('cm_stake_holder_master AS C', 'C.stake_id_pk = A.stake_id_fk', 'left')
                  ->join('cm_stake_holder_login AS D', 'D.stake_holder_login_id_pk = A.stake_holder_login_id_fk', 'right')
                  ->where($data)
                  ->where($stake)
                  ->get()
                  ->result_array();

    // echo $this->db->last_query();die;
    return $query;
    // return $this->db->affected_rows();
    }

    public function get_request_by_id($data = array())
    {

    $query = $this->db->select('A.stake_holder_login_id_fk,A.stake_id_fk,A.login_id,A.name,A.mobile_no,A.email_id')
                  ->from('cm_change_user_request_log AS A')
                  ->join('cm_change_user_status_master AS B', 'B.code = A.status', 'left')
                  ->where($data)
                  ->get()
                  ->row_array();

    // echo $this->db->last_query();die;
    return $query;
    // return $this->db->affected_rows();
    }
    
    public function update_request_log($data = array(),$where=array())
    {
      $this->db->set($data);
      $this->db->where($where);
      $this->db->update('cm_change_user_request_log');
      // echo $this->db->last_query();die;
      return $this->db->affected_rows();
    }

    public function get_old_login($id = null)
    {
      $query = $this->db->select('stake_holder_login_id_pk,stake_id_fk,login_id,login_password,stake_holder_details,base_password,name,mobile_no,login_email,district,block,subdiv,entry_time,service_from')
                          ->from('cm_stake_holder_login')
                          ->where('stake_holder_login_id_pk',$id)
                          ->get()->row_array();

                          // echo $this->db->last_query();

                          return $query;

    }

    public function archive_old_login($data = array())
    {
      $query = $this->db->insert('cm_stake_holder_archived_log', $data);
      return $this->db->affected_rows();

    }

    public function update_new_user($where)
    {

      $query = $this->db->select('*')
                          ->from('cm_change_user_request_log')
                          ->where($where)
                          ->get()->row_array();

      if(!empty($query))
      {
        $where1['stake_holder_login_id_pk'] = $query['stake_holder_login_id_fk'];
        $update['name'] = $query['name'];
        $update['mobile_no'] = $query['mobile_no'];
        $update['login_email'] = $query['email_id'];
        // $update['service_from'] = $query['approved_time'];

        $this->db->set($update);
        $this->db->where($where1);
        $this->db->update('cm_stake_holder_login');

        // echo $this->db->last_query();die;


      }


                          // echo "<pre>"; print_r($update);die;
      // echo $this->db->last_query();die;
      return $this->db->affected_rows();
    }

    public function new_user_dtls_by_id($sl_no = null)
    {
      $query = $this->db->select('*')
                          ->from('cm_change_user_request_log')
                          ->where('sl_no',$sl_no)
                          ->get()->row_array();
      // print_r($this->db->last_query());
      return $query;                
    }


     public function update_stake_holder_login($data = array(),$where=array())
    {
      $this->db->set($data);
      $this->db->where($where);
      $this->db->update('cm_stake_holder_login');
      // echo $this->db->last_query();die;
      return $this->db->affected_rows();
    }

    public function get_higher_authority_personnal($where)
    {
      $query = $this->db->select('stake_holder_login_id_pk,mobile_no,login_id')
                        ->from('cm_stake_holder_login')
                        ->where($where)
                        ->get()
                        ->row_array();
      return $query;


    }

    // public function archive_old_login($where = array())
    // {
    //     $query = $this->db->select('*')
    //                       ->from('cm_stake_holder_login')
    //                       ->where($where)
    //                       ->get()->row_array();

    //                       echo "<pre>"; print_r($query);

    //     if(!empty($query))
    //     {
    //       $query2 = $this->db->insert('cm_stake_holder_archived_log', $query);
    //     }


    // }
    
}
?>
