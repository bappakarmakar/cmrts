<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Login_model extends CI_Model 
{
	public function check_first_user($login_id=NULL) 
	{
		$query = $this->db->select('shl.stake_id_fk, shl.stake_holder_login_id_pk, shl.login_id, shl.login_email, shl.active_status, shm.stake_details, shl.stake_holder_details, shl.stake_details_id_fk,shl.login_password, shl.name, shl.district, shl.block, shl.subdiv')
			->from('cm_stake_holder_login AS shl')
			->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
			->where('UPPER(shl.login_id)',strtoupper($login_id))
			->where('shl.active_status' , 0)
			->where('shl.status' , 0)
			->where('shm.active_status' , 1)
			->get();
		return $query->result_array();
	}

	public function check_final_users($login_id=NULL) 
	{
		$query = $this->db->select('shl.stake_id_fk, shl.stake_holder_login_id_pk, shl.login_id, shl.login_email, shl.active_status, shm.stake_details, shl.stake_holder_details, shl.stake_details_id_fk, shl.login_password, shl.name, shl.district, shl.block, shl.subdiv, shl.login_status, shl.master_password')
			->from('cm_stake_holder_login AS shl')
			->join('cm_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
			->where('UPPER(shl.login_id)',strtoupper($login_id))
			->where('shl.active_status' , 1)
			->where('shl.status' , 1)
			->where('shm.active_status' , 1)
			->get();
		return $query->result_array();
	}

	public function check_mobile($login_id=NULL) {

		if(!empty($login_id))
		{
			$query = $this->db->select('mobile_no,stake_holder_login_id_pk')
						->from('cm_stake_holder_login')
						->where('UPPER(login_id)',strtoupper($login_id))
						->get();	
		}	
		else
		{
			return false;
		}
		// echo $this
		// return $query->result_array();
	return $query->row();
	
}

	public function insert_otp_log(array $data=array()) 
	{

		if(!empty($data))
		{
			$query = $this->db->insert('cm_sms_sent_log', $data);	
		}	
		else
		{
			return false;
		}
		// echo $this
		// return $query->result_array();
		return TRUE;
	}

	public function update_otp_log(array $data=array())
	{

		if(!empty($data))
		{
			// $query = $this->db->set('is_success', $data['is_success'])
			// 	->where('stake_holder_login_id_fk', $data['stake_holder_login_id_fk'])
			// 	->order_by('created_on', 'DESC') // Order by 'created' column in descending order
			// 	->limit(1)
			// 	->update('cm_sms_sent_log');
				// ->affected_rows();


			$this->db->set('is_success', $data['is_success']);
			$this->db->where('stake_holder_login_id_fk', $data['stake_holder_login_id_fk']);
			$this->db->where('created_on = (SELECT MAX(created_on) FROM cm_sms_sent_log WHERE stake_holder_login_id_fk = ' . $data['stake_holder_login_id_fk'] . ')', null, false);
			$this->db->update('cm_sms_sent_log');

			// Get the number of affected rows
			$affected_rows = $this->db->affected_rows();
			return $affected_rows;
		}	
		else
		{
			return false;
		}
		// echo $this
		// return $query->result_array();
		return TRUE;



	}

}