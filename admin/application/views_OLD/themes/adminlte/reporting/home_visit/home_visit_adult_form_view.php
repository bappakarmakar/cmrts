<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left-enquiry-to-adult'); ?>
<style>
   .showSweetAlert h2 {
      font-size: 18px !important;
    }
    .showSweetAlert button {
      font-size: 14px !important;
    }
    .showSweetAlert {
      width: 50% !important;
    }
   tr{
   background-color: #d9d9d9;
   }
   .star {
   color: red;
   font-size: 14px;
   }
   .mtop20 {
   margin-top: 20px; 
   }
   .mbottom20 {
   margin-bottom: 20px;
   }
   .mright20 {
   margin-right: 20px;
   }
   .previous_button {
   background: transparent;
   color: #99a2a8;
   border: 0 none;
   border-radius: 5px;
   cursor: pointer;
   min-width: 130px;
   font: 700 14px/40px "Roboto", sans-serif;
   border: 1px solid #99a2a8;
   margin: 0 5px;
   text-transform: uppercase;
   display: inline-block;
   float: right;
   /*margin-top: 25px; */
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .submit_button {
   background: #5cb85c;
   color: white;
   border: 0 none;
   border-radius: 5px;
   cursor: pointer;
   min-width: 130px;
   font: 700 14px/40px "Roboto", sans-serif;
   border: 1px solid #5cb85c;
   margin: -15 5px;
   text-transform: uppercase;
   display: inline-block;
   float: right;
   /*margin-top: 24px; */
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .submit_button:hover {
   background-color: #337ab7;
   border: 1px solid #337ab7;
   color: #FFFFFF;
   }
   .previous_button:hover {
   background-color: #99a2a8;
   border: 1px solid #FFFFFF;
   color: #FFFFFF;
   }
   h2 {
   font-size: 21px !important;
   }
   .error{
color: red;
}
    .fixed-header {
    background-color: #fff !important;
    width: 81.9%;
    right: 0 !important;
    left: auto !important;
    top: 0 !important;
    box-shadow: 0px 2px 5px #0000002b;
}
.content-header {
    display: flex;
    position: fixed;
    top: 50px;
    z-index: 99;
    width: 100%;
    padding-left: 250px;
    right: 0;
    padding-bottom: 10px;
    background-color: #fff !important;
        background: transparent;
    box-shadow: 1px 2px 3px #0005;
   }
</style>
<?php 
   $last = $this->uri->total_segments();
   $record_num_1 = $this->uri->segment(5);
   $record_num_2 = $this->uri->segment(6);
   $record_num_3 = $this->uri->segment(7);
   $incident_id_fk = base64_decode($record_num_1);
   $cm_incident_details = cm_incident_report_by_incident_id($incident_id_fk);
   $incident_date = ($cm_incident_details)?$cm_incident_details->incident_date:'';
?>
<?php echo form_open('admin/reporting/incident/incident_list/home_visit_adult_form/'.$record_num_1.'/'.$record_num_2.'/'.$record_num_3, array('class' => 'home_visit_adult_form', 'name' => 'home_visit_adult_form', 'id' => 'home_visit_adult_form'))?>
<input type="hidden" name="incidentDetailsId" value="<?=$record_num_1.'/'.$record_num_2.'/'.$record_num_3?>">
<div class="content-wrapper">
<section class="content-header" style="display:flex;justify-content: space-between;">
   <h1 style="width:33%">Home Enquiry (Adult)</h1>

    <div class="form-btn" style="width:33%">
               <ul style="display: flex;list-style: none;justify-content: start;padding: 0;margin: 0;">
                  <li style="margin-right: 5px;">
                     <button type="button" class="btn btn-danger" onclick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                  </li>
                  <li>
                     <button type="submit"onclick="" name="Sub_Minor_Form" id="" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                  </li>
               </ul>
            </div>
   <ol class="breadcrumb" style="float: none;position: relative;top: 0;" style="width:33%">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
   </ol>
</section>
<section class="content">
   
   <?php $this->load->view('errors/message'); ?>
   <div class="box bottom-box">
      
      <div class="row" style="margin-top: 75px;">
         <div class="col-md-12">
            <div class="card card-default">
               <div class="card-body p-0">
                              <div class="form-group">
                                 <div class="box-body ">
                                    <div class="row ">
                                       <div class="col-md-9">
                                          <div class="name-add-section" style="width: 60%;">
                                           
                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Full Name : </b></label><?=$incident_cp_details->cp_name; ?><br>
                                              </div>

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Address : </b></label><?php echo $incident_cp_details->district_name." - ".$incident_cp_details->block_name." - ".$incident_cp_details->ward_gp_name; ?><br>
                                              </div>

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Police Station of the CP Residence : </b></label><?php echo $incident_cp_details->cp_police_station; ?><br>
                                              </div>

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Date of Intervention : </b></label><?php echo (new DateTime($cm_incident_details->incident_date))->format('d/m/Y'); ?><br>
                                              </div>

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Marriage Pre/day/Post : </b></label><?php echo $cm_incident_details->marriage_val; ?><br>
                                              </div>

                                             <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Marriage Prevented/Not Prevented : </b></label><?php echo $cm_incident_details->prevented_val; ?><br>
                                              </div>


                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Phone No :</b> +91-</label><?php echo $incident_cp_details->cp_phone_no; ?><br>
                                              </div> 
                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <label style=""><b>Date of Birth :</b></label><?php echo $incident_cp_details->cp_dob; ?><br>

                                                 <input type="hidden" id="hidden_dob" name="hidden_dob" value="<?php echo htmlspecialchars($incident_cp_details->cp_dob, ENT_QUOTES, 'UTF-8'); ?>">

                                              </div> 

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px; display: none;">
                                                 <input type="text" class="form-control datepicker" data-date-end-date="0d" id="dob_val" name="dob_val" value="<?php echo $incident_cp_details->cp_dob; ?>"><br>
                                              </div>

                                              <div class="" style="border-bottom: 1px solid #0002;padding-bottom: 5px;padding-top: 5px;">
                                                 <!-- <label style=""><b>Age as on date of intervention :</b></label><?php echo $incident_cp_details->inc_cp_age; ?><br> -->
                                                 <label style=""><b>Age as on date of intervention :</b></label><?php get_full_for_excel_view_for_he($cm_incident_details->incident_date, $incident_cp_details->cp_dob_new); ?><br>
                                              </div>
                                        
                                        <div class="form-group" style="margin-top: 20px;width: 50%;">
                                          <label>Date of Home Enquiry <sup style="color: #FF0000;">*</sup>:</label>
                                          <input type="text" class="form-control homeEnquiryDatepicker" id="home_enquiry_date" placeholder="Date of Home Enquiry" readonly autocomplete="off" name="home_enquiry_date" value="" style="background-color: white;" tabindex="7">
                                           <span id="hv_cp_age_error" style="color: red;"></span>
                                        </div>

                                       <div class="form-group" style="margin-top: 20px;width: 50%;">
                                          <label>Age as on date of Home Enquiry<sup style="color: #FF0000;">*</sup></label>
                                          <!-- <input type="text" class="form-control " name="hv_cp_age" id="hv_cp_age" autocomplete="off" placeholder="Age" value="" maxlength="2" readonly style="cursor: not-allowed;"> -->

                                          <input type="hidden" class="form-control " name="hv_cp_age" id="hv_cp_age" autocomplete="off" placeholder="Age" value="" maxlength="2" readonly style="cursor: not-allowed;">

                                          <input type="text" class="form-control" name="full_hv_cp_age" id="full_hv_cp_age" autocomplete="off" placeholder="Age" readonly="" style="cursor: not-allowed;">

                                        </div>

                                       </div>
                                       </div>
                                       <div class="col-md-3">
                                           
                                       <label style="float: left;">Mode of Enquiry <sup style="color: #FF0000;">*</sup></label><br>
                                      
                                          <div style="width:100%; float:right; " >
                                             <table class="table table-bordered" id="mode_of_enquiry">
                                                <?php foreach($mode_of_enquiry_details as $key => $value){ ?> 
                                                <tr style="background-color:#0002">
                                                   <td>
                                                      <span style="margin-left: 0%; background-color: ;"><b><?php echo $value['description']?></b></span>
                                                      <input style="float: right"<?=$value['sl_no'];?> type="radio" name="mode_of_enquiry" value="<?php echo $value['sl_no']?>">
                                                   </td>
                                                </tr>
                                                <?php } ?>
                                             </table>
                                          </div>
                                    
                                       <div class="row" style="">
                                       <label style="float: left;margin-right: 57px;margin-top: 15px;">Gender <sup style="color: #FF0000;">*</sup></label>
                                  
                                          <div style="width:100%; float:right; " >
                                             <?php echo form_error('gender'); ?>
                                             <table class="table table-bordered" id="gender">
                                             <?php foreach($gender_details as $key => $value){ ?> 
                                             <tr style="background-color:#0002">
                                                <td>
                                                   <?php if($value['cm_gender_master_id_pk']==$incident_cp_details->gender ) {?>
                                                   <span style="margin-left: 0%;background-color:;"><b><?php if($incident_cp_details->gender == $value['cm_gender_master_id_pk']){?><?php echo $value['description']?><?php } ?></b></span><input style="float: right; margin-right: 0%;"  type="radio" name="gender" value="<?php echo $value['cm_gender_master_id_pk']?>" <?php echo ($incident_cp_details->gender == $value['cm_gender_master_id_pk']) ?  "checked" : "" ;  ?> <?php echo ($incident_cp_details->gender == $value['cm_gender_master_id_pk']) ?  "" : "style='display:none;'disabled" ;  ?>><?php } ?>
                                                </td>
                                             </tr>
                                             <?php } ?>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                    </div>

                                    </div>
                  <div class="box-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12"> 
                              <label class="badge badge-primary text-wrap" style="width: 28rem; font-size:medium;">Assessment of Family Situation&nbsp;<font color="red">*</font></label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                           </div>
                           <div class="col-sm-2">
                              <label>Rarely </label><br>  
                           </div>
                           <div class="col-sm-2">
                              <label>Sometimes </label><br>  
                           </div>
                           <div class="col-sm-2">
                              <label>Regularly </label><br>  
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>Total family income is at least Rs.10,000 /- every month</label>
                              <samp id="family_income"></samp>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income" value="1" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income" value="2" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income"  value="3" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>Every member of the family has at least two nutritious meals a day</label><samp id="family_income"></samp> 
                               
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" class="nutritious_meals" value="1">
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" class="nutritious_meals" value="2">
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" class="nutritious_meals" value="3">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>The family get support from neighbours and community in time of need</label>
                              <samp id="neighbours_community"></samp>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="1" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="2" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="3" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>The family has some money kept aside for emergencies</label>
                              <samp id="emergencies"></samp>
                              
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="1" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="2" >
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="3" >
                           </div>
                        </div>
                     </div>
                  </div>
                              <div class="box-body">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-sm-12"> 
                                          <label class="badge badge-primary text-wrap " style="width: 9rem; font-size:medium;">Siblings</label>    
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="box-body">
                                    <div class="row">
                                       <div class="col-sm-12">
                                          <table class="table table-bordered" id="Siblings_Table_Field">
                                             <thead>
                                                <tr style="background-color: #508de2; color: #FFFFFF;">
                                                   <th rowspan="2">Name</th>
                                                   <th rowspan="2">Age</th>
                                                   <th rowspan="2" colspan="1" style="text-align: center;">Gender</th>
                                                   <th rowspan="2" colspan="1" style="text-align: center;">Married</th>
                                                   <th colspan="2" style="text-align: center;">Occupation</th>
                                                   <th rowspan="2">Action</th>
                                                </tr>
                                                <tr style="background-color: #508de2; color: #FFFFFF;">
                                                
                                                <th style="text-align: center;">In Education</th>
                                                <th style="text-align: center;">In paid work</th>
                                             </tr>
                                             </thead>
                                             <tbody></tbody>
                                             
                                          </table>
                                          <div class="text-right">
                                             <button type="button" id="siblings_Add" class="btn btn-warning form-control" style="width: 49px;margin-right: 9px;margin-top: -11px;"><i class="fa fa-plus"></i></button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                  <div class="box-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12">    
                              <label class="badge badge-primary text-wrap " style="width: 50rem; font-size:medium;">At time Home Enquiry, was the contraction party engaged in&nbsp;<font color="red">*</font></label>   
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-6">
                              <table class="table table-bordered">
                                 <tr style="background-color: #508de2; color: #FFFFFF;">
                                    <th colspan="2" style="text-align: end;">Yes</th>
                                    <th style="text-align: center;">No</th>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Education
                                    <samp id="education"></samp>  
                                    </td>

                                    
                                    <td><input type="radio" name="education" class="education" value="1"></td>
                                    <td><input type="radio" name="education" class="education" value="2" ></td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Paid work
                                    <samp id="paid_work"></samp>
                                    </td>
                                    
                                    <td><input type="radio" name="paid_work" class="paid_work" value="1" ></td>
                                    <td><input type="radio" name="paid_work" class="paid_work" value="2"></td>
                                 </tr>
                              </table>
                           </div>
                           <div class="col-sm-6">
                              <h5 style="text-align: center; margin-top: -26px;">If Yes, Frequency of Attendance</h5>
                              <table class="table table-bordered" id="documents_collected_table_field">
                                 <tr style="background-color: #508de2; color: #FFFFFF;">
                                    <th style="text-align: center;">Rarely</th>
                                    <th style="text-align: left;">Sometimes</th>
                                    <th style="text-align: center;">Regularly</th>
                                 </tr>
                                 <tr class="education_data">
                                    <td><input type="radio" name="education_frequency" class="education_frequency" value="1" ></td>

                                    <td><input type="radio" name="education_frequency" class="education_frequency"  value="2"></td>

                                    <td id="education_frequency"><input type="radio" name="education_frequency" class="education_frequency"  value="3" ></td>
                                 </tr>
                                 <tr class="paid_work_data">
                                    <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" value="1"></td>

                                    <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" value="2"></td>

                                    <td id="paid_work_frequency"><input type="radio" name="paid_work_frequency" class="paid_work_frequency" value="3" ></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
         </div>
      </div>
</section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $(document).ready(function(){
      var incidentDetailsId = $("input[name='incidentDetailsId']").val();
      siblings_table_record_loade(incidentDetailsId);
      $(document).off('submit', '#home_visit_adult_form').on('submit', '#home_visit_adult_form', function (event) {
         event.preventDefault();
         var csrf_token_value = $('input[name=csrf_cmrts]').val();
         var formName = 'home_visit_adult_form';
         var formData = new FormData($('form[name="' + formName + '"]')[0]);
         formData.append("csrf_cmrts", csrf_token_value);
         formData.append("action", "submit");
         $.ajax({
            type: 'POST',
             url: '<?php echo base_url()?>admin/reporting/home_visit/Home_visit_adult_form/create/',
             data: formData,
             processData: false,
             cache: false,
             contentType: false,
             dataType: 'JSON',
             beforeSend: function (xhr, plainObject) {
               //$('#btn_forward').html("working");
               //$('#btn_forward').attr('disabled', 'disabled');
             },
             success: function (data){
               console.log(data);
               $('input[name=csrf_cmrts]').val(data.csrf_token_value);

               if (data.formCompleteStatus) {

                  swal({
                   title: "The Home Enquiry To Adult Report has been saved in the Register",
                   type: "warning",
                   confirmButtonClass: "btn-success",
                   confirmButtonText: "Ok",
                   closeOnConfirm: false
                 }, function(isConfirm) {
                   if (isConfirm) {
                     var formName = 'home_visit_adult_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/home_visit/Home_visit_adult_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              if (data.errorFields.length == 0) {
                                 window.location.href = 'reporting/home_visit/home_visits_list/';
                              }else{
                               swal.close();  
                              }
                            }
                        });
                   }
                 });






               }else{
                  swal({
                     title: "All fields are not correctly filled in.What would you like to do?",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonClass: "btn-success",
                     confirmButtonText: "Save as Draft and return to Home Enquiry To Adult Report",
                     cancelButtonClass: "btn-primary",
                     cancelButtonText: "Save as draft and close Home Enquiry Report",
                     closeOnConfirm: false,
                     closeOnCancel: false
                    }, function(isConfirm) {
                      if (isConfirm) {
                        var formName = 'home_visit_adult_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/home_visit/Home_visit_adult_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              siblings_table_record_loade(incidentDetailsId);
                              swal.close();
                            }
                        });
                        
                      }else {

                        var formName = 'home_visit_adult_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/home_visit/Home_visit_adult_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              if (data.draftErrorFields.length == 0) {
                                 window.location.href = 'reporting/home_visit/home_visits_list/';
                              }else{
                               swal.close();  
                              }
                            }
                        });
                     } 
                    });

               }




               if (data.errorFields) {
                  $(document).find('.removeErrorMessage').remove();
                  var squareBracketsRegex = /\[[^\]]+\]/;

                  $.each(data.errorFields, function(key, value) {
                     if (squareBracketsRegex.test(key)) {
                        var fieldName = key.replace(/\]/g, '').replace(/\[/g, '-');
                        console.log(key);
                        $('[name="' + key + '"]').parent().append('<p id="' + fieldName + '-error" class="removeErrorMessage text-danger">' + value + '</p>');
                     }else{
                        var field_name = key.replace(/\[|\]/g, '');
                       $(document).find('#' + field_name).parent().append('<p  id="' + field_name + '-error" class="removeErrorMessage text-danger">' + value + '</p>');
                     }
                  });
               }
               
             }
         });
      });

   });
