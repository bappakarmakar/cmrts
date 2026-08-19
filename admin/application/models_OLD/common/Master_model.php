<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Master_model extends CI_Model 
{
	public function get_state_name()
   {
	   $query = $this->db->select('state_id_pk, state_name')
	   ->from('rp_location_master_state')
	   ->where('active_status', 1)
	   ->get(); 
	   return $query->result_array(); 
   }

	 public function get_district_name($district_id)
    {
	   $query = $this->db->select('district_name, district_id_pk')
	   ->from('rp_location_master_district')
	   ->where('LENGTH(schcd) =', 4 )
	   ->where('district_id_pk', $district_id)
	   ->get();
	   return $query->row(); 
    }

    public function get_block_name($block_id)
    {
	   $query = $this->db->select('block_name, block_id_pk')
	   ->from('rp_location_master_block')
	   ->where('block_id_pk', $block_id)
	   ->order_by('block_name', 'asc')
	   ->get();
	   return $query->row(); 
    }

    public function get_district()
    {
	   $query = $this->db->select('district_name, district_id_pk')
	   ->from('rp_location_master_district')
	   ->where('LENGTH(schcd) =', 4 )
	   ->get();
	   return $query->result_array(); 
    }

    public function Get_District_Details_Name($state_id)
    {
	   $query = $this->db->select("*")
	   ->from("rp_location_master_district")
	   ->where("state_id_fk", $state_id)
	   ->order_by('district_name', 'asc')
	   ->get();
	   // print_r($this->db->last_query());die;
  	   return $query->result_array(); 
    }

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

    public function get_ward_gp_block($block_id)
    {
       $block_details_query = $this->db->select("block_id_pk, rural_urban")
	   ->from("rp_location_master_block")
	   ->where("block_id_pk", $block_id)
	   ->get()->row();
	   // echo $this->db->last_query();die;
  	   return $block_details_query; 
    }

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
    //
    public function get_all_ward()
    {
    	 $query = $this->db->select("ward.municipality_id_fk as block_id_fk, ward.ward_id_pk, ward.ward_no as name")
		   ->from("cm_ward_master as ward")
		   ->join("rp_location_master_block as block", "ward.municipality_id_fk = block.block_id_pk")
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

    public function get_all_gp()
    {
    	$query = $this->db->select("gp_id_pk, gp_name as name,block_id_fk")
		   ->from("cm_gp_master as gpm")
		   ->join("rp_location_master_block as lmb", "gpm.block_id_fk = lmb.block_id_pk")
		   ->order_by('gp_name', 'asc')
		   ->get();
    	 return $query->result_array();
    }
 
    public function get_sdo_deo_level_block($subdiv)
    {
	   $query = $this->db->select("*")
	   ->from("rp_location_master_block as block")
	   ->join("rp_location_master_district as district", "block.district_id_fk = district.district_id_pk")
	   ->join("rp_location_master_subdiv as subdiv", "block.clucd = subdiv.schcd")
	   ->where("block.subdiv_id_fk", $subdiv)
	   ->order_by('block_name', 'asc')
	   ->get();

	   // echo $query;die;
	   // print_r($this->db->last_query());die;
  	   return $query->result_array(); 
    }

	public function block()
	{
		$query = $this->db->query('SELECT block_name,block_id_pk FROM rp_location_master_block')->result();
		return $query; 
	}

	public function get_marriage_details()
    {
	   $query = $this->db->select('cm_marriage_master_id_pk, description')
	   ->from('cm_marriage_details_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_prevented_details()
    {
	   $query = $this->db->select('cm_incident_report_details_master_id_pk, description')
	   ->from('cm_prevented_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_location_description_details()
    {
	   $query = $this->db->select('cm_location_master_id_pk, description')
	   ->from('cm_location_description_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_information_received_details()
    {
	   $query = $this->db->select('cm_information_received_master_id_pk, description')
	   ->from('cm_information_received_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_gender_details()
    {
	   $query = $this->db->select('cm_gender_master_id_pk, description')
	   ->from('cm_gender_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_social_category_details()
    {
	   $query = $this->db->select('cm_social_category_master_id_pk, description')
	   ->from('cm_social_category_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_religion_details()
    {
	   $query = $this->db->select('cm_religion_master_id_pk, description')
	   ->from('cm_religion_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_document_type_details()
    {
	   $query = $this->db->select('cm_document_type_master_master_id_pk, description')
	   ->from('cm_document_type_master')
	   ->where('active_status', 1)
	   ->order_by('description', 'ASC')
	   ->get();
	   return $query->result_array(); 
    }

    public function get_highest_education_details()
    {
	   $query = $this->db->select('cm_highest_educational_attainment_master_id_pk, description')
	   ->from('cm_highest_educational_attainment_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_minor_details()
    {
	   $query = $this->db->select('cm_minor_master_id_pk, description')
	   ->from('cm_minor_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
    }

    public function get_minor_transfer_details()
    {
	   $query = $this->db->select('sl_no, description')
	   ->from('cm_minor_transfer_details_master')
	   ->where('active_status', 1)
	   ->order_by('sl_no','asc')
	   ->get();
	   return $query->result_array(); 
    }

   /*public function Get_Cp_One_CCI_Details($cp_one_gender, $cp_one_cwc_district)
   {
	   if($cp_one_gender == '1'){
	      $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   }elseif($cp_one_gender == '2'){
	      $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   }
	   return $query->result_array(); 
   }

   public function Get_Cp_Two_CCI_Details($cp_one_gender, $cp_one_cwc_district)
   {
	   if($cp_one_gender == '1'){
	      $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   }elseif($cp_one_gender == '2'){
	      $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   }
	   return $query->result_array(); 
   }*/
   public function Get_Cp_One_CCI_Details($cp_one_gender, $cp_one_cwc_district)
   {
	   if($cp_one_gender == '1'){
	   	  if($cp_one_gender == '1' & $cp_one_cwc_district != ''){
	   	  	 $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   	  }else{
	   	  	 return null;
	   	  }
	   }elseif($cp_one_gender == '2'){
	   	  if($cp_one_gender == '2' & $cp_one_cwc_district != ''){
	   	  	 $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   	  }else{
	   	  	 return null;
	   	  }
	   }else{
	   	  return null;
	   } 
	   return $query->result_array(); 
   }

   public function Get_Cp_Two_CCI_Details($cp_one_gender, $cp_one_cwc_district)
   {
	   if($cp_one_gender == '1'){
	   	  if($cp_one_gender == '1' & $cp_one_cwc_district != ''){
	   	  	 $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   	  }else{
	   	  	 return null;
	   	  }
	   }elseif($cp_one_gender == '2'){
	   	  if($cp_one_gender == '2' & $cp_one_cwc_district != ''){
	   	  	 $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $cp_one_cwc_district");
	   	  }else{
	   	  	 return null;
	   	  }
	   }else{
	   	  return null;
	   } 
	   return $query->result_array(); 
   }

   public function Get_total_CCI()
   {
   			$query = $this->db->select('sl_no, cci_name')
	      ->from('cm_cci_details')
	      ->where('active_status', 1)
	      ->get();
	      return $query->result_array(); 
   }

   public function get_mode_of_enquiry_details()
   {
	   $query = $this->db->select('sl_no, description')
	   ->from('cm_mode_of_enquiry_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
   }
	
	public function get_stage_of_pregnancy_details()
	{
		$query = $this->db->select('sl_no, description')
	   ->from('cm_pregnancy_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 

	}
   public function get_disability_details()
   {
	   $query = $this->db->select('sl_no, description')
	   ->from('cm_disability_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
   }

   public function get_estimated_severity_details()
   {
	   $query = $this->db->select('sl_no, description')
	   ->from('cm_estimated_severity_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
   }

   public function get_pregnancy_details()
   {
	   $query = $this->db->select('sl_no, description')
	   ->from('cm_pregnancy_master')
	   ->where('active_status', 1)
	   ->get();
	   return $query->result_array(); 
   }

   public function BDO_DEO_Get_Ward_GP($block_id)
   {
   	 	$query = $this->db->select("gp_id_pk, gp_name")
	   ->from("cm_gp_master as gpm")
	   ->join("rp_location_master_block as lmb", "gpm.block_id_fk = lmb.block_id_pk")
	   ->where("gpm.block_id_fk", $block_id)
	   ->order_by('gp_name', 'asc')
	   ->get();
   	 return $query->result_array(); 
   }

   public function get_block_details($block_id)
   {
   	  $block_details_query = $this->db->select("block_id_pk, rural_urban")
	   ->from("rp_location_master_block")
	   ->where("block_id_pk", $block_id)
	   ->get()->row();
 	return $block_details_query;
   }

   public function get_ward_details($block_id)
   {
   	  $query = $this->db->select("ward.municipality_id_fk, ward.ward_id_pk, ward.ward_no")
	   ->from("cm_ward_master as ward")
	   ->join("rp_location_master_block as block", "ward.municipality_id_fk = block.block_id_pk")
	   ->where("ward.municipality_id_fk", $block_id)
	   ->order_by('ward_no', 'asc')
	   ->get();
	   return $query->result_array(); 
   }

   public function get_gp_details($block_id)
   {
   	   $query = $this->db->select("gp_id_pk, gp_name")
	   ->from("cm_gp_master as gpm")
	   ->join("rp_location_master_block as lmb", "gpm.block_id_fk = lmb.block_id_pk")
	   ->where("gpm.block_id_fk", $block_id)
	   ->order_by('gp_name', 'asc')
	   ->get();
	   return $query->result_array();
   }

   //Debojit


   public function get_dist_by_block($data=array())
   {
   	// print_r($data);die;s
		$query = $this->db->select("A. block_id_pk, A. block_name, B. district_id_pk, B. district_name")
								->from("rp_location_master_block AS A")
								->join("rp_location_master_district AS B","A.district_id_fk = B.district_id_pk","left")
								->where("A.block_id_pk", $data['block_id'])
								->Get();

		return $query->row_array();

   }

   public function Get_gp_by_gpid($gp_id)
   {
   	 	$query = $this->db->select("gp_id_pk,gp_name")
	   ->from("cm_gp_master as gpm")
	   // ->join("rp_location_master_block as lmb", "gpm.block_id_fk = lmb.block_id_pk")
	   ->where("gpm.gp_id_pk", $gp_id)
	   ->order_by('gp_name', 'asc')
	   ->get();
   	 return $query->row_array(); 
   }

   public function Get_ward_by_wardid($ward_id)
   {
   	 $query = $this->db->select("ward.municipality_id_fk, ward.ward_id_pk, ward.ward_no")
	   ->from("cm_ward_master as ward")
	   // ->join("rp_location_master_block as block", "ward.municipality_id_fk = block.block_id_pk")
	   ->where("ward.ward_id_pk", $ward_id)
	   ->order_by('ward_no', 'asc')
	   ->get();
	   // echo ($this->db->last_query());die;
   	 return $query->row_array(); 
   }
}