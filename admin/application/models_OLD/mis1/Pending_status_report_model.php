<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Pending_status_report_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function pending_status_report_get_district($from_date, $to_date)
    {
        $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
        if($this->session->userdata('stake_id_fk') == '4'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
        }
        elseif($this->session->userdata('stake_id_fk') == '6'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk 

                left join cm_stake_holder_login as cmlog ON cmlog.stake_holder_login_id_pk = cmir.stake_holder_id_fk

            where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmlog.subdiv = '".$this->session->userdata('subdiv')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
           // print_r($this->db->last_query());die;
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            if($this->session->userdata('district') != ''){
                $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.district = '".$this->session->userdata('district')."' group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
            }elseif($this->session->userdata('district') == ''){
                $query = $this->db->query("select * from
            (select district_id_pk, district_name from rp_location_master_district) as c
            left join
            (select 
            cmir.district,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.district) as b
            on c.district_id_pk=b.district
            order by district_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
            order by lmd.district_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select cmir.district, lmd.district_id_pk, lmd.district_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count

            from cm_incident_report as cmir left join rp_location_master_district as lmd on cmir.district = lmd.district_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.district, lmd.district_id_pk, lmd.district_name
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

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
            
            from cm_incident_report as cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and  cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
               order by lmb.block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
            
            from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and  cmir.incident_draft_status = '2' group by cmir.block) as b
               on c.block_id_pk=b.block
               order by block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
            
            from cm_incident_report as cmir left join rp_location_master_block as lmb on cmir.block =  lmb.block_id_pk left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and  cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.district, cmir.block, lmb.block_id_pk, lmb.block_name
            order by lmb.block_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            $query = $this->db->query("select * from
            (select district_id_fk, block_id_pk, block_name from rp_location_master_block where district_id_fk = '".$district_id."') as c
            left join
            (select 
            cmir.block,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
            
            from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.district = ".$district_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and  cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.block) as b
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

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                

                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
                $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                
                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' group by cmir.ward_gp) as b
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

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                

                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                
                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' group by cmir.ward_gp) as b
                on c.gp_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }
        }elseif($this->session->userdata('stake_id_fk') == '2'){
            $query = $this->db->query("select * from
            (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
            left join
            (select 
            cmir.ward_gp,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

            count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

            count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

            count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

            count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
            
            from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or (cmir.district = '".$this->session->userdata('district')."' and cmir.block = '".$this->session->userdata('block')."') group by cmir.ward_gp) as b
            on c.gp_id_pk = b.ward_gp
            order by ward_gp_name asc");
        }elseif($this->session->userdata('stake_id_fk') == '3'){
            if($Block_Details_Query->rural_urban == 'U'){
                $query = $this->db->query("select * from
                (select ward_id_pk, ward_no as ward_gp_name from cm_ward_master where municipality_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                

                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
                on c.ward_id_pk = b.ward_gp
                order by ward_gp_name asc");
            }else{
               $query = $this->db->query("select * from
                (select gp_id_pk, gp_name as ward_gp_name from cm_gp_master where block_id_fk = '".$block_id."') as c    
                left join
                (select 
                cmir.ward_gp,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 4 and cmir.forward_status is null then 1 end) as deo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 101 then 1 end) as deo_level_not_forwarded_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 4 and CAST(cmir.forward_status AS INTEGER) = 102 then 1 end) as deo_level_forwarded_count,

                count(case when cmir.incident_draft_status = 1 and cmshl.stake_id_fk in(2, 6) and cmir.forward_status is null then 1 end) as bdo_sdo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 101 then 1 end) as bdo_sdo_level_received_deo_not_published_count,

                count(case when cmir.incident_draft_status = 2 and cmshl.stake_id_fk in(2, 6) and cmir.publish_status = 102 then 1 end) as bdo_sdo_level_published_count,

                count(case when cmir.incident_draft_status = 1 and shl.stake_id_fk = 3 and cmir.forward_status is null then 1 end) as cmpo_level_draft_pending_count,

                count(case when cmir.incident_draft_status = 2 and shl.stake_id_fk = 3 and cmir.publish_status = 102 then 1 end) as cmpo_level_published_count
                
                from cm_incident_report as cmir left join cm_stake_holder_login as shl on cmir.stake_holder_id_fk = shl.stake_holder_login_id_pk left join cm_incident_report_forward_tracks_details as irftd on cmir.incident_id_pk = irftd.incident_id_fk left join cm_stake_holder_login as cmshl on irftd.bdo_sdo_stake_id_fk = cmshl.stake_holder_login_id_pk where cmir.block = ".$block_id." and cmir.incident_date between '".$from_date."' and '".$to_date."' and cmir.incident_draft_status = '2' and (cmir.stake_holder_id_fk = '".$stake_holder_id_fk."' or cmir.district = '".$this->session->userdata('district')."') group by cmir.ward_gp) as b
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