function siblings_table_record_loade(id){
   var url = 'reporting/home_visit/Home_visit_adult_form/siblings_table_record_loade/?id='+ id;
   $.ajax({
      url: url,
      success: function(result){
         console.log(result);
         $("#Siblings_Table_Field tbody").empty();
         $('#Siblings_Table_Field tbody').append(result);
      }
   });
}
function Cancel_Incident(){
   swal({
   title: "Any information you may have entered will not be saved. Do you want to cancel, or return to the Home Enquiry List",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-success",
   confirmButtonText: "Return to Home Enquiry To Adult Form",
   cancelButtonClass: "btn-danger",
   cancelButtonText: "Cancel",
   closeOnConfirm: true,
   closeOnCancel: false
 },
 function(isConfirm){
   if(!isConfirm){
       setTimeout(function(){
          window.location.href = "<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/";
       }, 100);
   } 
 });
}
</script>


<script type="text/javascript">
   $(document).ready(function(){
       $(".education").change(function(){
          var education = [];
          $(".education").each(function(){
             if($(this).is(":checked"))
             {
                education.push($(this).val());
             }
          });
          education_value = education.toString();
      });
      
      $(".paid_work").change(function(){
          var paid_work = [];
          $(".paid_work").each(function(){
             if($(this).is(":checked"))
             {
                paid_work.push($(this).val());
             }
          });
          paid_work_value = paid_work.toString();
      });
   });
