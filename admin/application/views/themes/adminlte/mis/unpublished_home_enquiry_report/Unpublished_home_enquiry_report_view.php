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
      <h1>Unpublished Home enquiry Report</h1>
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
      <?php echo form_open('admin/mis/unpublished_home_enquiry_report/unpublished_home_enquiry_report', array('class' => 'EducationReportForm','name' => 'EducationReportForm', 'id' => 'EducationReportForm')) ?>

      <?php if($hide_search ==0)
      { ?>
        <div class="box bottom-box">
           <div class="box-body">
              <div class="card-body">
                 <!-- <div class="form-group row">
                   <label class="col-sm-12 col-form-label" style="color: red;">From Date and To Date should match each other.</label>
                 </div> -->
                 <!-- <div class="form-group row">
                   <label class="col-sm-2 col-form-label">From Date <font color="red">*</font></label>
                    <div class="col-sm-4">
                     <input type="text" name="from_date" class="form-control datepicker" data-date-end-date="0d" autocomplete="off" readonly placeholder="From Date" value="<?php if($this->input->post('from_date')){echo set_value('from_date'); }else{ echo date('d/m/Y', strtotime($currentDate_conv. ' - 30 days'));} ?>" style="background-color: white;">
                     <?php echo form_error('from_date');?>
                   </div>
                 </div> -->
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Date as on <font color="red">*</font></label>
                   <div class="col-sm-4">
                     <input type="text" class="form-control datepicker" data-date-end-date="0d" placeholder="To Date" autocomplete="off" readonly name="to_date" value="<?php if($this->input->post('to_date')){echo set_value('to_date'); }else{ echo $currentDate;} ?>" style="background-color: white;">
                     <?php echo form_error('to_date');?>
                   </div>
                 </div>
              </div>
           </div>
           <button type="submit" name="date_submit" class="btn btn-primary" style="margin-left: 8px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </div>
        <?php
      } ?>
      <?php echo form_close();?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
              
              <table id="table" class="table table-bordered table-striped">
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Jurisdiction</th>
                       <th class="text-center" colspan="3">DEO level</th>
                       <th class="text-center" colspan="2">BDO level</th>
                       <!-- <th class="text-center" colspan="2">Total</th> -->
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">Pending as Drafts</th>
                      <th class="text-center">Completed but not forwarded</th>

                      <th class="text-center">Received but reverted</th>
                      <th class="text-center">Received but not Published</th>
                      <th class="text-center">Published</th>
                      
                    </tr>
                 </thead>
                 
                  <tbody id="childAppend">
                  <?php
                  $c = 1;
                  // echo "<pre>";print_r($report_result);die;
                  if($force_view == 1){

                    $segregate_val = isset($_GET['segregate']) ? $_GET['segregate'] : $segregate; // check this one
                    $from_date_val = isset($_GET['from_date']) ? $_GET['from_date'] : $from_date;
                    $to_date_val = isset($_GET['to_date']) ? $_GET['to_date'] : $to_date;
                    $unique_id_val = isset($_GET['unique_id']) ? $_GET['unique_id'] : (isset($unique_id) ? $unique_id : null);
 

                     $url_download = base_url()."admin/mis/unpublished_home_enquiry_report/unpublished_home_enquiry_report/download_excel?segregate=".$segregate."&from_date=".$from_date_val."&to_date=".$to_date_val."&unique_id=".$unique_id_val;

                      echo '<a href="' . $url_download . '" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>';

                  if(isset($report_result) && count($report_result) > 0)
                  { 
                    ?> 
                    <?php foreach ($report_result as $value) 
                    {
                      // $segregate = 101;
                      // $url = base_url()."admin/mis/education_wise_report/education_wise_report/".$value['district_id_pk']."/".$date_raw_from."/".$date_raw_to;
                      // $url = base_url()."admin/mis/education_wise_mis/education_wise_mis?"."segregate".$segregate."from_date=".$from_date."&to_date=".$to_date;
                      $url = "";
                      if($segregate!="ward_gp")
                      {
                        $url = base_url()."admin/mis/unpublished_home_enquiry_report/unpublished_home_enquiry_report?segregate=".$segregate."&from_date=".$from_date."&to_date=".$to_date."&unique_id=".$value['unique_id'];
                      }


                      ?>
                      <?php
                     
                      ?>

             
                      <tr>
                      <td><?php echo $c++; ?></td>
                      
                      <td>
                        <?= (!empty($url) ? '<a href="' . $url . '">' : '') ?>
                        <?php echo $value['name']; ?>
                        <?= (!empty($url) ? '</a>' : '') ?>
                      </td>
                      <td><?= ($value['draft_report'] != 0)?($value['draft_report']):0 ;?></td>
                      <td><?= ($value['saved_report'] != 0)?($value['saved_report']):0 ;?></td>
                      <td><?= ($value['reverted_report'] != 0)?($value['reverted_report']):0 ;?></td>
                      <td><?= ($value['forwarded_report'] != 0)?($value['forwarded_report']):0 ;?></td>
                      <td><?= ($value['published_report'] != 0)?($value['published_report']):0 ;?></td>
                      <!-- <td><?= ($value['total_report'] != 0)?($value['total_report']):0 ;?></td> -->

                      </tr>
                      <?php
                    } ?>
                    <?php 
                  if(count($report_result)>1)
                  {
                    ?>
                  </tbody>
                  <tfoot>
                    <tr class="custom_table_head">
                      <td colspan="2">Total</td>
                      <td><?php echo array_sum(array_column($report_result, 'draft_report'));?></td>

                      <td><?php echo array_sum(array_column($report_result, 'saved_report'));?></td>

                      <td><?php echo array_sum(array_column($report_result, 'reverted_report'));?></td>
                      <td><?php echo array_sum(array_column($report_result, 'forwarded_report'));?></td>

                      <td><?php echo array_sum(array_column($report_result, 'published_report'));?></td>

                      <!-- <td><?php echo array_sum(array_column($report_result, 'total_report'));?></td> -->
<!--  -->


                    </tr>
                  </tfoot>
                      <?php
                  }
                }
                else
                { ?>
                  <tr>
                    <td colspan="14" align="center"><font color="#990000" >  No Data Found !!! </font>
                    </td>
                  </tr>
                <?php
                }   }                   
                  ?>
                 
              </table>



            </div>
         </div>
          <div class="box-footer"></div>
      </div>
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