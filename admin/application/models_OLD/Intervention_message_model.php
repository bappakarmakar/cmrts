<?php
defined('BASEPATH') OR exit('No direct script access allowed' );


class Intervention_message_model extends CI_Model{

    public function __construct()
    { 
      parent::__construct(); 
    }

    // Intervention District name
    public function district_name($district){

      $district_id = !empty($district) ? $district : null;
      $query = $this->db->select('*')
          ->from('rp_location_master_district')
          ->where('district_id_pk', $district_id)
          ->get()->result_array();

      if (!empty($query)) {
          return $query[0]; // Return the first element
      } else {
          return null; // Or return an empty array, or handle it as needed
      }
    }

    // Intervention Block/Municipality name
    public function block_municipal($district,$block){
      
      $district_id = !empty($district) ? $district : null;
      $block_id    = !empty($block) ? $block : null;
      $query = $this->db->select('*')
          ->from('rp_location_master_block')
          ->where('district_id_fk', $district_id)
          ->where('block_id_pk', $block_id)
          ->get()->result_array();

      if (!empty($query)) {
          return $query[0]; // Return the first element
      } else {
          return null; // Or return an empty array, or handle it as needed
      }
    } 

    // CP1 Gp and Ward name
    public function cp_gp_ward($district,$block,$gp_ward_id){

      $district = !empty($district) ? $district : null;
      $block    = !empty($block) ? $block : null;

      $query = $this->db->select('*')
          ->from('rp_location_master_block')
          ->where('district_id_fk', $district)
          ->where('block_id_pk', $block)
          ->get()->result_array();

      if (!empty($query[0]) && isset($query[0]['rural_urban']) && $query[0]['rural_urban'] === 'R') {

        $gp_ward_query = $this->db->query("SELECT * FROM cm_gp_master WHERE gp_id_pk= '".$gp_ward_id."' AND district_id_fk = '".$district."' ")->result_array();

      }elseif (!empty($query[0]) && isset($query[0]['rural_urban']) && $query[0]['rural_urban'] !== 'R') {

        $gp_ward_query = $this->db->query("SELECT * FROM cm_ward_master WHERE ward_id_pk= '".$gp_ward_id."' AND district_id_fk = '".$district."' ")->result_array();

      }else {
          // Handle case where $query[0]['rural_urban'] is null or $query[0] is not set
          $gp_ward_query = [];
      }

      $cp_gp_ward_data = array(
          "block_location_data" => !empty($query[0]) ? $query[0] : null,
          "gp_ward_query" => !empty($gp_ward_query) ? $gp_ward_query[0] : null,
      );
      return $cp_gp_ward_data;
    }

    public function get_incident_details($incident_id){

      $query = $this->db->query("SELECT incident_id_pk, reporting_id, TO_CHAR(incident_date, 'DD-MM-YYYY') AS incident_date, ward_gp, state, district, block from cm_incident_report WHERE incident_id_pk = '".$incident_id."' ")->result_array();
      return $query;
    }

    public function cp1_data($incident_id){
      $query = $this->db->query("SELECT cp_id_pk, reporting_id, incident_id_fk, cp_type, cp_name, cp_state, cp_district, cp_block, cp_ward_gp, cp_gender, cp_age FROM cm_incident_report_contracting_parties WHERE cp_type=1 AND incident_id_fk='".$incident_id."' ")->result_array();
      return $query;
    }

    public function cp2_data($incident_id){
      $query = $this->db->query("SELECT cp_id_pk, reporting_id, incident_id_fk, cp_type, cp_name, cp_state, cp_district, cp_block, cp_ward_gp, cp_gender, cp_age FROM cm_incident_report_contracting_parties WHERE cp_type=2 AND incident_id_fk='".$incident_id."' ")->result_array();
      return $query;
    }