</script>
<script type="text/javascript">
// Siblings Name validation
function Siblings_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var siblings_name_validate_error = document.getElementById("siblings_name_validate_error");
    siblings_name_validate_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        siblings_name_validate_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// Siblings Age Validation
function onlyNumbers(e,t){
    e = e || window.event;
    var charCode = e.which || e.keyCode;
    if (String.fromCharCode(charCode).match(/[0-9]/g))
        return true;
    return e.preventDefault(), false;
}
</script>
<script type="text/javascript">
   $(document).ready(function(){
      var max=50;
      var x=1;
      var rowCount = '<?=($homwvisit_siblings_dtls_count)?$homwvisit_siblings_dtls_count:0;?>';
      $('#siblings_Add').click(function(){
         if(x <= max)
         {
            
            var html = '<tr class="Siblings_Table_Field_Remove"><td><input type="text" class="form-control" name="Siblings_Details['+rowCount+'][name]" placeholder="Name" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return Siblings_Name_Validate(event);"></td><td><input type="text" class="form-control" name="Siblings_Details['+rowCount+'][age]" placeholder="Age" maxlength="2" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return onlyNumbers(event, this);"></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][sex]" id="siblings_sex" value="1">&nbsp;Male</label><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][sex]" id="siblings_sex" value="2">&nbsp;Female</label></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][marriage]" id="siblings_marriage" value="1">&nbsp;Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][marriage]" id="siblings_marriage" value="2">&nbsp;No</label></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][in_education]" id="siblings_occupation_in_education" value="1">Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][in_education]" id="siblings_occupation_in_education" value="2">No</label></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][in_paid_work]" id="siblings_occupation_in_paid_work" value="1">Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][in_paid_work]" id="siblings_occupation_in_paid_work" value="2">No</label></td><td><button type="button" class="btn btn-danger form-control siblings_Remove" data-id=""><i class="fa fa-trash"></i></button></td></tr>';


           $('#Siblings_Table_Field').append(html);
           x++;
         }
         //$('.siblings_Remove'+(rowCount-1)).hide();
         rowCount++;
      });
   
      $('#Siblings_Table_Field').on('click','.siblings_Remove',function(){
          let text = "Are you sure you want to delete this row?";
          if (confirm(text) == true) {
              $(this).closest('tr').remove();
          }
         x--;
      });
   });
