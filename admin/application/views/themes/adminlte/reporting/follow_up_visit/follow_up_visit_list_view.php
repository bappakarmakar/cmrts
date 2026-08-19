<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
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
   .ttext {
      text-align: left !important;
   }
   .action_menu {
      box-shadow: none;
      border-color: #12386e;
      background: #12386e;
    }
    .dropdown-menu>li>a {
      display: block;
      padding: 3px 12px;
      clear: both;
      font-weight: 400;
      line-height: 1.42857143;
      color: #fff;
      white-space: nowrap;
    }
    .btn-action {
      color: #fff;
      background-color: #12386e;
      border-color: #12386e;
    }
    .btn-action:hover {
      color: #fff;
    }
   .count_one {
      width: 22.5%;
      display: inline-block;
      border-radius: 6px;
      background: #00ccff;
      padding: 20px 10px;
      margin: 0 12px;
      vertical-align: middle;
    }
    .count_two {
      width: 22.5%;
      display: inline-block;
      border-radius: 6px;
      background: #339933;
      padding: 20px 10px;
      margin: 0 12px;
      vertical-align: middle;
    }
    .count_three {
      width: 22.5%;
      display: inline-block;
      border-radius: 6px;
      background: #e6b800;
      padding: 7px 10px;
      margin: 0 12px;
      vertical-align: middle;
    }
    .count_four {
      width: 22.5%;
      display: inline-block;
      border-radius: 6px;
      background: #dd4b39;
      padding: 20px 10px;
      margin: 0 12px;
      vertical-align: middle;
    }
    .count_content .title {
      font-size: 17px;
      font-weight: normal;
      display: block;
    }
    th {
      font-size: 11px;
    }
    td {
      font-size: 12px;
    }
    .modal_table {
      background: #339933;
      color: #FFFFFF;
    }
    .modal_incident {
      background: #085876;
      color: #fff;
    }
    .dataTables_length {
      display: block;
      max-width: 100%;
      margin-bottom: 5px;
      font-weight: 700;
    }
    .dataTables_info {
      display: none;
    }
    .dataTables_paginate {
      display: block;
    }
    .table {
      display: table;
      border-collapse: collapse;
    }
    .table .tr {
      display: table-row;
      border: 1px solid #ddd;
    }
    .table .tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .table .tr .td {
      display: table-cell;
      padding: 8px;
      border-left: 1px solid #ddd;
    }
    .table .tr .td:first-child {
      border-left: 0;
    }
    .div-table .title,
    .table-tag .title {
      text-align: center;
      padding-bottom: 0.5em;
      font-size: 19px;
      font-weight: bold;
    }
    .datepicker {
      background: #fff;
    }
    .error {
      color: #a94442;
    }
    .fa-arrow-down {
        margin-left: 430px;
    }
    .custom-modal-header {
      background: #12386e;
    }
    .close {
      border-radius: 50px;
      background: #ffffff !important;
      width: 28px;
      height: 27px;
      color: red;
    }
    .dataTables_filter {
      display: block;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Follow-Up Visit Register</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
        <div id="date_div">
            <form id="advanced_search_form">
               <div class="box-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-4">
                           <label>From Date (dd/mm/yyyy) <font color="red">*</font></label>
                           <input type="text" class="form-control datepicker" data-date-end-date="0d" id="start_date" placeholder="Start Date" readonly autocomplete="off" name="incident_date" value="<?php echo set_value('incident_date'); ?>" style="background-color: white;" tabindex="7">
                        </div>
                        <div class="col-sm-4">
                           <label>To Date (dd/mm/yyyy) <font color="red">*</font></label>
                           <input type="text" class="form-control datepicker" data-date-end-date="0d" id="end_date" placeholder="End Date" readonly autocomplete="off" name="incident_date" value="<?php echo set_value('incident_date'); ?>" style="background-color: white;" tabindex="7">
                        </div>
                        <div class="col-sm-4">
                           <button type="submit" id="search_btn" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                           <button type="button" id="reset_btn" class="btn btn-danger" style="margin-top: 25px;"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>

         <!-- <a href="<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_print" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;margin-bottom: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a> -->

         <a href="<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>

         <a href="<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_print" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;margin-bottom: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a>

         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Age at Intervention</th>

                     <th class="text-center">Follow-up Date</th>
                     <th class="text-center">Age at Follow-up</th>
                     <!-- <th class="text-center">Contracting party</th> -->
                     <th class="text-center">Location</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <!-- <th class="text-center">status</th> -->
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <?php //echo '<pre>';print_r($follow_up_visits_total_details); ?>
               <tbody id="childAppend">
                  <?php 
                  $c = 1;
                  foreach($follow_up_visits_total_details as $value){
                    if($value->fv_status == 0)
                    {
                       $value->action = "Edit Draft Form";
                    }
                    else if($value->fv_status == 1 || $value->fv_status == 4 )
                    {
                       $value->action = "Edit Form";
                    }
                    else
                    {
                       $value->action = "";
                    }
                   $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo $value->cp_1_age; ?></td>
                     <td><?php if($value->followup_date != ''){?><?php echo date('d-m-Y', strtotime($value->followup_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <td><?php echo $value->age_on_folllowup; ?></td>
                     <!-- <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td> -->
                     <td><?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     
                     <td>
                       <?php if($value->fv_status==1)
                       {echo 'Saved';}elseif ($value->fv_status==2) {echo 'Forwarded';}else if($value->fv_status==3){echo 'Published';}elseif ($value->fv_status==4) {echo 'Reverted'; } else{echo "saved as drafts";} ?>
                       <?php if($value->fv_status == 4)
                        { ?>
                          <br>
                          <a class="" onclick="view_revert_reason('<?php echo ($value->revert_reason); ?>')">
                            <i class="fa fa-eye"></i>
                          </a>
                          <?php 
                        } ?>
                     </td>
                     <td>
                        <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            <li role="presentation">
                              <!-- <a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal_<?php echo $c; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a> -->

                              <a class="" onclick="view_details('<?php echo base64_encode($value->follow_up_sl_no); ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details
                            </a>


                            </li>

                            <?php if(($value->fv_status == 0 ||$value->fv_status==1 || $value->fv_status==4)&& $this->session->userdata('stake_id_fk')==4){ ?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/reporting/follow_up_visit/Follow_up_visit_form/edit/') ?><?php echo base64_encode($value->follow_up_sl_no); ?>">
                                    <i class='fa fa-edit'></i>
                                  <?php echo $value->action ; ?>
                                </a>
                              </li>

                              <!-- ADDED BY SOUMEN -->
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Delete_followupVisit('<?php echo base64_encode($value->follow_up_sl_no); ?>',' <?php echo base64_encode($value->scheduler_id_fk); ?>')"><i class="fa fa-trash"></i> Delete </a></li>
                              <?php } ?>

                              <?php if($value->fv_status ==1 && $this->session->userdata('stake_id_fk')==4){ ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Forward_followup('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-forward"></i> Forward Follow-Up Visit</a></li>
                              </li>
                              <?php }
                              else if ($value->fv_status ==2 && ($this->session->userdata('stake_id_fk')==2 || $this->session->userdata('stake_id_fk')==6))
                              {
                                ?>
                                
                                <!-- ADDED BY SOUMEN -->
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Publish_followup('<?php echo base64_encode($value->follow_up_sl_no); ?>',' <?php echo base64_encode($value->scheduler_id_fk); ?>',' <?php echo base64_encode($value->incident_id_fk); ?>',' <?php echo base64_encode($value->cp_type); ?>')"><i class="fa fa-forward"></i> Publish Follow-up Visit</a></li> 

                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="revert_back_follow_up_visit('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-backward"></i> Revert Follow-up Visit</a></li>
                                <?php  
                              }  
                            ?>
                           
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
   <!-- View Modal -->
   <?php
   $k = 2;
   foreach($follow_up_visits_total_details as $value1){
   ?>
   <div id="viewModal_<?php echo $k++; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Follow Up Visit Data</h4>
            </div>
            <div class="modal-body">
               <div class="div-table">
                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">Mode of Enquiry :</div>
                     <div class="td"><?php if($value1->mode_of_enquiry == 1){?>Phone Call<?php }elseif($value1->mode_of_enquiry == 2){?>Video Call<?php }else{?>In Person<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Gender :</div>
                     <div class="td"><?php if($value1->follow_gender == 1){?>Male<?php }else{?>Female<?php } ?></div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col-sm-6">
                      <div class="title">Minor is enrolled in</div>
                       <div class="table">
                         <div class="tr">
                           <div class="td">Education :</div>
                           <div class="td"><?php if($value1->follow_education == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                         <div class="tr">
                           <div class="td">Kishori Group :</div>
                           <div class="td"><?php if($value1->kishori_group == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                         <div class="tr">
                           <div class="td">Paid work :</div>
                           <div class="td"><?php if($value1->paid_work == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                       </div>
                   </div>
                   <div class="col-sm-6">
                      <div class="title">If Yes, Frequency of Attendance</div>
                       <div class="table">
                        <?php if($value1->follow_education == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value1->education_frequency == 1){?>Rarely<?php }elseif($value1->education_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>

                         <?php if($value1->kishori_group == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value1->kishori_group_frequency == 1){?>Rarely<?php }elseif($value1->kishori_group_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>

                         <?php if($value1->paid_work == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value1->paid_work_frequency == 1){?>Rarely<?php }elseif($value1->paid_work_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>
                       </div>
                   </div>
                 </div>

                 <div class="title">Minor feels supported by</div>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Parents :</div>
                     <div class="td"><?php if($value1->parents_supported == 1){?>Rarely<?php }elseif($value1->parents_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Family elders :</div>
                     <div class="td"><?php if($value1->family_elders_supported == 1){?>Rarely<?php }elseif($value1->family_elders_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Peers :</div>
                     <div class="td"><?php if($value1->peers_supported == 1){?>Rarely<?php }elseif($value1->peers_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Neighbours :</div>
                     <div class="td"><?php if($value1->neighbours_supported == 1){?>Rarely<?php }elseif($value1->neighbours_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Others :</div>
                     <div class="td"><?php if($value1->others_supported == 1){?>Rarely<?php }elseif($value1->others_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                 </div>

                 <div class="table">
                    <div class="tr">
                     <div class="td">If female, Minor is pregnant? :</div>
                     <div class="td"><?php if($value1->minor_pregnant == 1){?>Yes<?php }elseif($value1->minor_pregnant == 2){?>No<?php }else{?>N/A<?php } ?></div>
                   </div>
                   <?php if($value1->minor_pregnant == 1){?>
                   <div class="tr">
                     <div class="td">If Yes, Stage of pregnancy (Trimester) :</div>
                     <div class="td"><?php if($value1->stage_of_pregnancy == 1){?>First<?php }elseif($value1->stage_of_pregnancy == 2){?>Second<?php }else{?>Third<?php } ?></div>
                   </div>
                   <?php } ?>
                 </div>

                 <div class="table">
                    <div class="tr">
                     <div class="td">Remarks :</div>
                     <div class="td"><?php echo $value1->remarks; ?></div>
                   </div>
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <!-- View End Modal -->
</div>


<div id="myModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="upload-dynamic"></div>
      
</div>

<div id="revert_modal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <!-- <div class="upload-dynamic"></div> -->
    <div class="modal-dialog modal-lm">
           <!-- Modal content-->
           <div class="modal-content" id="mod">
              <div class="modal-header custom-modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Reason For Revert</h4>
              </div>
              <div class="modal-body">
                <!-- <p>Reason For Revert : </p> -->
                <p class="revert_val" style="word-break: break-all;"></p>
              </div>
            </div>
        <div class="modal-footer" style="background-color: #f4f4f4">
           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>


<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">

  function view_details(sl_no=null)
  {
    var url = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/view_details/';
        // alert(csrf_token); 
        $.ajax({
              url: url,
              method: 'get',
              data: {sl_no:sl_no} ,
              //dataType: 'json',
              success: function(result)
              {
                console.log(result);
                $('.upload-dynamic').html(result);
                $('#myModal').modal('show');

              }
            });
  }

function Publish_followup(sl_no,scheduler_id_fk,incident_id_fk,cp_type) {

    // alert(sl_no);
    swal({
        title: "Publish?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, Publish it",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/publish_follow_up';
            $.ajax({
                url: url,
                method: "GET",
                data: {'sl_no': sl_no,'scheduler_id_fk': scheduler_id_fk,'incident_id_fk':incident_id_fk,'cp_type': cp_type},
                dataType: "JSON",
                success: function(response) {
                    swal("Published!", "Publish success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while publishing", "error");
                    console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", "Publish cancel!", "error");
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        } 
    });
}

// admin/reporting/follow_up_visit/follow_up_visits_list/forward_followup
// Forward_homeVisit

function Forward_followup(sl_no) {
    // alert(cp_id_fk);
    swal({
        title: "Forward?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, Forward it",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/forward_followup';
            $.ajax({
                url: url,
                method: "GET",
                data: {'sl_no': sl_no},
                dataType: "JSON",
                success: function(response) {
                    swal("Forward!", "Forward success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while forward", "error");
                    console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", "Forward cancel!", "error");
            /*setTimeout(function(){
                window.location.reload();
            }, 1500);*/
        } 
    });
}
</script>

<script type="text/javascript">
 $( document ).ready(function() {
    
    $('#date_div').hide();
    function show_hide_adv_date_search() 
    {
      $('#date_div').toggle('swing');
    }
   $(document).on("click","#advanced_search_btn",function(e){
      e.preventDefault();
      show_hide_adv_date_search();
    });
});



</script>

<!-- admin/reporting/follow_up_visit/follow_up_visits_list/list_print -->
<script type="text/javascript">
   $(document).on("click","#search_btn",function(e){
      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_print/';
     e.preventDefault();
     var start_date = $("#start_date").val();
     var end_date = $("#end_date").val();
     if(start_date != '' && end_date != ''){

      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_print/?start_date='+start_date+'&end_date='+end_date;
      var downloadBtnUrl = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/list_download/?start_date='+start_date+'&end_date='+end_date;
      $('#btnPrint2').attr('href',btnPrintUrl);
      $('#download_btn').attr('href',downloadBtnUrl);
       $.ajax({
           url:"reporting/follow_up_visit/follow_up_visits_list/dateSearch",
           method:"GET",
           data:{"start_date":start_date,"end_date":end_date},
           success:function(response)
           {
               var table = $('#mytable').DataTable();
              if ($.fn.DataTable.isDataTable('#mytable')) {
                            table.destroy();
                        }

                        // Clear the table body
                        $("#childAppend").empty();

                        // Populate the table with the new data
                        if (response != "") {
                            $("#childAppend").html(response);
                        } else {
                            $("#childAppend").html("<td colspan='14' style='color:red;'><b>No matching record found!</b></td>");
                        }

                        // Re-initialize DataTable
                        // table = $('#mytable').DataTable();
                            table = $('#mytable').DataTable({
                              "columnDefs": [{
                                 "targets": 2,
                                 "render": function(data, type, row, meta) {
                                    if(type === 'sort') {
                                       return data.replace(/(\d{2})-(\d{2})-(\d{4})/, '$3-$2-$1');
                                    }
                                    return data;
                                 }
                              }],
                              "paging": true,
                              "scrollX": false,
                              "info": false,
                              "ordering": true,
                              "searching": true
                            });
           }
       });
      }else{
        alert("Both date is required");
      }  
   });
</script>


<script type="text/javascript">
$('.datepicker').datepicker({
  changeMonth: true,
  changeYear: true,
  yearRange: '1900:+0',
  dateFormat: 'dd/mm/yy', 
  maxDate: '0'
});
</script>




<script type="text/javascript">

   $('#reset_btn').click(function() {
       location.reload();
   });
</script>


<script type="text/javascript">
// Delete Record 

 function Delete_followupVisit(sl_no,scheduler_id_fk) {
    // alert(cp_id_fk);
    swal({
        title: "Delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, delete it",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/reporting/follow_up_visit/follow_up_visits_list/delete_followup';
            $.ajax({
                url: url,
                method: "GET",
                data: {'sl_no': sl_no,'scheduler_id_fk':scheduler_id_fk},
                dataType: "JSON",
                success: function(response) {
                    swal("Deleted!", "Delete success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while deleting", "error");
                    console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", "delete cancel!", "error");
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        } 
    });
}
</script>

<script type="text/javascript">
 function revert_back_follow_up_visit(cp_id_fk) {
    // First SweetAlert for confirmation
    swal({
        title: "Revert Follow-up Visit?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, Revert",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: true,
    }, function(isConfirmed) {
        if (isConfirmed) {
            // If user clicks "Yes, Revertback", open second SweetAlert for reason input
            swal({
                title: "provide a reason (max 200 characters)",
                // text: "Please enter the reason for reverting back:",
                // text:'<input type="textarea" id="revert" class="form-control" maxlength="200">',
                text:'<textarea id="revert" class="form-control" maxlength="200">',
                type: "warning",
                customClass: 'swal-custom-width',
                html:true,
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
            }, function(inputValue) {
                if (inputValue === false) return false; // If cancel is clicked
                if (inputValue === "") {
                    swal.showInputError("You need to provide a reason!"); // If no reason is provided
                    return false;
                }
                
                // If reason is provided, proceed with the revertback action
                var url = '<?php echo base_url()?>admin/reporting/follow_up_visit/Follow_up_visits_list/revert_back_follow_up_visit';
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {'cp_id_fk': cp_id_fk, 'reason': $('#revert').val()},
                    dataType: "JSON",
                    success: function(response) {
                        swal("Reverted!", "Revert success", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        swal("Error", "An error occurred while publishing", "error");
                        console.error(xhr.responseText);
                    }
                });
            });
        }
    });

  }
</script>

<script type="text/javascript">
  function view_revert_reason(reason=null)
  {
    $('.revert_val').html(reason);
    $('#revert_modal').modal('show');
  }
</script>