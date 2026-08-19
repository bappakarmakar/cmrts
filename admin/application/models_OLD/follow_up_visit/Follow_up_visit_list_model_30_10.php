<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function follow_up_visits_list_details()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("SELECT cmir.incident_id_pk, cmir.reporting_id, cmir.incident_date, cmir.cp_one_age AS age, cpo.sl_no AS cp_id, cpo.cp_one_gender AS gender, cpo.cp_one_name AS name, cpo.cp_one_ward_gp, cpo.cp_one_block AS cp_one_block_id FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_one AS cpo ON cmir.incident_id_pk = cpo.incident_id_fk WHERE cmir.follow_up_visit_status = '102' AND cpo.cp_one_district = $district AND cpo.cp_one_block = $block")->result();

        $query_2 = $this->db->query("SELECT cmir.incident_id_pk, cmir.reporting_id, cmir.incident_date, cmir.cp_two_age AS age, cpt.sl_no AS cp_id, cpt.cp_two_gender AS gender, cpt.cp_two_name AS name, cpt.cp_two_ward_gp, cpt.cp_two_block AS cp_two_block_id FROM cm_incident_report AS cmir LEFT JOIN cm_incident_report_contracting_party_two AS cpt ON cmir.incident_id_pk = cpt.incident_id_fk WHERE cmir.follow_up_visit_status = '102' AND cpt.cp_two_district = $district AND cpt.cp_two_block = $block")->result();
        $age = ($query)?$query[0]->age:0;
        
        if($age < 18){
            return $query;
        }else{
            return $query_2;
        }
    }
}
?>
