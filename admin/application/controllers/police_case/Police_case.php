<?php 
defined('BASEPATH') OR exit('No direct script access allowed' );

class Police_case extends NIC_Controller {

	public function __construct(){ 
		parent::__construct();
		parent::check_privilege();
		$this->load->model('common/Master_model');
		$this->load->model('Dashboard_model');
		$this->load->model('police_case/Police_case_model');

		$this->css_head = array(
	     1 =>$this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',
	     2 =>$this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
	 
	    );
	    $this->js_foot = array(
	      // 1 =>$this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
	      2 =>$this->config->item('theme_uri').'assets/js/jquery-ui.js',
	      // 3 =>$this->config->item('theme_uri').'assets/js/incident_form.js',
	      3 =>$this->config->item('theme_uri').'assets/js/incident_form_updated1.js',
	    ); 
	}   
 
	// Get Police case register data
	public function police_case_register_data(){
		//$this->validate_login(array('4'));
      	$login_id = $this->session->userdata('login_id');
      	$data['districts'] = $this->Master_model->get_district();
      	$data['district_details'] = $this->Dashboard_model->district_details($login_id);
      	$data['reason'] = $this->Police_case_model->cm_police_case_reason();
      	$data['police_case_details'] = $this->Police_case_model->police_case_registers(); 
      	$this->load->view($this->config->item('theme').'police_case/police_case_list', $data);
	} 
 
