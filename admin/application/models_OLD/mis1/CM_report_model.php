<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class CM_report_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function cm_report($from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     


            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc
            ");
        }

       
        elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($this->session->userdata('district') != ''){
                $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18

                from cm_incident_report AS cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.district = '".$this->session->userdata('district')."' group by cmir.district, lmd.district_id_pk, lmd.district_name
                order by lmd.district_name asc
                ");
            }elseif($this->session->userdata('district') == ''){
                $query = $this->db->query("select * from
                (select district_id_pk, district_name from rp_location_master_district) as c
                left join
                (select 
                cmir.district,

                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


                from cm_incident_report AS cmir 
                left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.district) as b
                on c.district_id_pk=b.district
                order by district_name asc
                ");
            }
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc
            ");
        }
       // print_r($this->db->last_query());die;
       return $query->result_array();
    }

    public function get_sd_block_count_details($district_id, $from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk  left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir 
            left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("select * from 
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' and subdiv_id_fk = '".$this->session->userdata('subdiv')."' and rural_urban = 'U') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir 
            left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk  left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir 
            left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc
            ");
        }
       // print_r($this->db->last_query());die;
      return $query->result_array();
    }

    public function get_ward_gp_count_details($block_id, $from_date, $to_date)
    {   $Block_Details_Query = $this->db->select('rural_urban')
        ->from('rp_location_master_block')
        ->where('block_id_pk' , $block_id)
        ->get()->row();

        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            if($Block_Details_Query->rural_urban == 'U'){
                $query = $this->db->query("select * from
                (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,
                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.gp_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'|| $this->session->userdata('stake_id_fk') == '6'){
            if($Block_Details_Query->rural_urban == 'U'){
                $query = $this->db->query("select * from
                (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,
                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
                $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.ward_gp) as b
                on c.gp_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select * from
            (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
            left join
            (select 
            cmir.ward_gp,

            count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            
            count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

            count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
            
            from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.ward_gp) as b
            on c.gp_id_pk = b.ward_gp
            order by ward_gp_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            if($Block_Details_Query->rural_urban == 'U'){
                $query = $this->db->query("select * from
                (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,
                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
                $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.marriage_details = 1 then 1 end) as before_marriage_reported,
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                
                count(case when cmir.marriage_details = 2 then 1 end) as during_marriage_reported,
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,

                count(case when cmir.marriage_details = 3 then 1 end) as after_marriage_reported,
                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
                on c.gp_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }
        }
        // print_r($this->db->last_query());die;
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
