<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/follow-up-of-minor'); ?>
<style>
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
   input.hidden {
   position: absolute;
   visibility: hidden;
   }
   input[type="radio"] + .show-when-checked {
   display: none;
   }
   input[type="radio"]:checked + .show-when-checked {
   display: block;
   }
   fieldset > .enable-when-valid {
   background-color : gray;
   }
   fieldset:valid > .enable-when-valid {
   background-color: white;
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
   /*float: right;*/
   margin-top: 25px; 
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .btn-primary {
   margin-top: 24px; 
   margin-bottom: 30px;
   margin-right: 10px;
   }
   h2 {
   font-size: 21px !important;
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
   .showSweetAlert h2 {
      font-size: 18px !important;
    }
    .showSweetAlert button {
      font-size: 14px !important;
    }
    .showSweetAlert {
      width: 50% !important;
    }
</style>
<?php 
   $sl_no = ($follow_up_details)?$follow_up_details->sl_no:'';
   $incident_id_fk = ($follow_up_details)?$follow_up_details->incident_id_fk:'';
   $cm_incident_details = cm_incident_report_by_incident_id($incident_id_fk);
   $incident_date = ($cm_incident_details)?$cm_incident_details->incident_date:'';
?>

<?php echo form_open('admin/reporting/follow_up_visit/Follow_up_visit_form/edit/'.base64_encode($sl_no), array('class' => 'follow_up_visit_edit_form','name' => 'follow_up_visit_edit_form', 'id' => 'follow_up_visit_edit_form'))?>
<input type="hidden" name="follow_up_sl_no" value="<?=base64_encode($sl_no)?>">
<div class="content-wrapper">
   <section class="content-header"style="display:flex;justify-content: space-between;">
      <h1 style="width:33%">Follow Up of Minor</h1>
<?php //echo '<pre>';print_r($follow_up_details);die();?>
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
         <div class="form-group">
            <div class="box-body">
               <div class="row ">
                  <div class="col-md-9">

                     <div class="name-add-section" style="width: 60%;padding-top: 40px;">
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
                           <label>Date of Follow up   <sup style="color: #FF0000;">*</sup>:</label>
                           <?php 

                              $followup_date = ($follow_up_details->followup_date)?$follow_up_details->followup_date:'';
                            ?>

                           <input type="text" class="form-control homeEnquiryDatepicker" id="followup_date" placeholder="Date of Follow up " readonly autocomplete="off" name="followup_date" value="<?php echo $followup_date; ?>" style="background-color: white;" tabindex="7">
                            <span id="hv_cp_age_error" style="color: red;"></span>
                         </div>

                            <?php 

                              $age_on_folllowup = ($follow_up_details->age_on_folllowup)?$follow_up_details->age_on_folllowup:'';
                            ?>
                        <div class="form-group" style="margin-top: 20px;width: 50%;">
                           <label>Age as on date of Follow up <sup style="color: #FF0000;">*</sup></label>
                           <input type="hidden" class="form-control " name="age_on_folllowup" id="age_on_folllowup" autocomplete="off" placeholder="Age" value="<?php echo $age_on_folllowup; ?>" maxlength="2" readonly style="cursor: not-allowed;">
                           <input type="text" class="form-control" name="full_age_on_folllowup" id="full_age_on_folllowup" autocomplete="off" placeholder="Age" readonly="" style="cursor: not-allowed;">
                         </div>
                     </div>
                  </div>
                  <div class="col-md-3" style="float: right;padding-top: 40px;">
                     <label style="float: left;margin-right: 100px;">Mode of Enquiry <sup style="color: #FF0000;">*</sup></label><br>
                     <div class=""style="">
                        <div style="width: 100%; margin-right: 100px;" >
                           <table class="table table-bordered" id="mode_of_enquiry">
                              <?php foreach($mode_of_enquiry_details as $key => $value){ ?> 
                              <tr style="background-color:#0002">
                                 <td>
                                    <span style="margin-left: 0%; background-color: ; "><b><?php echo $value['description']?></b></span><input <?=($follow_up_details->mode_of_enquiry==$value['sl_no'])?'checked':''?>  style="float: right" type="radio" name="mode_of_enquiry"  value="<?php echo $value['sl_no']?>">
                                 </td>
                              </tr>
                              <?php } ?>
                           </table>
                        </div>
                     </div>

                     <div class="row">
                        <label style="margin-top: 30px;">Gender <sup style="color: #FF0000;">*</sup></label><br>
                        <div class="col-sm-12">
                           <div style="width:100%; float:right;" >
                              <table class="table table-bordered" id="gender">
                              <?php foreach($gender_details as $key => $value){ ?> 
                              <tr style="background-color:#0002">
                                 <td>
                                    <?php if($value['cm_gender_master_id_pk'] == $incident_cp_details->gender ) {?>
                                    <span style="margin-left: 0%;background-color:;"><b><?php if($incident_cp_details->gender == $value['cm_gender_master_id_pk']){?><?php echo $value['description']?><?php } ?></b></span><input style="float: right; margin-right: 0%;"  type="radio" name="gender"  value="<?php echo $value['cm_gender_master_id_pk']?>" <?php echo ($incident_cp_details->gender == $value['cm_gender_master_id_pk']) ?  "checked" : "" ;  ?> <?php echo ($incident_cp_details->gender == $value['cm_gender_master_id_pk']) ?  "" : "style='display:none;'disabled" ;  ?>><?php } ?>
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
         </div>
         <div class="box-body">
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-12"> 
                     <label class="badge badge-primary text-wrap " style="width: 18rem; font-size:medium;">Minor is enrolled in&nbsp;<font color="red">*</font></label> 
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="box-body">
               <div class="row">
                  <div class="col-sm-6">
                     <table class="table table-bordered">
                        <tr style="background-color: #508de2; color: #FFFFFF;">
                           <th colspan="2" style="text-align: end;">Yes</th>
                           <th style="text-align: center;">No</th>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Education<samp id="education"></samp></td>
                           <td><input type="radio" name="education" class="education" value="1" <?=($follow_up_details->education==1)?'checked':''?>></td>
                           <td><input type="radio" name="education" class="education" value="2" <?=($follow_up_details->education==2)?'checked':''?>></td> 
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Kishori Group<samp id="kishori_group"></samp></td>
                           <td><input type="radio" name="kishori_group" class="kishori_group" value="1" <?=($follow_up_details->kishori_group==1)?'checked':''?>></td>
                           <td><input type="radio" name="kishori_group" class="kishori_group" value="2" <?=($follow_up_details->kishori_group==2)?'checked':''?>></td>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Paid work<samp id="paid_work"></samp></td>
                           <td><input type="radio" name="paid_work" class="paid_work" value="1" <?=($follow_up_details->paid_work==1)?'checked':''?>></td>
                           <td><input type="radio" name="paid_work" class="paid_work" value="2" <?=($follow_up_details->paid_work==2)?'checked':''?>></td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-sm-6">
                     <h5 style="text-align: center; margin-top: -26px;">If Yes, Frequency of Attendance</h5>
                     <table class="table table-bordered" id="documents_collected_table_field">
                        <tr style="background-color: #508de2; color: #FFFFFF;">
                           <th style="text-align: center;">Rarely</th>
                           <th style="text-align: center;">Sometimes</th>
                           <th style="text-align: center;">Regularly</th>
                        </tr>
                        <tr class="education_data">
                           <td><input type="radio" name="education_frequency" class="education_frequency" value="1" <?=($follow_up_details->education_frequency==1)?'checked':''?>></td>

                           <td><input type="radio" name="education_frequency" class="education_frequency" value="2" <?=($follow_up_details->education_frequency==2)?'checked':''?>></td>

                           <td id="education_frequency"><input type="radio" name="education_frequency" class="education_frequency" value="3" <?=($follow_up_details->education_frequency==3)?'checked':''?>></td>
                        </tr>
                        
                        <tr class="kishori_group_data">
                           <td><input type="radio" name="kishori_group_frequency" class="kishori_group_frequency" value="1" <?=($follow_up_details->kishori_group_frequency==1)?'checked':''?>></td>

                           <td><input type="radio" name="kishori_group_frequency" class="kishori_group_frequency" value="2" <?=($follow_up_details->kishori_group_frequency==2)?'checked':''?>></td>

                           <td id="kishori_group_frequency"><input type="radio" name="kishori_group_frequency"  class="kishori_group_frequency" value="3" <?=($follow_up_details->kishori_group_frequency==3)?'checked':''?>></td>
                        </tr>
                        <tr class="paid_work_data">
                           <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" value="1" <?=($follow_up_details->paid_work_frequency==1)?'checked':''?>></td>

                           <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" value="2" <?=($follow_up_details->paid_work_frequency==2)?'checked':''?>></td>

                           <td id="paid_work_frequency"><input type="radio" name="paid_work_frequency"  class="paid_work_frequency" value="3" <?=($follow_up_details->paid_work_frequency==3)?'checked':''?>></td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>

         <div class="box-body">
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-12"> 
                     <label class="badge badge-primary text-wrap " style="width: 22rem; font-size:medium;">Minor feels supported by&nbsp;<font color="red">*</font></label>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="box-body">
               <div class="row">
                  <div class="col-sm-12">
                     <table class="table table-bordered">
                        <tr style="background-color: #508de2; color: #FFFFFF;">
                           <th colspan="2" style="text-align: end;">Rarely</th>
                           <th style="text-align: center;">Sometimes</th>
                           <th style="text-align: center;">Regularly</th>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Parents<samp id="parents_supported"></samp></td>
                           <td><input type="radio" name="parents_supported" value="1" <?=($follow_up_details->parents_supported==1)?'checked':''?>></td>

                           <td><input type="radio" name="parents_supported" value="2" <?=($follow_up_details->parents_supported==2)?'checked':''?>></td>

                           <td><input type="radio" name="parents_supported" value="3" <?=($follow_up_details->parents_supported==3)?'checked':''?>></td>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Family elders<samp id="family_elders_supported"></td>
                           <td><input type="radio" name="family_elders_supported" value="1" <?=($follow_up_details->family_elders_supported==1)?'checked':''?>></td>

                           <td><input type="radio" name="family_elders_supported" value="2" <?=($follow_up_details->family_elders_supported==2)?'checked':''?>></td>

                           <td><input type="radio" name="family_elders_supported" value="3" <?=($follow_up_details->family_elders_supported==3)?'checked':''?>></td>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Peers<samp id="peers_supported"></td>
                           <td><input type="radio" name="peers_supported" value="1" <?=($follow_up_details->peers_supported==1)?'checked':''?>></td>

                           <td><input type="radio" name="peers_supported" value="2" <?=($follow_up_details->peers_supported==2)?'checked':''?>></td>

                           <td><input type="radio" name="peers_supported" value="3" <?=($follow_up_details->peers_supported==3)?'checked':''?>></td>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Neighbours<samp id="neighbours_supported"></td>
                           <td><input type="radio" name="neighbours_supported" value="1" <?=($follow_up_details->neighbours_supported==1)?'checked':''?>></td>

                           <td><input type="radio" name="neighbours_supported" value="2" <?=($follow_up_details->neighbours_supported==2)?'checked':''?>></td>

                           <td><input type="radio" name="neighbours_supported" value="3" <?=($follow_up_details->neighbours_supported==3)?'checked':''?>></td>
                        </tr>
                        <tr>
                           <td style="text-align: left; font-weight: bold;">Others<samp id="others_supported"></td>
                           <td><input type="radio" name="others_supported" value="1" <?=($follow_up_details->others_supported==1)?'checked':''?>></td>

                           <td><input type="radio" name="others_supported" value="2" <?=($follow_up_details->others_supported==2)?'checked':''?>></td>

                           <td><input type="radio" name="others_supported" value="3" <?=($follow_up_details->others_supported==3)?'checked':''?>></td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php if($incident_cp_details->gender ==2){?>
         <div class="box-body minor_pregnant_div">
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-6">
                     <label>Minor is pregnant? <sup style="color: #FF0000">*</sup></label>&nbsp;&nbsp; 
                     <label class="radio-inline"><input name="minor_pregnant" class="minor_pregnant" type="radio" value="1" <?=($follow_up_details->minor_pregnant==1)?'checked':''?>>&nbsp;Yes</label>&nbsp;&nbsp;

                     <label class="radio-inline"><input name="minor_pregnant" class="minor_pregnant" type="radio" value="2" <?=($follow_up_details->minor_pregnant==2)?'checked':''?>>&nbsp;No</label>&nbsp;&nbsp;

                     <samp id="minor_pregnant"></samp>
                  </div>
                  <div class="col-sm-6 stage_of_pregnancy">
                     <label>Stage of pregnancy (Trimester) <sup style="color: #FF0000">*</sup></label>&nbsp;&nbsp;  
                     <?php foreach($pregnancy_details as $value){?>
                     <label class="radio-inline"><input name="stage_of_pregnancy" class="stage_of_pregnancy_cls" type="radio" value="<?php echo $value['sl_no']?>" <?=($follow_up_details->stage_of_pregnancy==$value['sl_no'])?'checked':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                     <?php } ?>
                     <samp id="stage_of_pregnancy"></samp>
                  </div>
               </div>
            </div>
         </div>
       <?php } ?>
         
         
         <div class="box-body">
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-12">
                     <label>Remarks, if any <span >(NOTE: max 100 characters)</span></label>  
                     <textarea rows="3" class="form-control" maxlength="100" placeholder="Write Remarks" name="remarks"><?=($follow_up_details->remarks)?$follow_up_details->remarks:''?></textarea>
                     <samp id="remarks"></samp>                       
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="box bottom-box" style="text-align: center;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
         </div> -->
      </div>
</div>
</section>
<!-- Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $(document).ready(function(){
      var gender = $("input[name='gender']:checked").val();
      if(gender==1){
         $('.minor_pregnant_div').hide();
      }
      

      $(document).off('submit', '#follow_up_visit_edit_form').on('submit', '#follow_up_visit_edit_form',function (event) {
         event.preventDefault();
         var csrf_token_value = $('input[name=csrf_cmrts]').val();
         var formName = 'follow_up_visit_edit_form';
         var formData = new FormData($('form[name="' + formName + '"]')[0]);
         formData.append("csrf_cmrts", csrf_token_value);
         formData.append("action", "submit");
         $.ajax({
            type: 'POST',
             url: '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visit_form/edit_from_update/',
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
                   title: "The Follow Up Report has been saved in the Register",
                   type: "warning",
                   confirmButtonClass: "btn-success",
                   confirmButtonText: "Ok",
                   closeOnConfirm: false
                 }, function(isConfirm) {
                   if (isConfirm) {
                     var formName = 'follow_up_visit_edit_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visit_form/edit_from_update/',
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
                                 window.location.href = 'reporting/follow_up_visit/follow_up_visits_list/';
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
                     confirmButtonText: "Save as Draft and return to Follow Up Report",
                     cancelButtonClass: "btn-primary",
                     cancelButtonText: "Save as draft and close Follow Up Report",
                     closeOnConfirm: false,
                     closeOnCancel: false
                    }, function(isConfirm) {
                      if (isConfirm) {
                        var formName = 'follow_up_visit_edit_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visit_form/edit_from_update/',
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
                              swal.close();
                            }
                        });
                        
                      }else {

                        var formName = 'follow_up_visit_edit_form';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visit_form/edit_from_update/',
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
                                 window.location.href = 'reporting/follow_up_visit/follow_up_visits_list/';
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





   /*$("#follow_up_visit_form").submit(function(e) {
     e.preventDefault();
     var form = this;
     swal({
       title: "Please take a moment to verify your input, After submit this form cannot be edited!",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-success",
       confirmButtonText: "Submit",
       cancelButtonClass: "btn-danger",
       cancelButtonText: "Cancel",
       closeOnConfirm: false,
       closeOnCancel: false,
       showLoaderOnConfirm: true
     }, function(isConfirm) {
       if (isConfirm) {
          form.submit();
       }else {
          swal("Cancelled", "Form submit cancelled", "error");
      } 
     });
   });
*/

   function Cancel_Incident(){
   swal({
   title: "Any information you may have entered will not be saved. Do you want to cancel, or return to the Follow Up List",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-success",
   confirmButtonText: "Return to Follow Up",
   cancelButtonClass: "btn-danger",
   cancelButtonText: "Cancel",
   closeOnConfirm: true,
   closeOnCancel: false
 },
 function(isConfirm){
   if(!isConfirm){
       setTimeout(function(){
          window.location.href = "<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/";
       }, 100);
   } 
 });
}
</script>
<script type="text/javascript">
   $(document).on('click','#intermediary_involved_marriag_block',function(){
      if($( "#intermediary_involved_marriag_district option:selected" ).val()!="")
      {
         var id=$('#intermediary_involved_marriag_district').val()
         $.ajax({
             url:'<?php echo base_url()?>admin/prevention_enquery/prevention_enquery_form/getBlockById',
             type:'GET',
             data:{'id':id}, 
             dataType: 'json',
             success: function(data)
             {
                $('#intermediary_involved_marriag_block').html('');
                data.forEach(element =>$("#intermediary_involved_marriag_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
                var v=$( "#intermediary_involved_marriag_block option:selected" ).val();
             }
         });
      }
   });
   $(document).on('change','#intermediary_involved_marriag_district',function(){
      $('#intermediary_involved_marriag_block').html('');
      if($('#intermediary_involved_marriag_block').val()!=""){
          $('#intermediary_involved_marriag_block').append('<option disabled="" selected="">--SELECT SD/BLOCK--</option>');
      }
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
      var html='<tr class="Siblings_Table_Field_Remove"><td><input type="text" class="form-control" name="name[]" placeholder="Name"></td><td><input type="text" class="form-control" name="name[]" placeholder="Age"></td><td><input type="text" class="form-control" name="name[]" placeholder="Sex"></td><td><input type="checkbox" name="in_education[]" value="1">&nbsp;In education</td><td><input type="checkbox" name="in_paid_work[]" value="2">&nbsp;In Paid work</td><td><button type="button" id="Siblings_Remove" class="btn btn-danger form-control"><i class="fa fa-minus"></i></button></td></tr>';
      var max=50;
      var x=1;
      $('#Siblings_Add').click(function(){
         if(x <= max)
         {
           $('#Siblings_Table_Field').append(html);
           x++;
         }
      });
   
      $('#Siblings_Table_Field').on('click','#Siblings_Remove',function(){
         let text = "Are you sure you want to delete this element?";
         if (confirm(text) == true) {
              $(this).closest('.Siblings_Table_Field_Remove').remove();
         }
         x--;
      });
   
      $(".disability_div").hide();
       $(".disability").change(function(){
          var disability = [];
          $(".disability").each(function(){
             if($(this).is(":checked"))
             {
                disability.push($(this).val());
             }
          });
          disability_value = disability.toString();
          if(disability_value == '1'){
             $(".disability_div").show();
          }else{
             $(".disability_div").hide();
          }
      });
   
      $(".disability_percent_div").hide();
       $(".disability_certificate").change(function(){
          var disability_certificate = [];
          $(".disability_certificate").each(function(){
             if($(this).is(":checked"))
             {
                disability_certificate.push($(this).val());
             }
          });
          disability_certificate_value = disability_certificate.toString();
          if(disability_certificate_value == '1'){
             $(".disability_percent_div").show();
          }else{
             $(".disability_percent_div").hide();
          }
      });
   
      $(".stage_of_pregnancy").hide();
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
   
      $(".kishori_group").change(function(){
          var kishori_group = [];
          $(".kishori_group").each(function(){
             if($(this).is(":checked"))
             {
                kishori_group.push($(this).val());
             }
          });
          kishori_group_value = kishori_group.toString();
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
   
      $(".minor_pregnant").change(function(){
          var minor_pregnant = [];
          $(".minor_pregnant").each(function(){
             if($(this).is(":checked"))
             {
                minor_pregnant.push($(this).val());
             }
          });
          minor_pregnant_value = minor_pregnant.toString();
          if(minor_pregnant_value == '1'){
             $(".stage_of_pregnancy").show();
          }else{
            $(".stage_of_pregnancy_cls").prop('checked', false);
             $(".stage_of_pregnancy").hide();
            
          }
      });
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){ 
      $(".education_frequency").attr('disabled', true);
      $(".kishori_group_frequency").attr('disabled', true);
      $(".paid_work_frequency").attr('disabled', true);
      var education = $("input[name='education']:checked").val();

      var minor_pregnant = $("input[name='minor_pregnant']:checked").val();
      if(minor_pregnant == '1'){
             $(".stage_of_pregnancy").show();
      }



      if(education==1){
         $(".education_frequency").attr('disabled', false);
      }
      var kishori_group = $("input[name='kishori_group']:checked").val();
      if(kishori_group==1){
         $(".kishori_group_frequency").attr('disabled', false);
      }
      var paid_work = $("input[name='paid_work']:checked").val();
      if(paid_work==1){
         $(".paid_work_frequency").attr('disabled', false);
      }

      
      
   
      $(document).on('change','.education',function(){
         //alert($(this).val());
         var education=$(this).val();
         if(education==2)
         {
            $(".education_frequency").prop('checked', false);
            $(".education_frequency").attr('disabled', true);
         }
         else{
            $(".education_frequency").attr('disabled', false);
         }
      });
   
      $(document).on('change','.kishori_group',function(){
         //alert($(this).val());
         var kishori_group=$(this).val();
         if(kishori_group==2)
         {
            $(".kishori_group_frequency").prop('checked', false);
            $(".kishori_group_frequency").attr('disabled', true);
         }
         else{
            $(".kishori_group_frequency").attr('disabled', false);
         }
   
      });
   
      $(document).on('change','.paid_work',function(){
         var paid_work=$(this).val();
         if(paid_work==2)
         {
            $(".paid_work_frequency").prop('checked', false);
            $(".paid_work_frequency").attr('disabled', true);
         }
         else{
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
   var hv_date = $('#followup_date').datepicker('getDate');
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


$("input[name='followup_date']").change(function()
{
   $("#hv_cp_age_error").text('');
   var hv_date = $('#followup_date').datepicker('getDate');
   var dob = $('#dob_val').datepicker('getDate');

   if(hv_date - dob<=0)
   {

      //alert(hv_date - dob);
      $("#hv_cp_age_error").text("Please Enter Valid Home Enquiry Date to calculate Age");
   }
   else
   {
      var hv_age = cal_age();
      $("input[name='age_on_folllowup']").val(hv_age);
   }

});

</script>

<script>
  $(document).ready(function () {

    $('#followup_date').change(function () {

      const followup_date = $(this).val(); // Get the selected followup_date in dd/mm/yyyy format
      const bate_of_birth = $('#hidden_dob').val(); // Get the selected dob in dd/mm/yyyy format

    if (followup_date && bate_of_birth) { // Fix condition to check both inputs
        // Parse the dates (dd/mm/yyyy format)
        const [day1, month1, year1] = followup_date.split('/').map(Number);
        const [day2, month2, year2] = bate_of_birth.split('/').map(Number);

        // Create date objects
        const fu_date = new Date(year1, month1 - 1, day1);
        const dob = new Date(year2, month2 - 1, day2);

        // Calculate the differences
        let years  = fu_date.getFullYear() - dob.getFullYear();
        let months = fu_date.getMonth() - dob.getMonth();
        let days   = fu_date.getDate() - dob.getDate();

        // Adjust for negative days
        if (days < 0) {
            months--;
            const prevMonth = new Date(fu_date.getFullYear(), fu_date.getMonth(), 0);
            days += prevMonth.getDate();
        }
        // Adjust for negative months
        if (months < 0) {
            years--;
            months += 12;
        }

        // Display the result in HTML
        $('#full_age_on_folllowup').val(`${years} years ${months} months ${days} days`);
    } else {
        $('#full_age_on_folllowup').val('');
    }
      
    });
  });
</script>