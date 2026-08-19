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
	<h2>Police Case Report Data</h2>
	<table class="rwd-table">
		<thead>
         <tr>
            <th>Sl. No</th>
            <th>Incident ID</th>
            <th>GD No</th>
            <th>GD Date</th>
            <th>FIR No</th>
            <th>FIR Date</th>
         </tr>
		</thead>
		<tbody>
			<?php 
			$c = 1; 
			foreach($police_case_print_details_data as $value){?>
			<tr>
			    <td><?php echo $c++; ?></td>
          <td><?php echo $value->reporting_id; ?></td>
          <td><?php echo $value->gd_no; ?></td>
          <td><?php echo date('d-m-Y', strtotime($value->gd_date)); ?></td>
          <td><?php echo $value->fir_no; ?></td>
          <td><?php echo date('d-m-Y', strtotime($value->fir_date)); ?></td>
			</tr>
		  <?php } ?>
		</tbody>
	</table>
</body>
</html>

<script type="text/javascript"> 
var base_url = '<?=base_url()?>';
window.print();
window.onafterprint = function(event) {
   window.location.href = base_url+'admin/reporting/police_case/police_case_list';
};
</script>