<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Age_wise_minor_involved_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function age_wise_minor_involved_details_district_count($from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name, 

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
  
            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district =  lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."'
            group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($this->session->userdata('district') != ''){
                $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name, 

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
      
      
                from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district =  lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.district = '".$this->session->userdata('district')."'
                group by cmir.district, lmd.district_id_pk, lmd.district_name
                order by lmd.district_name asc");
            }elseif($this->session->userdata('district') == ''){
                $query = $this->db->query("select * from
                (select district_id_pk, district_name from rp_location_master_district) as c
                left join
                (select 
                cmir.district,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
      
      
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.district) as b
                on c.district_id_pk=b.district
                order by district_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name, 

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
  
            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district =  lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name, 

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
  
            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district =  lmd.district_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."')
            group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
        }
       
       // print_r($this->db->last_query());die;
       return $query->result_array();
    }

    public function get_sd_block_count_details($district_id, $from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name, 

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
            from cm_incident_report as cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."'
            group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
            from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name, 

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
            from cm_incident_report as cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') 
            group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
           

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
  
            from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.block) as b
            on c.block_id_pk=b.block
            order by block_name asc");
        }
       // print_r($this->db->last_query());die;
       return $query->result_array();
    }

    public function get_ward_gp_count_details($block_id, $from_date, $to_date)
    {   
        $Block_Details_Query = $this->db->select('rural_urban')
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

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
               from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
               on c.gp_id_pk = b.ward_gp
               order by ward_gp_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($Block_Details_Query->rural_urban == 'U'){
                $query = $this->db->query("select * from
                (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
                $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
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

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

            SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
            
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

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
                from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
                $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

               SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_under_12,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 12 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 12 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_under_12,
               

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_12_13,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 13 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 12 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 13 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_12_13,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_13_14,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 14 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 13 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 14 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_13_14,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_14_15,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 15 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 14 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 15 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_14_15,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_15_16,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 16 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 15 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 16 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_15_16,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_16_17,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 17 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 16 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 17 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_16_17,


                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 1 THEN 1 ELSE 0 END) AS male_count_17_18,

                SUM(CASE WHEN NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_one_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_one_age, '') AS INTEGER) < 18 AND ircpo.cp_one_gender = 2 THEN 1 ELSE 0 END) + SUM(CASE WHEN NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) >= 17 AND NULLIF(cmir.cp_two_age, '') ~ '^[0-9]+$' AND CAST(NULLIF(cmir.cp_two_age, '') AS INTEGER) < 18 AND ircpt.cp_two_gender = 2 THEN 1 ELSE 0 END) AS female_count_17_18
                
               from cm_incident_report as cmir left join cm_incident_report_contracting_party_one as ircpo on cmir.incident_id_pk = ircpo.incident_id_fk left join cm_incident_report_contracting_party_two as ircpt on cmir.incident_id_pk = ircpt.incident_id_fk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
               on c.gp_id_pk = b.ward_gp
               order by ward_gp_name asc");
            }
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
