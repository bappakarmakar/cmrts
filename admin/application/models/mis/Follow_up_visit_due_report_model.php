<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Follow_up_visit_due_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->mis = $this->load->database('mis', TRUE);
    }

    public function get_follow_up_overdue_dtls($data = array())
    {
        $this->db->select("COUNT (1) AS total_due");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (
                WHERE schd.calculated_date::DATE = CURRENT_DATE) AS due_today");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 1 AND 7) AS pending_1_7_days");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 8 AND 15) AS pending_8_15_days");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 16 AND 30) AS pending_16_30_days");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 31 AND 60) AS pending_31_60_days");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 61 AND 90) AS pending_61_90_days");
        $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) > 90) AS pending_above_90_days");

        $this->db->from('cm_follow_up_visit_minor_scheduler AS schd');

        $this->db->join('cm_incident_report_contracting_parties AS cp', 'schd.incident_id = cp.incident_id_fk AND cp.cp_type = schd.cp_type', 'left');
        $this->db->join('cm_incident_report as cmir', 'cp.incident_id_fk = cmir.incident_id_pk');


        $this->db->join('rp_location_master_district as district_master', 'cp.cp_district = district_master.district_id_pk', 'left');
        $this->db->join('rp_location_master_block as block_master', 'cp.cp_block = block_master.block_id_pk', 'left');

        $this->db->where('schd.active_status', 0);
        $this->db->where('CAST(schd.fu_names AS INT) !=', 0);
        $this->db->where('CURRENT_DATE >= schd.calculated_date', null, false); // LESS THAN TODAY DATE


        if (!empty($data['is_ward'])) {
            $this->db->join('cm_ward_master AS wmstr', 'cp.cp_ward_gp = wmstr.ward_id_pk ', 'left');
        }
        if (!empty($data['is_gp'])) {
            $this->db->join('cm_gp_master AS gpmstr', 'cp.cp_ward_gp = gpmstr.gp_id_pk ', 'left');
        }


        $this->db->where('cp.cp_district is not null');
        if (!empty($data['district'])) {
            $this->db->where('cp.cp_district', $data['district']);
        }
        if (!empty($data['block'])) {
            if ($data['block'] != 0) {
                $this->db->where('cp.cp_block', $data['block']);
            }
        }

        if (!empty($data['subdiv'])) {
            $subdiv = $data['subdiv'];
            $subquery = "(select block_id_pk from rp_location_master_block where subdiv_id_fk = '$subdiv' AND rural_urban = 'U')";
            $this->db->where("cp.cp_block IN $subquery", null, false);
        }


        if (!empty($data['from_date'])) {
            $this->db->where('cmir.incident_date >=', $data['from_date']);
        }
        if (!empty($data['to_date'])) {
            $this->db->where('cmir.incident_date <=', $data['to_date']);
        }

        if (!empty($data['current_status'])) {
            $this->db->where('cmir.current_status', $data['current_status']);
        }

        if (isset($data['delete_status'])) {
            $this->db->where('cmir.delete_status', $data['delete_status']);
        }

        if (!empty($data['field_selection'])) {
            $this->db->select($data['field_selection']);
        }


        if (!empty($data['order_by'])) {
            $this->db->order_by($data['order_by']);
        } else {
        }
        if (!empty($data['group_by'])) {
            $this->db->group_by($data['group_by']);
        }

        $query = $this->db->get();

        // echo $this->db->last_query();die;

        if (isset($data['get'])) {
            return  $query->row_array();
        } else if (isset($data['get_as_obj'])) {
            return  $query->result();
        } else {
            return  $query->result_array();
        }
    }

    public function get_follow_up_visits_overdue_dtls_by_counts($data = array())
    {
        if ($data['flag'] == 0) { // DUE TODAY 
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE schd.calculated_date::DATE = CURRENT_DATE) AS due_today");
        }
        if ($data['flag'] == 1) { // TOTAL DUE
            $this->db->select("COUNT (1) AS total_due");
        }
        if ($data['flag'] == 2) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 1 AND 7) AS pending_1_7_days");
        }
        if ($data['flag'] == 3) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 8 AND 15) AS pending_8_15_days");
        }
        if ($data['flag'] == 4) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 16 AND 30) AS pending_16_30_days");
        }
        if ($data['flag'] == 5) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 31 AND 60) AS pending_31_60_days");
        }
        if ($data['flag'] == 6) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) BETWEEN 61 AND 90) AS pending_61_90_days");
        }
        if ($data['flag'] == 7) {
            $this->db->select("COUNT(cmir.incident_id_pk) FILTER (WHERE (CURRENT_DATE - schd.calculated_date::DATE) > 90) AS pending_above_90_days");
        }


        $this->db->from('cm_follow_up_visit_minor_scheduler AS schd');

        $this->db->join('cm_incident_report_contracting_parties AS cp', 'schd.incident_id = cp.incident_id_fk AND cp.cp_type = schd.cp_type', 'left');
        $this->db->join('cm_incident_report as cmir', 'cp.incident_id_fk = cmir.incident_id_pk');

        $this->db->join('rp_location_master_district as district_master', 'cp.cp_district = district_master.district_id_pk', 'left');

        $this->db->join('rp_location_master_block as block_master', 'cp.cp_block = block_master.block_id_pk', 'left');

        $this->db->where('schd.active_status', 0);
        $this->db->where('CAST(schd.fu_names AS INT) !=', 0);
        $this->db->where('CURRENT_DATE >= schd.calculated_date', null, false); // LESS THAN TODAY DATE

        // View the intervention details against count column wise using flag
        if ($data['flag'] == 0) { // DUE TODAY
            $this->db->where("schd.calculated_date::DATE = CURRENT_DATE", null, false);
        }
        if ($data['flag'] == 2) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) BETWEEN 1 AND 7");
        }
        if ($data['flag'] == 3) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) BETWEEN 8 AND 15");
        }
        if ($data['flag'] == 4) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) BETWEEN 16 AND 30");
        }
        if ($data['flag'] == 5) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) BETWEEN 31 AND 60");
        }
        if ($data['flag'] == 6) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) BETWEEN 61 AND 90");
        }
        if ($data['flag'] == 7) {
            $this->db->where("CURRENT_DATE - DATE(schd.calculated_date) > 90");
        }


        if (!empty($data['is_ward'])) {
            $this->db->join('cm_ward_master AS wmstr', 'cp.cp_ward_gp = wmstr.ward_id_pk ', 'left');
        }
        if (!empty($data['is_gp'])) {
            $this->db->join('cm_gp_master AS gpmstr', 'cp.cp_ward_gp = gpmstr.gp_id_pk ', 'left');
        }


        if (!empty($data['is_ward']) && $data['is_ward'] == 2) //ward_gp_count_details show
        {
            $this->db->where('wmstr.ward_id_pk', $data['unique_id']);
        }
        if (!empty($data['is_gp']) && $data['is_gp'] == 2) //ward_gp_count_details show
        {
            $this->db->where('gpmstr.gp_id_pk', $data['unique_id']);
        }


        $this->db->where('cp.cp_district is not null');

        if (!empty($data['district'])) {
            $this->db->where('cp.cp_district', $data['district']);
        }
        if (!empty($data['block'])) {
            if ($data['block'] != 0) {
                $this->db->where('cp.cp_block', $data['block']);
            }
        }

        if (!empty($data['subdiv'])) {
            $subdiv = $data['subdiv'];
            $subquery = "(select block_id_pk from rp_location_master_block where subdiv_id_fk = '$subdiv' AND rural_urban = 'U')";
            $this->db->where("cp.cp_block IN $subquery", null, false);
        }


        if (!empty($data['from_date'])) // Incident date from date-to date
        {
            $this->db->where('schd.incident_date >=', $data['from_date']);
        }
        if (!empty($data['to_date'])) {
            $this->db->where('schd.incident_date <=', $data['to_date']);
        }

        if (!empty($data['current_status'])) {
            $this->db->where('cmir.current_status', $data['current_status']);
        }

        if (isset($data['delete_status'])) {
            $this->db->where('cmir.delete_status', $data['delete_status']);
        }


        if (!empty($data['field_selection'])) {
            $this->db->select($data['field_selection']);
        }

        if (!empty($data['order_by'])) {
            $this->db->order_by($data['order_by']);
        } else {
        }
        if (!empty($data['group_by'])) {
            $this->db->group_by($data['group_by']);
        }

        $query = $this->db->get();

        // echo $this->db->last_query();die;

        if (isset($data['get'])) {
            return  $query->row_array();
        } else if (isset($data['get_as_obj'])) {
            return  $query->result();
        } else {
            return  $query->result();
        }
    }
}
