<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Print List</title>
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
  </style>
</head>
<body>
  <h2>Home Enquiry Register Data</h2>
  <div class="date">
    <?php 
      if(isset($start_date) && isset($end_date))
      {
        echo "From Date : ".$start_date."<br>";
        echo "To Date : ".$end_date."<br>";
      }
    ?>

  </div>
  <table class="rwd-table">
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
          </tr>
    </thead>
               <tbody id="childAppend">
                  <?php 

                  // echo "<pre>"
                  $c = 1;
                  foreach($home_visits_print_details_data as $value){
                    if($value->cp_age<18)
                    {
                    // $data['home_visits_total_details']->$key['minor_adult_status'] = "Home Visit Minor Form";
                      $value->minor_adult_status = "Minor";
                    }
                    else
                    {
                      $value->minor_adult_status = "Adult";
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
                     <!-- <td><?php echo $value->cp_age; ?></td> -->
                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_dob); ?></td>
                     
                     <td><?php if($value->home_enquiry_date != ''){?><?php echo date('d-m-Y', strtotime($value->home_enquiry_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <!-- <td><?php echo $value->age_of_home_enquiry; ?></td> -->
                     <td><?php get_full_for_excel_view_for_he($value->home_enquiry_date, $value->cp_dob); ?>
                     <td>
                        <?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?>
                    </td>
                     <td><?php echo $value->cp_name; ?></td>
                     <td><?php echo $value->cp_gender_val; ?></td>
                    
                     <!-- <td><?php //echo $value->hv_status; ?></td> -->
                     <td><?php echo $value->minor_adult_status; ?></td>
                     <td><?php echo $value->status; ?></td>
                  </tr>
                  <?php } ?>
               </tbody>
  </table>
</body>
</html>
<script type="text/javascript"> 
   var base_url = '<?php echo base_url(); ?>';
   window.print();
   window.onafterprint = function(event) {
     window.location.href = base_url+'admin/reporting/home_visit/home_visits_list';
   };
</script>
