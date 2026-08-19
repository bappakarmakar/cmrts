<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }
    public function home_visits_list_details_bak()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        //echo $stake_holder_id_fk;die();
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            home.mode_of_enquiry,home.gender as home_gender,home.family_income,home.nutritious_meals,home.neighbours_community,home.emergencies,
            home.sl_no as home_sl_no,home.disability,home.disability_certificate,home.type_of_disability,home.disability_percent,home.estimated_severity,home.education,home.kishori_group,home.paid_work,home.education_frequency,home.kishori_group_frequency,home.paid_work_frequency,home.kanyashree_id,home.parents_supported,home.family_elders_supported,home.peers_supported,home.neighbours_supported,home.others_supported,home.minor_pregnant,home.stage_of_pregnancy,home.remarks,cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,cp1.cp_district AS cp_1_district_id,
            district_location_master_description(cp1.cp_district) AS cp_1_district,
            block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
            cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
            gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
            cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
            cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
            cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
            cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
            cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
            cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
            cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address

            from cm_incident_report inc join cm_incident_report_home_visit AS home ON inc.incident_id_pk = home.incident_id_fk join cm_incident_report_contracting_parties AS cp1 ON home.cp_id_fk=cp1.cp_id_pk where home.entry_by=$stake_holder_id_fk order by home.sl_no DESC ")->result();
        return $query;
        //return array();
    }
    public function home_enquiry_visits_list_details_bak()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.entry_by = $stake_holder_id_fk ORDER BY A.cp_id_fk")->result();
        return $query;
    }

    public function home_enquiry_visits_list_details()
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        

        if($this->session->userdata('stake_id_fk')==4)
        {
            
            $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.entry_by = $stake_holder_id_fk ORDER BY A.cp_id_fk")->result();
            return $query;
        }
        else if($this->session->userdata('stake_id_fk')==2)
        {
            
            $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(2,3) AND B.cp_block = $block  ORDER BY A.cp_id_fk")->result();

            // print_r($this->db->last_query());die;
            return $query;
        }
        else if($this->session->userdata('stake_id_fk')== 5 || $this->session->userdata('stake_id_fk')== 1|| $this->session->userdata('stake_id_fk')== 3 )
        {
            if($district != '')
            {
                $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(3) AND B.cp_district = $district  ORDER BY A.cp_id_fk")->result();

                // print_r($this->db->last_query());die;
                return $query;
            }
            else
            {
                $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(3) ORDER BY A.cp_id_fk")->result();
                // print_r($this->db->last_query());die;
                return $query;
            }
        }else if($this->session->userdata('stake_id_fk')==6){
            $subdiv = $this->session->userdata('subdiv');
            $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender,B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk LEFT JOIN rp_location_master_block AS block on b.cp_block=block.block_id_pk  WHERE A.active_status=1 AND A.hv_status in(2,3) AND block.subdiv_id_fk = $subdiv AND rural_urban='U'  ORDER BY A.cp_id_fk")->result();
            return $query;

        }else{
            return array();
        }


    }


    public function home_enquiry_visits_list_details_by_date($start_date,$end_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');

        if($this->session->userdata('stake_id_fk')==4)
        {
            
            $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.entry_by = $stake_holder_id_fk AND G.incident_date BETWEEN '$start_date' AND '$end_date' AND A.entry_by = $stake_holder_id_fk  ORDER BY A.cp_id_fk")->result();
            return $query;
        }
        else if($this->session->userdata('stake_id_fk')==2)
        {
            
            $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(2,3) AND B.cp_block = $block AND G.incident_date BETWEEN '$start_date' AND '$end_date'  ORDER BY A.cp_id_fk")->result();

            // print_r($this->db->last_query());die;
            return $query;
        }
        else if($this->session->userdata('stake_id_fk')== 5 || $this->session->userdata('stake_id_fk')== 1 || $this->session->userdata('stake_id_fk')== 3 )
        {
            if($district != '')
            {
                $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(3) AND B.cp_district = $district AND G.incident_date BETWEEN '$start_date' AND '$end_date'  ORDER BY A.cp_id_fk")->result();

                // print_r($this->db->last_query());die;
                return $query;
        }
            else
            {
                $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND A.hv_status in(3) AND G.incident_date BETWEEN '$start_date' AND '$end_date' ORDER BY A.cp_id_fk")->result();
                // print_r($this->db->last_query());die;
                return $query;
            }
        }
    }
    public function home_enquiry_visits_list_details_by_date1($start_date,$end_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $query = $this->db->query("select A.cp_id_fk,A.hv_status,A.sl_no AS home_visits_sl_no, A.cp_type, A.cp_id_fk, A.incident_id_fk, G.incident_date, G.reporting_id, B.cp_name, B.cp_age, B.cp_gender, B.cp_block, B.cp_ward_gp, F.description as status, H.description as cp_gender_val FROM cm_incident_report_home_visit AS A LEFT JOIN cm_incident_report_contracting_parties AS B ON A.incident_id_fk = B.incident_id_fk AND A.cp_type = B.cp_type LEFT JOIN public.cm_homevisit_status_master AS F ON A.hv_status = F.code LEFT JOIN public.cm_incident_report AS G ON A.incident_id_fk = G.incident_id_pk LEFT JOIN public.cm_gender_master AS H ON B.cp_gender =H.cm_gender_master_id_pk WHERE A.active_status=1 AND G.incident_date BETWEEN '$start_date' AND '$end_date' AND A.entry_by = $stake_holder_id_fk ORDER BY A.cp_id_fk")->result();
        return $query;
    }


    


    public function publish_homevisit_details($data = array(),$where=array())
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('cm_incident_report_home_visit');
        return $this->db->affected_rows();
    }


    public function get_homwvisit_list_dtls($data=array())
    {
        //echo "<pre>";print_r($data);die; 

        $this->db->from('cm_incident_report_home_visit AS A', 'left');
        if(!empty($data['party_details']))
        {
            $this->db->join('cm_incident_report_contracting_parties AS B', 'A.incident_id_fk = B.incident_id_fk','left');
        }
        if(!empty($data['login_details']))
        {
            $this->db->join('public.cm_stake_holder_login AS C', 'B.stake_holder_id_fk = C.stake_holder_login_id_pk', 'left');
        }
        if(!empty($data['location_details']))
        {
            $this->db->join('public.rp_location_master_district AS D', 'B.district = D.district_id_pk', 'left');
        }
        if(!empty($data['silbings_details']))
        {
            $this->db->join('public.cm_incident_report_home_visit_siblings_details AS E', 'A.cp_id_fk = E.cp_id_fk', 'left');
        }
        if(!empty($data['hv_status_details']))
        {
            $this->db->join('public.cm_homevisit_status_master AS F', 'A.hv_status = F.code', 'left');
        }
        if(!empty($data['incident_details']))
        {
            $this->db->join('public.cm_incident_report AS G', 'A.incident_id_fk = G.incident_id_pk', 'left');
        }
        if(!empty($data['cp_gender_details']) && !empty($data['party_details']))
        {
            $this->db->join('public.cm_gender_master AS H', 'B.cp_gender = H.cm_gender_master_id_pk', 'left');
        }

        if(!empty($data['mode_of_enquiry_details']))
        {
            $this->db->join('public.cm_mode_of_enquiry_master AS I', 'A.mode_of_enquiry = I.sl_no', 'left');
        }
        if(!empty($data['estimated_severity_details']))
        {
            $this->db->join('public.cm_estimated_severity_master AS J', 'A.estimated_severity = J.sl_no', 'left');
        }



        // if(!empty($data['district']))
        // {
        //     $this->db->where('A.district', $data['district']);
        // }
        // if(!empty($data['block']) || $data['block']!=0)
        // {
        //     $this->db->where('A.block', $data['block']);
        // } 
        // if(!empty($data['subdiv']))
        // {
        //     $this->db->where('B.subdiv', $data['subdiv']);
        // }

        // if(!empty($data['sl_no']))
        // {
        //     $this->db->where('A.sl_no', $data['sl_no']);
        // }
        // if(!empty($data['sl_no']))
        // {
        //     $this->db->where('A.sl_no', $data['sl_no']);
        // }
        // if(!empty($data['cp_id_fk']))
        // {
        //     $this->db->where('A.cp_id_fk', $data['cp_id_fk']);
        // }        
        // if(!empty($data['cp_type']))
        // {
        //     $this->db->where('A.cp_type', $data['cp_type']);
        // }
        // if(!empty($data['incident_id_fk']))
        // {
        //     $this->db->where('A.incident_id_fk', $data['incident_id_fk']);
        // }

        if(!empty($data['entry_by']))
        {
            $this->db->where('A.entry_by', $data['entry_by']);
        }
        // CUSTOM WHERE
        if(isset($data['date_search']))
        {
            // $this->db->distinct();
            $this->db->where($data['date_search']);
        }

        // $this->db->group_start();
        // $this->db->group_start();
        // $this->db->group_end();

        // $this->db->group_end();
        if(!empty($data['selected_fields']))
        {
            $this->db->select($data['selected_fields']);
        }
        else
        {
            $this->db->select('A.*');
        }
        if(!empty($data['order_by']))
        {
            $this->db->order_by($data['order_by']);
        }
        else
        {
            $this->db->order_by('A.cp_id_fk');
        }
        if(!empty($data['group_by']))
        {
            $this->db->group_by($data['group_by']);
        }

        $query = $this->db->get();

        // echo $this->db->get_compiled_select();die;
        //echo $this->db->last_query();die;


        if(isset($data['get']))
        {
            return  $query->row_array();
        }
        else if(isset($data['get_as_obj'])) 
        {
            return  $query->result();
        }
        else
        {
            return  $query->result_array();
        }
        

    }
}
?>