</script>



<script type="text/javascript">
   $(document).ready(function(){   
      $(".education_frequency").attr('disabled', true);
      $(".paid_work_frequency").attr('disabled', true);

       var education = $("input[name='education']:checked").val();
       var paid_work = $("input[name='paid_work']:checked").val();

      if(education ==1)
      {
         $(".education_frequency").attr('disabled', false);
      }
      if(paid_work ==1)
      {
         $(".paid_work_frequency").attr('disabled', false);
      }
   
      $(document).on('change','.education',function(){
         var education=$(this).val();
         if(education==2){
            $(".education_frequency").prop('checked', false);
            $(".education_frequency").attr('disabled', true);
         }else{
            $(".education_frequency").attr('disabled', false);
         }
      });
   
     
      $(document).on('change','.paid_work',function(){
         var paid_work=$(this).val();
         if(paid_work==2){
            $(".paid_work_frequency").prop('checked', false);
            $(".paid_work_frequency").attr('disabled', true);
         }else{
            $(".paid_work_frequency").attr('disabled', false);
         }
      });
   });
   $(window).scroll(function(){
    if ($(window).scrollTop() >= 80) {
        $('.content-header').addClass('fixed-header');
        $('.form-btn').addClass('fixed-header-btn');
       
    }else {
         $('.content-header').removeClass('fixed-header');
        $('.form-btn').removeClass('fixed-header-btn');
    }
});
</script>

