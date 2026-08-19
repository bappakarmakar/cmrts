<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
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
    .btn-primary {
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
      <h1>Interventions Undertaken Report</h1>
      <ol class="breadcrumb">
         <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php 
          $currentDate = date('d/m/Y'); 
          $currentDate_conv = date('Y/m/d'); 
      ?>
      <?php echo form_open('admin/mis/cm_report/cm_report_view', array('class' => 'CMReportForm','name' => 'CMReportForm', 'id' => 'CMReportForm')) ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <!-- <div class="form-group row">
                 <label class="col-sm-12 col-form-label" style="color: red;">From Date and To Date should match each other.</label>
               </div> -->
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">From Date<font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" name="from_date" class="form-control datepicker" data-date-end-date="0d" autocomplete="off" readonly placeholder="From Date" value="<?php if($this->input->post('from_date')){echo set_value('from_date'); }else{ echo date('d/m/Y', strtotime($currentDate_conv. ' - 30 days'));} ?>" style="background-color: white;">
                   <?php echo form_error('from_date');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">To Date<font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" class="form-control datepicker" data-date-end-date="0d" placeholder="To Date" autocomplete="off" readonly name="to_date" value="<?php if($this->input->post('to_date')){echo set_value('to_date'); }else{ echo $currentDate;} ?>" style="background-color: white;">
                   <?php echo form_error('to_date');?>
                 </div>
               </div>
            </div>
         </div>
         <button type="submit" name="cm_report_sub" class="btn btn-primary" style="margin-left: 8px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
      </div>
      <?php echo form_close();?>
      <?php if( (count($this->form_validation->error_array()) == 0) || $force_view == 1 ){?>
      <?php
      if($force_view == 1){
        $date_from = explode('-', $from_date);
      }else{
        $date_from = explode('/', $_POST['from_date']);
        // echo 'OKKK----'.$_POST['from_date'];
      }

      $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
          
      if($force_view == 1){
        $date_to = explode('-', $to_date);
      }else{
        $date_to = explode('/', $_POST['to_date']);
      }
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
                      $download_excel_link = base_url()."admin/mis/cm_report/cm_report_view/GP_Ward_Wise_Download_Excel/".$block_id."/".$date_raw_from."/".$date_raw_to;

                    }elseif($stake_id_fk == '6'){
                      $download_excel_link = base_url()."admin/mis/cm_report/cm_report_view/GP_Ward_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;

                    }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){ 
                      if(empty($district_id)){
                        $download_excel_link = base_url()."admin/mis/cm_report/cm_report_view/District_Wise_Download_Excel/".$date_raw_from."/".$date_raw_to;
                      }else{
                        $download_excel_link = base_url()."admin/mis/cm_report/cm_report_view/SD_Block_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;
                      }
                    }elseif($stake_id_fk == '2'){
                      $download_excel_link = base_url()."admin/mis/pending_status_report/pending_status_report_view/GP_Ward_Wise_Download_Excel/".$block_id."/".$date_raw_from."/".$date_raw_to;
                    }elseif($stake_id_fk == '3'){  
                      $download_excel_link = base_url()."admin/mis/cm_report/cm_report_view/SD_Block_Wise_Download_Excel/".$district_id."/".$date_raw_from."/".$date_raw_to;
                    }else{
                      $download_excel_link ="";
                    } 
                  ?>


                  <a href="<?php echo $download_excel_link; ?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Jurisdiction</th>
                       <th class="text-center" colspan="2">Before</th>
                       <th class="text-center" colspan="2">On Day of Marriage</th>
                       <th class="text-center" colspan="2">After</th>
                       <th class="text-center" colspan="2">Totals</th>
                       <th class="text-center" colspan="2">No. of minor involved</th>
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Female</th>
                      <th class="text-center">Male</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                    <?php 
                    //echo '<pre>';print_r($report_result);
                    if(count((array)$report_result) > 0){
                      if(isset($report_result)){
                        $c = 1;
                        foreach($report_result as $value){ 

                          if($force_view == 1)
                          {
                            $date_from = explode('-', $from_date);
                            // print_r($date_from );die;
                          }
                          else
                          {
                            $date_from = explode('/', $_POST['from_date']);
                          }

                          $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
                              
                          if($force_view == 1)
                          {
                            $date_to = explode('-', $to_date);
                          }
                          else
                          {
                            $date_to = explode('/', $_POST['to_date']);
                          }
                          $date_raw_to = $date_to['2']."-".$date_to['1']."-".$date_to['0'];

                          $before_marriage_prevented = $value['before_marriage_prevented'];
                          $before_marriage_not_prevented = $value['before_marriage_not_prevented'];

                          $during_marriage_prevented = $value['during_marriage_prevented'];
                          $during_marriage_not_prevented = $value['during_marriage_not_prevented'];

                          $after_marriage_prevented = $value['after_marriage_prevented'];
                          $after_marriage_not_prevented = $value['after_marriage_not_prevented'];

                          $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

                          $total_not_prevented = $before_marriage_not_prevented+$during_marriage_not_prevented+$after_marriage_not_prevented;

                    ?>
                    <tr>
                       <td><?php echo $c++;?></td>
                       <td style="text-align: left;">
                        <?php 
                          if($stake_id_fk==4){
                            $url = "";
                            $district_name = $value['ward_gp_name'];

                          }elseif($stake_id_fk == '6'){
                            $url = base_url()."admin/mis/cm_report/cm_report_view/ward_gp/".$value['block_id_pk']."/".$date_raw_from."/".$date_raw_to;
                            $district_name = $value['block_name'];

                          }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){ 
                            $url = base_url()."admin/mis/cm_report/cm_report_view/block_wise/".$value['district_id_pk']."/".$date_raw_from."/".$date_raw_to;
                            $district_name = $value['district_name'];
                          }elseif($stake_id_fk == '2'){
                            $url = "";
                            $district_name = $value['ward_gp_name'];
                          }elseif($stake_id_fk == '3'){  

                            $url = base_url()."admin/mis/cm_report/cm_report_view/ward_gp/".$value['block_id_pk']."/".$date_raw_from."/".$date_raw_to;
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
                       <td><?php if($value['before_marriage_prevented'] != 0){ echo $value['before_marriage_prevented']; } else{ echo "0"; } ?></td>
                       <td><?php if($value['before_marriage_not_prevented'] != 0){ echo $value['before_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php if($value['during_marriage_prevented'] != 0){ echo $value['during_marriage_prevented']; } else { echo "0"; } ?></td>
                       <td><?php if($value['during_marriage_not_prevented'] != 0){ echo $value['during_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php if($value['after_marriage_prevented'] != 0){ echo $value['after_marriage_prevented']; } else { echo "0"; } ?></td>
                       <td><?php if($value['after_marriage_not_prevented'] != 0){ echo $value['after_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php echo $total_prevented; ?></td>
                       <td><?php echo $total_not_prevented; ?></td>

                       <td><?php if($value['total_female_count_under_18'] != 0){ echo $value['total_female_count_under_18']; } else { echo "0"; } ?></td>
                       <td><?php if($value['total_male_count_under_18'] != 0){ echo $value['total_male_count_under_18']; } else { echo "0"; } ?></td>
                    </tr>
                    <?php } } ?>

                    <?php 
                    if(count($report_result)>1)
                    {
                      ?>
                      <tfoot>
                        <tr class="custom_table_head">
                          <td colspan="2">Total  --->></td>
                          <td><?php echo array_sum(array_column($report_result, 'before_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'before_marriage_not_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'during_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'during_marriage_not_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'after_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'after_marriage_not_prevented'));?></td>

                          <td><?php echo (array_sum(array_column($report_result, 'before_marriage_prevented')) + array_sum(array_column($report_result, 'during_marriage_prevented')) + array_sum(array_column($report_result, 'after_marriage_prevented')))
                              ?>
                          </td>
                          <td><?php echo (array_sum(array_column($report_result, 'before_marriage_not_prevented')) + array_sum(array_column($report_result, 'during_marriage_not_prevented')) + array_sum(array_column($report_result, 'after_marriage_not_prevented')))
                              ?>
                          </td>

                          <td><?php echo array_sum(array_column($report_result, 'total_female_count_under_18'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'total_male_count_under_18'));?></td>



                        </tr>
                      </tfoot>
                      <?php 
                    }  
                    ?>

                    <?php } else { ?>
                    <tr>
                         <td colspan="14" align="center"><font color="#990000" >  No Data Found !!! </font></td>
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

      // Set the value of the 'to_date' input field to today's date in the format dd/mm/yyyy
      $('[name="to_date"]').val(`${day}/${month}/${year}`);

      // Show the form container when the form is opened
      $('#formContainer').show();

      // Submit event for the form
      $('#myForm').submit(function(event) {
        event.preventDefault();
        // Process form data here
        console.log('Form submitted!');
        // You can add form submission logic here
      });
    });
  </script> -->

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
<script type="text/javascript">
  $(document).ready(function(){

    $('.toDateDatepicker').datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1900:+0',
      dateFormat: 'dd/mm/yy', 
      maxDate: '0',
      // setDate: new Date()
    });
    $('.fromDateDatepicker').datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1900:+0',
      dateFormat: 'dd/mm/yy', 
      maxDate: '0'
    });

    


  });
</script>