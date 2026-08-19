<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change_list_model extends CI_Model
{
    public function __construct(){ 
      parent::__construct(); 
    }

    // Get Block name by selected district
    public function get_block($district_id)
    {
       $query = $this->db->select("*")
       ->from("rp_location_master_block as block")
       ->join("rp_location_master_district as district", "block.district_id_fk = district.district_id_pk")
       ->where("block.district_id_fk", $district_id)
       ->order_by('block_name', 'asc')
       ->get();
       // echo $this->db->last_query();die;
       return $query->result_array();
    }

    // Get Ward name selected by block
    public function get_ward($block_id)
    {
         $query = $this->db->select("ward.municipality_id_fk, ward.ward_id_pk, ward.ward_no")
           ->from("cm_ward_master as ward")
           ->join("rp_location_master_block as block", "ward.municipality_id_fk = block.block_id_pk")
           ->where("ward.municipality_id_fk", $block_id)
           ->order_by('ward_no', 'asc')
           ->get();
         return $query->result_array();
    }

    // Get GP by selected Block
    public function get_gp($block_id)
    {
        $query = $this->db->select("gp_id_pk, gp_name")
           ->from("cm_gp_master as gpm")
           ->join("rp_location_master_block as lmb", "gpm.block_id_fk = lmb.block_id_pk")
           ->where("gpm.block_id_fk", $block_id)
           ->order_by('gp_name', 'asc')
           ->get();
         return $query->result_array();
    }

    // Get block details
    public function get_ward_gp_block($block_id)
    {
       $block_details_query = $this->db->select("block_id_pk, rural_urban")
       ->from("rp_location_master_block")
       ->where("block_id_pk", $block_id)
       ->get()->row();
       // echo $this->db->last_query();die;
       return $block_details_query; 
    }

    public function already_exist($incident_id, $reporting_id, $cp_id){
    	//echo $incident_id.'---'.$reporting_id.'---'.$cp_id;die;
    	$this->db->select('*');
		$this->db->from('cm_cp_address_change_data');
		$this->db->where('incident_id_fk', $incident_id);
		$this->db->where('reporting_id', $reporting_id);
		$this->db->where('cp_id_fk', $cp_id);
		$this->db->where('current_status !=', 3);
		$query_data = $this->db->get();
		// echo $this->db->last_query();die;
		return $query_data;
    }

    public function address_change_details(){

    	$stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
    	$stake_id_fk = $this->session->userdata('stake_id_fk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        // echo "<pre>";
        // print_r($this->session->userdata());die;

        if($stake_id_fk =='1' || $stake_id_fk =='5'){  // SNO login and MIS
        	$attach_query = "AND cad.current_status IN(3)";
         }
         else if($stake_id_fk =='2'){ // BDO
        	$attach_query = "AND 
        	(
        		(ir.district = '".$district."' AND ir.block = '".$block."' AND cad.current_status IN(1,2,3,4)) 
        		OR (cp.cp_district ='".$district."' AND cp.cp_block='".$block."' AND cad.current_status IN(1,2,3,4))
                OR (cad.district ='".$district."' and cad.block='".$block."' AND cad.current_status IN(1,2,3,4) )
        	)";
        }
        else if($stake_id_fk =='3'){ // CMPO
        	$attach_query = "AND
        	(
        		(ir.district = '".$district."' AND cad.current_status IN(3) )
        		OR (cp.cp_district ='".$district."' AND cad.current_status IN(3) )
        	)";
        }
        else if($stake_id_fk =='4'){ // DEO
        	$attach_query = "AND 
        	(
        		(ir.district = '".$district."' AND ir.block = '".$block."' AND cad.current_status IN(1,3,4)) 
        		OR (cp.cp_district ='".$district."' AND cp.cp_block='".$block."' AND cad.current_status IN(1,3,4) )
        		OR (ir.district ='".$district."' AND ir.block = '".$block."' AND cad.created_by_stake_holder_id='".$stake_holder_id_fk."')
        		OR (cp.cp_district ='".$district."' AND cp.cp_block='".$block."' AND cad.created_by_stake_holder_id='".$stake_holder_id_fk."')
        	)";
        }
        else if($stake_id_fk =='6'){ // SDO
        	$attach_query = "AND
        	(
        		(ir.district ='".$district."' AND ir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cad.current_status IN(1,2,3))
        		OR (cp.cp_district ='".$district."' AND cp.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cad.current_status IN(1,2,3))
                OR (cad.district ='".$district."' and cad.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND cad.current_status in(1,2,3))
        	)";
        }

        $query = $this->db->query("SELECT cad.*, ir.state AS incident_state, ir.district AS incident_district, dm.district_name AS Incident_district_name,
			ir.block AS incident_block, bm.block_name AS incident_block_name, bm.rural_urban AS rural_urban,ir.ward_gp AS incident_ward_gp, cp.cp_gender,
			cp.cp_name AS cp_name, cp.cp_state AS current_state, cp.cp_district AS current_district,cp.cp_block AS current_block, 
			cp.cp_ward_gp AS current_word_gp, cp_table_district.district_name AS current_district_name, 
			cp_table_block.block_name AS current_block_name, cp_table_block.rural_urban AS curren_rural_urban, 
			cp.cp_address AS cp_current_address, new_district.district_name AS new_district_name, new_block.block_name AS new_block_name, new_block.rural_urban AS new_rural_urban, address_status.description AS address_change_status FROM cm_cp_address_change_data cad
			INNER JOIN cm_incident_report_contracting_parties cp ON cp.cp_id_pk::VARCHAR = cad.cp_id_fk 
			INNER JOIN cm_incident_report ir ON ir.incident_id_pk::VARCHAR = cad.incident_id_fk
			LEFT JOIN rp_location_master_district dm ON dm.district_id_pk = ir.district
			LEFT JOIN rp_location_master_block bm ON bm.block_id_pk = ir.block
			LEFT JOIN rp_location_master_district cp_table_district ON cp_table_district.district_id_pk = cp.cp_district
			LEFT JOIN rp_location_master_block cp_table_block ON cp_table_block.block_id_pk = cp.cp_block
			LEFT JOIN rp_location_master_district new_district ON new_district.district_id_pk=cad.district
			LEFT JOIN rp_location_master_block new_block ON new_block.block_id_pk = cad.block
			JOIN cm_cp_status_master address_status ON address_status.status_code = cad.current_status WHERE cad.delete_status ='0' $attach_query
			")->result();
        // echo $this->db->last_query();
        //die;
        return $query;
    }

    public function address_exist_cnt($cp_id_fk){
        // Get Incidet id
        $query_data = $this->db->query("SELECT incident_id_fk, reporting_id, cp_id_fk, cp_type FROM cm_cp_address_change_data WHERE cp_id_fk='".$cp_id_fk."'");
        return $query_data;
    }

    public function address_data($address_change_id, $incident_id_fk, $cp_id_fk, $change_address_cnt)
    {
        //echo address_change_id.'='.$incident_id_fk.'--'.$cp_id_fk.'--'.$change_address_cnt.'</br>';
        if($change_address_cnt<2){

            $incident_data = $this->db->query("SELECT incident_id_pk AS incident_id, stake_holder_id_fk AS created_stakholder, created_at, created_ip, publish_by_stake_id_fk, publish_date, publish_by_ip FROM cm_incident_report WHERE incident_id_pk='".$incident_id_fk."'")->row_array();
            // echo '->>>';print_r($incident_data);
            return $incident_data;
        }else{

            // print_r($this->session->userdata());
            date_default_timezone_set('Asia/Kolkata');
            $publish_stakeholder_id = $this->session->userdata('stake_holder_login_id_pk');
            $publish_date = date('Y-m-d H:i:s');

            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                // Check for client IP
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                // Fallback to REMOTE_ADDR if no proxy headers are found
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $publish_ip = explode(',', $ip)[0]; 

            $incident_data = $this->db->query("SELECT incident_id_fk AS incident_id, created_by_stake_holder_id  AS created_stakholder, created_at, created_ip, '".$publish_stakeholder_id."' AS publish_by_stake_id_fk , '".$publish_date."' AS publish_date, '".$publish_ip."' AS publish_by_ip FROM cm_cp_address_change_data WHERE address_change_id_pk = '".$address_change_id."'")->row_array();
            return $incident_data;
        }
       
    }

    public function cp_current_address($cp_id_fk){

        $incident_data = $this->db->query("SELECT cp_street_landmark, cp_state, cp_district, cp_block, cp_ward_gp, cp_address, cp_pin_code, cp_police_station, cp_phone_no, created_at FROM cm_incident_report_contracting_parties WHERE cp_id_pk='".$cp_id_fk."'")->row_array();
        return $incident_data;
    }
    // Get New Address form Address change table
    public function get_new_address($address_change_id){

        // echo '====>>'.$address_change_id;die;
        $cp_current_address = $this->db->query("SELECT cp_id_fk, street_landmark, state, district, block, ward_gp, cp_address, pin_code, police_station, cp_mobile FROM cm_cp_address_change_data WHERE address_change_id_pk='".$address_change_id."'")->row_array();
        // echo $this->db->last_query();die;
        return $cp_current_address;
    }




}