    public function Incident_Sdo_Bdo_Deo_details($incident_id){

      $incident_query = $this->db->select('ir.district, ir.block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report as ir')
            ->join('rp_location_master_block as lmb', 'ir.district = lmb.district_id_fk AND ir.block = lmb.block_id_pk')
            ->where('ir.incident_id_pk' , $incident_id)
            ->get()->row();

      //print_r($incident_query);
      if($incident_query->rural_urban == 'U'){
            $sdo_bdo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $incident_query->district_id_fk)
                ->where('shl.subdiv', $incident_query->subdiv_id_fk)
                ->where('shl.stake_holder_details' , 'SDO')
                ->get()->row();
        }else{
            $sdo_bdo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $incident_query->district_id_fk)
                ->where('shl.block', $incident_query->block_id_pk)
                ->where('shl.stake_holder_details' , 'BDO')
                ->get()->row();
        }

        //echo '-->>'.$incident_query->rural_urban.'</br>';
        if($incident_query->rural_urban == 'U'){
            $deo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $incident_query->district_id_fk)
                ->where('shl.subdiv', $incident_query->subdiv_id_fk)
                ->where('shl.stake_holder_details' , 'DEO')
                ->get()->row();
        }else{
            $deo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $incident_query->district_id_fk)
                ->where('shl.block', $incident_query->block_id_pk)
                ->where('shl.stake_holder_details' , 'DEO')
                ->get()->row();
        }
        // print_r($sdo_bdo_query);
        // print_r($deo_query);
        $incident_sdo_bdo_deo = array(
          "sdo_bdo_query" => $sdo_bdo_query,
          "deo_query" => $deo_query,
        );
        return $incident_sdo_bdo_deo;

    }

    public function cp1_cmpo($district){

        $cmpo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $district)
                ->where('shl.stake_holder_details' , 'CMPO')
                ->get()->row();

        return $cmpo_query;
    }

    public function cp2_cmpo($district){

        $cmpo_query = $this->db->select('shl.*')
                ->from('cm_stake_holder_login AS shl')
                ->where('shl.district', $district)
                ->where('shl.stake_holder_details' , 'CMPO')
                ->get()->row();

        return $cmpo_query;
    }


    public function cp1_Sdo_Bdo_Deo_details($incident_id){

      $cp1_one_query = $this->db->select('cp1.cp_district, cp1.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp1')
            ->join('rp_location_master_block as lmb', 'cp1.cp_district = lmb.district_id_fk AND cp1.cp_block = lmb.block_id_pk')
            ->where('cp1.incident_id_fk' , $incident_id)
            ->where('cp1.cp_type' , 1)
            ->get()->row();

      //print_r($cp1_one_query);
      if (isset($cp1_one_query) && is_object($cp1_one_query)){

          if($cp1_one_query->rural_urban == 'U'){
                $cp1_sdo_bdo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp1_one_query->district_id_fk)
                    ->where('shl.subdiv', $cp1_one_query->subdiv_id_fk)
                    ->where('shl.stake_holder_details' , 'SDO')
                    ->get()->row();
            }else{
                $cp1_sdo_bdo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp1_one_query->district_id_fk)
                    ->where('shl.block', $cp1_one_query->block_id_pk)
                    ->where('shl.stake_holder_details' , 'BDO')
                    ->get()->row();
            }

        }
        //echo '-->>'.$incident_query->rural_urban.'</br>';

        if (isset($cp1_one_query) && is_object($cp1_one_query)){
   
            if($cp1_one_query->rural_urban == 'U'){
                $cp1_deo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp1_one_query->district_id_fk)
                    ->where('shl.subdiv', $cp1_one_query->subdiv_id_fk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }else{
                $cp1_deo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp1_one_query->district_id_fk)
                    ->where('shl.block', $cp1_one_query->block_id_pk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }
        }

        if (!empty($cp1_sdo_bdo_query) && !empty($cp1_deo_query)) {
          $cp1_sdo_bdo_deo = array(
            "cp1_sdo_bdo_query" => $cp1_sdo_bdo_query,
            "cp1_deo_query" => $cp1_deo_query,
          );
        }else{
          $cp1_sdo_bdo_deo = array(
            "cp1_sdo_bdo_query" => null,
            "cp1_deo_query" => null,
          );
        }
        return $cp1_sdo_bdo_deo;
    }


    public function cp2_Sdo_Bdo_Deo_details($incident_id){

        $cp2_query = $this->db->select('cp1.cp_district, cp1.cp_block, lmb.district_id_fk, lmb.block_id_pk, lmb.subdiv_id_fk, lmb.clucd, lmb.rural_urban')
            ->from('cm_incident_report_contracting_parties as cp1')
            ->join('rp_location_master_block as lmb', 'cp1.cp_district = lmb.district_id_fk AND cp1.cp_block = lmb.block_id_pk')
            ->where('cp1.incident_id_fk' , $incident_id)
            ->where('cp1.cp_type' , 2)
            ->get()->row();

        if (isset($cp2_query) && is_object($cp2_query)) {
          if($cp2_query->rural_urban == 'U'){
                $cp2_sdo_bdo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp2_query->district_id_fk)
                    ->where('shl.subdiv', $cp2_query->subdiv_id_fk)
                    ->where('shl.stake_holder_details' , 'SDO')
                    ->get()->row();
            }else{
                $cp2_sdo_bdo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp2_query->district_id_fk)
                    ->where('shl.block', $cp2_query->block_id_pk)
                    ->where('shl.stake_holder_details' , 'BDO')
                    ->get()->row();
            }
          }

        //echo '-->>'.$incident_query->rural_urban.'</br>';
          if (isset($cp2_query) && is_object($cp2_query)) {

            if($cp2_query->rural_urban == 'U'){
                $cp2_deo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp2_query->district_id_fk)
                    ->where('shl.subdiv', $cp2_query->subdiv_id_fk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }else{
                $cp2_deo_query = $this->db->select('shl.*')
                    ->from('cm_stake_holder_login AS shl')
                    ->where('shl.district', $cp2_query->district_id_fk)
                    ->where('shl.block', $cp2_query->block_id_pk)
                    ->where('shl.stake_holder_details' , 'DEO')
                    ->get()->row();
            }
          }
        //echo $this->db->last_query();die;
        
        if (!empty($cp2_sdo_bdo_query) && !empty($cp2_deo_query)) {
          $cp2_sdo_bdo_deo = array(
            "cp2_sdo_bdo_query" => $cp2_sdo_bdo_query,
            "cp2_deo_query" => $cp2_deo_query,
          );
        }else{
          $cp2_sdo_bdo_deo = array(
            "cp2_sdo_bdo_query" => null,
            "cp2_deo_query" => null,
          );
        }
        return $cp2_sdo_bdo_deo;

    }

    public function get_sno_data(){
        $sno_query = $this->db->select('shl.stake_holder_login_id_pk, shl.login_id, shl.stake_holder_details, shl.mobile_no, shl.district, shl.block ')
          ->from('cm_stake_holder_login AS shl')
          ->where('shl.stake_id_fk' , '1')
          ->get()->row();

        return $sno_query;
    }

    public function get_district_id($incident_id){

        $query = $this->db->select('cir.district')
            ->from('cm_incident_report AS cir')
            ->where('cir.incident_id_pk' , $incident_id)
            ->get()->row();
        return $query->district;
    }

}

?>