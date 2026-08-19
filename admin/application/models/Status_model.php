<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Status_model extends CI_Model 
{
	public function get_incident_draft_status($data=array()) 
	{
		$query = $this->db->select('incident_draft_status_id, incident_draft_status_name,status_color')
			->from('cm_incident_draft_status_master')
			// ->where('active_status' , 1)
			->get();
		return $query->result_array();
	}

	public function get_cp1_status($data=array()) 
	{
		$query = $this->db->select('cp1_status_id, cp1_status_name,status_color')
			->from('cm_cp1_status_master')
			// ->where('active_status' , 1)
			->get();
		return $query->result_array();
	}


	
}