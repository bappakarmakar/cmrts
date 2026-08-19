<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Dashboard_model extends CI_Model 
{
	public function district_details($login_id)
	{
		 if($this->session->userdata('stake_id_fk') == '6'){
		 	$query = $this->db->select('shl.district, shl.subdiv, district_location_master_description(shl.district) AS district_name, subdiv_location_master_description(shl.subdiv) AS subdiv_name')
			->from('cm_stake_holder_login AS shl')
			->where('shl.login_id', $login_id)
			->get();
		 }else{
		 	$query = $this->db->select('shl.district, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name, subdiv_location_master_description(shl.subdiv) AS subdiv_name')
			->from('cm_stake_holder_login AS shl')
			->where('shl.login_id', $login_id)
			->get();
		 }
		return $query->result_array();
	}

	public function Complaints_Received_Count_Details()
	{
		$stake_id = $this->session->userdata('stake_holder_login_id_pk');
		$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE deo_cp_one_stake_id_fk = $stake_id OR deo_cp_two_stake_id_fk = $stake_id OR stake_holder_id_fk = $stake_id AND incident_draft_status = 2");
        return $query->result();
	}

	public function Child_Marriage_Prevented_Count_Details()
	{
		$stake_id = $this->session->userdata('stake_holder_login_id_pk');
		$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND (deo_cp_one_stake_id_fk = $stake_id OR deo_cp_two_stake_id_fk = $stake_id OR stake_holder_id_fk = $stake_id AND incident_draft_status = 2)");
        return $query->result();
	}

	public function Child_Marriage_Cannot_Prevented_Count_Details()
	{
		$stake_id = $this->session->userdata('stake_holder_login_id_pk');
		$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND (deo_cp_one_stake_id_fk = $stake_id OR deo_cp_two_stake_id_fk = $stake_id OR stake_holder_id_fk = $stake_id AND incident_draft_status = 2)");
        return $query->result();
	}
}
