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
      display: none;
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
    .btn-primary {
        margin-top: 15px;
        margin-bottom: 20px;
    }
    .btn-danger {
        margin-top: 15px;
        margin-bottom: 20px;
    }
</style>
<script>
  function previous() {
    window.history.back();
  }
</script>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Age Wise Minors Involved Report</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/mis/age_wise_minors_involved/age_wise_minors_involved_view', array('class' => 'PendingStatusReportForm','name' => 'PendingStatusReportForm', 'id' => 'PendingStatusReportForm')) ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
              <?php $currentDate = date('d/m/Y'); ?>
              <?php $currentDate_conv = date('Y/m/d'); ?>
              <!-- <div class="form-group row">
                 <label class="col-sm-12 col-form-label" style="color: red;">From Date and To Date should match each other.</label>
               </div> -->
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">From Date <font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" name="from_date" class="form-control datepicker" data-date-end-date="0d" autocomplete="off" placeholder="From Date" value="<?php if($this->input->post('from_date')){echo set_value('from_date'); }else{ echo date('d/m/Y', strtotime($currentDate_conv. ' - 30 days'));} ?>">
                   <?php echo form_error('from_date');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">To Date <font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" class="form-control datepicker" data-date-end-date="0d" placeholder="To Date" autocomplete="off" name="to_date" value="<?php if($this->input->post('to_date')){echo set_value('to_date'); }else{ echo $currentDate;} ?>">
                   <?php echo form_error('to_date');?>
                 </div>
               </div>
            </div>
         </div>
         <button type="submit" name="age_wise_minors_involved_sub" class="btn btn-primary" style="margin-left: 8px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
      </div>
      <?php echo form_close();?>
      <?php if(isset($_POST['age_wise_minors_involved_sub']) && count($this->form_validation->error_array()) == 0){?>
      <?php
      $date_from = explode('/', $_POST['from_date']);
      $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
          
      $date_to = explode('/', $_POST['to_date']);
      $date_raw_to = $date_to['2']."-".$date_to['1']."-".$date_to['0'];
      $stake_id_fk = $this->session->userdata('stake_id_fk');
      $district = $this->session->userdata('district');
      ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <table id="table" class="table table-bordered table-striped">

                <?php 
                    $district_id = $this->session->userdata('district');
                    $block_id = $this->session->userdata('block');
                    if($stake_id_fk==4){
                      $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/GP_Ward_Wise_Download_Excel/".$block_id."/".$date_raw_from."/".$date_raw_to;

                    }elseif($stake_id_fk == '6'){
                      $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/SD_Block_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;

                    }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){ 
                      if(empty($district_id)){
                        $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/District_Wise_Download_Excel/".$date_raw_from."/".$date_raw_to;
                      }else{
                         $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/SD_Block_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;
                      }
                    }elseif($stake_id_fk == '2'){
                      $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/GP_Ward_Wise_Download_Excel/".$block_id."/".$date_raw_from."/".$date_raw_to;
                    }elseif($stake_id_fk == '3'){  
                      $download_excel_link = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/SD_Block_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;
                    }else{
                      $download_excel_link ="";
                    } 
                  ?>



                  <a href="<?php echo $download_excel_link; ?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Jurisdiction</th>
                       <th class="text-center" colspan="2">< 12 Yrs</th>
                       <th class="text-center" colspan="2">12-13 Yrs</th>
                       <th class="text-center" colspan="2">13-14 Yrs</th>
                       <th class="text-center" colspan="2">14-15 Yrs</th>
                       <th class="text-center" colspan="2">15-16 Yrs</th>
                       <th class="text-center" colspan="2">16-17 Yrs</th>
                       <th class="text-center" colspan="2">17-18 Yrs</th>
                       <th class="text-center" colspan="2">Totals</th>
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>

                      <th class="text-center">F</th>
                      <th class="text-center">M</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                    <?php 
                    if(count((array)$report_result) > 0){
                      if(isset($report_result)){
                        $c = 1;
                        foreach($report_result as $value){

                          $date_from = explode('/', $_POST['from_date']);
                          $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
                              
                          $date_to = explode('/', $_POST['to_date']);
                          $date_raw_to = $date_to['2']."-".$date_to['1']."-".$date_to['0'];

                          $total_female_count = $value['female_count_under_12']+$value['female_count_12_13']+$value['female_count_13_14']+$value['female_count_14_15']+$value['female_count_15_16']+$value['female_count_16_17']+$value['female_count_17_18'];

                          $total_male_count = $value['male_count_under_12']+$value['male_count_12_13']+$value['male_count_13_14']+$value['male_count_14_15']+$value['male_count_15_16']+$value['male_count_16_17']+$value['male_count_17_18'];
                    ?>
                    <tr>
                       <td><?php echo $c++; ?></td>



                        <td style="text-align: left;">
                        <?php 
                          if($stake_id_fk==4){
                            $url = "";
                            $district_name = $value['ward_gp_name'];

                          }elseif($stake_id_fk == '6'){
                            $url = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/sd_block/".$value['block_id_pk']."/".$date_raw_from."/".$date_raw_to;
                            $district_name = $value['block_name'];

                          }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){ 
                            $url = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/sd_block/".$value['district_id_pk']."/".$date_raw_from."/".$date_raw_to;
                            $district_name = $value['district_name'];
                          }elseif($stake_id_fk == '2'){
                            $url = "";
                            $district_name = $value['ward_gp_name'];
                          }elseif($stake_id_fk == '3'){  

                            $url = base_url()."admin/mis/age_wise_minors_involved/age_wise_minors_involved_view/sd_block/".$value['block_id_pk']."/".$date_raw_from."/".$date_raw_to;
                            $district_name = $value['block_name'];

                          }else{
                            $url ="";
                            $district_name = "";
                          } 
                        ?>
                        <?php if(empty($url)){
                          echo $district_name;
                        }else{ ?>
                          <a href="<?php echo $url; ?>"><?php echo $district_name; ?></a>
                        <?php } ?>
                        
                      </td>







                       <td><?php if($value['female_count_under_12'] != 0){ echo $value['female_count_under_12']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_under_12'] != 0){ echo $value['male_count_under_12']; } else { echo "0"; } ?></td>
                       
                       <td><?php if($value['female_count_12_13'] != 0){ echo $value['female_count_12_13']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_12_13'] != 0){ echo $value['male_count_12_13']; } else { echo "0"; } ?></td>

                       <td><?php if($value['female_count_13_14'] != 0){ echo $value['female_count_13_14']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_13_14'] != 0){ echo $value['male_count_13_14']; } else { echo "0"; } ?></td>

                       <td><?php if($value['female_count_14_15'] != 0){ echo $value['female_count_14_15']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_14_15'] != 0){ echo $value['male_count_14_15']; } else { echo "0"; } ?></td>

                       <td><?php if($value['female_count_15_16'] != 0){ echo $value['female_count_15_16']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_15_16'] != 0){ echo $value['male_count_15_16']; } else { echo "0"; } ?></td>

                       <td><?php if($value['female_count_16_17'] != 0){ echo $value['female_count_16_17']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_16_17'] != 0){ echo $value['male_count_16_17']; } else { echo "0"; } ?></td>

                       <td><?php if($value['female_count_17_18'] != 0){ echo $value['female_count_17_18']; } else { echo "0"; } ?></td>
                       <td><?php if($value['male_count_17_18'] != 0){ echo $value['male_count_17_18']; } else { echo "0"; } ?></td>

                       <td><?php echo $total_female_count; ?></td>
                       <td><?php echo $total_male_count; ?></td>
                    </tr>
                    <?php } } ?>

                    <?php 
                    if(count($report_result)>1)
                    {
                      ?>
                      <tfoot>
                        <tr class="custom_table_head">
                          <td colspan="2">Total</td>
                          <td><?php echo array_sum(array_column($report_result, 'female_count_under_12'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_under_12'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'female_count_12_13'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_12_13'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'female_count_13_14'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_13_14'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'female_count_14_15'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_14_15'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'female_count_15_16'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_15_16'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'female_count_16_17'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_16_17'));?></td>


                          <td><?php echo array_sum(array_column($report_result, 'female_count_17_18'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'male_count_17_18'));?></td>


                          <td><?php echo (array_sum(array_column($report_result, 'female_count_under_12')) + 
                                          array_sum(array_column($report_result, 'female_count_13_14')) + 
                                          array_sum(array_column($report_result, 'female_count_14_15')) +
                                          array_sum(array_column($report_result, 'female_count_15_16')) +
                                          array_sum(array_column($report_result, 'female_count_16_17')) +
                                          array_sum(array_column($report_result, 'female_count_17_18')) 
                                        ) 
                              ?>
                          </td>
                          <td><?php echo (array_sum(array_column($report_result, 'male_count_under_12')) + 
                                          array_sum(array_column($report_result, 'male_count_13_14')) + 
                                          array_sum(array_column($report_result, 'male_count_14_15')) +
                                          array_sum(array_column($report_result, 'male_count_15_16')) +
                                          array_sum(array_column($report_result, 'male_count_16_17')) +
                                          array_sum(array_column($report_result, 'male_count_17_18')) 
                                        ) 
                              ?>
                          </td>
                        </tr>
                      </tfoot>
                      <?php 
                    }  
                    ?>
                     <?php } else { ?>
                    <tr>
                        <td colspan="18" align="center"><font color="#990000" >  No Data Found !!! </font></td>
                    </tr>
                    <?php } ?>
                 </tbody>
              </table>
            </div>
         </div>
          <div class="box-footer"></div>
      </div>
      <?php } ?>
   </section>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $('#table').dataTable({
    "bDestroy": true
  }).fnDestroy();  
});
</script>
<!-- <script>
  $(document).ready(function() {
    // Get today's date
    const today = new Date();

    // Format the date to dd/mm/yyyy
    let day = today.getDate().toString().padStart(2, '0');
    let month = (today.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-indexed
    const year = today.getFullYear();

    // Set the value of the 'from_date' input field to today's date in the format dd/mm/yyyy
     $('[name="to_date"]').val(`${day}/${month}/${year}`);
    // $('#from_date').val(`${day}/${month}/${year}`);

    // Calculate the date 30 days prior to today
    const thirtyDaysAgo = new Date(today);
    thirtyDaysAgo.setDate(today.getDate() - 30);

    // Format the date to dd/mm/yyyy for 30 days ago
    let fromDay = thirtyDaysAgo.getDate().toString().padStart(2, '0');
    let fromMonth = (thirtyDaysAgo.getMonth() + 1).toString().padStart(2, '0');
    const fromYear = thirtyDaysAgo.getFullYear();

    // Set the value of the 'to_date' input field to 30 days ago in the format dd/mm/yyyy
     $('[name="from_date"]').val(`${fromDay}/${fromMonth}/${fromYear}`);
    // $('#to_date').val(`${fromDay}/${fromMonth}/${fromYear}`);

    // Show the form container when the form is opened
    $('#formContainer').show();

    // // Submit event for the form
    // $('#myForm').submit(function(event) {
    //   event.preventDefault();
    //   // Process form data here
    //   console.log('Form submitted!');
    //   // You can add form submission logic here
    // });
  });
</script> -->
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>