	// Save Police Case data
	public function police_case_register(){
		// echo "<pre>";print_r($_SESSION);die;
		// echo "<pre>";print_r($_GET);
		// die;
		$gd_number 	= isset($_GET['gd_number']) ? $_GET['gd_number']:'';
	    $gd_date 	= isset($_GET['gd_date']) ? $_GET['gd_date']:'';
	    $fir_no 	= isset($_GET['fir_no']) ? $_GET['fir_no']:'';
	    $fir_date 	= isset($_GET['fir_date']) ? $_GET['fir_date']:'';
	   	   
	    $fir_district        = isset($_SESSION) ? $_SESSION['district']:'';
	    $fir_block_municipal = isset($_SESSION) ? $_SESSION['block']:'';
	    $police_case_station = isset($_GET['police_case_station']) ? $_GET['police_case_station']:'';
	    
	    $filing_complaint    = isset($_GET['filing_complaint']) ? $_GET['filing_complaint']:'';
	    $persons_accused     = isset($_GET['persons_accused']) ? $_GET['persons_accused']:'';
	    $description_complain = isset($_GET['description_complain']) ? $_GET['description_complain']:'';
	    $polish_case_form_type= isset($_GET['polish_case_form_type']) ? $_GET['polish_case_form_type']:'';
	    $police_incident_id  =isset($_GET['police_incident_id']) ? $_GET['police_incident_id']:'';
	    $police_reporting_id =isset($_GET['police_reporting_id']) ? $_GET['police_reporting_id']:'';
	    $police_cp_id 		 =isset($_GET['police_cp_id']) ? $_GET['police_cp_id']:'';
	    $police_cp_type 	 =isset($_GET['police_cp_type']) ? $_GET['police_cp_type']:'';
	    $police_incident_date=isset($_GET['police_incident_date']) ? $_GET['police_incident_date']:'';
	    $validation_error_count=isset($_GET['validation_error_count']) ? $_GET['validation_error_count']:'';
	    

	    $off_first_name      = isset($_GET['off_first_name']) ? $_GET['off_first_name'] :''; 
	    $off_middle_name     = isset($_GET['off_middle_name']) ? $_GET['off_middle_name'] :''; 
	    $off_last_name  	 = isset($_GET['off_last_name']) ? $_GET['off_last_name'] :''; 
	    $officer_designation = isset($_GET['officer_designation']) ? $_GET['officer_designation'] :''; 
	    $pcma_section = isset($_GET['pcma_section']) ? $_GET['pcma_section'] :array(); //Ensure it's an array
	    
		// echo "<pre>";print_r($pcma_section);die;
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
	        // Check for client IP
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } else {
	        // Fallback to REMOTE_ADDR if no proxy headers are found
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    $current_ip = explode(',', $ip)[0]; 

	    date_default_timezone_set('Asia/Kolkata');
    	$gd_dateParts = explode("/", $gd_date);
		if (!empty($gd_dateParts[0]) && !empty($gd_dateParts[1]) && !empty($gd_dateParts[2])) {
		    $gd_date = $gd_dateParts[2] . "-" . $gd_dateParts[1] . "-" . $gd_dateParts[0];
		} else {
		    $gd_date = null; // Leave blank if any part is missing
		}

    	$fir_dateParts = explode("/", $fir_date);
    	if(!empty($fir_dateParts[0]) && !empty($fir_dateParts[1]) && !empty($fir_dateParts[2])){
    		$fir_date = $fir_dateParts[2]."-".$fir_dateParts[1]."-".$fir_dateParts[0];
    	} else {
    		$fir_date = null;
    	}

		$stake_holder_login_id_pk =$this->session->userdata('stake_holder_login_id_pk');
    	$stake_id_fk =$this->session->userdata('stake_id_fk');
		$cur_date = date('Y-m-d H:i:s'); 

		if($validation_error_count>0){
	    	$current_status = 19;
	    }else{
	    	$current_status = 20;
	    }
	    // echo $validation_error_count.'---'.$current_status;die;
		
	    if($polish_case_form_type=='save'){

		    $police_case_exist = $this->Police_case_model->police_case_exist($police_incident_id, $police_reporting_id, $police_cp_id);
		    $num_rows = $police_case_exist->num_rows();
		    $police_case_data = $police_case_exist->result_array();


		    if($num_rows>0){
		    	//echo 1; // address chnage request already present

		    		$police_case_id_pk =$police_case_data[0]['police_case_id_pk']; 
			    	$editData = array(
			            'incident_id_fk'      	=> $police_incident_id,
			            'reporting_id'        	=> $police_reporting_id,
			            'cp_id_fk'        	  	=> $police_cp_id,
			            'cp_type'        	  	=> $police_cp_type,
			            'incident_date'       	=> $police_incident_date,
			            'gd_no'       			=> $gd_number,
			            'gd_date'       		=> $gd_date,
			            'fir_no'       			=> $fir_no,
			            'fir_date'       		=> $fir_date,
			            
			            'fir_state'    			=> 19,
			            'fir_district'    		=> $fir_district,
			            'fir_block_municipality'=> $fir_block_municipal,
			            'police_station'    	=> $police_case_station,

			            'officer_first_name'    => $off_first_name,
			            'officer_middle_name'   => $off_middle_name,
			            'officer_last_name'     => $off_last_name,
			            'officer_designation'   => $officer_designation,
			            
			            'person_filing_complain'=> $filing_complaint,
			            'person_accused'    	=> $persons_accused,
			            'description_complaint' => $description_complain,
			            'current_status'   	  	=> $current_status,
				    );

				//$this->db->trans_start();// Start the transaction
				$result = $this->db->where('police_case_id_pk', $police_case_id_pk)
                   				   ->update('cm_police_case_register', $editData);
                if($result){
                	$del_query_res =$this->db->query("DELETE FROM cm_police_case_pcma_section WHERE police_case_id_fk='".$police_case_id_pk."' ");

                	if (!empty($pcma_section)) {
						$pcma_data = array(); // Initialize an empty array for the batch insert
		                // Loop through each section and prepare data for batch insert
					    foreach ($pcma_section as $section) {
					        $pcma_data[] = array(
					            'police_case_id_fk' => $police_case_id_pk,
					            'incident_id_fk'    => $police_incident_id,
					            'pcma_section'      => $section
					        );
					    }
					    
					    // Perform batch insert if there is data to insert
					    if (!empty($pcma_data)) {
					        $batch_insert = $this->db->insert_batch('cm_police_case_pcma_section', $pcma_data);
					    }
			        }
			    	echo 2;
                } else {
                	echo 3;
                }

		    }else{
		    	
				$data = array(
		            'incident_id_fk'      	=> $police_incident_id,
		            'reporting_id'        	=> $police_reporting_id,
		            'cp_id_fk'        	  	=> $police_cp_id,
		            'cp_type'        	  	=> $police_cp_type,
		            'incident_date'       	=> $police_incident_date,
		            'gd_no'       			=> $gd_number,
		            'gd_date'       		=> $gd_date,
		            'fir_no'       			=> $fir_no,
		            'fir_date'       		=> $fir_date,
		           
		            'fir_state'    			=> 19,
		            'fir_district'    		=> $fir_district,
		            'fir_block_municipality'=> $fir_block_municipal,
		            'police_station'    	=> $police_case_station,
		            
		            'person_filing_complain'=> $filing_complaint,
		            'person_accused'    	=> $persons_accused,
		            'description_complaint' => $description_complain,

		            'officer_first_name'    => $off_first_name,
		            'officer_middle_name'   => $off_middle_name,
		            'officer_last_name'     => $off_last_name,
		            'officer_designation'   => $officer_designation,

		            'current_status'   	  	=> $current_status,
		            'created_by_stake_holder_id'=> $stake_holder_login_id_pk,
		            'created_by_stake_id' 		=> $stake_id_fk,
		            'created_at'          		=> $cur_date,
		            'created_ip'          		=> $current_ip
			    );
				// echo "<pre>";print_r($data);die;
				$inserted = $this->db->insert('cm_police_case_register', $data);
				// echo $this->db->last_query();die;
		        if($inserted){

		        	// Get the last inserted police_case_id from cm_police_case_register table
		            $police_case_id = $this->db->insert_id();
		            // Now, insert the pcma_section values into cm_police_case_pcma_section table
		            if (!empty($pcma_section)) {
		                foreach ($pcma_section as $section) {
		                    $pcma_data = array(
		                        'police_case_id_fk' => $police_case_id,
		                        'incident_id_fk'    => $police_incident_id,
		                        'pcma_section'      => $section
		                    );
		                	$this->db->insert('cm_police_case_pcma_section', $pcma_data);
		                }
		            }
					$update_data = array('police_case' =>1);
					$result = $this->db->where('incident_id_pk', $police_incident_id)
							 		   ->update('cm_incident_report', $update_data);

					$update_cp = array('cp_police_case' =>1);
					$cp_result = $this->db->where('cp_id_pk', $police_cp_id)
										  ->where('incident_id_fk', $police_incident_id)
							 		      ->update('cm_incident_report_contracting_parties', $update_cp);
					// echo $this->db->last_query();die;

					echo 2;
		        }else{
		        	echo 3;
		        }
		    }

		}else{

			$police_register_id = isset($_GET['police_register_id']) ? $_GET['police_register_id']:'';
			$editData = array(
	            'incident_id_fk'      	=> $police_incident_id,
	            'reporting_id'        	=> $police_reporting_id,
	            'cp_id_fk'        	  	=> $police_cp_id,
	            'cp_type'        	  	=> $police_cp_type,
	            'incident_date'       	=> $police_incident_date,
	            'gd_no'       			=> $gd_number,
	            'gd_date'       		=> $gd_date,
	            'fir_no'       			=> $fir_no,
	            'fir_date'       		=> $fir_date,
	            
	            'fir_state'    			=> 19,
	            'fir_district'    		=> $fir_district,
	            'fir_block_municipality'=> $fir_block_municipal,
	            'police_station'    	=> $police_case_station,

	            'officer_first_name'    => $off_first_name,
	            'officer_middle_name'   => $off_middle_name,
	            'officer_last_name'     => $off_last_name,
	            'officer_designation'   => $officer_designation,
	            
	            'person_filing_complain'=> $filing_complaint,
	            'person_accused'    	=> $persons_accused,
	            'description_complaint' => $description_complain,
	            'current_status'   	  	=> 20,
	            'updated_by'			=> $stake_holder_login_id_pk,
	            'updated_by_stake_id' 	=> $stake_id_fk,
	            'updated_at'          	=> $cur_date,
	            'updated_ip'          	=> $current_ip
		    );

			$this->db->trans_start();// Start the transaction
		    $result = $this->db->where('police_case_id_pk', $police_register_id)
							   ->update('cm_police_case_register', $editData);
			// echo $this->db->last_query();die;
			if($result){
				$del_query_res =$this->db->query("DELETE FROM cm_police_case_pcma_section WHERE police_case_id_fk='".$police_register_id."' AND incident_id_fk='".$police_incident_id."' ");
				if (!empty($pcma_section)) {
					$pcma_data = array(); // Initialize an empty array for the batch insert
	                // Loop through each section and prepare data for batch insert
				    foreach ($pcma_section as $section) {
				        $pcma_data[] = array(
				            'police_case_id_fk' => $police_register_id,
				            'incident_id_fk'    => $police_incident_id,
				            'pcma_section'      => $section
				        );
				    }
				    
				    // Perform batch insert if there is data to insert
				    if (!empty($pcma_data)) {
				        $batch_insert = $this->db->insert_batch('cm_police_case_pcma_section', $pcma_data);
				    }
		        }
		        if($result>0 && $del_query_res>0 && $batch_insert>0){
		        	$this->db->trans_complete(); // Commit the transaction
					echo 2;
		        }else{
		        	$this->db->trans_rollback(); // rollback the transaction
		        	echo 3;
		        }
	        }else{
	        	$this->db->trans_rollback(); // rollback the transaction
	        	echo 3;
	        }
		}

	} // Police Case Save Function END

