<?php 
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change extends NIC_Controller {
	
	public function __construct(){ 
		parent::__construct();
		parent::check_privilege();
		$this->load->model('address/Address_change_list_model');
	} 

	public function index(){
		// blank function
	}

	// Get Block or Municipality of selected District
	public function get_block_municipality(){
		$district_id = $this->input->get('district_id');
		$block = $this->Address_change_list_model->get_block($district_id);
		echo json_encode($block);
  	}

  	// Get ward by selected block/municipality
	public function get_ward_data(){
		$block_id  = $this->input->get('block_id');
		$word_data = $this->Address_change_list_model->get_ward($block_id);
		echo json_encode($word_data);
	}
	// Get ward by selected block/municipality
	public function get_gp_data(){
		$block_id = $this->input->get('block_id');
		$gp_data  = $this->Address_change_list_model->get_gp($block_id);
		echo json_encode($gp_data);
	}

	public function save_address_changed_data(){

		date_default_timezone_set('Asia/Kolkata');
		$formData = $_GET['formData'];
		parse_str($formData, $formFields);
		// echo "<pre>";print_r($formFields);
		$street   = isset($formFields['street_landmark']) ? $formFields['street_landmark'] : '';
		$state    = isset($formFields['state']) ? $formFields['state'] : '';
		if($state==1){
			$district =isset($formFields['district']) ? $formFields['district'] : '';
			$block_municipal =isset($formFields['block_municipal']) ? $formFields['block_municipal'] : '';
			$array = explode(":", $block_municipal);
			$block_municipal = $array[0];
			$ward_gp = isset($formFields['ward_gp']) ? $formFields['ward_gp'] : '';
		}else{
			$other_address = isset($formFields['other_address']) ? $formFields['other_address'] : '';
		}
		$pin_code = isset($formFields['pin_code']) ? $formFields['pin_code'] : '';
		$police_station = isset($formFields['police_station']) ? $formFields['police_station'] : '';
		$mobile   = isset($formFields['mobile']) ? $formFields['mobile'] : '';
		$remarks  = isset($formFields['remarks']) ? $formFields['remarks'] : '';

		$form_type = isset($formFields['form_type']) ? $formFields['form_type'] : '';
		if($form_type=='Save'){
	
			$incident_id =isset($formFields['hidden_incident_id']) ? $formFields['hidden_incident_id'] : '';
			$reporting_id = isset($formFields['hidden_reporting_id']) ? $formFields['hidden_reporting_id'] : '';
			$cp_id  = isset($formFields['hidden_cp_id']) ? $formFields['hidden_cp_id'] : '';
			$cp_type = isset($formFields['hidden_cp_type_id']) ? $formFields['hidden_cp_type_id'] : '';
			$incident_date = isset($formFields['hidden_incident_date']) ? $formFields['hidden_incident_date'] : '';

		}else if($form_type=='Edit'){
			$hidden_address_change_id = isset($formFields['hidden_address_change_id']) ? $formFields['hidden_address_change_id'] : '';
		}

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
	        // Check for client IP
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } else {
	        // Fallback to REMOTE_ADDR if no proxy headers are found
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    $ip = explode(',', $ip)[0];  

	    $row_exist = $this->Address_change_list_model->already_exist($incident_id,$reporting_id,$cp_id);
	    $num_rows = $row_exist->num_rows();
	    if($num_rows>0){
	    	echo 1; // address chnage request already present
	    }else{
	    		    
			$stake_id_fk = $this->session->userdata('stake_id_fk');
			$stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
			$cur_date = date('Y-m-d H:i:s');

				if($form_type=='Save'){
					$data = array(
			            'incident_id_fk'      		=> $incident_id,
			            'reporting_id'        		=> $reporting_id,
			            'cp_id_fk'        	  		=> $cp_id,
			            'cp_type'        	  		=> $cp_type,
			            'incident_date'       		=> $incident_date,
			            'street_landmark'     		=> $street,
			            'state'    			  		=> $state,
			            'pin_code'    		  		=> $pin_code,
			            'police_station'     		=> $police_station,
			            'cp_mobile'    		 		=> $mobile,
			            'remarks'    		  		=> $remarks,
			            'current_status'   	  		=> 1,
			            'created_by_stake_holder_id'=> $stake_holder_login_id_pk,
			            'created_by_stake_id' 		=> $stake_id_fk,
			            'created_at'          		=> $cur_date,
			            'created_ip'          		=> $ip
			        );

			        if($state=='1'){
						$address_data = array(
				            'district'  => $district,
				            'block'   	=> $block_municipal,
				            'ward_gp'   => $ward_gp
				        );
					}else if($state=='2'){
						$address_data = array(
				            'cp_address'=> $other_address
				        );
					}else{
						$address_data = array();
					}

			    }else if($form_type=='Edit'){
			    	$data = array(
			            'street_landmark'     => $street,
			            'state'    			  => $state,
			            'pin_code'    		  => $pin_code,
			            'police_station'      => $police_station,
			            'cp_mobile'    		  => $mobile,
			            'remarks'    		  => $remarks,
			            'updated_by'		  => $stake_holder_login_id_pk,
			            'updated_by_stake_id' => $stake_id_fk,
			            'updated_at'          => $cur_date,
			            'updated_ip'          => $ip
			        );

			        if($state=='1'){
						$address_data = array(
				            'district'  => $district,
				            'block'   	=> $block_municipal,
				            'ward_gp'   => $ward_gp,
				            'cp_address'=> NULL
				        );
					}else if($state=='2'){
						$address_data = array(
							'district'  => NULL,
				            'block'   	=> NULL,
				            'ward_gp'   => NULL,
				            'cp_address'=> $other_address
				        );
					}else{
						$address_data = array();
					}
			    }
			// echo "<pre>";print_r($data);die;
			$full_address_change_data =array_merge($data, $address_data);
			// echo "<pre>";print_r($full_address_change_data);

			if($form_type=='Save'){
		        // Insert data into the database
		        $inserted = $this->db->insert('cm_cp_address_change_data', $full_address_change_data);
		        if($inserted){
					$update_data = array('address_change_status' =>1);
					$result = $this->db->where('incident_id_pk', $incident_id)
							 		   ->update('cm_incident_report', $update_data);

					$status_data = array(
						'address_change_status' =>1,
						'address_change_created_at' =>$cur_date
					);
					$update_res = $this->db->where('cp_id_pk', $cp_id)
							  ->update('cm_incident_report_contracting_parties', $status_data);
					echo 2;
		        }else{
		        	echo 3;
		        }
	    	}else if($form_type=='Edit'){
	    		$result = $this->db->where('address_change_id_pk', $hidden_address_change_id)
						 		   ->update('cm_cp_address_change_data', $full_address_change_data);

				if($result){
					echo 2;
				}else{
					echo 3;
				}

	    	}

   		} // End save else part
	}

	
	
}
?>