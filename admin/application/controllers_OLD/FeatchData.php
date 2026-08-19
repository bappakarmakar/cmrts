<?php
class FeatchData extends CI_Controller
{
    function __construct(){
        parent::__construct();  // Ensure you call the parent constructor of CI_Controller
        // You can initialize your properties or load models here
    }

    public function index(){

        $LiveDB   = $this->load->database('live_default',TRUE); // Featch From Live DB Data
		$ldefault = $this->load->database('ldefault',TRUE); // Test Server DB Data
		print_r($LiveDB);die;
		$query  = $LiveDB->query("SELECT * FROM cm_incident_report WHERE current_status =3");
		$result = $query->result_array();
		echo "<pre>";print_r($result);die();
		//$ldefault->insert_batch('ifms_track_status',$result);
		//echo "<pre>";print_r($query);
		

    }
}
?>