<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Forgot_password_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function check_user($user_name)
    {
        $query = $this->db->select('shl.stake_holder_login_id_pk, shl.login_id, shl.login_email,shl.stake_id_fk,shl.login_email,shl.district,shl.block,shl.name,shl.stake_holder_details')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->where('shl.login_id' , $user_name)
            ->where('shl.active_status', 1)
            ->where('shl.status', 1)
            ->get();
            // print_r($this->db->last_query());die;
        return $query->result_array();
    }

    public function check_user_forgot_pass($user_name)
    {
        $query = $this->db->select('shl.stake_holder_login_id_pk, shl.login_id, shl.login_email,shl.stake_id_fk,shl.login_email,shl.district,shl.block,shl.subdiv,shl.name,shl.stake_holder_details,fpass.is_active')
            ->from('cm_stake_holder_login AS shl')
            ->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
            ->join('cm_change_password_master AS fpass', 'shl.stake_holder_login_id_pk = fpass.stake_holder_login_id_fk', 'left')
            ->where('shl.login_id' , $user_name)
            ->where('shl.active_status', 1)
            ->where('shl.status', 1)
            ->order_by('fpass.is_active desc')
            ->get();
            // print_r($this->db->last_query());die;
        return $query->row_array();
    }

    public function check_user_details($stake_holder_id)
    {
        $query = $this->db->select('stake_holder_id_fk')
            ->from('cm_forgot_password')
            ->where('stake_holder_id_fk' , $stake_holder_id)
            ->where('active_status', 1)
            ->get();
        return $query->num_rows();
    }

    public function update_otp_details($uploaded, $stake_id)
    {
        $this->db->trans_start();
        $this->db->where('stake_holder_id_fk', $stake_id)->update('cm_forgot_password', $uploaded);
        $this->db->trans_complete(); 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
        //print_r($this->db->last_query());die;
    }

    public function insert_otp_details($uploaded)
    {
        $this->db->trans_start();
        $result = $this->db->insert('cm_forgot_password', $uploaded);
        $this->db->trans_complete(); 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function check_otp($otp, $stake_holder_id)
    {
        $query = $this->db->select('sl_no, otp, entry_time')
            ->from('cm_forgot_password')
            ->where('stake_holder_id_fk' , $stake_holder_id)
            ->where('otp', $otp)
            ->where('active_status', 1)
            ->where('status', 0)
            ->order_by('sl_no', 'desc')
            ->limit(1)
            ->get();
        return $query->row_array();
    }

    public function update_password_reset_details($uploaded, $stake_holder_id, $sl_no)
    {
        $this->db->trans_start();
        $this->db->where('stake_holder_login_id_pk', $stake_holder_id)->update('cm_stake_holder_login', $uploaded);
        $data = array(
            'status' => 1
        );
        $this->db->where('sl_no', $sl_no)->update('cm_forgot_password', $data);
        $this->db->trans_complete(); 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function insert_user_dtls($data=array())
    {
        $this->db->insert('cm_change_password_master',$data); 
        // echo $this->db->last_query();
    }
}
?>
