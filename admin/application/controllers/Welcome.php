<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class welcome extends NIC_Controller {


public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index() 
  {

  	$query = $this->db->select('*')
  						->from('cm_incident_report')
  						//->where('current_status',3)
  						->get()
  						->result_array();
  	// foreach ($query as $key => $value) {
   //    $incident_id_fk = $value['incident_id_pk'];
   //    $updateData = $value['created_at'];

   //    $publish_by = $value['publish_by'];
   //    $publish_by_stake_id_fk = $value['publish_by_stake_id_fk'];

   //    if($publish_by != 3){
   //      $updateData_array = array('publish_by'=>$publish_by_stake_id_fk,'publish_by_stake_id_fk'=>$publish_by);
   //      echo $publish_by_stake_id_fk. "---------".$publish_by."<br>"; 
        // $this->db->where('incident_id_pk',$incident_id_fk);
        // $this->db->update('cm_incident_report', $updateData_array);
      }
     
      /*$this->db->where('incident_id_pk',$incident_id_fk);
      $this->db->update('cm_incident_report', $updateData);
      echo $this->db->last_query();
echo $incident_id_fk.'==='.$updateData;die();*/
  		
  	}					
  }



}
  