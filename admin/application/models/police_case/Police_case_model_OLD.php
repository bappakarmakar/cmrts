<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Police_case_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function cm_police_case_reason(){
        $query = $this->db->select('sl_no,description')
            ->from('cm_police_case_reason_master')
            ->where('status', 1)
            ->order_by('sl_no','desc')
            ->get()->result();

        return $query;

    }

    public function incident_details($incident_id)
    {   
        $query = $this->db->select('cmir.forward_status, cmir.publish_status, cmir.home_visit_minor_status, cmir.home_visit_adult_status,  cmir.follow_up_visit_status')
            ->from('cm_incident_report AS cmir')
            ->where('cmir.incident_id_pk', $incident_id)
            ->get()->row();
        return $query;
    }

    public function police_case_list_details()
    {
        $query = $this->db->select('irpc.sl_no, irpc.incident_id_fk, irpc.gd_no, irpc.gd_date,  irpc.fir_no, irpc.fir_date, irpc.police_station, irpc.state, district_location_master_description(irpc.district) AS district_name, block_location_master_description(irpc.block) AS block_name, irpc,remarks, cmir.reporting_id, irpc.reason')
            ->from('cm_incident_report_police_case AS irpc')
            ->join('cm_incident_report AS cmir', 'irpc.incident_id_fk = cmir.incident_id_pk')
            ->where('irpc.stake_holder_id_fk' , $this->session->userdata('stake_holder_login_id_pk'))
            // ->where('irpc.district' , $this->session->userdata('district'))
            // ->where('irpc.block' , $this->session->userdata('block'))
            ->order_by('irpc.sl_no', 'desc')
            ->get()->result();
            // print_r($this->db->last_query());die;
        return $query;
    }

    public function insert_police_case_details($incident_id,$cp_id,$cp_type)
    {
        $upload_police_case_details = array(
            'incident_id_fk' => $incident_id,
            'cp_id_fk' => $cp_id,
            'cp_type' => $cp_type,
            'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
            'gd_no' => $this->input->post('gd_no'),
            'gd_date' => $this->us_date_format($this->input->post('gd_date')),
            'fir_no' => $this->input->post('fir_no'),
            'fir_date' => $this->us_date_format($this->input->post('fir_date')),
            'police_station' => $this->input->post('police_station'),
            'state' => 19,
            'district' => $this->input->post('pc_district'),
            'block' => $this->input->post('pc_block'),
            'reason' => $this->input->post('reason'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_ip' => $_SERVER['REMOTE_ADDR'],
            'active_status' => 1
        );

        $incident_reporting_details = $this->db->select('cmir.district, cmir.block, cmir.reporting_id, lmb.district_id_fk, lmb.subdiv_id_fk, lmb.rural_urban')
        ->from('cm_incident_report as cmir')
        ->join('rp_location_master_block AS lmb', 'cmir.district = lmb.district_id_fk AND cmir.block = lmb.block_id_pk')
        ->where('incident_id_pk' , $incident_id)
        ->get()->row();
        $reason_name = get_police_cases_reason_name($this->input->post('reason'));
         $message = 'Incident ID:'.$incident_reporting_details->reporting_id.' '.$reason_name;
         $query_2 = $this->db->select('stake_holder_login_id_pk')
            ->from('cm_stake_holder_login')
            ->where('district', $incident_reporting_details->district)
            ->where('stake_id_fk' , 3)
            ->get()->row();

        $receiver_by = ($query_2)?$query_2->stake_holder_login_id_pk:'';
        $page_link = base_url()."admin/reporting/incident/incident_list";

        $uploaded_notification_details = array(
          'sender_by' => $this->session->userdata('stake_holder_login_id_pk'),
          'receiver_by' => $receiver_by,
          'page_link' => $page_link,
          'message' => $message,
          'sending_time' => date('Y-m-d H:i:s'),
          'status' => 0
        );
        $result = $this->db->insert('cm_notification_details', $uploaded_notification_details);
        $result = $this->db->insert('cm_incident_report_police_case', $upload_police_case_details);
    }

    public function police_case_edit_details($sl_no)
    {
        $query = $this->db->select('irpc.sl_no, irpc.incident_id_fk, irpc.gd_no, irpc.gd_date,  irpc.fir_no, irpc.fir_date, irpc.police_station, irpc.state, irpc.district, irpc.block, irpc,remarks, irpc.reason')
            ->from('cm_incident_report_police_case AS irpc')
            ->where('irpc.sl_no', $sl_no)
            ->get()->row();
        return $query;
    }

    public function update_police_case_details($sl_no)
    {
        $upload_police_case_details = array(
            'gd_no' => $this->input->post('gd_no'),
            'gd_date' => $this->us_date_format($this->input->post('gd_date')),
            'fir_no' => $this->input->post('fir_no'),
            'fir_date' => $this->us_date_format($this->input->post('fir_date')),
            'police_station' => $this->input->post('police_station'),
            'state' => 19,
            'district' => $this->input->post('pc_district'),
            'block' => $this->input->post('pc_block'),
            'reason' => $this->input->post('reason'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR']
        );
        $this->db->where('sl_no', $sl_no)->update('cm_incident_report_police_case', $upload_police_case_details);
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
