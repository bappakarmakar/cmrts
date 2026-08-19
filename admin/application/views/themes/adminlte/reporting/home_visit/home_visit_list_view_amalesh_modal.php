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
      <h1>Home visits List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>

        

         <a href="<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/list_print" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;margin-bottom: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
        
         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Incident Date</th>
                     <th class="text-center">Incident ID</th>
                     <th class="text-center">Contracting party</th>
                     <th class="text-center">Ward/GP</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">status</th>
                     <th class="text-center">Minor / Adult Home Visit</th>
                     <th class="text-center">status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php 
                  $c = 1;
                  echo "<pre>";print_r($home_visits_total_details);
                  foreach($home_visits_total_details as $value){
                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_block);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo $value->cp_type; ?></td>
                     <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td>
                     <td><?php echo $value->cp_name; ?></td>
                     <td><?php echo $value->cp_gender_val; ?></td>
                     <td><?php echo $value->cp_age; ?></td>
                     <td><?php echo $value->hv_status; ?></td>
                     <td><?php echo $value->minor_adult_status; ?></td>
                     <td><?php echo $value->status; ?></td>
                     <td>
                        <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal_<?php echo $c; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a></li>
                            <?php if($value->hv_status !=2)
                            {
                              ?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo $value->url; ?><?php echo base64_encode($value->incident_id_fk); ?>/<?php echo base64_encode($value->cp_type); ?>/<?php echo base64_encode($value->cp_id_fk); ?>">
                                    <i class='fa fa-edit'></i>
                                  <?php echo $value->action ; ?>
                                </a>
                              </li>
                              <?php
                            }
                              ?>
                            <?php if($value->hv_status ==1)
                            {
                              ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_homeVisit('<?php echo base64_encode($value->cp_id_fk); ?>')"><i class="fa fa-forward"></i> Publish Home Visit</a></li>
                              </li>
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
   <?php
   $k = 2;
   foreach($home_visits_total_details as $value){
   ?>
   <div id="viewModal_<?php echo $k++; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Home Visit Data</h4>
            </div>
            <div class="modal-body">
              
               <div class="div-table">

                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">Mode of Enquiry :</div>
                     <div class="td"><?php if($value->mode_of_enquiry == 1){?>Phone Call<?php }elseif($value->mode_of_enquiry == 2){?>Video Call<?php }else{?>In Person<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Gender :</div>
                     <div class="td"><?php echo $value->cp_gender_val ?></div>
                   </div>
                 </div>

                 <div class="title">Assessment of Family Situation</div>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Total family income is at least Rs.10,000 /- every month :</div>
                     <div class="td"><?php if($value->family_income == 1){?>Rarely<?php }elseif($value->family_income == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Every member of the family has at least two nutritious meals a day :</div>
                     <div class="td"><?php if($value->nutritious_meals == 1){?>Rarely<?php }elseif($value->nutritious_meals == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">The family get support from neighbours and community in time of need :</div>
                     <div class="td"><?php if($value->neighbours_community == 1){?>Rarely<?php }elseif($value->neighbours_community == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">The family has some money kept aside for emergencies :</div>
                     <div class="td"><?php if($value->emergencies == 1){?>Rarely<?php }elseif($value->emergencies == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                 </div>

                 <div class="title">Siblings</div>
                 <?php 
                 $Siblings_Query_Result = Get_Home_Visit_Minor_Siblings_Details($value->home_sl_no);
                 if(!empty($Siblings_Query_Result)){
                 foreach($Siblings_Query_Result as $row_value){?>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Name :</div>
                     <div class="td"><?php echo $row_value->siblings_name; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Age :</div>
                     <div class="td"><?php echo $row_value->siblings_age; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Sex :</div>
                     <div class="td"><?php if($row_value->siblings_sex == 1){?>Male<?php }else{?>Female<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Occupation :</div>
                     <div class="td"><?php if($row_value->siblings_occupation == 1){?>In education<?php }else{?>In Paid work<?php } ?></div>
                   </div>
                 </div>
                 <?php } }else{ ?> 
                  <div class="table">
                    <div class="tr">
                     <div class="td">No. Data Found.</div>
                     
                   </div>
                  </div>
                 <?php } ?>
                 <?php if($value->cp_1_age<18){ ?>
                 <div class="title">Assessment of Minor</div>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Has a disability? :</div>
                     <div class="td"><?php if($value->disability == 1){?>Yes<?php }else{?>No<?php } ?></div>
                   </div>
                   <?php if($value->disability == 1){?>
                   <div class="tr">
                     <div class="td">If Yes, Type of Disability :</div>
                     <div class="td">
                      <?php 
                        $type_of_disability_array = explode(",",$value->type_of_disability);
                        $type_of_disability_name = array(); 
                      ?>

                      <?php 
                        if(in_array(1, $type_of_disability_array)){ array_push($type_of_disability_name,"Locomotor");}
                        if(in_array(2, $type_of_disability_array)){ array_push($type_of_disability_name,"Hearing");}
                        if(in_array(3, $type_of_disability_array)){ array_push($type_of_disability_name,"Speech/Language"); }
                        if(in_array(4, $type_of_disability_array)){ array_push($type_of_disability_name,"Visual");}
                        if(in_array(5, $type_of_disability_array)){ array_push($type_of_disability_name,"Intellectual");}
                        if(in_array(6, $type_of_disability_array)){ array_push($type_of_disability_name,"Other");}
                      ?>
                        <?=implode(",", $type_of_disability_name);?>
                      </div>
                   </div>
                   <div class="tr">
                     <div class="td">Has a disability certificate? :</div>
                     <div class="td"><?php if($value->disability_certificate == 1){?>Yes<?php }else{?>No<?php } ?></div>
                   </div>
                   <?php if($value->disability_certificate == 1){?>
                   <div class="tr">
                     <div class="td">If Yes, % of disability :</div>
                     <div class="td"><?php echo $value->disability_percent; ?></div>
                   </div>
                   <?php }else{ ?>
                    <div class="tr">
                     <div class="td">If certificate not available estimated severity :</div>
                     <div class="td"><?php if($value->estimated_severity == 1){?>Very High<?php }elseif($value->estimated_severity == 2){?>High<?php }elseif($value->estimated_severity == 3){?>Moderate<?php }elseif($value->estimated_severity == 4){?>Low<?php }else{?>Very Low<?php } ?></div>
                   </div>

                   <?php } ?>

                   <?php } ?>
                 <?php } ?>  
                   
                   
                 </div>

                 <div class="row">
                   <div class="col-sm-6">
                      <div class="title">At time of incident, was the minor engaged in</div>
                       <div class="table">
                         <div class="tr">
                           <div class="td">Education :</div>
                           <div class="td"><?php if($value->education == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                         <?php if(18>$value->cp_1_age){ ?>
                         <div class="tr">
                           <div class="td">Kishori Group :</div>
                           <div class="td"><?php if($value->kishori_group == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                       <?php } ?>
                         <div class="tr">
                           <div class="td">Paid work :</div>
                           <div class="td"><?php if($value->paid_work == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                       </div>
                   </div>
                   <div class="col-sm-6">
                      <div class="title">If Yes, Frequency of Attendance</div>
                       <div class="table">
                        <?php if($value->education == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value->education_frequency == 1){?>Rarely<?php }elseif($value->education_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">NA</div>
                         </div>
                         <?php } ?>
                          <?php if(18>$value->cp_1_age){ ?>
                         <?php if($value->kishori_group == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value->kishori_group_frequency == 1){?>Rarely<?php }elseif($value->kishori_group_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>
                       <?php } ?>
                         <?php if($value->paid_work == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($value->paid_work_frequency == 1){?>Rarely<?php }elseif($value->paid_work_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>
                       </div>
                   </div>
                 </div>
                <?php if(18>$value->cp_1_age){ ?>
                 <div class="table">
                    <div class="tr">
                     <div class="td">Kanyashree ID, if any :</div>
                     <div class="td"><?php if($value->kanyashree_id != ''){?><?php echo $value->kanyashree_id; ?><?php }else{?>NA<?php } ?></div>
                   </div>
                 </div>

                 <div class="title">At time of incident, did the minor feel supported by</div>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Parents :</div>
                     <div class="td"><?php if($value->parents_supported == 1){?>Rarely<?php }elseif($value->parents_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Family elders :</div>
                     <div class="td"><?php if($value->family_elders_supported == 1){?>Rarely<?php }elseif($value->family_elders_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Peers :</div>
                     <div class="td"><?php if($value->peers_supported == 1){?>Rarely<?php }elseif($value->peers_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Neighbours :</div>
                     <div class="td"><?php if($value->neighbours_supported == 1){?>Rarely<?php }elseif($value->neighbours_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Others :</div>
                     <div class="td"><?php if($value->others_supported == 1){?>Rarely<?php }elseif($value->others_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                 </div>

                 <div class="table">
                    <div class="tr">
                     <div class="td">Minor is pregnant? :</div>
                     <div class="td"><?php if($value->minor_pregnant == 1){?>Yes<?php }elseif($value->minor_pregnant == 2){?>No<?php }else{?>N/A<?php } ?></div>
                   </div>
                   <?php if($value->minor_pregnant == 1){?>
                   <div class="tr">
                     <div class="td">If Yes, Stage of pregnancy (Trimester) :</div>
                     <div class="td"><?php echo $value->stage_of_pregnancy; ?></div>
                   </div>
                   <?php } ?>
                 </div>

                  <div class="table">
                    <div class="tr">
                     <div class="td">Remarks :</div>
                     <div class="td"><?php echo $value->remarks; ?></div>
                   </div>
                 </div>
               <?php } ?>
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
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>

<script type="text/javascript">
   // function Publish_homeVisit(cp_id_fk){
   //  alert(cp_id_fk);
   //    swal({
   //    title: "Publish?",
   //    type: "warning",
   //    showCancelButton: true,
   //    confirmButtonClass: "btn-success",
   //    confirmButtonText: "Yes, Publish it",
   //    cancelButtonClass: "btn-danger",
   //    cancelButtonText: "No, Cancel",
   //    closeOnConfirm: false,
   //    closeOnCancel: false,
   //    showLoaderOnConfirm: true
   //  },
   //  function(isConfirm){
   //    if(isConfirm){
   //        var cp_id_fk = cp_id_fk;
   //        url = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/publish_homevisit';
   //        $.ajax({
   //            url: url,
   //            method:"GET",
   //            data:{'cp_id_fk':cp_id_fk},
   //            dataType:"JSON",
   //            success:function(response)
   //            {
   //                swal("Published!", "Publish success", "success");
   //                setTimeout(function(){
   //                   window.location.reload();
   //                }, 2000);
   //            }
   //        });
   //    } else {
   //        swal("Cancelled", "Publish cancel!", "error");
   //        setTimeout(function(){
   //           window.location.reload();
   //        }, 1500);
   //    } 
   //  });
   // }

  function Publish_homeVisit(cp_id_fk) {
    // alert(cp_id_fk);
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
            var url = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/publish_homevisit';
            $.ajax({
                url: url,
                method: "GET",
                data: {'cp_id_fk': cp_id_fk},
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




</script>