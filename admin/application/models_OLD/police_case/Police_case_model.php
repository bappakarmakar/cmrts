<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Police_case_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function police_case_exist($incident_id, $reporting_id, $cp_id){
     
        $this->db->select('*');
        $this->db->from('cm_police_case_register');
        $this->db->where('incident_id_fk', $incident_id);
        // $this->db->where('reporting_id', $reporting_id);
        $this->db->where('cp_id_fk', $cp_id);
        $this->db->where('current_status !=', 22);
        $query_data = $this->db->get();
        // echo $this->db->last_query();die;
        return $query_data;
    } 
 
    public function police_case_registers(){

        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk        = $this->session->userdata('stake_id_fk');
        $district           = $this->session->userdata('district');
        $block              = $this->session->userdata('block');
        $subdiv             = $this->session->userdata('subdiv');

        // print_r($this->session->userdata());

        if($stake_id_fk =='1' || $stake_id_fk =='5'){  // SNO login and MIS
            $attach_query = "AND pcr.current_status IN(22)";
        }
        else if($stake_id_fk =='2'){ // BDO
            $attach_query = "AND 
            (
                (pcr.fir_district = '".$district."' AND pcr.fir_block_municipality = '".$block."' AND pcr.current_status IN(21,22,23))
            )";
        }
        else if($stake_id_fk =='3'){ // CMPO
            $attach_query = "AND
            (
                (pcr.fir_district = '".$district."' AND pcr.created_by_stake_holder_id !='".$stake_holder_id_fk."' AND pcr.current_status IN(21,22,23) )
                OR (pcr.fir_district = '".$district."' AND pcr.created_by_stake_holder_id='".$stake_holder_id_fk."' AND pcr.current_status IN(19,20,22) )
            )";
        }
        else if($stake_id_fk =='4'){ // DEO
            $attach_query = "AND 
            (
                (pcr.fir_district = '".$district."' AND pcr.fir_block_municipality = '".$block."' AND pcr.current_status IN(19,20,21,22,23)) 
            )";
        }
        else if($stake_id_fk =='6'){ // SDO
            $attach_query = "AND
            (
                (pcr.fir_district ='".$district."' AND pcr.fir_block_municipality in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."') AND pcr.current_status IN(21,22,23))
            )";
        }

        $query = $this->db->query("SELECT pcr.*, dm.district_name, bm.block_name, 
            --pd.police_district_name, 
            ps.police_station_name, cp.cp_name, cp.cp_gender, sm.description AS status, shl.login_id
            FROM cm_police_case_register pcr
            JOIN rp_location_master_district dm ON dm.district_id_pk = pcr.fir_district
            LEFT JOIN rp_location_master_block bm ON bm.block_id_pk = pcr.fir_block_municipality
            --JOIN cm_police_district_master pd ON pd.police_district_id_pk::integer = pcr.police_district
            LEFT JOIN cm_police_station_master ps ON ps.police_station_id_pk = pcr.police_station
            LEFT JOIN cm_incident_report_contracting_parties cp ON cp.cp_id_pk::varchar=pcr.cp_id_fk AND cp.incident_id_fk::varchar=pcr.incident_id_fk
            LEFT JOIN cm_cp_status_master sm ON sm.status_code=pcr.current_status 
            LEFT JOIN cm_stake_holder_login shl ON shl.stake_holder_login_id_pk = pcr.created_by_stake_holder_id
            WHERE pcr.current_status!='24' $attach_query ORDER BY pcr.police_case_id_pk DESC")->result();
        // echo $this->db->last_query();die;
        return $query;
    }

    public function get_pcma_section($police_case_id_pk, $incident_id_fk){
        $query = $this->db->query("SELECT pcm.* FROM cm_police_case_pcma_section pcm 
            JOIN cm_police_case_register r ON r.police_case_id_pk = pcm.police_case_id_fk
            WHERE pcm.police_case_id_fk='".$police_case_id_pk."' AND pcm.incident_id_fk ='".$incident_id_fk."' ")->result_array();
        return $query;
    }

    public function get_police_district_data($district_id){
        $query = $this->db->query("SELECT * FROM cm_police_district_master WHERE district_id_fk='".$district_id."' AND active_status=1 ORDER BY police_district_id_pk DESC")->result_array();
        // echo $this->db->last_query();die;
        return $query;
    }

    public function get_police_station_data($login_district_id){
        $query = $this->db->query("SELECT * FROM cm_police_station_master WHERE district_id_fk='".$login_district_id."' AND active_status=1 ORDER BY police_station_id_pk DESC")->result_array();
        // echo $this->db->last_query();die;
        return $query;
    }

    //Get Intervention Full Address
    public function get_intervention_address($incident_id){

        $query = $this->db->query("SELECT ir.incident_id_pk, ir.reporting_id, ir.street_landmark, ir.state, ir.district, ir.block, bm.rural_urban, ir.ward_gp, dm.district_name, bm.block_name, ir.pin_code, ir.police_station,
            CASE 
                WHEN bm.rural_urban = 'U' THEN CONCAT('Ward', CAST(wm.ward_no AS VARCHAR))
                WHEN bm.rural_urban = 'R' THEN gm.gp_name
            END AS ward_gp_name
            FROM cm_incident_report ir
            JOIN rp_location_master_district dm ON dm.district_id_pk=ir.district
            JOIN rp_location_master_block bm ON bm.block_id_pk=ir.block
            LEFT JOIN cm_ward_master wm ON wm.ward_id_pk = ir.ward_gp AND bm.rural_urban = 'U'
            LEFT JOIN cm_gp_master gm ON gm.gp_id_pk = ir.ward_gp AND bm.rural_urban = 'R'
            WHERE ir.incident_id_pk='".$incident_id."' ")->result_array();
        // echo $this->db->last_query();die;
        return $query;
    }

    // Get CP full Address
    public function cp_address($incident_id, $incident_date){

        $query = $this->db->query("SELECT * FROM cm_incident_report_contracting_parties WHERE incident_id_fk='".$incident_id."' ORDER BY cp_id_pk ASC ")->result_array();
        // echo $this->db->last_query();die;

        $all_cp_data = [];
        foreach ($query as $value) {   
            if(isset($value['cp_type']) && !empty($value['cp_type'])){
                //echo "</br> 1--".$value['cp_type'].'</br>';

                $cp_data = $this->db->query("SELECT cp.incident_id_fk, cp.reporting_id, cp.cp_name, cp.cp_type, cp.cp_dob, cp.cp_gender, g.description AS gender, cp.cp_street_landmark, cp.cp_state, cp.cp_pin_code, cp.cp_police_station,
                CASE
                    WHEN cp.cp_state = 1 THEN dm.district_name
                    WHEN cp.cp_state = 2 THEN NULL
                END AS district_name, 
                CASE 
                    WHEN cp.cp_state = 1 THEN bm.block_name
                    ELSE NULL
                END AS block_name, 
                CASE 
                    WHEN cp.cp_state = 2 THEN cp.cp_address
                    ELSE NULL 
                END AS cp_address,
                CASE 
                    WHEN cp.cp_state = 1 AND bm.rural_urban = 'U' THEN CONCAT('Ward', CAST(wm.ward_no AS VARCHAR))
                    WHEN cp.cp_state = 1 AND bm.rural_urban = 'R' THEN gm.gp_name
                END AS ward_gp_name,

                EXTRACT(YEAR FROM AGE('".$incident_date."', cp.cp_dob)) AS age_years,
                EXTRACT(MONTH FROM AGE('".$incident_date."', cp.cp_dob)) AS age_months,
                EXTRACT(DAY FROM AGE('".$incident_date."', cp.cp_dob)) AS age_days
                
                FROM cm_incident_report_contracting_parties cp
                LEFT JOIN rp_location_master_district dm ON dm.district_id_pk=cp.cp_district AND cp.cp_state = 1
                LEFT JOIN rp_location_master_block bm ON bm.block_id_pk=cp.cp_block AND cp.cp_state = 1
                LEFT JOIN cm_ward_master wm ON wm.ward_id_pk = cp.cp_ward_gp AND bm.rural_urban = 'U' AND cp.cp_state = 1
                LEFT JOIN cm_gp_master gm ON gm.gp_id_pk = cp.cp_ward_gp AND bm.rural_urban = 'R' AND cp.cp_state = 1
                JOIN cm_gender_master g ON g.cm_gender_master_id_pk = cp.cp_gender
                WHERE cp.incident_id_fk='".$incident_id."' AND cp.cp_type ='".$value['cp_type']."' ORDER BY cp.cp_id_pk ")->result_array();
            }
            //echo $this->db->last_query();
            // echo "<pre>";print_r($cp_data);die;
            $all_cp_data = array_merge($all_cp_data, $cp_data);
        }
        // echo "<pre>";print_r($all_cp_data);
        return $all_cp_data;
    }

    public function police_station(){
       // echo "<pre>";print_r($_SESSION);
       $login_district = $_SESSION['district'];
       $query = $this->db->query("SELECT * FROM cm_police_station_master WHERE district_id_fk='".$login_district."' AND active_status=1 ORDER BY police_station_id_pk ASC")->result_array();
       return $query;
    }
    //-----------------------------------------------------------------------------

    public function cm_police_case_reason(){
        $query = $this->db->select('sl_no,description')
            ->from('cm_police_case_reason_master')
            ->where('status', 1)
            ->order_by('sl_no','desc')
            ->get()->result();
            // echo $this->db->last_query();die;
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
