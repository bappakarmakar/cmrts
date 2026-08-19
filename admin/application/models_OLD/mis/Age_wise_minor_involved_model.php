<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Age_wise_minor_involved_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct();
      $this->mis=$this->load->database('mis', TRUE); 
    }

    public function age_wise_minor_involved_details_district_count($from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        if($stake_id_fk == '4'){
            if(empty($subdiv)){
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and (cmir.district ='".$district."' AND cmir.block = '".$block."')  group by cmir.district order by district_name";
            }else{
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and (cmir.district ='".$district."' AND cmir.block in ( select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND rural_urban ='U' )) group by cmir.district order by district_name";
            }
            
        }elseif($stake_id_fk == '6'){
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and (cmir.district ='".$district."' AND cmir.block in ( select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND rural_urban ='U' ))  group by cmir.district order by district_name";
        }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){
            if($district != ''){
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and cmir.district ='".$district."'  group by cmir.district order by district_name";
            }else{
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.district order by district_name";
            }

        }elseif($stake_id_fk == '2'){

            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and (cmir.district ='".$district."' AND cmir.block = '".$block."')  group by cmir.district order by district_name";

        }elseif($stake_id_fk == '3'){

            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and cmir.district ='".$district."'  group by cmir.district order by district_name";

        }else{
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 WHERE cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and cmir.district ='".$district."'  group by cmir.district order by district_name";
        }
        $query_sql = "select cmir.district as district,cmir.district as district_id_pk,district_location_master_description(cmir.district) as district_name, 

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + 
            SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18

         $table";
            $query = $this->mis->query($query_sql);
            //print_r($this->mis->last_query());die;
            return $query->result_array();
    }
    public function get_sd_block_count_details($district_id, $from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        if($stake_id_fk == '4'){
            if(empty($subdiv)){
                $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' AND block_id_pk = '".$block."' ) as c left join (select cmir.block, ";
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";
            }else{
                $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' AND subdiv_id_fk = '".$subdiv."' AND rural_urban ='U') as c left join (select cmir.block, ";
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";
            }
            
        }elseif($stake_id_fk == '6'){
            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' AND subdiv_id_fk = '".$subdiv."' AND rural_urban ='U') as c left join (select cmir.block, ";
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1  group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";
        }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){
            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c left join
            (select cmir.block, ";
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";

        }elseif($stake_id_fk == '2'){

            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' AND block_id_pk = '".$block."') as c left join (select ircpo.cp_block, ";

            $table = " from cm_incident_report as cmir left join cm_incident_report_contracting_parties as ircpo ON  ircpo.incident_id_fk=cmir.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties as ircpo2 ON  ircpo2.incident_id_fk=cmir.incident_id_pk AND ircpo2.cp_type=1 where cmir.district = '".$district_id."' and cmir.incident_date between '".$from_date."' and '".$to_date."' AND cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";

        }elseif($stake_id_fk == '3'){

            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c left join
            (select cmir.block, ";
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";

        }else{
            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c left join (select ircpo.cp_block, ";
            $table = " from cm_incident_report_contracting_parties as ircpo  left join cm_incident_report as cmir ON  ircpo.incident_id_fk=cmir.incident_id_pk where ircpo.cp_district = '".$district_id."' and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by ircpo.cp_block) as b on c.block_id_pk=b.cp_block order by block_name asc";
        }
        $query_sql = "$master_table 
        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + 
            SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18 $table";
            $query = $this->mis->query($query_sql);
            //print_r($this->mis->last_query());die;
            return $query->result_array();
    }
    public function get_ward_gp_count_details($block_id, $from_date, $to_date)
    {
        $Block_Details_Query = $this->db->select('rural_urban')
        ->from('rp_location_master_block')
        ->where('block_id_pk' , $block_id)
        ->get()->row();

        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        if($Block_Details_Query->rural_urban == 'U'){
                $master_table = "select * from (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c left join (select cmir.ward_gp, ";
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.block = '".$block_id."' and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.ward_gp) as b on c.ward_id_pk=b.ward_gp order by ward_gp_name asc";
            }else{
                $master_table = "select * from (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c left join (select cmir.ward_gp, ";
                $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.block = '".$block_id."' and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.ward_gp) as b on c.gp_id_pk=b.ward_gp order by ward_gp_name asc";

            }
        $query_sql = "$master_table 
            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT < 12 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT < 12 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,

        SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 12 AND NULLIF(ircpo.cp_age, '')::INT < 13 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 12 AND NULLIF(ircpt.cp_age, '')::INT < 13 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 13 AND NULLIF(ircpo.cp_age, '')::INT < 14 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 13 AND NULLIF(ircpt.cp_age, '')::INT < 14 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 14 AND NULLIF(ircpo.cp_age, '')::INT < 15 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 14 AND NULLIF(ircpt.cp_age, '')::INT < 15 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 15 AND NULLIF(ircpo.cp_age, '')::INT < 16 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 15 AND NULLIF(ircpt.cp_age, '')::INT < 16 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 16 AND NULLIF(ircpo.cp_age, '')::INT < 17 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 16 AND NULLIF(ircpt.cp_age, '')::INT < 17 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(ircpo.cp_age, '')::INT >= 17 AND NULLIF(ircpo.cp_age, '')::INT < 18 AND ircpo.cp_gender = 2 THEN 1 ELSE 0 END) + 
            SUM(CASE WHEN NULLIF(ircpt.cp_age, '')::INT >= 17 AND NULLIF(ircpt.cp_age, '')::INT < 18 AND ircpt.cp_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
         $table";
            $query = $this->mis->query($query_sql);
            //print_r($this->mis->last_query());die;
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
