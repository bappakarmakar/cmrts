<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class CM_report_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
      $this->mis=$this->load->database('mis', TRUE);
    }
    public function cm_report($from_date, $to_date)
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        // echo  $block.$subdiv;die;

        if(($stake_id_fk == '4') || ($stake_id_fk == '2')){
            if($block!='')
            {
                $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                    (
                        (cmir.district = '".$district."' AND cmir.block = '".$block."') 

                        OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block = '".$block."')
                        
                        OR (cp_address.district = '".$district."' and cp_address.block = '".$block."')

                        OR (cmir.district = '".$district."' AND cmir.block = '".$block."' AND cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                    ) GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";
            }
            else
            {
                $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cmircpo.cp_district = '".$district."')
                ) GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";



            }
        }elseif($stake_id_fk == '3'){
            $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."') 

                    OR (cmircpo.cp_district = '".$district."')
                    
                    OR (cp_address.district = '".$district."')

                    OR (cmir.district = '".$district."' AND cmir.stake_holder_id_fk = '".$stake_holder_id_fk."')
                ) GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($district != ''){
                $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."') 
                    OR (cmircpo.cp_district = '".$district."')
                ) GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";
            }elseif($district == ''){
                $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null  GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";
            }
        }elseif($this->session->userdata('stake_id_fk') == '6'){
            $master_where = "WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '".$district."' AND cmir.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cmircpo.cp_district = '".$district."' and cmircpo.cp_block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cp_address.district = '".$district."' and cp_address.block in (select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."'))
                    OR (cmircpo.cp_district = '".$district."')
                ) GROUP BY cmir.incident_id_pk ORDER BY cmir.incident_id_pk  ";
        }
        $query_sql = "select inc.district, lmd.district_id_pk, lmd.district_name,
        count(case when inc.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented, 
        count(case when inc.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented, 
        count(case when inc.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented, 
        count(case when inc.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented, 
        count(case when inc.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented, 
        count(case when inc.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented, 

        sum(case when cp1.cp_gender = 1 and nullif(cp1.cp_age, '') ~ '^[0-9]+$' and cast(nullif(cp1.cp_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 1 and nullif(cp2.cp_gender, '') ~ '^[0-9]+$' and cast(nullif(cp2.cp_gender, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

        sum(case when cp1.cp_gender = 2 and nullif(cp1.cp_age, '') ~ '^[0-9]+$' and cast(nullif(cp1.cp_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 2 and nullif(cp2.cp_gender, '') ~ '^[0-9]+$' and cast(nullif(cp2.cp_gender, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18

        sum(case when cp1.cp_gender = 2 and nullif(cp1.cp_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18

        FROM cm_incident_report inc
        LEFT JOIN rp_location_master_district AS lmd ON inc.district = lmd.district_id_pk
        LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1
        LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2
        WHERE incident_id_pk IN (
            SELECT cmir.incident_id_pk
            FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            LEFT JOIN cm_incident_report_cp_address_details AS cp_address ON cmircpo.cp_id_pk = cp_address.cp_id_fk
            $master_where
        )
        GROUP BY inc.district, lmd.district_id_pk, lmd.district_name
        ORDER BY lmd.district_name ASC;
        ";
    $query = $this->mis->query($query_sql);
    // print_r($query_sql);die;
    return $query->result_array();   
    }

    

    public function get_sd_block_count_details($district_id, $from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        // echo $this->session->userdata('stake_id_fk');die();
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name,

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

            sum(case when cp1.cp_gender = 1 and nullif(cp1.cp_age, '') ~ '^[0-9]+$' and cast(nullif(cp1.cp_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 1 and nullif(cp2.cp_gender, '') ~ '^[0-9]+$' and cast(nullif(cp2.cp_gender, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when cp1.cp_gender = 2 and nullif(cp1.cp_age, '') ~ '^[0-9]+$' and cast(nullif(cp1.cp_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 2 and nullif(cp2.cp_gender, '') ~ '^[0-9]+$' and cast(nullif(cp2.cp_gender, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18,
















            from cm_incident_report AS cmir 
            left join rp_location_master_block as lmb 
            on cmir.block =  lmb.block_id_pk  

            LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON cmir.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1

            LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON cmir.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2 


            where cmir.incident_date between '".$from_date."' and '".$to_date."' 
            and cmir.delete_status = '0' and cmir.created_at is not null
            and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc
            ");
        }
        elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("select * from 
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' and subdiv_id_fk = '".$this->session->userdata('subdiv')."' and rural_urban = 'U') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir 
            left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc
            ");
        }
        elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,    

            sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

            sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18


            from cm_incident_report AS cmir 
            left join cm_incident_report_contracting_party_one as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc
            ");
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name,

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,   

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

    public function get_ward_gp_count_details1($block_id, $from_date, $to_date)
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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

                sum(case when ircpo.cp_one_gender = 1 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 1 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18,

                sum(case when ircpo.cp_one_gender = 2 and nullif(cmir.cp_one_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_one_age, '') AS integer) < 18 then 1 else 0 end) + sum(case when ircpt.cp_two_gender = 2 and nullif(cmir.cp_two_age, '') ~ '^[0-9]+$' and cast(nullif(cmir.cp_two_age, '') AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir 
                left join cm_incident_report_contracting_party_one as ircpo 
                on cmir.incident_id_pk = ircpo.incident_id_fk 
                left join cm_incident_report_contracting_party_two as ircpt 
                on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,    

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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,    

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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

                sum(case when cp1.cp_gender = 1 and cast(cp1.cp_age AS integer) < 18 then 1 else 0 end)
                 + 
                sum(case when cp2.cp_gender = 1 and cast(cp2.cp_age AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18, 

                sum(case when cp1.cp_gender = 2 and cast(cp1.cp_age AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 2 and cast(cp2.cp_age AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir 
                LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1
                LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2



                where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,    

                sum(case when cp1.cp_gender = 1 and cast(cp1.cp_age AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 1 and cast(cp2.cp_age AS integer) < 18 then 1 else 0 end) AS total_male_count_under_18, 

                sum(case when cp1.cp_gender = 2 and cast(cp1.cp_age AS integer) < 18 then 1 else 0 end) + sum(case when cp2.cp_gender = 2 and cast(cp2.cp_age AS integer) < 18 then 1 else 0 end) AS total_female_count_under_18
                
                from cm_incident_report as cmir 
                LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON cmir.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1
                LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON cmir.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2 


                where cmir.block = ".$block_id." 
                and cmir.incident_date between '".$from_date."' 
                and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

            count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
            count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
            
            count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
            count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

            count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
            count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,    

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
                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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

                count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented,
                
                count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented,
                count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented,

                count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented,     
                count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,     

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
