<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Print List</title>
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
  </style>
</head>
<body onload="window.print();">
  <h2>Follow Up Visit Register Data</h2>
  <div class="date">
    <?php 
      if(isset($start_date) && isset($end_date))
      {
        echo "From Date : ".$start_date."<br>";
        echo "To Date : ".$end_date."<br>";
      }
    ?>

  </div>
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
                    else if($value->fv_status == 1)
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
                     <!-- <td><?php echo $value->cp_1_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_1_dob); ?></td>
                     
                     <td><?php if($value->followup_date != ''){?><?php echo date('d-m-Y', strtotime($value->followup_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <!-- <td><?php echo $value->age_on_folllowup; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->followup_date, $value->cp_1_dob); ?></td>
                     
                     <!-- <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td> -->
                     <td><?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     
                     <td>
                       <?php if($value->fv_status==1)
                       {echo 'Saved';}elseif ($value->fv_status==2) {echo 'Forwarded';}else if($value->fv_status==3){echo 'Published';}elseif ($value->fv_status==4) {echo 'Reverted'; } else{echo "saved as drafts";} ?>
                     </td>
                     
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
</body>
</html>
<script type="text/javascript">
setTimeout(window.close, 1);
</script>