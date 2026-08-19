<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Child_welfare_committee_proceedings_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function cwc_proceedings_list_details()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $query = $this->db->query("SELECT cpocwcd.sl_no, cpocwcd.minor_details, cpocwcd.minor_sent, cpocwcd.case_no,cpocwcd.case_date, cpocwcd.state, cpocwcd.remarks, district_location_master_description(cpocwcd.district) AS district_name, block_location_master_description(cpocwcd.block) AS block_name, cci_details_master_description(cpocwcd.cci_details) AS cci_name, cmir.reporting_id FROM cm_incident_report_cp_one_cwc_details AS cpocwcd LEFT JOIN cm_incident_report AS cmir ON cpocwcd.incident_id_fk = cmir.incident_id_pk WHERE cpocwcd.stake_holder_id_fk = $stake_holder_id_fk AND cpocwcd.minor_sent = 4 ORDER BY cpocwcd.sl_no DESC")->result();
       
        $query_2 = $this->db->query("SELECT cptcwcd.sl_no, cptcwcd.minor_details, cptcwcd.minor_sent, cptcwcd.case_no,cptcwcd.case_date, cptcwcd.state, cptcwcd.remarks, district_location_master_description(cptcwcd.district) AS district_name, block_location_master_description(cptcwcd.block) AS block_name, cci_details_master_description(cptcwcd.cci_details) AS cci_name, cmir.reporting_id FROM cm_incident_report_cp_two_cwc_details AS cptcwcd LEFT JOIN cm_incident_report AS cmir ON cptcwcd.incident_id_fk = cmir.incident_id_pk WHERE cptcwcd.stake_holder_id_fk = $stake_holder_id_fk AND cptcwcd.minor_sent = 4 ORDER BY cptcwcd.sl_no DESC")->result();
        $array = array_merge($query, $query_2); 
        // print_r($this->db->last_query());die;
        return $array;
    }

    public function cwc_proceedings_edit_details($cwc_proceedings_id, $minor_details)
    {
        if($minor_details == 1){
            $query = $this->db->select('cpocwcd.sl_no, cpocwcd.incident_id_fk, cpocwcd.minor_details, cpocwcd.minor_sent, cpocwcd.case_no,cpocwcd.case_date, cpocwcd.state, cpocwcd.remarks, cpocwcd.district, cpocwcd.block, cpocwcd.cci_details')
            ->from('cm_incident_report_cp_one_cwc_details AS cpocwcd')
            ->where('cpocwcd.sl_no' , $cwc_proceedings_id)
            ->get()->row();
        }else{
            $query = $this->db->select('cpocwcd.sl_no, cpocwcd.incident_id_fk, cpocwcd.minor_details, cpocwcd.minor_sent, cpocwcd.case_no,cpocwcd.case_date, cpocwcd.state, cpocwcd.remarks, cpocwcd.district, cpocwcd.block, cpocwcd.cci_details')
            ->from('cm_incident_report_cp_one_cwc_details AS cpocwcd')
            ->where('cpocwcd.sl_no' , $cwc_proceedings_id)
            ->get()->row();
        }
        return $query;
    }

    public function update_cwc_proceedings_details($cwc_proceedings_id, $minor_details)
    {
        $upload_cwc_proceedings_details = array(
            'minor_details' => $this->input->post('minor_details'),
            'minor_sent' => $this->input->post('minor_sent'),
            'case_no' => $this->input->post('case_no'),
            'case_date' => $this->us_date_format($this->input->post('case_date')),
            'district' => $this->input->post('district'),
            'block' => $this->input->post('block'),
            'cci_details' => $this->input->post('cci_details'),
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        if($minor_details == 1){
            $this->db->where('sl_no', $cwc_proceedings_id)->update('cm_incident_report_cp_one_cwc_details', $upload_cwc_proceedings_details);
        }else{
            $this->db->where('sl_no', $cwc_proceedings_id)->update('cm_incident_report_cp_two_cwc_details', $upload_cwc_proceedings_details);
        }
    }

    public function cp_one_gender_value($incident_id)
    {
        $query = $this->db->select('cpone.cp_one_gender')
            ->from('cm_incident_report_contracting_party_one AS cpone')
            ->where('cpone.incident_id_fk' , $incident_id)
            ->get()->row();
        return $query->cp_one_gender;
    }

    public function cp_two_gender_value($incident_id)
    {
        $query = $this->db->select('cptwo.cp_two_gender')
            ->from('cm_incident_report_contracting_party_two AS cptwo')
            ->where('cptwo.incident_id_fk', $incident_id)
            ->get()->row();
        return $query->cp_two_gender;
    }

    public function cp_cci_value($district_value, $cp_gender)
    {
        if($cp_gender == '1'){
          $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (boys_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $district_value");
        }elseif($cp_gender == '2'){
          $query = $this->db->query("SELECT sl_no, cci_name FROM cm_cci_details WHERE (girls_status = '1' OR both_status = '1') AND active_status = 1 AND district_id_fk = $district_value");
        }
        return $query->result_array(); 
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