	// Get PCMA Section data 
	public function pcma_section(){
		$police_case_id_pk = $this->input->get('police_case_id_pk');
		$incident_id_fk    = $this->input->get('incident_id_fk');
		$pcma_section_data = $this->Police_case_model->get_pcma_section($police_case_id_pk, $incident_id_fk);
      	echo json_encode($pcma_section_data);
	}

	// Get FIR block_municipal data
	public function get_block_municipality(){
      $district_id = $this->input->get('district_id');
      $block = $this->Master_model->get_block($district_id);
      echo json_encode($block);
  	}

	// Get FIR GP/Ward Data
	public function get_block_data(){
	$block = $this->input->get('block');
	$block_data = $this->Master_model->get_ward_gp_block($block);
	if($block_data->rural_urban=='R'){
		$word_gp_data = $this->Master_model->get_gp($block);
	}else if($block_data->rural_urban=='U'){
		$word_gp_data = $this->Master_model->get_ward($block);
	}
	$block_gp_data = array(
	  'block_rural_urban' => $block_data->rural_urban,
	  'block_gp_data'     => $word_gp_data,
	);
	//print_r($block_gp_data);die;
	echo json_encode($block_gp_data);
	}

	// Get Police District Data
	public function get_police_district(){
		$district_id = $this->input->get('district_id');
		$police_district = $this->Police_case_model->get_police_district_data($district_id);
		echo json_encode($police_district);
	}

