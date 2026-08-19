<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Welcome_model extends CI_model{
	
	function __construct(){
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'file'));
	}
	
	public function get_no_civil_engineering()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 9
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}

	public function get_no_automobile()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 12
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}

	public function get_no_Electronics_Communication()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 16
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}

	public function get_no_Electrical()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 14
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}

	public function get_no_Mechanical()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 7
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}



	public function get_no_Chemical()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 1
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}


	public function get_no_Instrumentation_Control()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 10
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}


	public function get_no_Computer_Science_Technology()
	{
		// if(!$sector_count=$this->cache->get('public/common/sector_count.json'))
		// {
			$this->db->select('reading_materials_id')
					 ->from('elearning_reading_materials')
					 ->where(
					 		array(
					 			'status' 		=> 1,
					 			'course_code' 	=> 11
					 		)
					 );
			$query=$this->db->get();
			$sector_count=$query->num_rows();
		//}
		return $sector_count;
	}
	
}