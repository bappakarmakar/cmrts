<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
  .incident-details {
    background-color: #fff;
    /* Light gray background */
    padding: 15px;
    /* Add padding for spacing */
    border: 1px solid #ddd;
    /* Border with light gray color */
    border-radius: 8px;
    /* Rounded corners */
    max-width: auto;
    /* Limit the width */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Subtle shadow for depth */
    font-family: Arial, sans-serif;
    /* Clean font */
    margin: 0px auto;
    /* Center on the page */
    border-bottom: 4px solid skyblue;
  }

  .incident-details strong {
    display: block;
    /* Ensure each item is on its own line */
    font-size: 16px;
    /* Set font size */
    color: #333;
    /* Dark gray text */
    margin-bottom: 5px;
    /* Space between lines */
  }

  .incident-id {
    color: #007bff;
    /* Blue color for the ID */
  }

  .incident-date {
    color: #28a745;
    /* Green color for the date */
  }

  table {
    width: 100% !important;
  }

  .dataTables_wrapper .dataTables_filter input {
    padding: 6px;
  }

  .dataTables_length select {
    padding: 5px
  }

  .red_row {
    background-color: #f7ebeb !important;
    color: #000 !important;
  }

  .green_row {
    background-color: #e7f1ec !important;
    color: #000 !important;
  }

  .orange_row {
    background-color: #ffefdb !important;
    color: #000 !important;
  }
</style>

