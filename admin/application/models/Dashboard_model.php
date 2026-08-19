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
		if($this->session->userdata('stake_id_fk') == '4'){

		    $query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE ( block = '".$this->session->userdata('block')."') AND current_status != 1 AND delete_status = 0");

		}elseif($this->session->userdata('stake_id_fk') == '2'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."' and block = '".$this->session->userdata('block')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '3'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
			if($this->session->userdata('district') == ''){
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE current_status != 1 AND delete_status = 0");
			}else{
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report WHERE district = '".$this->session->userdata('district')."' AND current_status != 1 AND delete_status = 0");
			}
		}elseif($this->session->userdata('stake_id_fk') == '6'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS complaints_received_total_count FROM cm_incident_report as a LEFT JOIN rp_location_master_block as b ON a.block = b.block_id_pk LEFT JOIN rp_location_master_subdiv as c ON b.clucd = c.schcd WHERE a.current_status != 1 AND delete_status = 0 AND c.subdiv_id_pk = '".$this->session->userdata('subdiv')."'");
		}
		// echo $this->db->last_query();die;
        return $query->result();
	}

	public function Child_Marriage_Prevented_Count_Details()
	{
		$stake_id = $this->session->userdata('stake_holder_login_id_pk');
		if($this->session->userdata('stake_id_fk') == '4'){

		    $query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND block = '".$this->session->userdata('block')."' AND current_status != 1 AND delete_status = 0");

		}elseif($this->session->userdata('stake_id_fk') == '2'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."' and block = '".$this->session->userdata('block')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '3'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
			if($this->session->userdata('district') == ''){
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND current_status != 1 AND delete_status = 0");
			}else{
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report WHERE prevented_details = 1 AND district = '".$this->session->userdata('district')."' AND current_status != 1 AND delete_status = 0");
			}
		}elseif($this->session->userdata('stake_id_fk') == '6'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_prevented_total_count FROM cm_incident_report as a LEFT JOIN rp_location_master_block as b ON a.block = b.block_id_pk LEFT JOIN rp_location_master_subdiv as c ON b.clucd = c.schcd WHERE a.current_status != 1 AND delete_status = 0 AND c.subdiv_id_pk = '".$this->session->userdata('subdiv')."' AND prevented_details = 1");
		}
        return $query->result();
	}

	public function Child_Marriage_Cannot_Prevented_Count_Details()
	{
		$stake_id = $this->session->userdata('stake_holder_login_id_pk');
		if($this->session->userdata('stake_id_fk') == '4'){
		    $query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND block = '".$this->session->userdata('block')."' AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '2'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."' and block = '".$this->session->userdata('block')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '3'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND (stake_holder_id_fk = $stake_id OR district = '".$this->session->userdata('district')."') AND current_status != 1 AND delete_status = 0");
		}elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
			if($this->session->userdata('district') == ''){
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND current_status != 1 AND delete_status = 0");
			}else{
				$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report WHERE prevented_details = 2 AND district = '".$this->session->userdata('district')."' AND current_status != 1 AND delete_status = 0");
			}
		}elseif($this->session->userdata('stake_id_fk') == '6'){
			$query = $this->db->query("SELECT COUNT(incident_id_pk) AS child_marriage_cannot_prevented_total_count FROM cm_incident_report as a LEFT JOIN rp_location_master_block as b ON a.block = b.block_id_pk LEFT JOIN rp_location_master_subdiv as c ON b.clucd = c.schcd WHERE a.current_status != 1 AND delete_status = 0 AND c.subdiv_id_pk = '".$this->session->userdata('subdiv')."' AND prevented_details = 2");
		}
        return $query->result();
	}

	public function cp_previous_scheduler_count(){

		// echo "<pre>";print_r($this->session->userdata());
		$district = $this->session->userdata('district');
		$query = $this->db->query("SELECT ir.incident_id_pk, ir.incident_date, ir.reporting_id, cp.cp_id_pk, cp.cp_type, cp.cp_dob, cp.cp_age
			FROM cm_incident_report_contracting_parties cp 
			JOIN cm_incident_report ir ON ir.incident_id_pk = cp.incident_id_fk
			WHERE 
			cp.cp_age>'18' AND cp.cp_age<'21' AND
			cp.cp_gender=1 AND 
			ir.delete_status=0 AND 
			ir.cp_two_is_available=1 AND 
			cp.cp_district=10
			ORDER BY ir.incident_id_pk ASC")->result();
		// echo $this->db->last_query();die;
		echo "<pre>"; print_r($query);


	}
}
