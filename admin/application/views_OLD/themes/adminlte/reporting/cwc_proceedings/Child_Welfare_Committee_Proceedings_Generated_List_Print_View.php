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
  <h2>CWC Proceedings Report Data</h2>
  <table class="rwd-table">
    <thead>
         <tr>
            <th>Sl. No</th>
            <th>Incident ID</th>
            <th>Minor Details</th>
            <th>Minor Sent to</th>
            <th>Case No</th>
            <th>Case Date</th>
            <th>District</th>
            <th>SD/Block</th>
            <th>CCI Name</th>
         </tr>
    </thead>
    <tbody>
         <?php 
         $c = 1;
         foreach($cwc_proceedings_details_data as $value){
         ?>
         <tr>
            <td><?php echo $c++; ?></td>
            <td><?php echo $value->reporting_id; ?></td>
            <td><?php if($value->minor_details == '1'){?>Contracting Party One<?php }else{?>Contracting Party Two<?php } ?></td>
            <td><?php if($value->minor_sent == '4'){?>Institutional Care <?php }?></td>
            <td><?php echo $value->case_no; ?></td>
            <td><?php echo date('d-m-Y', strtotime($value->case_date)); ?></td>
            <td><?php echo ucwords(strtolower($value->district_name)); ?></td>
            <td><?php echo ucwords(strtolower($value->block_name)); ?></td>
            <td><?php echo $value->cci_name; ?></td>
         </tr>
         <?php } ?>
    </tbody>
  </table>
</body>
</html>
<script type="text/javascript">
setTimeout(window.close, 1);
</script>