<body>
  <div class="content-wrapper">
    <section class="content-header" style="margin-bottom: 9px">
      <h1 class="text-center"><strong>Home Enquiry & Follow-Up Visit Scheduler of Contracting Party
          <?php if ($cp_type == 1) {
            echo "One";
          } elseif ($cp_type == 2) {
            echo "Two";
          } ?></strong></h1>
      <ol class="breadcrumb">

        <li><a href="<?php echo base_url('admin/reporting/incident/incident_list'); ?>"><i class="fa fa-backward"></i> Back</a></li>
      </ol>
    </section>
    <section class="content">
      <?php  //print_r($_SESSION);
      foreach ($result as $res) {
        // echo "<pre>";
        // print_r($res); 
      ?>

        <div class="incident-details" style="margin-bottom: 30px">
          <div style="display: flex;justify-content: space-between;padding: 0px 70px">
            <div style="width: 50%;border-right: 1px solid #0002;text-align: center;">
              <strong class="incident-id">Intervention ID: <?php echo $res->reporting_id; ?></strong>
              <strong class="incident-date">Intervention Date: <?php echo date('d-m-Y', strtotime($res->incident_date)); ?> </strong>
            </div>
            <div style="width:50%;text-align: center;">

              <strong class="incident-date">Contracting Party Name: <?php if ($cp_type == 1) {
                                                echo  $res->cp_1_name;
                                              } elseif ($cp_type == 2) {
                                                echo $res->cp_2_name;
                                              } ?></strong>

              <strong class="incident-id">Contracting Party Gender: <?php if ($cp_type == 1) {
                                                if ($res->cp1_gender == 1) {
                                                  echo "Male";
                                                } elseif ($res->cp1_gender == 2) {
                                                  echo "Female";
                                                }
                                              } elseif ($cp_type == 2) {
                                                if ($res->cp2_gender == 1) {
                                                  echo "Male";
                                                } elseif ($res->cp2_gender == 2) {
                                                  echo "Female";
                                                }
                                              } ?></strong>

            </div>
          </div>

        </div>



        <div class="box-body" id="box-table" style="padding: 0">
          <table class=" table-bordered table-hover" id="mytable">
            <thead>

              <tr class="custom_table_head">
                <th class="text-center">Sl no.</th>
                <th class="text-center">Visits</th>

                <th class="text-center">Date Scheduled</th>
                <th class="text-center">Date Completed</th>

                <th class="text-center">Days Overdue</th>
                <th class="text-center">Age<br>(at date of visit)</th>
                <th class="text-center">In Education</th>
                <th class="text-center">Attendance Frequency</th>
                <th class="text-center">Parental Support</th>
                <th class="text-center">Pregnant?</th>
                <th class="text-center">Status of Entry</th>
                <?php if ($this->session->userdata('stake_id_fk') == '4') { ?>
                  <th class="text-center">Action</th>
                <?php } ?>
              </tr>
            </thead><?php } ?>
          <tbody id="childAppend">

            <?php
            $c = 1;
            foreach ($view as $fu) {
              // echo "<pre>";print_r($fu);
            ?>
              <?php
              //$today = date('Y-m-d', strtotime("2025-01-18"));
              if ($fu->fu_names == 0) {
                if (isset($fu->fusc_current_status) && ($fu->fusc_current_status != NULL)) {
                  $color_class = 'green_row';
                } else if (!isset($fu->fusc_current_status) && ($fu->fusc_current_status == NULL)) {
                  $color_class = 'red_row';
                }
              if (isset($fu->fusc_current_status) && ($fu->active_status == 0)) {
                  $color_class = 'orange_row';
              }
                
              } else if ($fu->fu_names > 0) {
                if (isset($fu->fusc_current_status) && ($fu->fusc_current_status != NULL)) {
                    $color_class = 'green_row';
                } elseif (!isset($fu->fusc_current_status)) {
                    $color_class = 'red_row';
                } 
              if (isset($fu->fusc_current_status) && ($fu->active_status == 0)) {
                  $color_class = 'orange_row';
              }

              } 
              ?>

              <tr class="<?php echo $color_class; ?>">
                 <!-- SL NO -->
                <td><?php echo $c++; ?> </td>

                <!-- VISITS -->
                <td>  
                  <?php if ($fu->fu_names == 0) {
                      echo "Home Enquiry";
                    } else {
                      echo "Follow Up-" . $fu->fu_names;
                    } ?>
                </td>

                <!-- SCHEDULED DATE -->
                <td><?php echo date('d-m-Y', strtotime($fu->calculated_date)) ?></td> 

                <!-- DATE COMPLETED -->
                <td> 
                  <?php if ($fu->fu_names == 0) {
                                $he_date = Get_he_details($fu->scheduler_id); 
                                
                                if(isset($he_date)){
                                  $date_of_he = ($he_date['home_enquiry_date']);
                                  echo date('d-m-Y',strtotime($date_of_he));
                                }else{
                                  echo "-";
                                }
                            }elseif($fu->fu_names > 0){
                                $fuv_date = Get_fuv_details($fu->scheduler_id); 
                                
                                if(isset($fuv_date)){
                                  $date_of_fuv = $fuv_date['followup_date'];
                                  echo date('d-m-Y',strtotime($date_of_fuv));
                                }else{
                                  echo "-";
                                }
                        } ?> 
                </td>

                <!-- DAYS OVERDUE -->
                <td> 
                  <?php if ($fu->fu_names == 0) {
                          if(isset($fu->cp1_id_pk)){
                            echo full_he_fuv_age_in_days($fu->scheduler_id,$fu->calculated_date); 
                          }elseif(isset($fu->cp2_id_pk)){
                            echo full_he_fuv_age_in_days($fu->scheduler_id,$fu->calculated_date); 
                          }     
                        }elseif($fu->fu_names > 0){
                          if(isset($fu->cp1_id_pk)){
                            echo full_he_fuv_age_in_days($fu->scheduler_id,$fu->calculated_date); 
                          }elseif(isset($fu->cp2_id_pk)){
                            echo full_he_fuv_age_in_days($fu->scheduler_id,$fu->calculated_date); 
                          }       
                        }
                  ?> 
                </td>

               <!--  AGE IN YEARS, MONTHS, DAYS -->
                <td>
                  <?php if ($fu->fu_names == 0) {
                          if(isset($fu->cp1_id_pk)){
                            echo full_he_age_echo($fu->scheduler_id,$fu->cp1_dob); 
                          }elseif(isset($fu->cp2_id_pk)){
                            echo full_he_age_echo($fu->scheduler_id,$fu->cp2_dob); 
                          }     
                        }elseif($fu->fu_names > 0){
                          if(isset($fu->cp1_id_pk)){
                            echo full_fuv_age_echo($fu->scheduler_id,$fu->cp1_dob); 
                          }elseif(isset($fu->cp2_id_pk)){
                            echo full_fuv_age_echo($fu->scheduler_id,$fu->cp2_dob); 
                          }       
                        }
                  ?>                   
                </td>

                <!-- IN EDUCATION -->
                <td>
                   <?php  if($fu->fu_names == 0) {
                                $he_education = Get_he_details($fu->scheduler_id);
                                
                                if(isset($he_education)) {
                                  $he_edu_data = $he_education['education'];
                                  if($he_edu_data == 1){
                                     echo "Yes";
                                  }elseif($he_edu_data == 2){
                                     echo "No";  
                                  }
                                }else{
                                  echo "-";
                                }
                            }elseif($fu->fu_names > 0){
                              $fuv_education = Get_fuv_details($fu->scheduler_id);
                                
                               if(isset($fuv_education)) {
                                $fu_edu_data = $fuv_education['education'];
                                  if($fu_edu_data == 1){
                                     echo "Yes";
                                  }elseif($fu_edu_data == 2){
                                     echo "No";  
                                  }  
                                }else{
                                  echo "-";
                                }
                            }
                         ?> 
                </td>

                <!-- ATTENDANCE FREQUENCY -->
                <td>
                  <?php  if($fu->fu_names == 0) {
                                $he_edu = Get_he_details($fu->scheduler_id);
                                
                                if(isset($he_edu)){
                                  $he_edu_freq = $he_edu['education_frequency'];
                                  if($he_edu_freq == 1){
                                  echo "Rarely";
                                  }elseif($he_edu_freq == 2){
                                    echo "Sometimes";  
                                  }elseif($he_edu_freq == 3){
                                    echo "Regularly";
                                  }else{
                                  echo "-";
                                }
                                }else{
                                  echo "-";
                                }
                            }elseif($fu->fu_names > 0){
                                $fuv_edu = Get_fuv_details($fu->scheduler_id);
                                
                                if(isset($fuv_edu)){
                                  $fuv_edu_freq = $fuv_edu['education_frequency'];
                                  if($fuv_edu_freq == 1){
                                  echo "Rarely";
                                  }elseif($fuv_edu_freq == 2){
                                    echo "Sometimes";  
                                  }elseif($fuv_edu_freq == 3){
                                    echo "Regularly";
                                  }else{
                                  echo "-";
                                }
                                }else{
                                  echo "-";
                                }
                            }
                         ?> 
                </td>

                <!-- PARENTAL SUPPORT -->
                <td>
                   <?php    if($fu->fu_names == 0) {
                                $he_support = Get_he_details($fu->scheduler_id);
                                
                                if(isset($he_support)){
                                  $he_sup = $he_support['parents_supported'];
                                  if($he_sup == 1){
                                  echo "Low";
                                  }elseif($he_sup == 2){
                                    echo "Medium";  
                                  }elseif($he_sup == 3){
                                    echo "High";
                                  }else{
                                  echo "-";
                                }
                                }else{
                                  echo "-";
                                }
                            }elseif($fu->fu_names > 0){
                              $fuv_support = Get_fuv_details($fu->scheduler_id);
                                
                                if(isset($fuv_support)){
                                  $fuv_sup = $fuv_support['parents_supported'];
                                  if($fuv_sup == 1){
                                    echo "Rarely";
                                  }elseif($fuv_sup == 2){
                                    echo "Sometimes";  
                                  }elseif($fuv_sup == 3){
                                    echo "Regularly";
                                  }else{
                                  echo "-";
                                }
                                }else{
                                  echo "-";
                                }
                            }
                         ?> 
                </td>

                <!-- PREGNANT? -->
                <td>
                  <?php    if($fu->fu_names == 0) {
                                $he_pregnant = Get_he_details($fu->scheduler_id);
                                
                                if(isset($he_pregnant)){
                                  $he_preg = $he_pregnant['minor_pregnant'];
                                  if(isset($he_preg) && $he_preg == 1){
                                    echo "Yes";
                                  }elseif(isset($he_preg) && $he_preg == 2){
                                    echo "No";  
                                  }else{
                                  echo "-";
                                }
                                }else{
                                  echo "-";
                                }
                            }elseif($fu->fu_names > 0){
                              $fuv_pregnant = Get_fuv_details($fu->scheduler_id);
                              if(isset($fuv_pregnant)){
                                $fuv_preg = $fuv_pregnant['minor_pregnant'];
                                if(isset($fuv_preg) && $fuv_preg == 1){
                                  echo "Yes";
                                }elseif(isset($fuv_preg) && $fuv_preg == 2){
                                  echo "No";  
                                }else{
                                  echo "-";
                                }
                              }else{
                                  echo "-";
                                }
                            }
                         ?> 
                </td>

                <!-- STATUS OF ENTRY -->
                <td>
                  <?php 
                        if($fu->fusc_current_status != NULL){
                          if ($fu->cp_type == 1 && $fu->fu_names == 0) {

                            echo cp_status_he($fu->current_status, $fu->cp1_id_pk, $fu->cp_1_age);
                          } elseif ($fu->cp_type == 2 && $fu->fu_names == 0) {

                            echo cp_status_he($fu->current_status, $fu->cp2_id_pk, $fu->cp_2_age);
                          }

                          if ($fu->cp_type == 1 && $fu->fu_names > 0) {

                            echo cp_status_fuv($fu->current_status, $fu->cp1_id_pk, $fu->cp_1_age, $fu->scheduler_id);
                          } elseif ($fu->cp_type == 2 && $fu->fu_names > 0) {

                            echo cp_status_fuv($fu->current_status, $fu->cp2_id_pk, $fu->cp_2_age, $fu->scheduler_id);
                          }
                        }else{
                          // echo "helo";
                          $cp_dob = $fu->calculated_date;
                          $today = date('Y-m-d');
                          $scheduler_date = date('Y-m-d', strtotime($cp_dob));
                            if ($today <= $scheduler_date) { ?>
                                    <p class="text-danger"  style="padding: 0;margin: 0;color: #ff0000;font-weight: bold;">Upcoming</p>
                                   
                            <?php } elseif (!isset($fu->fusc_current_status)) { ?>
                                      <p class="text-danger"  style="padding: 0;margin: 0;color: #ff0000;font-weight: bold;">Overdue</p>
                                       
                            <?php }
                        }
                  ?>
                </td>
                


                <?php
                if ($this->session->userdata('stake_id_fk') == '4') {
                  if ($fu->current_status == 3) { ?>

                    <!-- ACTION -->
                    <td>
                      <?php date_default_timezone_set("Asia/Kolkata");
                      $today = date('Y-m-d');
                      $cp_dob = $fu->calculated_date;
                      $scheduler_date = date('Y-m-d', strtotime($cp_dob));
                      

                      if ($fu->fu_names == 0) {
                        $btn_name = 'Home Enquiry';
                      } else {
                        $btn_name = 'Follow-Up Visit';
                      }
                      //HOME ENQUIRY FORM LINK
                    
                      if ($fu->fu_names == 0 && $fu->cp_type == 1) { //cp1 he minor/adult
                        if ($fu->cp_1_age < 18) { // minor he cp1
                          // echo base_url();
                          $button = base_url('admin/incident/incident_list/home_visit_minor_form/index/' . base64_encode($fu->incident_id_pk) . '/' . base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp1_id_pk) . '/' . base64_encode($fu->scheduler_id));
                          // echo '<br>'.$button;

                        } else {  //adult he cp1
                          $button = base_url('admin/reporting/incident/incident_list/home_visit_adult_form/' . base64_encode($fu->incident_id_pk) . '/' . base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp1_id_pk) . '/' . base64_encode($fu->scheduler_id));
                        }
                      } elseif ($fu->fu_names == 0 && $fu->cp_type == 2) { //cp2 he adult/minor
                        if ($fu->cp_2_age < 18) { //minor he cp2
                          $button = base_url('admin/incident/incident_list/home_visit_minor_form/index/' . base64_encode($fu->incident_id_pk) . '/' . base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp2_id_pk) . '/' . base64_encode($fu->scheduler_id));
                        } else {  // adult he cp1
                          $button = base_url('admin/reporting/incident/incident_list/home_visit_adult_form/' . base64_encode($fu->incident_id_pk) . '/' . base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp2_id_pk) . '/' . base64_encode($fu->scheduler_id));
                        }
                      } elseif ($fu->fu_names > 0 && $fu->cp_type == 1) { //Follow-up cp1

                        $button = base_url('admin/reporting/incident/incident_list/follow_up_visit_form/' . base64_encode($fu->incident_id_pk) . '/' . base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp1_id_pk) . '/' . base64_encode($fu->scheduler_id));
                      } elseif ($fu->fu_names > 0 && $fu->cp_type == 2) { //Follow-up cp2

                        $button = base_url('admin/reporting/incident/incident_list/follow_up_visit_form/' . base64_encode($fu->incident_id_pk) . '/' .
                          base64_encode($fu->cp_type) . '/' . base64_encode($fu->cp2_id_pk) . '/' . base64_encode($fu->scheduler_id));
                      }

                      ?>

                      <?php


                      if ($fu->fu_names == 0) {
                        $min_date = get_min_calculated_date($fu->incident_id_pk, $fu->cp_type);

                        if ($min_date == $fu->calculated_date && $fu->fusc_current_status == NULL) {
                          $class = '';
                        } else {
                          $class = 'disabled';
                        }
                      } elseif ($fu->fu_names > 0) {
                        $min_date = get_min_calculated_date($fu->incident_id_pk, $fu->cp_type);

                        if ($min_date == $fu->calculated_date && $fu->fusc_current_status == NULL) {
                          $class = '';
                        } else {
                          $class = 'disabled';
                        }
                      }

                    
                      ?>
                      <a style="color: #fff;" href="<?php echo $button ?>">
                        <button type="button" class="btn btn-primary" <?php echo $class ?>>
                          <i class="fa fa-arrow-up" aria-hidden="true"></i>&nbsp;
                          Add New</button></a>
                      <?php // } 
                      ?>

                    </td>
                <?php
                  };
                }  ?>


              <?php }   ?>
              </tr>
          </tbody>
          </table>
        </div>

    </section>
  </div>

</body>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>