<script type="text/javascript">
   $(document).ready(function() {
    var dateOfBirth = '<?php echo $incident_date; ?>';
    // Parse dateOfBirth string and add one day
    var dateParts = dateOfBirth.split('-');
    var day = parseInt(dateParts[2]);
    var month = parseInt(dateParts[1]) - 1; // Months are zero-indexed
    var year = parseInt(dateParts[0]);
    var adjustedDateOfBirth = new Date(year, month, day + 1); // Adding one day
    
    var minDate = adjustedDateOfBirth; // Minimum date
    var maxDate = new Date(); // Current date

    $('.homeEnquiryDatepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: year + ':+0',
        dateFormat: 'dd/mm/yy',
        startDate: minDate,
        endDate: maxDate,
        beforeShowDay: function(date) {
            var currDate = new Date(date);
            return currDate >= minDate && currDate <= maxDate ? [true] : [false];
        }
    }).prop('readonly', true);
   });
</script>



<script type="text/javascript">
// Calculate Age At the time of Home Enquiry
function cal_age(hv_date = null,dob=null) 
{
   // alert('test');
   var hv_date = $('#home_enquiry_date').datepicker('getDate');
   var dob = $('#dob_val').datepicker('getDate');


   var ageDate = new Date(hv_date - dob);
   var newAge = Math.abs(ageDate.getUTCFullYear() - 1970);

   var months = ageDate.getUTCMonth();
   var days = ageDate.getUTCDate() - 1;

   console.log(hv_date+"--------------------"+dob);
   console.log(ageDate+"--------------------"+newAge);
   console.log(newAge+"years "+months+"month "+days+" days");

   return newAge;
}


