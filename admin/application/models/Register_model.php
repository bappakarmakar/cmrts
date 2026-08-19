<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Register_model extends CI_Model 
{
	public function __construct()
  { 
      parent::__construct(); 
  }

  public function check_duplicate_mobile_no($subdiv,$stake_holder_login_id, $mobile_no,$stake_id_fk)
  {
   if($stake_id_fk==4){
      if(empty($subdiv)){
         $query = $this->db->select('shl.mobile_no')
            ->from('cm_stake_holder_login AS shl')
            ->where_not_in('shl.stake_holder_login_id_pk' , $stake_holder_login_id)
            ->where('shl.mobile_no', $mobile_no)
            ->get()->num_rows();
         return $query;
      }else{

          
         // $query = $this->db->select('shl.mobile_no,shl.stake_holder_login_id_pk,shl.login_id')
         //       ->from('cm_stake_holder_login AS shl')
         //       ->where_not_in('shl.subdiv' , $subdiv)
         //       ->where('shl.mobile_no', $mobile_no)
         //       ->get()->num_rows();

         $query1 = $this->db->select('shl.mobile_no,shl.login_id,stake_holder_login_id_pk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.subdiv' , $subdiv)
            ->where('shl.stake_id_fk', 6)
            ->get()->row_array();

            // echo "<pre>";print_r($query);die;

         $query = $this->db->select('shl.mobile_no, shl.stake_holder_login_id_pk, shl.login_id')
                  ->from('cm_stake_holder_login AS shl')
                  ->group_start()
                       ->where_not_in('shl.subdiv' , $subdiv)
                      ->or_where('shl.subdiv IS NULL', null, false)
                      ->or_where('shl.stake_holder_login_id_pk', $query1['stake_holder_login_id_pk'])
                  ->group_end()
                  ->where('shl.mobile_no', $mobile_no)
                  ->get()
                  ->num_rows();

               // echo $this->db->last_query();die;
               return $query;
      }

   }else{
      $query = $this->db->select('shl.mobile_no')
            ->from('cm_stake_holder_login AS shl')
            ->where_not_in('shl.stake_holder_login_id_pk' , $stake_holder_login_id)
            ->where('shl.mobile_no', $mobile_no)
            ->get()->num_rows();
      return $query;

   }
     
      
  }
 
  public function update_user_details($uploaded, $stake_id) 
  {
      

      $query = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk, shl.district, shl.block, shl.subdiv')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.stake_holder_login_id_pk' , $stake_id)
            ->get()->row();

      if($query->stake_id_fk == 4){
         $message = 'DEO sign up';
         if($query->stake_id_fk == 4 && $query->subdiv == ''){
            $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.block' , $query->block)
            ->where('shl.stake_id_fk' , 2)
            ->get()->row();
         }else{
            $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.subdiv' , $query->subdiv)
            ->where('shl.stake_id_fk' , 6)
            ->get()->row();
         }
      }elseif($query->stake_id_fk == 2){
         $message = 'BDO sign up';
         $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.stake_id_fk' , 3)
            ->get()->row();
      }elseif($query->stake_id_fk == 6){
         $message = 'SDO sign up';
         $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.district' , $query->district)
            ->where('shl.stake_id_fk' , 3)
            ->get()->row();
      }elseif($query->stake_id_fk == 3){
         $message = 'CMPO sign up';
         $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.stake_id_fk' , 1)
            ->get()->row();
      }else{
         $message = 'MIS User sign up';
         $query_2 = $this->db->select('shl.stake_holder_login_id_pk, shl.stake_id_fk')
            ->from('cm_stake_holder_login AS shl')
            ->where('shl.stake_holder_login_id_pk' , 1173)
            ->get()->row();
      }
        
      if($query_2)
      {
         $receiver_by = ($query_2)?$query_2->stake_holder_login_id_pk:'';
      }
      else
      {
         $receiver_by = NULL;
      }
      // echo $receiver_by;die;
      $this->db->trans_start();
      $this->db->where('stake_holder_login_id_pk', $stake_id)->update('cm_stake_holder_login', $uploaded);
      $stake_holder_login_id_status = $this->db->affected_rows();

      $page_link = base_url()."admin/user_list/user";
      $uploaded_notification_details = array(
         'sender_by' => $stake_id,
         'receiver_by' => $receiver_by,
         'page_link' => $page_link,
         'message' => $message,
         'sending_time' => date('Y-m-d H:i:s'),
         'status' => 0
      );
      $this->db->insert('cm_notification_details', $uploaded_notification_details);
      $cm_notification_details_status = $this->db->affected_rows();
      if($stake_holder_login_id_status>0 && $cm_notification_details_status>0){
         $this->db->trans_commit();
         return 1;
      }else{
         $this->db->trans_rollback();
         return 0;
      }
  }
}

