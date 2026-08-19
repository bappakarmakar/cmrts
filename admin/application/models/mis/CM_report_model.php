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
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $district = $this->session->userdata('district');
        $block = $this->session->userdata('block');
        $subdiv = $this->session->userdata('subdiv');
        if($stake_id_fk == '4'){
            if(empty($subdiv)){
                $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";

                $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and (inc.district ='".$district."' AND inc.block = '".$block."')  group by inc.district order by district_name";

            }else{
                $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";

                $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and (inc.district ='".$district."' AND inc.block in ( select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND rural_urban ='U' )) group by inc.district order by district_name";



            }
            
        }elseif($stake_id_fk == '6'){

            $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";
            $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and (inc.district ='".$district."' AND inc.block in ( select block_id_pk from rp_location_master_block where subdiv_id_fk = '".$subdiv."' AND rural_urban ='U' ))  group by inc.district order by district_name";


        }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){
            if($district != ''){
                $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";
                $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and inc.district ='".$district."'  group by inc.district order by district_name";
            }else{
                $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";
                
                $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 group by inc.district order by district_name";

            }

        }elseif($stake_id_fk == '2'){
            $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";

            $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and (inc.district ='".$district."' AND inc.block = '".$block."')  group by inc.district order by district_name";

        }elseif($stake_id_fk == '3'){
            $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";
            $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and inc.district ='".$district."'  group by inc.district order by district_name";

        }else{
            $master_table ="select inc.district as district,inc.district as district_id_pk,district_location_master_description(inc.district) as district_name, ";
            $table = " from cm_incident_report inc left join cm_incident_report_contracting_parties AS ircpo ON ircpo.incident_id_fk=inc.incident_id_pk AND ircpo.cp_type=1 left join cm_incident_report_contracting_parties AS ircpo2 ON ircpo2.incident_id_fk=inc.incident_id_pk AND ircpo2.cp_type=2 WHERE inc.incident_date between '".$from_date."' and '".$to_date."' and inc.delete_status = '0' and inc.created_at is not null and inc.current_status!=1 and inc.district ='".$district."'  group by inc.district order by district_name";
        }
        $query_sql = "$master_table

                    count(case when inc.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                    count(case when inc.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented, 
                    count(case when inc.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented, 
                    count(case when inc.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented, 
                    count(case when inc.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented, 
                    count(case when inc.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,
                    sum(case when ircpo.cp_gender = 1 AND ircpo.cp_type=1 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) + sum(case when ircpo2.cp_gender = 1 AND ircpo2.cp_type=2 and NULLIF(ircpo2.cp_age, '')::INT < 18 then 1 else 0 end) AS total_male_count_under_18,
                     sum(case when ircpo.cp_gender = 2 AND ircpo.cp_type=1 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) +
                     sum(case when ircpo2.cp_gender = 2 AND ircpo2.cp_type=2 and NULLIF(ircpo2.cp_age, '')::INT < 18 then 1 else 0 end) AS total_female_count_under_18 $table";

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

            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."' AND block_id_pk = '".$block."') as c left join (select cmir.block, ";

            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.district = '".$district_id."' and cmir.incident_date between '".$from_date."' and '".$to_date."' AND cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";


        }elseif($stake_id_fk == '3'){
            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c left join
            (select cmir.block, ";
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";

        }else{
            $master_table = "select * from (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c left join
            (select cmir.block, ";
            $table = " from cm_incident_report AS cmir left join cm_incident_report_contracting_parties as ircpo ON cmir.incident_id_pk = ircpo.incident_id_fk AND ircpo.cp_type = 1 left join cm_incident_report_contracting_parties as ircpt ON cmir.incident_id_pk = ircpt.incident_id_fk AND ircpt.cp_type = 2 where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.delete_status = '0' and cmir.created_at is not null and cmir.current_status!=1 and ( cmir.district = '".$district_id."') group by cmir.block) as b on c.block_id_pk=b.block order by block_name asc";
        }
        $query_sql = "$master_table 
                    count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                    count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented, 
                    count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented, 
                    count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented, 
                    count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented, 
                    count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,
                    sum(case when ircpo.cp_gender = 1 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) + sum(case when ircpt.cp_gender = 1 and NULLIF(ircpt.cp_age, '')::INT < 18 then 1 else 0 end) AS total_male_count_under_18,

                    sum(case when ircpo.cp_gender = 2 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) + sum(case when ircpt.cp_gender = 2 and NULLIF(ircpt.cp_age, '')::INT < 18 then 1 else 0 end) AS total_female_count_under_18

                     $table";
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
        $query_sql = "$master_table count(case when cmir.marriage_details = 1 and prevented_details = 1 then 1 end) as before_marriage_prevented,
                    count(case when cmir.marriage_details = 1 and prevented_details = 2 then 1 end) as before_marriage_not_prevented, 
                    count(case when cmir.marriage_details = 2 and prevented_details = 1 then 1 end) as during_marriage_prevented, 
                    count(case when cmir.marriage_details = 2 and prevented_details = 2 then 1 end) as during_marriage_not_prevented, 
                    count(case when cmir.marriage_details = 3 and prevented_details = 1 then 1 end) as after_marriage_prevented, 
                    count(case when cmir.marriage_details = 3 and prevented_details = 2 then 1 end) as after_marriage_not_prevented,
                    sum(case when ircpo.cp_gender = 1 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) + sum(case when ircpt.cp_gender = 1 and NULLIF(ircpt.cp_age, '')::INT < 18 then 1 else 0 end) AS total_male_count_under_18,

                    sum(case when ircpo.cp_gender = 2 and NULLIF(ircpo.cp_age, '')::INT < 18 then 1 else 0 end) + sum(case when ircpt.cp_gender = 2 and NULLIF(ircpt.cp_age, '')::INT < 18 then 1 else 0 end) AS total_female_count_under_18 $table";
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
