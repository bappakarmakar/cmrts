<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
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
</style>
<div class="content-wrapper">
<section class="content-header">
   <h1>Home Visit to Adult</h1>
   <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
   </ol>
</section>
<section class="content">
   <?php 
      $last = $this->uri->total_segments();
      $record_num_1 = $this->uri->segment(5);
      $record_num_2 = $this->uri->segment(6);
      $record_num_3 = $this->uri->segment(7);
      ?>
   <?php $this->load->view('errors/message'); ?>
   <div class="box bottom-box">
      <?php echo form_open('admin/reporting/incident/incident_list/home_visit_adult_form/'.$record_num_1.'/'.$record_num_2.'/'.$record_num_3, array('class' => 'home_visit_adult_form', 'name' => 'home_visit_adult_form', 'id' => 'home_visit_adult_form'))?>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-default">
               <div class="card-body p-0">
                  <div class="form-group">
                     <div class="box-body" >
                        <div class="row" style="">
                           <label style="float: right;margin-right: 85px;">Mode of Enquiry <sup style="color: #FF0000;">*</sup></label><br>
                           <div class="col-sm-12">
                              <div style="width:15%; float:right;margin-right: 45px;">
                              <?php echo form_error('mode_of_enquiry'); ?>
                                 <table class="table table-bordered">
                                    <?php foreach($mode_of_enquiry_details as $key => $value){ ?> 
                                    <tr style="background-color: #d9d9d9;">
                                       <td>
                                          <span style="margin-left: 0%; background-color: #d9d9d9 ; "><b><?php echo $value['description']?></b></span><input style="float: right" type="radio" name="mode_of_enquiry" id="mode_of_enquiry" value="<?php echo $value['sl_no']?>" <?php echo set_radio('mode_of_enquiry', $value['sl_no']); ?>>
                                       </td>
                                    </tr>
                                    <?php } ?>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                           <label style="float: right;margin-right: 120px;margin-top: 8px;">Gender <sup style="color: #FF0000;">*</sup></label>
                           <div class="col-sm-12">
                              <div style="width:15%; float:right;margin-right: 45px;">
                                 <?php echo form_error('gender'); ?>
                                 <table class="table table-bordered">
                                    <?php foreach($gender_details as $key => $value){ ?> 
                                    <tr>
                                       <td>
                                          <?php if($value['cm_gender_master_id_pk'] == $incident_home_visit_details->gender ){?>
                                          <span style="margin-left: 0%;background-color:;"><b><?php if($incident_home_visit_details->gender == $value['cm_gender_master_id_pk']){?><?php echo $value['description']?><?php } ?></b></span><input style="float: right; margin-right: 0%;"  type="radio" name="gender" id="gender" value="<?php echo $value['cm_gender_master_id_pk']?>" <?php echo ($incident_home_visit_details->gender == $value['cm_gender_master_id_pk']) ?  "checked" : "" ;  ?> <?php echo ($incident_home_visit_details->gender == $value['cm_gender_master_id_pk']) ?  "" : "style='display:none;'disabled" ;  ?>> <?php } ?>
                                       </td>
                                    </tr>
                                    <?php } ?>
                                 </table>
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
                              <?php echo form_error('family_income'); ?>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income" id="family_income" value="1" <?php echo set_radio('family_income', 1); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income" id="family_income" value="2" <?php echo set_radio('family_income', 2); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="family_income" id="family_income" value="3" <?php echo set_radio('family_income', 3); ?>>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>Every member of the family has at least two nutritious meals a day</label>
                              <?php echo form_error('nutritious_meals'); ?>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" id="nutritious_meals" value="1" <?php echo set_radio('nutritious_meals', 1); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" id="nutritious_meals" value="2" <?php echo set_radio('nutritious_meals', 2); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="nutritious_meals" id="nutritious_meals" value="3" <?php echo set_radio('nutritious_meals', 3); ?>>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>The family get support from neighbours and community in time of need</label>
                              <?php echo form_error('neighbours_community'); ?>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="1" <?php echo set_radio('neighbours_community', 1); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="2" <?php echo set_radio('neighbours_community', 2); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="neighbours_community" id="neighbours_community" value="3" <?php echo set_radio('neighbours_community', 3); ?>>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <label>The family has some money kept aside for emergencies</label>
                              <?php echo form_error('emergencies'); ?>   
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="1" <?php echo set_radio('emergencies', 1); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="2" <?php echo set_radio('emergencies', 2); ?>>
                           </div>
                           <div class="col-sm-2">
                              <input type="radio" name="emergencies" id="emergencies" value="3" <?php echo set_radio('emergencies', 3); ?>>
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
                                 <tr style="background-color: #508de2; color: #FFFFFF;">
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th colspan="2" style="text-align: center;">Gender</th>
                                    <th colspan="2" style="text-align: center;">Occupation</th>
                                    <th>Action</th>
                                 </tr>
                                 <?php 
                                 $count = 0;
                                 $query[0] = array ( 
                                    "name" => "",
                                    "age" => "",
                                    "sex" => "",
                                    "occupation" => "",
                                 );
                                 $queryArray = ($this->input->post('Siblings_Details'))?set_value('Siblings_Details'):$query;
                                 foreach($queryArray as $key => $value){$count ++;
                                 ?>
                                 <tr>
                                    <td><input type="text" class="form-control" name="Siblings_Details[<?php echo $key ?>][name]" placeholder="Name" autocomplete="off" value="<?php echo $value['name']; ?>" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return Siblings_Name_Validate(event);">
                                    <span id="siblings_name_validate_error" style="color: red;float: left;"></span></td>

                                    <td><input type="text" class="form-control" name="Siblings_Details[<?php echo $key ?>][age]" placeholder="Age" maxlength="2" autocomplete="off" value="<?php echo $value['age']; ?>" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return onlyNumbers(event, this);">
                                    <span id="age_validate_error" style="color: red;float: left;"></span>
                                    </td>

                                    <td><label class="radio-inline"><input type="radio" name="Siblings_Details[<?= $key?>][sex]" id="siblings_sex" value="1" <?php if(isset($value['sex'])){ if($value['sex'] == 1){ echo "checked"; } } ?>>&nbsp;Male</label></td>

                                    <td><label class="radio-inline"><input type="radio" name="Siblings_Details[<?= $key?>][sex]" id="siblings_sex" value="2" <?php if(isset($value['sex'])){ if($value['sex'] == 2){ echo "checked"; } } ?>>&nbsp;Female</label></td>

                                    <td><label class="radio-inline"><input type="checkbox" name="Siblings_Details[<?=$key?>][occupation][0]" id="siblings_occupation" value="1" <?php if(isset($value['occupation'][0])){ if($value['occupation'][0] == 1){ echo "checked"; } } ?>> In education</label></td>

                                    <td><label class="radio-inline"><input type="checkbox" name="Siblings_Details[<?=$key?>][occupation][1]" id="siblings_occupation" value="2" <?php if(isset($value['occupation'][1])){ if($value['occupation'][1] == 2){ echo "checked"; } } ?>> In Paid work</label></td>

                                    <td>
                                       <?php if($this->input->post('Siblings_Details')){ ?> 
                                       <button type="button" id="siblings_Remove_new" class="btn btn-danger form-control" ><i class="fa fa-trash"></i></button>
                                       <?php }else{ ?>
                                       <button type="button" id="siblings_Remove" class="btn btn-danger form-control" fdprocessedid="ebpxyn"><i class="fa fa-trash"></i></button>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              <?php } ?>
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
                              <label class="badge badge-primary text-wrap " style="width: 50rem; font-size:medium;">At time of incident, was the contraction party engaged in&nbsp;<font color="red">*</font></label>   
                              <?php echo form_error('education_frequency'); ?>
                              <?php echo form_error('paid_work_frequency'); ?>
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
                                    <?php echo form_error('education'); ?> 
                                    </td>
                                    <td><input type="radio" name="education" class="education" value="1" <?php echo set_radio('education', 1); ?>></td>
                                    <td><input type="radio" name="education" class="education" value="2" <?php echo set_radio('education', 2); ?>></td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Paid work
                                    <?php echo form_error('paid_work'); ?>
                                    </td>
                                    <td><input type="radio" name="paid_work" class="paid_work" value="1" <?php echo set_radio('paid_work', 1); ?>></td>
                                    <td><input type="radio" name="paid_work" class="paid_work" value="2" <?php echo set_radio('paid_work', 2); ?>></td>
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
                                    <td><input type="radio" name="education_frequency" class="education_frequency" id="education_frequency" value="1" <?php echo set_radio('education_frequency', 1); ?>></td>

                                    <td><input type="radio" name="education_frequency" class="education_frequency" id="education_frequency" value="2" <?php echo set_radio('education_frequency', 2); ?>></td>

                                    <td><input type="radio" name="education_frequency" class="education_frequency" id="education_frequency" value="3" <?php echo set_radio('education_frequency', 3); ?>></td>
                                 </tr>
                                 <tr class="paid_work_data">
                                    <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" id="paid_work_frequency" value="1" <?php echo set_radio('paid_work_frequency', 1); ?>></td>

                                    <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" id="paid_work_frequency" value="2" <?php echo set_radio('paid_work_frequency', 2); ?>></td>

                                    <td><input type="radio" name="paid_work_frequency" class="paid_work_frequency" id="paid_work_frequency" value="3" <?php echo set_radio('paid_work_frequency', 3); ?>></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box bottom-box" style="text-align: center;">
                     <button type="submit" class="btn btn-primary" style="margin-top: 16px; margin-bottom: 20px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
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
   $("#home_visit_adult_form").submit(function(e) {
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
      var rowCount = ($('#Siblings_Table_Field >tbody >tr').length)-1;
      $('#siblings_Add').click(function(){
         if(x <= max)
         {
            var html='<tr class="Siblings_Table_Field_Remove"><td><input type="text" class="form-control" name="Siblings_Details['+rowCount+'][name]" placeholder="Name" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return Siblings_Name_Validate(event);"></td><td><input type="text" class="form-control" name="Siblings_Details['+rowCount+'][age]" placeholder="Age" maxlength="2" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return onlyNumbers(event, this);"></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][sex]" id="siblings_sex" value="1">&nbsp;Male</label></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['+rowCount+'][sex]" id="siblings_sex" value="2">&nbsp;Female</label></td><td><label class="radio-inline"><input type="checkbox" name="Siblings_Details['+rowCount+'][occupation]['+0+']" id="siblings_occupation" value="1">&nbsp;In education</label></td><td><label class="radio-inline"><input type="checkbox" name="Siblings_Details['+rowCount+'][occupation]['+1+']" id="siblings_occupation" value="2">&nbsp;In Paid work</label></td><td><button type="button" id="siblings_Remove" class="btn btn-danger form-control"><i class="fa fa-trash"></i></button></td></tr>'
           $('#Siblings_Table_Field').append(html);
           x++;
         }
         rowCount++;
      });
   
      $('#Siblings_Table_Field').on('click','#siblings_Remove',function(){
          let text = "Are you sure you want to delete this element?";
          if (confirm(text) == true) {
              $(this).closest('tr').remove();
          }
         x--;
      });
      $('#Siblings_Table_Field').on('click','#siblings_Remove_new',function(){
          let text = "Are you sure you want to delete this element?";
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
</script>