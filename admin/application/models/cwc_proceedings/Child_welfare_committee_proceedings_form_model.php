<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Child_welfare_committee_proceedings_form_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function insert_cwc_proceedings_cp_one_details($uploaded)
    {
        $result = $this->db->insert('cm_incident_report_cp_one_cwc_details', $uploaded);
    }

    public function insert_cwc_proceedings_cp_two_details($uploaded)
    {
        $result = $this->db->insert('cm_incident_report_cp_two_cwc_details', $uploaded);
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
