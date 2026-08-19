<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
/*   input[type="radio"] {
   cursor: not-allowed;
   }*/
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
   font-size: 12px;
   }
   td {
   font-size: 13px;
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
   font-size: 20px;
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
   .label-div
   {
   display: flex;
   justify-content: end;
   }
   .inp
   {
   width: 24%;
   margin-left: 10px;
   }
   .otp-input-fields
   {
   display: flex;
   }
   .otp-input-fields input[type=number]
   {
   width: 20%;
   background-color: #0000000d;
   margin-right: 5px;
   outline: none;
   border: none;
   }
   .otp-input-fields {
   background-color: white;
   width: auto;
   display: flex;
   justify-content: center;
   gap: 10px;
   }
   .otp-input-fields input {
   height: 34px;
   width: 40px;
   background-color: transparent;
   border-radius: 0px;
   border: 1px solid #0b1b52;
   text-align: center;
   outline: none;
   font-size: 16px;
   border: 1px solid #ccc!important;
   }
   .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   margin: 0;
   }
   .otp-input-fields input[type=number] {
   -moz-appearance: textfield;
   }
   .otp-input-fields input:focus {
   border-width: 2px;
   border-color: #287a1a;
   font-size: 20px;
   }
   .des-loc
   {
   display: flex;
   flex-wrap: wrap;
   }
   .inp-radio
   {
   width: 28%;
   }
   .inp-inf
   {
   float: right;
   }
   .left-form
   {
   position: relative;
   }
   .Information_Received
   {
   position: absolute;
   right: 75px;
   top:0;
   text-align: right;
   }
   .Information_Received h5 
   {
   text-align: right;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Address Change List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <div id="date_div" style="display:none">
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
         <!-- <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a> -->
         
         
         <div class="box-body" id="box-table">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th colspan="4">Intervention</th>
                     <th colspan="2">Contracting Party 1</th>
                     <th colspan="2">Contracting Party 2</th>
                     <th colspan="1">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Location</th>
                     <th class="text-center">Basic Details</th>
                     
                     <th class="text-center">CP 1 Status</th>
                     <th class="text-center">Basic Details</th>
                     <!-- <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th> -->
                     <th class="text-center">CP 2 Status</th>
                     
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php
                     //echo '<pre>';print_r($incident_details);
                     $c = 1;
                     foreach($incident_details as $value){
                      
                       $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);

                       $incident_block_details = Get_Incident_List_CP_One_Block_Details($value->block);

                       // print_r($incident_block_details);die;

                       if(!empty($incident_block_details))
                       {
                         if($incident_block_details->rural_urban == 'U')
                         {
                           $incident_ward_gp_details = Get_Incident_List_Incident_Ward_Details($value->ward_gp);
                         }
                         else
                         {
                           $incident_ward_gp_details = Get_Incident_List_Incident_GP_Details($value->ward_gp);
                         }
                       }
                       else
                       {
                         $incident_ward_gp_details = array();
                       }

                       // echo"<pre>";print_r($incident_ward_gp_details);die;
                       // echo $incident_ward_gp_details->incident_ward_gp;die;
                     
                       if(!empty($cp_one_block_details)){
                         if($cp_one_block_details->rural_urban == 'U'){
                           $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
                         }else{
                           $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
                         }
                       }else{
                         $cp_one_ward_gp_details = array();
                       }
                     
                       $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
                       if(!empty($cp_two_block_details)){
                         if($cp_two_block_details->rural_urban == 'U'){
                           $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
                         }else{
                           $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
                         }
                       }else{
                         $cp_two_ward_gp_details = array();
                       }
                     ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td>
                        <?php echo $value->incident_district;?>,<br>
                        <?php echo $value->incident_block; ?>,<br>
                        <?=($incident_ward_gp_details)?$incident_ward_gp_details->incident_ward_gp:'';?>
                     </td>
                     <td>
                       <ul class="list-unstyled">
                         <li><b>Name : </b><?php echo $value->cp_1_name; ?></li>
                         <li><b>Gender : </b><?php echo $value->cp_1_gender_value; ?></li>
                         <li><b>Age : </b><?php echo $value->cp_1_age; ?></li>

                    <?php if($value->cp_1_state == 1){?>
                     <li> <b>Address : </b>
                        <?php echo $value->cp_1_district;?>,<br>
                        <?php echo $value->cp_1_block?>,<br>
                        <?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?>
                     </li>
                     <?php }else{ ?>
                      <li><b>Address : </b><?php echo $value->cp_1_address;?></li>
                     <?php } ?>
                         
                       </ul>
                     </td>
                     <td>
                      <?php
                      $contractingPartyOneCount = contracting_parties_archive_details_count($value->cp_1_id_pk);
                      $contractingPartyTwoCount = contracting_parties_archive_details_count($value->cp_2_id_pk);
                      ?>
                      <button type="button" class="btn btn-primary">Total <span class="badge"><?=$contractingPartyOneCount?></span></button>
                    </td>
                     <td>
                       <ul class="list-unstyled">
                         <li><b>Name : </b><?=($value->cp_2_name)?$value->cp_2_name:''; ?></li>
                         <li><b>Gender : </b><?=($value->cp_2_gender_value)?$value->cp_2_gender_value:''; ?></li>
                         <li><b>Age : </b><?=($value->cp_2_age)?$value->cp_2_age:''; ?></li>
                         <?php if($value->cp_2_state == 1){?>
                         <li><b>Address : </b>
                            <?php echo $value->cp_2_district;?>,<br>
                            <?php echo $value->cp_2_block; ?>,<br>
                            <?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?>
                         </li>
                         <?php }else{?>
                         <li><b>Address : </b><?php echo $value->cp_2_address;?></li>
                         <?php } ?>
                       </ul>
                     </td>
                     
                     
                     
                    
                     

                    <td><button type="button" class="btn btn-primary">Total <span class="badge"><?=$contractingPartyTwoCount?></span></button></td>
                  


                     
                     
                     <td>
                        <div class="dropdown" style="">
                           <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->incident_id_pk?>"><i class="fa fa-eye" aria-hidden="true"></i>View Details</a></li>
                              <?php
                                $contracting_parties_details = contracting_parties_details_by_incident_id($value->incident_id_pk);
                                $incident_id_fk = $value->incident_id_pk;
                                if(!empty($contracting_parties_details)){
                                foreach($contracting_parties_details as $value){
                                  $cp_type = $value->cp_type;
                                  $cp_id_fk = $value->cp_id_pk;
                                  $address_changes_details = address_changes_details_by_id(array('incident_id_fk'=>$incident_id_fk,'cp_id_fk'=>$cp_id_fk,'cp_type'=>$cp_type));
                                    //echo '<pre>';print_r($address_changes_details);
                                    if(empty($address_changes_details)){

                                      if($value->cp_type==1){
                                        
                                        $addressChange = 'Address Change Contracting Party One';
                                        $url = base_url().'admin/reporting/incident/incident_list/address_change/'.base64_encode($value->cp_id_pk);
                                      }elseif ($value->cp_type==2) {
                                        
                                        $addressChange = 'Address Change Contracting Party Two';
                                        $url = base_url().'admin/reporting/incident/incident_list/address_change/'.base64_encode($value->cp_id_pk);
                                      }else{
                                        $addressChange = '';
                                        $url = base_url().'admin/reporting/incident/incident_list/address_change/'.base64_encode($value->cp_id_pk);
                                      }

                                    }else{

                                     if($address_changes_details->ac_status==0){
                                        $addressChange = 'Edit Draft Form Address Change Contracting Party One';
                                        $url = base_url().'admin/reporting/address_change/address_change_form/edit/'.base64_encode($address_changes_details->sl_no);
                                      }elseif ($address_changes_details->ac_status==1) {
                                        $addressChange = 'Edit Form Address Change Contracting Party Two';
                                        $url = base_url().'admin/reporting/address_change/address_change_form/edit/'.base64_encode($address_changes_details->sl_no);
                                      }else{
                                        $addressChange = 'Address Change Contracting Party One';
                                        $url = base_url().'admin/reporting/incident/incident_list/address_change/'.base64_encode($value->cp_id_pk);
                                      }

                                    }

                                  
                              ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=$url?>"><i class="fa fa-address-card" aria-hidden="true"></i><?=$addressChange?></a></li>
                              <?php
                              if(!empty($address_changes_details)){
                                if($address_changes_details->cp_type==1){
                                  $publishFollowMsg = 'Publish Follow Up(Party One)';
                                }elseif ($address_changes_details->cp_type==2) {
                                  $publishFollowMsg = 'Publish Follow Up(Party Two)';
                                }else{

                                }
                              }
                              ?>
                              <?php 
                               if(!empty($address_changes_details)){
                                if($address_changes_details->ac_status==1){
                              ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Publish_address_change('<?php echo base64_encode($address_changes_details->sl_no); ?>')"><i class="fa fa-forward"></i> <?=$publishFollowMsg?></a></li>

                            <?php } } } } ?>


                            
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

</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>



<script type="text/javascript">
   function expand(){
   document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
   }
</script>
<script type="text/javascript">
  function Publish_address_change(sl_no) {
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
            var url = '<?php echo base_url()?>admin/reporting/address/Address_list/publish_address_change';
            $.ajax({
                url: url,
                method: "GET",
                data: {'sl_no': sl_no},
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