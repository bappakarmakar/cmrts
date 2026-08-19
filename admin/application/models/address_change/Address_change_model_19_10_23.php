<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function insert_address_change_details($uploaded, $minor_details)
    {
        if($minor_details == '1'){
            $result = $this->db->insert('cm_incident_report_cp_one_cwc_details', $uploaded);
        }else{
            $result = $this->db->insert('cm_incident_report_cp_two_cwc_details', $uploaded);
        }
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