	// Get Police Station Data
	public function get_police_station(){
		$login_district_id = $this->input->get('login_district_id');
		$police_station = $this->Police_case_model->get_police_station_data($login_district_id);
		echo json_encode($police_station);
	}

	// Get Word Data
	public function get_ward_data(){
		$block_id  = $this->input->get('block_id');
		$word_data = $this->Master_model->get_ward($block_id);
		echo json_encode($word_data);
	}

	// Get GP data
	public function get_gp_data(){
		$block_id = $this->input->get('block_id');
		$gp_data  = $this->Master_model->get_gp($block_id);
		echo json_encode($gp_data);
	} 

	// Polish case all action function
	public function police_case_all_action(){

		date_default_timezone_set('Asia/Kolkata');
		$police_case_id_pk  = $this->input->get('police_case_id_pk');
		$action 		    = $this->input->get('action');
		$police_register_id = base64_decode($police_case_id_pk);

		$incident_id = $this->input->get('incident_id');
		$incident_id = base64_decode($incident_id);
		$cp_id = $this->input->get('cp_id');
		$cp_id = base64_decode($cp_id);
		// echo $police_register_id.'--->'.$incident_id.'--->'.$cp_id;die;

		$current_date = date('Y-m-d H:i:s');
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];// Check for client IP
		} else {
		    // Fallback to REMOTE_ADDR if no proxy headers are found
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		$current_ip = explode(',', $ip)[0];
		$stake_id_fk = $this->session->userdata('stake_id_fk');
		$login_id = $this->session->userdata('stake_holder_login_id_pk');

		if($action=='forward'){
			$save_data = array(
			    'current_status'      	=> 21,
			    'forward_by'			=> $login_id,
			    'forward_by_stake_id_fk'=> $stake_id_fk,
			    'forward_date'         	=> $current_date,
			    'forward_by_ip'         => $current_ip
			);
		}
		if($action=='publish'){
		    $save_data = array(
			    'current_status'        => 22,
			    'publish_by'		    => $login_id,
			    'publish_by_stake_id_fk'=> $stake_id_fk,
			    'publish_date'          => $current_date,
			    'publish_by_ip'         => $current_ip
			);
		}
		if($action=='revert'){
			$save_data = array(
				'current_status'        => 23
			);
		}
		if($action=='delete'){
			$save_data = array(
			    'current_status'     	=> 24,
			    'deleted_by'		 	=> $login_id,
			    'deleted_by_stake_id'	=> $stake_id_fk,
			    'deleted_at'         	=> $current_date,
			    'deleted_ip'         	=> $current_ip
			);
		}
		// print_r($save_data);die;
		$result = $this->db->where('police_case_id_pk', $police_register_id)
						   ->update('cm_police_case_register', $save_data);
		// echo $this->db->last_query();die;
		if ($result) {
			if($action=='publish' || $action=='delete'){
				$update_cp =array('cp_police_case' =>null);
				$cp_result =$this->db->where('cp_id_pk', $cp_id)
									  ->where('incident_id_fk', $incident_id)
						 		      ->update('cm_incident_report_contracting_parties', $update_cp);
				// Step 2: Check if all rows for this incident have cp_police_case = 0
			    // $this->db->from('cm_incident_report_contracting_parties');
			    // $this->db->where('incident_id_fk', $incident_id);
			    // $this->db->where('cp_police_case !=', null);
			    // $remaining = $this->db->count_all_results();
			    // if($remaining==0){
			    // 	echo "Test";
			    // }
			    // print_r($remaining);die;
			}
			echo json_encode(array('status'=>true, 'message'=>'Case updated successfully.'));
		} else {
			echo json_encode(array('status'=>false, 'message'=>'Failed to update the case.'));
		}
	}

	public function police_case_revert(){
		$police_case_id = $this->input->get('police_case_id');
		$police_case_id = base64_decode($police_case_id);
		$reason = $this->input->get('reason');
		
		$update =array(
					'revert_reason' =>$reason,
					'current_status'=> 23
				);
		$result =$this->db->where('police_case_id_pk', $police_case_id)
				 		  ->update('cm_police_case_register', $update);
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	// Get Intervention Data 
	public function intervention_address(){
		$incident_id      = $this->input->get('incident_id');
		$incident_address = $this->Police_case_model->get_intervention_address($incident_id);
		echo json_encode($incident_address[0]);
	}

	// Get CP Address
	public function cps_address(){
		$incident_id = $this->input->get('incident_id');
		$incident_date = $this->input->get('incident_date');
		$cp_address  = $this->Police_case_model->cp_address($incident_id, $incident_date);
		// echo "<pre>";print_r($cp_address);die;
		echo json_encode($cp_address);

	}

}