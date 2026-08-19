<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function contracting_parties_details_by_incident_id($incident_id){
        $query = $this->db->select('cp_id_pk,cp_type')
            ->from('cm_incident_report_contracting_parties')
            ->where('incident_id_fk' , $incident_id)
            ->get()->result();
            return $query;
    }
    public function contracting_parties_details_by_cp_id_pk($cp_id_pk){
        $query = $this->db->select('*')
            ->from('cm_incident_report_contracting_parties')
            ->where('cp_id_pk' , $cp_id_pk)
            ->get()->row();
            return $query;
    }
    public function address_changes_details_by_id($where_array=array()){
        $query = $this->db->select('*')
            ->from('cm_incident_report_cp_address_details')
            ->where($where_array)
            ->get()->row();
            return $query;
    }

    public function insert_address_change_details($insert_data)
    {
      $default = $this->load->database('default',TRUE);
        $default->insert('cm_incident_report_cp_address_details', $insert_data);
        //print $default->last_query();die();
        return $default->affected_rows();
    }
    public function update_address_change_details($updateData,$sl_no){
        $default = $this->load->database('default',TRUE);
        $default->where('sl_no', $sl_no)
           ->update('cm_incident_report_cp_address_details',$updateData);
        //print $default->last_query();die();
        return $default->affected_rows();
    }

    public function incident_list_reporting_details($incident_id)
    {
        $query = $this->db->query("SELECT stake_holder_id_fk, incident_id_pk FROM cm_incident_report WHERE incident_id_pk = $incident_id")->result();
        return $query;
    }

    public function us_date_format($uk_date=NULL)
    {
       if($uk_date != NULL){
          $date_array = explode('/', $uk_date);
          return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
       } else {
          return NULL;
       }
    }
}
?>
