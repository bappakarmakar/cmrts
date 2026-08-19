<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Print List</title>
      <base href="<?php echo base_url(); ?>admin/" />
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
      <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
      <style type="text/css">
         table {
         font-family: arial, sans-serif;
         border-collapse: collapse;
         width: 100%;
         }
         td, th {
         border: 1px solid #dddddd;
         text-align: center;
         padding: 8px;
         }
         th {
         background: #428bca;
         color: #ffffff;
         }
         tr {
         border-top: 1px solid #ddd;
         border-bottom: 1px solid #ddd;
         background-color: #f5f9fc;
         }
         tr:nth-child(odd):not(:first-child) {
         background-color: #ebf3f9;
         }
         h2 {
         text-align: center;
         font-size: 2.4em;
         color: #000000;
         text-decoration: underline;
         }
         @media print
         {
         body{
         padding: 0;
         margin: 0;
         }
         @page {size: landscape}
         }
      </style>
   </head>
   <body>
      <input type="hidden" id="base" value="<?php echo base_url(); ?>">
      <h2 style="text-transform: uppercase;">Intervention Report Data <span style="font-size:30px"><?php echo $user_dist?></span></h2>
      <?php if(!empty($start_date) || !empty($end_date)){ ?>
      <div class="date text-center" style=" margin:0 auto;">
         <div style="display:flex;">
         <h5>From Date : <?php echo $start_date; ?></h5>
         &nbsp;
         <h5>To Date : <?php echo $end_date; ?></h5>
      </div>
      </div>
   <?php } ?>
      <table class="rwd-table">
         <thead>
            <tr>
               <th colspan="5">Intervention</th>
               <th colspan="6">Contracting Party 1</th>
               <th colspan="6">Contracting Party 2</th>
            </tr>
            <tr>
               <th>Sl. No</th>
               <th>Intervention ID</th>
               <th>Intervention Date</th>
               <th>Location</th>
               <th>Police Station</th>
               <th>Name</th>
               <th>Gender</th>
               <th>Age</th>
               <th>Address</th>
               <th>Police Station</th>
               <th>CP One Status</th>
               <th>Name</th>
               <th>Gender</th>
               <th>Age</th>
               <th>Address</th>
               <th>Police Station</th>
               <th>CP Two Status</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $c = 1;
               foreach($Incident_Print_Data as $value){

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
                  <td><?=($value)?$value->police_station:''?></td>
                  <td><?php echo $value->cp_1_name; ?></td>
                  <td><?php echo $value->cp_1_gender_value; ?></td>
                  <!-- <td><?php echo $value->cp_1_age; ?></td> -->

                  <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_1_dob); ?></td>

                  <?php if($value->cp_1_state == 1){?>
                  <td>
                     <?php echo $value->cp_1_district;?>,<br>
                     <?php echo $value->cp_1_block?>,<br>
                     <?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?>
                  </td>
                  <?php }else{ ?>
                  <td><?php echo $value->cp_1_address;?></td>
                  <?php } ?>
                  <td><?=($value)?$value->cp_1_police_station:''?></td>
                  <td><?php echo cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);?> </td>
                  <td><?php echo $value->cp_2_name; ?></td>
                  <td><?php echo $value->cp_2_gender_value; ?></td>

                  <!-- <td><?php echo $value->cp_2_age; ?></td> -->

                  <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_2_dob); ?></td>
                  <?php if($value->cp_2_state == 1){?>
                  <td>
                     <?php echo $value->cp_2_district;?>,<br>
                     <?php echo $value->cp_2_block; ?>,<br>
                     <?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?>
                  </td>
                  <?php }else{?>

                  <td><?php echo $value->cp_2_address;?></td>
                  <?php } ?>
                  <td><?=($value)?$value->cp_2_police_station:''?></td>
                  <?php if($value->cp_two_is_available==1)
                   { 
                     ?>  
                     <td><?php echo cp_status($value->current_status, $value->cp_2_id_pk, $value->cp_2_age);?></td>
                     <?php
                   }elseif ($value->cp_two_is_available==2 || $value->cp_two_is_available =='') 
                   {
                     echo '<td>CP2 is not available</td>';
                   }else
                   {
                     echo '<td></td>';
                   }
                     ?>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </body>
</html>
<script type="text/javascript"> 
   var base_url = $('#base').val();
   // alert(base_url);
   window.print();
   window.onafterprint = function(event) {
     window.location.href = base_url+'admin/reporting/incident/incident_list';
   };
</script>
<!--   <script type="text/javascript"> 
  var base_url = '<?=base_url()?>';
  alert(base_url);
  window.print();
  window.onafterprint = function(event) {
    alert(1234);
    window.close();
  };
  </script> -->