$("input[name='home_enquiry_date']").change(function()
{
   $("#hv_cp_age_error").text('');
   var hv_date = $('#home_enquiry_date').datepicker('getDate');
   var dob = $('#dob_val').datepicker('getDate');

   if(hv_date - dob<=0)
   {

      //alert(hv_date - dob);
      $("#hv_cp_age_error").text("Please Enter Valid Home Enquiry Date to calculate Age");
   }
   else
   {
      var hv_age = cal_age();
      $("input[name='hv_cp_age']").val(hv_age);
   }

});

</script>



<script>
  $(document).ready(function () {

    $('#home_enquiry_date').change(function () {

      const home_enqry_date = $(this).val(); // Get the selected home_enqry_date in dd/mm/yyyy format
      const bate_of_birth = $('#hidden_dob').val(); // Get the selected dob in dd/mm/yyyy format

    if (home_enqry_date && bate_of_birth) { // Fix condition to check both inputs
        // Parse the dates (dd/mm/yyyy format)
        const [day1, month1, year1] = home_enqry_date.split('/').map(Number);
        const [day2, month2, year2] = bate_of_birth.split('/').map(Number);

        // Create date objects
        const he_enqry_date = new Date(year1, month1 - 1, day1);
        const dob = new Date(year2, month2 - 1, day2);

        // Calculate the differences
        let years = he_enqry_date.getFullYear() - dob.getFullYear();
        let months = he_enqry_date.getMonth() - dob.getMonth();
        let days = he_enqry_date.getDate() - dob.getDate();

        // Adjust for negative days
        if (days < 0) {
            months--;
            const prevMonth = new Date(he_enqry_date.getFullYear(), he_enqry_date.getMonth(), 0);
            days += prevMonth.getDate();
        }
        // Adjust for negative months
        if (months < 0) {
            years--;
            months += 12;
        }

        // Display the result in HTML
        $('#full_hv_cp_age').val(`${years} years ${months} months ${days} days`);
    } else {
        $('#full_hv_cp_age').val('');
    }
      
    });
  });
</script>