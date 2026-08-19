<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Generate_scheduler_for_legacy_data_model extends CI_Model 
{
    public function get_dist_wise_records($district)
    {
        $this->db->distinct();
        $this->db->select(' inc.stake_holder_id_fk, 
                            inc.incident_id_pk, 
                            inc.incident_date, 
                            inc.reporting_id ,
                            inc.marriage_date,
                            inc.new_schd_status,
                            inc.schd_generated_date, 
                            cp1.cp_dob as cp_1_dob, 
                            cp2.cp_dob as cp_2_dob,
                            cp1.cp_type as cp_1_type, 
                            cp2.cp_type as cp_2_type,
                            cp1.cp_id_pk as cp_1_id_pk,
                            cp2.cp_id_pk AS cp_2_id_pk,
                            cp1.cp_gender as cp1_gender,
                            cp2.cp_gender as cp2_gender,
                            cp1.cp_name as cp_1_name,
                            cp2.cp_name as cp_2_name');
        $this->db->from('cm_incident_report inc');
        $this->db->join('cm_incident_report_contracting_parties AS cp1', 'inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1', 'left');
        $this->db->join('cm_incident_report_contracting_parties AS cp2', 'inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2', 'left');
        $this->db->where('inc.current_status', 3);
        $this->db->where('inc.district', $district); 
        $this->db->where("cp1.cp_dob > inc.incident_date - INTERVAL '21 years'");
        $this->db->where("cp2.cp_dob > inc.incident_date - INTERVAL '21 years'");
        $this->db->where('inc.new_schd_status IS NULL');
        // $this->db->where('inc.reporting_id', '112400311');
        $this->db->limit(2);

        $query = $this->db->get();
        // echo "<pre>". $this->db->last_query();die;
        return $query->result();
    }


	public function get_scheduler_generate_data_district_view($district) {  // created by soumen for create scheduler
        $this->db->distinct();
        $this->db->select(' inc.stake_holder_id_fk, 
                            inc.incident_id_pk, 
                            inc.incident_date, 
                            inc.reporting_id ,
                            inc.marriage_date,
                            inc.schd_status,
                            inc.schd_generated_date, 
                            cp1.cp_dob as cp_1_dob, 
                            cp2.cp_dob as cp_2_dob,
                            cp1.cp_type as cp_1_type, 
                            cp2.cp_type as cp_2_type,
                            cp1.cp_id_pk as cp_1_id_pk,
                            cp2.cp_id_pk AS cp_2_id_pk,
                            cp1.cp_gender as cp1_gender,
                            cp2.cp_gender as cp2_gender,
                            cp1.cp_name as cp_1_name,
                            cp2.cp_name as cp_2_name');
        $this->db->from('cm_incident_report inc');
        $this->db->join('cm_incident_report_contracting_parties AS cp1', 'inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1', 'left');
        $this->db->join('cm_incident_report_contracting_parties AS cp2', 'inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2', 'left');
        $this->db->where('inc.current_status', 3);
        // $this->db->where('inc.delete_status', 0);
        $this->db->where('inc.district', $district); // Filter by incident_id_pk
        // $this->db->where('inc.schd_status IS NULL'); // Proper NULL check

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

	public function get_scheduler_generate_data_by_district($district) {  // created by soumen for create scheduler
        $this->db->distinct();
        $this->db->select(' inc.stake_holder_id_fk, 
                            inc.incident_id_pk, 
                            inc.incident_date, 
                            inc.reporting_id ,
                            inc.marriage_date,
                            inc.schd_status,
                            inc.schd_generated_date, 
                            cp1.cp_dob as cp_1_dob, 
                            cp2.cp_dob as cp_2_dob,
                            cp1.cp_type as cp_1_type, 
                            cp2.cp_type as cp_2_type,
                            cp1.cp_id_pk as cp_1_id_pk,
                            cp2.cp_id_pk AS cp_2_id_pk,
                            cp1.cp_gender as cp1_gender,
                            cp2.cp_gender as cp2_gender,
                            cp1.cp_name as cp_1_name,
                            cp2.cp_name as cp_2_name');
        $this->db->from('cm_incident_report inc');
        $this->db->join('cm_incident_report_contracting_parties AS cp1', 'inc.incident_id_pk = cp1.incident_id_fk AND cp1.cp_type = 1', 'left');
        $this->db->join('cm_incident_report_contracting_parties AS cp2', 'inc.incident_id_pk = cp2.incident_id_fk AND cp2.cp_type = 2', 'left');
        $this->db->where('inc.current_status', 3);
        $this->db->where('inc.district', $district); // Filter by incident_id_pk
        $this->db->where('inc.schd_status IS NULL'); // Proper NULL check
        // $this->db->limit(50);

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

	public function update_schd_status_inc_table($incident_id) //incident table schd_status update 
    {

        $cur_date = date('Y-m-d H:i:s');
        $query = $this->db->query("UPDATE cm_incident_report SET new_schd_status=1 , schd_generated_date= '".$cur_date."'  WHERE incident_id_pk = '".$incident_id."' ");
        echo $this->db->last_query();die;
        return $query;
    }

	//HOME ENQUIRY
	public function get_existing_he_data($incident_id, $cp_id, $cp_type){

        $query = $this->db->query("SELECT sl_no, incident_id_fk, cp_id_fk, cp_type, hv_status FROM cm_incident_report_home_visit WHERE incident_id_fk = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type = '".$cp_type."' AND active_status = 1 ");
        // echo $this->db->last_query();die();
        return $query;
    }

	public function update_scheduler_he_data($incident_id, $cp_id, $cp_type, $hv_status)
    {
        // echo $incident_id ."--". $cp_id ."--". $cp_type ."--". $hv_status;die;
        if($hv_status != 3){
            $query = $this->db->query("UPDATE cm_follow_up_visit_minor_scheduler SET current_status=1 WHERE incident_id = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type='".$cp_type."' AND fu_names = '0' RETURNING *");
        }else{
            $query = $this->db->query("UPDATE cm_follow_up_visit_minor_scheduler SET active_status=1 , current_status=1 WHERE incident_id = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type='".$cp_type."' AND fu_names = '0' RETURNING *");
        }
        // echo $this->db->last_query();die;
        $last_updated_rows = $query->result();
        return $last_updated_rows;
    }

	public function update_home_enquiry_data($homenq_slr_id, $updated_scheduler_id)
    {
        $qry_result =$this->db->query("UPDATE cm_incident_report_home_visit SET scheduler_id_fk = '".$updated_scheduler_id."' WHERE sl_no='".$homenq_slr_id."' ");
        return $qry_result;
    }

	//FOLLOW UP VISIT
	public function get_existing_followup_data($incident_id, $cp_id, $cp_type){
        // echo 'MM-->>'.$incident_id.'---'.$cp_is;die;
        $query = $this->db->query("SELECT sl_no, incident_id_fk, cp_id_fk, cp_type, fv_status FROM cm_follow_up_visit_details WHERE incident_id_fk = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type='".$cp_type."' AND active_status = 1 AND scheduler_id_fk IS NULl ORDER BY followup_date ASC");
        // echo $this->db->last_query();die();
        return $query;
    }

	public function update_fuv_scheduler_status($loop_cnt, $incident_id, $cp_id, $cp_type, $fv_status){
        // echo $loop_cnt."--->>".$incident_id.'--'.$cp_id.'---'.$cp_type.'</br>';
        if($fv_status != 3){
            $query = $this->db->query("UPDATE cm_follow_up_visit_minor_scheduler SET current_status=1 WHERE incident_id = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type='".$cp_type."' AND fu_names='".$loop_cnt."' RETURNING * ");
        }else{
            $query = $this->db->query("UPDATE cm_follow_up_visit_minor_scheduler SET active_status=1 ,  current_status=1 WHERE incident_id = '".$incident_id."' AND cp_id_fk = '".$cp_id."' AND cp_type='".$cp_type."' AND fu_names='".$loop_cnt."' RETURNING * ");
        }
        
        $last_updated_rows = $query->result();
        return $last_updated_rows;
    }

	public function update_followup_by_scheduler($followup_slr_id, $last_updated_scheduler_id){
        $qry_result =$this->db->query("UPDATE cm_follow_up_visit_details SET scheduler_id_fk = '".$last_updated_scheduler_id."' WHERE sl_no='".$followup_slr_id."'  ");
        return $qry_result;
    }


// SCHEDULER GENERATE FOR CP1 AND CP2 FUNCTION START

public function insert_date_cp1($row) {  // created by soumen
    // print_r($row);die;   
    $incident_id_pk = $row->incident_id_pk;
    $incident_date = $row->incident_date;
    $reporting_id = $row->reporting_id;
    $cp_1_dob = $row->cp_1_dob;
    $cp_1_type = $row->cp_1_type;
    $cp_1_id_pk = $row->cp_1_id_pk;
    $cp1_gender = $row->cp1_gender; // Added 19-05-2025

    $dob_date = new DateTime($cp_1_dob);
    $inc_date = new DateTime($incident_date);

    $dates_to_insert = [];
    $name = [];
    $a = 1;


        $cp1_he = $inc_date->modify('+1 days'); 
        $dates_to_insert[] = $cp1_he->format('Y-m-d');
        $name[] = 0;

        for ($i = 1; $i <= 2; $i++) {
            $yesterday = $inc_date->modify('+14 days');
            if ($this->check_age_limit($dob_date, $yesterday,$cp1_gender)) {
                $dates_to_insert[] = $yesterday->format('Y-m-d');
                $name[] = $a++;
            } else {
                break; 
            }
        }

        // Step 3: Add dates with a 1-month gap, 11 times
        for ($i = 1; $i <= 11; $i++) {
            $yesterday = $yesterday->modify('+30 days'); //+1 month
            if ($this->check_age_limit($dob_date, $yesterday,$cp1_gender)) {
                $dates_to_insert[] = $yesterday->format('Y-m-d');
                $name[] = $a++;
            } else {
                break; 
            }
        }

        // Step 4: Add dates with a 3-month gap until age 18
            if($cp1_gender == 1){ // Male
                $cp1_check_adult = ($dob_date)->modify('+21 years');
            }
            if($cp1_gender == 2){ // Female
                $cp1_check_adult = ($dob_date)->modify('+18 years');
            }

        //$cp1_check_adult = ($dob_date)->modify('+18 years');
        // print_r($cp1_check_adult);die;
        // print_r($yesterday);die;
        while ($yesterday < $cp1_check_adult) {
            $yesterday = $yesterday->modify('+90 days');
            if ($cp1_check_adult > $yesterday ) {
                $dates_to_insert[] = $yesterday->format('Y-m-d');
                $name[] = $a++;
            } else {
                break;
            }
        }

        $query = $this->db->query("SELECT COUNT(fu_names) FROM cm_follow_up_visit_minor_scheduler WHERE incident_id = $incident_id_pk AND cp_id_fk = $cp_1_id_pk ");
        $data = $query->result();
        $count = $data[0]->count;

        // echo "<pre>"; print_r($dates_to_insert);
        // echo "<pre>";
        //print_r($dates_to_insert);
        for ($i = $count; $i < count($dates_to_insert); $i++) {
            
           $this->db->insert('cm_follow_up_visit_minor_scheduler_21year', [
                'dob' => $cp_1_dob,
                'calculated_date' => $dates_to_insert[$i],
                'incident_id' =>  $incident_id_pk, 
                'fu_names' => $name[$i],
                'reporting_id' => $reporting_id,
                'cp_type' => $cp_1_type,
                'incident_date' => $incident_date,
                'cp_id_fk' => $cp_1_id_pk
            ]);

        }

    
}

public function insert_date_cp2($row) { // created by soumen
    // echo "<pre>"; print_r($row);die;   
    $incident_id_pk = $row->incident_id_pk;
    $incident_date  = $row->incident_date;
    $reporting_id   = $row->reporting_id;
    $cp_2_dob   = $row->cp_2_dob;
    $cp_2_type  = $row->cp_2_type;
    $cp_2_id_pk = $row->cp_2_id_pk;
    $cp2_gender = $row->cp2_gender; // Added 19-05-2025

    $dob_date2  = new DateTime($cp_2_dob);
    $inc_dates  = new DateTime($incident_date);

    $dates_to_inserts = [];
    $names = [];
    $as = 1;

   
        $cp2_he = $inc_dates->modify('+1 days'); // Home Enquiry Add
        $dates_to_inserts[] = $cp2_he->format('Y-m-d');
        $names[] = 0;

        for ($i = 1; $i <= 2; $i++) {
            $yesterday2 = $inc_dates->modify('+14 days');
            if ($this->check_age_limit($dob_date2, $yesterday2,$cp2_gender)) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d'); 
                $names[] = $as++;
            } else {
                break;
            }
        }

        // Step 3: Add dates with a 1-month gap, 11 times
        for ($i = 1; $i <= 11; $i++) {
            $yesterday2 = $yesterday2->modify('+30 days');
            if ($this->check_age_limit($dob_date2, $yesterday2,$cp2_gender)) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d');
                $names[] = $as++;
            } else {
                break;
            }
        }

        // Step 4: Add dates with a 3-month gap until age 18
        if($cp2_gender == 1){ // Male
            $cp2_check_adult = ($dob_date2)->modify('+21 years');
        }
        if($cp2_gender == 2){ // Female
            $cp2_check_adult = ($dob_date2)->modify('+18 years');
        }

        // $cp2_check_adult = ($dob_date2)->modify('+18 years');
         // print_r($cp2_check_adult);die;
        while ($yesterday2 < $cp2_check_adult) {
            $yesterday2 = $yesterday2->modify('+90 days');
            if ($cp2_check_adult > $yesterday2) {
                $dates_to_inserts[] = $yesterday2->format('Y-m-d');
                $names[] = $as++;
            } else { 
                break; 
            }
        }

         $query = $this->db->query("SELECT COUNT(fu_names) FROM cm_follow_up_visit_minor_scheduler WHERE incident_id = $incident_id_pk AND cp_id_fk = $cp_2_id_pk ");
         $data = $query->result();
         $count = $data[0]->count;
         // $count = 3;
        // echo "<pre>"; print_r($data);die;

         // echo "<pre>"; echo $i.'--'.$count.'--'.count($dates_to_inserts); print_r($dates_to_inserts);
        // Insert dates and names into the database
        for ($i = $count; $i < count($dates_to_inserts); $i++) {
            // echo $i.", " ;die;
            $this->db->insert('cm_follow_up_visit_minor_scheduler_21year', [
                'dob' => $cp_2_dob,
                'calculated_date' => $dates_to_inserts[$i],
                'incident_id' =>  $incident_id_pk, 
                'fu_names' => $names[$i],
                'reporting_id' => $reporting_id,
                'cp_type' => $cp_2_type,
                'incident_date' => $incident_date,
                'cp_id_fk' => $cp_2_id_pk
            ]);   
        }
      // echo $this->db->last_query();
}

    private function check_age_limit($dob_date, $current_date, $cp_gender) {
        $age = $dob_date->diff($current_date)->y;
          if(isset($cp_gender) && $cp_gender == 1){ // Male
            return $age < 21;
          }
          if(isset($cp_gender) && $cp_gender == 2){ // Female
            return $age < 18;
          }
    }


}