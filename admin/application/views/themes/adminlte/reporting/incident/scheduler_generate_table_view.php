<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<!-- <?php echo "<pre>";print_r($dist_data); ?> -->
<div class="content-wrapper">
      <section class="content-header">
      <h1>Scheduler Generate Register</h1>
      <!-- <?php if($this->session->userdata('stake_id_fk') == '3') { ?>   
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/scheduler_generate_by_dist/" >
            <button class="btn btn-success" >Generate Legacy Scheduler</button>
         </a>
      <?php } ?> -->
      <!-- <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol> -->
     
   </section>

   <section class="content">
 
      <?php if ($this->session->userdata('stake_id_fk') == '3') { ?> 
         <?php 
         if (isset($incident_data) && is_array($incident_data) && !empty($incident_data)) { 
             $buttonStyle = '';
         } else {
             $buttonStyle = 'pointer-events: none; cursor: not-allowed; opacity: 0.6;';
         } 
         ?>
         <a href="<?php echo base_url()?>admin/Generate_scheduler_for_legacy_data/legacy_data_schd_generate/" 
          class="btn btn-success" id = "schd_btn" onclick= "btn_disable()"
          style="margin-top: 0px; float: right; margin-right: 10px; margin-bottom: 12px; <?php echo $buttonStyle; ?>">
          <i class="fa fa-plus-circle" aria-hidden="true"></i> Generate Scheduler for Legacy Data
         </a>
      <?php } ?>

      <div class="box-body" id="box-table">
      <table class="table table-bordered table-hover" id="mytable">
         <thead>
                  <tr class="custom_table_head">
                     <th colspan="4">Intervention</th>

                     <th colspan="1">Scheduler</th>
                     <th colspan="1">Status</th>
                     <!-- <th colspan="1">Action</th> -->
                  </tr>
                  <tr class = "custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">CP Age</th>

                     <th colspan="1">Scheduler  Generated Date</th>
                     <th class="text-center">Status</th>
                     <!-- <th class="text-center">Action</th> -->
                  </tr>
         </thead>
         <?php  $c = 1; ?>
         <?php foreach($dist_data as $data){ ?>
                <tbody id="childAppend">
                  <tr>
                  
                  <td><?php echo $c++;   ?></td>
                  <td><?php echo $data->reporting_id; ?></td>
                  <td><?php echo $data->incident_date; ?></td>
                  <?php if($data->cp_1_type === 1){ ?>
                    <td><?php echo get_cp_full_age($data->incident_date,$data->cp_1_dob) ?></td>
                  <?php } else { ?>
                    <td><?php echo get_cp_full_age($data->incident_date,$data->cp_2_dob) ?></td>
                  <?php } ?>

                  <td><?php if($data->schd_generated_date != NULL){
                     echo $data->schd_generated_date;
                  }else{
                     echo "Date Not Found";
                  } ?></td>

                  <td><?php if($data->new_schd_status == 0 || $data->new_schd_status == NULL){
                     echo "Scheduler Not Generated";
                  }else{
                     echo '<p style="padding: 0;margin: 0;color: #125e00;font-weight: bold;"><i class="fa fa-check-circle" aria-hidden="true"></i>Scheduler Generated</p>';
                  } ?></td>

                  
                   </tr>
                </tbody>
         <?php } ?>
      </table>
      </div>
   </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script type="text/javascript">
  function btn_disable()
  {
    $('#schd_btn').show().css({
      'pointer-events': 'none', 
      'cursor': 'not-allowed', 
      'opacity': '0.5'
    });
  }
</script>