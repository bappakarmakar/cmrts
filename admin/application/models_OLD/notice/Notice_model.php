<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Notice_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct();  
    }
    
    public function user_type($data = array()){
      $query = $this->db->select('*')
                        ->from('cm_stake_holder_master')
                        // ->where('active_status =', 1)
                        ->where_in('active_status', [0,1])
                        ->where('stake_id_pk !=', 1)
                        ->get()->result_array();
      // echo $this->db->last_query();die;
      return $query;
    } 

    public  function insert_notice($value=array()){
      $query = $this->db->insert('cm_notice_request', $value);
      //echo $this->db->last_query();die;
      return $this->db->insert_id();
    }
    public  function insert_user_wise_message_data($value=array()){
      $query = $this->db->insert('cm_notice_received', $value);
      return $this->db->insert_id();
    }

    public function get_notice(){

      $stake_id_fk        = $this->session->userdata('stake_id_fk');
      $stake_holder_login = $this->session->userdata('stake_holder_login_id_pk');

      $query = $this->db->query("SELECT notice_req.*, notice_rec.* FROM cm_notice_request notice_req
        LEFT JOIN cm_notice_received notice_rec ON notice_rec.notice_id_fk = notice_req.notice_id_pk 
        where notice_req.active_status = 1 AND notice_req.is_published=1 AND notice_rec.stake_id_fk = '".$stake_id_fk."' 
        AND notice_req.notice_id_pk not in(select notice_id_fk from cm_notice_marked where stake_holder_login_id_fk='".$stake_holder_login."') ")->result_array();
      // echo $this->db->last_query();die;
      return $query;
    }
 
    public function insert_accept_message_by_user($insert_data){
      $query = $this->db->insert('cm_notice_marked', $insert_data);
      return $query;
    }

    public function get_all_message_date(){

      $stake_id_fk = $this->session->userdata('stake_id_fk');
      if($stake_id_fk==1){

        $query = $this->db->query("SELECT * FROM cm_notice_request WHERE active_status IN(1) ORDER BY notice_id_pk ASC ")->result_array();
      }else{
        $query = $this->db->query("SELECT * FROM cm_notice_request WHERE active_status IN(1) AND notice_id_pk IN(SELECT notice_id_fk FROM cm_notice_received WHERE stake_id_fk ='".$stake_id_fk."') ORDER BY notice_id_pk ASC ")->result_array();
      }
      // echo $this->db->last_query();die;
      return $query;
    }

    public function publish_message_model($notice_id){

      $stake_holder_login = $this->session->userdata('stake_holder_login_id_pk');
      $today_date         = date('Y-m-d H:i:s');

      $query = $this->db->query("UPDATE cm_notice_request SET is_published='1', published_date='".$today_date."', published_by='".$stake_holder_login."' WHERE notice_id_pk ='".$notice_id."' ");
      return $query;
    }

    public function get_message_model($notice_id){
        $query = $this->db->query("SELECT notice_id_pk, title, description, created_by, created_date, active_status, is_published, published_date, published_by FROM cm_notice_request WHERE active_status='1' AND notice_id_pk='".$notice_id."' ")->result_array();
      // echo $this->db->last_query();die;
      return $query;
    }

    public function get_edit_message_model($notice_id){
       $query = $this->db->query("SELECT notice_req.*, notice_rec.* FROM cm_notice_request notice_req
        LEFT JOIN cm_notice_received notice_rec ON notice_rec.notice_id_fk = notice_req.notice_id_pk 
        where notice_req.active_status = 1 AND notice_req.notice_id_pk = '".$notice_id."' ")->result_array();
      // echo $this->db->last_query();die;
      return $query;
    }

    public function inactive_message_modal($notice_id){

      $stake_holder_login = $this->session->userdata('stake_holder_login_id_pk');
      $today_date         = date('Y-m-d H:i:s');

      $query = $this->db->query("UPDATE cm_notice_request SET active_status=0 ,inactive_by='".$stake_holder_login."', inactive_date='".$today_date."' WHERE notice_id_pk ='".$notice_id."' ");
      return $query;
    }
    public function update_message_modal($title,$description,$notice_id,$user_id){

      $stake_holder_login = $this->session->userdata('stake_holder_login_id_pk');
      $today_date         = date('Y-m-d H:i:s');

      $query_res = $this->db->query("UPDATE cm_notice_request SET title='".$title."', description='".$description."', updated_by='".$stake_holder_login."', updated_at='".$today_date."' WHERE notice_id_pk ='".$notice_id."' ");
      if($query_res ==1){

        $del_query_res =$this->db->query("DELETE FROM cm_notice_received WHERE notice_id_fk='".$notice_id."' ");

          foreach ($user_id as $target_user) {
            $value = array(
                          'notice_id_fk' => $notice_id, 
                          'stake_id_fk'  => $target_user 
                      );
            $query = $this->db->insert('cm_notice_received', $value);
          }
          return 1;
      }else{
        return 0;
      }

    }


    // Create by soumen 24_09_2024 for Download Excel
    public function get_stake_holder_name($notice_id){

      $query = $this->db->query("SELECT stake_details  from cm_notice_received join cm_stake_holder_master ON stake_id_fk=stake_id_pk where notice_id_fk='".$notice_id."' ")->result_array();

      foreach($query as $val){
        if (!empty($val)) {
            $stakeholder_data[] = $val['stake_details'];
        }
      }
      return $stakeholder_data;
    }
    
}
?>
