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
      <h1>Home Enquiry Register</h1>
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
          <a href="<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>

          <a href="<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/list_print/" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         

         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a>

         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Age at Intervention</th>



                     <th class="text-center">Home Enquiry Date</th>
                     <th class="text-center">Age at Home Enquiry</th>
                     <!-- <th class="text-center">Contracting party</th> -->
                     <th class="text-center">Location</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <!-- <th class="text-center">status</th> -->
                     <th class="text-center">Minor/Adult</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php 
                  $c = 1;
                  // echo "<pre>";print_r($home_visits_total_details);
                  if(!empty($home_visits_total_details)){
                  foreach($home_visits_total_details as $value){
                     if($value->cp_age<18)
                    {
                      // $data['home_visits_total_details']->$key['minor_adult_status'] = "Home Visit Minor Form";
                       $value->minor_adult_status = "Minor";
                       $value->url = base_url()."admin/reporting/home_visit/Home_visit_minor_form/edit/";
                    }
                    else
                    {
                      $value->minor_adult_status = "Adult";
                      $value->url = base_url()."admin/reporting/home_visit/home_visit_adult_form/edit/";
                    }

                    if($value->hv_status == 0)
                    {
                       $value->action = "Edit Draft Form";
                    }
                    else if($value->hv_status == 1 || $value->hv_status==4)
                    {
                       $value->action = "Edit Form";
                    }
                    else
                    {
                       $value->action = "";
                    }

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
                     <td><?php echo $value->cp_age; ?></td>
                     <td><?php if($value->home_enquiry_date != ''){?><?php echo date('d-m-Y', strtotime($value->home_enquiry_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <td><?php echo $value->age_of_home_enquiry; ?></td>
                     <td>
                        <?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?>
                    </td>
                     <td><?php echo $value->cp_name; ?></td>
                     <td><?php echo $value->cp_gender_val; ?></td>
                     
                     <!-- <td><?php //echo $value->hv_status; ?></td> -->
                     <td><?php echo $value->minor_adult_status; ?></td>
                      <td>
                        <?php echo $value->status; ?>
                        <?php if($value->hv_status == 4)
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
                            <a class="" onclick="view_details('<?php echo base64_encode($value->home_visits_sl_no); ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details
                            </a>

                            </li>
                            <?php if(($value->hv_status == 0 ||$value->hv_status==1 || $value->hv_status==4)&& $this->session->userdata('stake_id_fk')==4)
                            {
                              ?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo $value->url; ?><?php echo base64_encode($value->home_visits_sl_no); ?>">
                                    <i class='fa fa-edit'></i>
                                  <?php echo $value->action ; ?>
                                </a>
                              </li>

                              <!-- ADDED BY SOUMEN -->
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Delete_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>',' <?php echo base64_encode($value->scheduler_id_fk); ?>')"><i class="fa fa-trash"></i> Delete </a></li>
                              
                              <?php } ?>



                            
                            <?php if($value->hv_status ==1 && $this->session->userdata('stake_id_fk')==4)
                            {
                              ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Forward_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-forward"></i> Forward Home Enquiry</a></li>
                                
                              </li>
                              <?php
                            }else if ($value->hv_status ==2 && ($this->session->userdata('stake_id_fk')==2 || $this->session->userdata('stake_id_fk')==6))
                            {
                              ?>

                              <!-- ADDED BY SOUMEN -->
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Publish_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>',' <?php echo base64_encode($value->scheduler_id_fk); ?>',' <?php echo base64_encode($value->incident_id_fk); ?>',' <?php echo base64_encode($value->cp_type); ?>')"><i class="fa fa-forward"></i> Publish Home Enquiry</a></li>


                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Revertback_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-backward"></i> Revert Home Enquiry</a></li> 
                              </li>

                              <?php  
                            }
                              ?>
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } } ?>
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
   <?php
   // $k = 2;
   ?>
   
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
   <!-- View End Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>

<script type="text/javascript">

  function Publish_homeVisit(cp_id_fk,scheduler_id_fk,incident_id_fk,cp_type) {
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
                data: {'cp_id_fk': cp_id_fk,'scheduler_id_fk': scheduler_id_fk,'incident_id_fk':incident_id_fk,'cp_type': cp_type},
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
  function Forward_homeVisit(cp_id_fk) {
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
            var url = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/forward_homevisit';
            $.ajax({
                url: url,
                method: "GET",
                data: {'cp_id_fk': cp_id_fk},
                dataType: "JSON",
                success: function(response) {
                    swal("Forwarded!", "forward success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while forwarding", "error");
                    console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", "forward cancel!", "error");
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        } 
    });
}


// Delete Record 

 function Delete_homeVisit(cp_id_fk,scheduler_id_fk) {
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
            var url = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/delete_homevisit';
            $.ajax({
                url: url,
                method: "GET",
                data: {'cp_id_fk': cp_id_fk,'scheduler_id_fk':scheduler_id_fk},
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
function view_details(sl_no=null)
{

  var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
  var url = '<?php echo base_url()?>admin/reporting/home_visit/Home_visits_list/get_homevist_dtls';
      // alert(csrf_token); 
      $.ajax({
            url: url,
            method: 'get',
            data: {sl_no:sl_no} ,
            success: function(result)
            {

              console.log(result);
                $('.upload-dynamic').html(result);
                $('#myModal').modal('show');

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


<!-- Show siblings in modal-->
<script type="text/javascript">
    function show_siblings_dtls(homwvisit_siblings_dtls = null)
    {
      // if(homwvisit_siblings_dtls.length>0)
      // {

        // Container where the table will be appended
        console.log(homwvisit_siblings_dtls);
        var container = $('#siblings_container');
        container.empty();



        // Create a table element
        var table = $('<table>').addClass('table table-bordered dataTable');

        // Add table header
        // Add table header
        var headerRow1 = $('<tr style="background-color: gray; color: #FFFFFF;">');
        headerRow1.append('<th colspan="2" class="col-sm-4"></th>');
        headerRow1.append('<th colspan="2" style="text-align: center;">Gender</th>');
        headerRow1.append('<th colspan="2" style="text-align: center;">Occupation</th>');
        table.append(headerRow1);

        var headerRow2 = $('<tr style="background-color: gray; color: #FFFFFF;">');
        headerRow2.append('<th class="col-sm-3" style="text-align: center; border: 0.5px solid #FFFFFF;">Name</th>');
        headerRow2.append('<th class="col-sm-3"style="text-align: center; border: 0.5px solid #FFFFFF;">Age</th>');
        headerRow2.append('<th class="col-sm-1" style="text-align: center; border: 0.5px solid #FFFFFF;">Male</th>');
        headerRow2.append('<th class="col-sm-" style="text-align: center; border: 0.5px solid #FFFFFF;">Female</th>');
        headerRow2.append('<th style="text-align: center; border: 0.5px solid #FFFFFF;">In education</th>');
        headerRow2.append('<th style="text-align: center; border: 0.5px solid #FFFFFF;">In Paid work</th>');
        table.append(headerRow2);

        // Add table data
        $.each(homwvisit_siblings_dtls, function(index, item) {
            var newRow = $('<tr>');
            newRow.append('<td style="border: 0.5px solid #dddddd;">'+item.siblings_name+'</td>');
            newRow.append('<td style="border: 0.5px solid #dddddd;">'+item.siblings_age+'</td>');
            // newRow.append('<td><input type="text" class="form-control" value="' + item.siblings_name + '" disabled></td>');
            // newRow.append('<td><input type="text" class="form-control" value="' + item.siblings_age + '" disabled></td>');
            newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="radio" ' + (item.siblings_sex == 1 ? 'checked' : '') + ' ></td>');
            newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="radio" ' + (item.siblings_sex == 2 ? 'checked' : '') + ' ></td>');

           if (item.siblings_occupation) {
    var checkedValues = item.siblings_occupation.split(',');
    var inEducationChecked = checkedValues.includes('1');
    var inPaidWorkChecked = checkedValues.includes('2');
    newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="checkbox" ' + (inEducationChecked ? 'checked' : '') + ' ></td>');
    newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="checkbox" ' + (inPaidWorkChecked ? 'checked' : '') + ' ></td>');
} else {
    newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="checkbox" ></td>');
    newRow.append('<td style="border: 0.5px solid #dddddd; pointer-events: none;"><input type="checkbox" ></td>');
}

            table.append(newRow);
        });

        // Append the table to the container
        container.append(table);
      }

    // }
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


<script type="text/javascript">
   $(document).on("click","#search_btn",function(e){
      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/home_visit/Home_visits_list/list_print/';
     e.preventDefault();
     var start_date = $("#start_date").val();
     var end_date = $("#end_date").val();
     if(start_date != '' && end_date != ''){

      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/list_print/?start_date='+start_date+'&end_date='+end_date;
      var downloadBtnUrl = '<?php echo base_url()?>admin/reporting/home_visit/Home_visits_list/list_download/?start_date='+start_date+'&end_date='+end_date;
      $('#btnPrint2').attr('href',btnPrintUrl);
      $('#download_btn').attr('href',downloadBtnUrl);
       $.ajax({
           url:"reporting/home_visit/Home_visits_list/dateSearch",
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
function Revertback_homeVisit(cp_id_fk) {
    // First SweetAlert for confirmation
    swal({
        title: "Revert Home Enquiry?",
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
                var url = '<?php echo base_url()?>admin/reporting/home_visit/home_visits_list/revertback_homevisit';
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {'cp_id_fk': cp_id_fk, 'reason': $('#revert').val()}, // Accessing the value of the input field correctly
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