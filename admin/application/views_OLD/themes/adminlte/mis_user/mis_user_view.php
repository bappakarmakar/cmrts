<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>





<div class="content-wrapper">
   <section class="content-header">
      <h1>Active/Inactive User List</h1>
      <br>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <?php //echo "<pre>";print_r($sdo[0]);echo"</pre>" ?>
	<div class="box-footer">
		<div class="box-body">
   		<h2>SDO List</h2>
   		<a href="<?php echo base_url().'admin/mis_user/mis_user/download_sdo/'?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
		    <table class="table table-bordered table-hover" id="mytable">
		       <thead>
		          <tr class="custom_table_head">
		             <th class="text-center">Sl. No</th>
		             <th class="text-center">District Name</th>
		             <th class="text-center">Subdiv Name</th>
		             <th class="text-center">User name</th>
		             <th class="text-center">status</th>
		          </tr>
		       </thead>
		       <tbody id="childAppend">
				<?php 
					$c = 1;
				foreach($sdo as $value)
				{
					?>
					<tr>
						<td><?php echo $c++; ?></td>
						<td><?php echo $value->district_name; ?></td>
						<td><?php echo $value->subdiv_name; ?></td>
						<td><?php echo $value->login_id; ?></td>
						<td>
							<?php 
								if($value->active_status == 1 && $value->status == 1)
								{
									echo "<p style='color:green'>Active</p>";
								}
								else
								{
									echo "<p style='color:red'>Inactive</p>";
								}
								// if($value->active_status == 0 && $value->status == 0)
								// {
								// 	echo "Inactive";
								// }
							?>
						</td>
					</tr>
                  <?php 
              	} 
              		?>

		       </tbody>
		     </table>
		</div>
	</div>

	<div class="box-footer">
		<div class="box-body">
			<h2>BDO List</h2>
			<a href="<?php echo base_url().'admin/mis_user/mis_user/download_bdo/'?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
		    <table class="table table-bordered table-hover" id="mytable">
		       <thead>
		          <tr class="custom_table_head">
		             <th class="text-center">Sl. No</th>
		             <th class="text-center">District Name</th>
		             <th class="text-center">Block Name</th>
		             <th class="text-center">User name</th>
		             <th class="text-center">status</th>
		          </tr>
		       </thead>
		       <tbody id="childAppend">
				<?php 
					$c = 1;
				foreach($bdo as $value)
				{
					?>
					<tr>
						<td><?php echo $c++; ?></td>
						<td><?php echo $value->district_name; ?></td>
						<td><?php echo $value->block_name; ?></td>
						<td><?php echo $value->login_id; ?></td>
						<td>
							<?php 
								if($value->active_status == 1 && $value->status == 1)
								{
									echo "<p style='color:green'>Active</p>";
								}
								else
								{
									echo "<p style='color:red'>Inactive</p>";
								}
								// if($value->active_status == 0 && $value->status == 0)
								// {
								// 	echo "Inactive";
								// }
							?>
						</td>
					</tr>
                  <?php 
              	} 
              		?>

		       </tbody>
		     </table>
		</div>
	</div>

	<div class="box-footer">
		<div class="box-body">
			<h2>DEO List(Municipality)</h2>
			<a href="<?php echo base_url().'admin/mis_user/mis_user/download_sdo_deo/'?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
		    <table class="table table-bordered table-hover" id="mytable">
		       <thead>
		          <tr class="custom_table_head">
		             <th class="text-center">Sl. No</th>
		             <th class="text-center">District Name</th>
		             <th class="text-center">Subdiv Name</th>
		             <th class="text-center">Municipality name</th>
		             <th class="text-center">DEO name</th>
		             <th class="text-center">status</th>
		          </tr>
		       </thead>
		       <tbody id="childAppend">
				<?php 
					$c = 1;
					// echo "<pre>";print_r($sdo_deo);echo "</pre>";
				foreach($sdo_deo as $value)
				{ 
					?>
					<tr>
						<td><?php echo $c++; ?></td>
						<td><?php echo $value->district_name; ?></td>
						<td><?php echo $value->subdiv_name; ?></td>
						<td><?php echo $value->block_name; ?></td>
						<td><?php echo $value->deo_login_id; ?></td>
						<td>
							<?php 
								if($value->active_status == 1 && $value->status == 1)
								{
									echo "<p style='color:green'>Active</p>";
								}
								else
								{
									echo "<p style='color:red'>Inactive</p>";
								}
								// if($value->active_status == 0 && $value->status == 0)
								// {
								// 	echo "Inactive";
								// }
							?>
						</td>
					</tr>
                  <?php 
              	} 
              		?>

		       </tbody>
		     </table>
		</div>
	</div>


	<div class="box-footer">
		<div class="box-body">
			<h2>DEO List(Block)</h2>
			<a href="<?php echo base_url().'admin/mis_user/mis_user/download_bdo_deo/'?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
		    <table class="table table-bordered table-hover" id="mytable">
		       <thead>
		          <tr class="custom_table_head">
		             <th class="text-center">Sl. No</th>
		             <th class="text-center">District Name</th>
		             <th class="text-center">Block Name</th>
		             <!-- <th class="text-center">BDO name</th> -->
		             <th class="text-center">DEO name</th>
		             <th class="text-center">status</th>
		          </tr>
		       </thead>
		       <tbody id="childAppend">
				<?php 
					$c = 1;
					//echo "<pre>";print_r($bdo_deo);echo "</pre>";
				foreach($bdo_deo as $value)
				{
					//echo $value->district_name.'---->>>'.$value->block_name.'>>>>'.$value->deo_login_id.'</br>';
					if($value->block_name!=''){
									 
					?>
					<tr>
						<td><?php echo $c++; ?></td>
						<td><?php echo $value->district_name; ?></td>
						<td><?php echo $value->block_name; ?></td>
						<td><?php echo $value->deo_login_id; ?></td>
						<td>
							<?php 
								if($value->active_status == 1 && $value->status == 1)
								{
									echo "<p style='color:green'>Active</p>";
								}
								else
								{
									echo "<p style='color:red'>Inactive</p>";
								}
							?>
						</td>
					</tr>
                  <?php 
              		}
              	} 
              	?>

		       </tbody>
		     </table>
		</div>
	</div>

	<div class="box-footer">
		<div class="box-body">
			<h2>MIS user (Distrct level)</h2>
			<a href="<?php echo base_url().'admin/mis_user/mis_user/download_mis_dist/'?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
		    <table class="table table-bordered table-hover" id="mytable">
		       <thead>
		          <tr class="custom_table_head">
		             <th class="text-center">Sl. No</th>
		             <th class="text-center">District Name</th>
		             <!-- <th class="text-center">Block Name</th> -->
		             <!-- <th class="text-center">BDO name</th> -->
		             <th class="text-center">MIS user name</th>
		             <th class="text-center">status</th>
		          </tr>
		       </thead>
		       <tbody id="childAppend">
				<?php 
					$c = 1;
					// echo "<pre>";print_r($bdo_deo);echo "</pre>";
				foreach($mis_dist as $value)
				{
					?>
					<tr>
						<td><?php echo $c++; ?></td>
						<td><?php echo $value->district_name; ?></td>
						<!-- <td><?php echo $value->block_name; ?></td> -->
						<!-- <td><?php echo $value->bdo_login_id; ?></td> -->
						<td><?php echo $value->mis_login_id; ?></td>
						<td>
							<?php 
								if($value->active_status == 1 && $value->status == 1)
								{
									echo "<p style='color:green'>Active</p>";
								}
								else
								{
									echo "<p style='color:red'>Inactive</p>";
								}
								// if($value->active_status == 0 && $value->status == 0)
								// {
								// 	echo "Inactive";
								// }
							?>
						</td>
					</tr>
                  <?php 
              	} 
              		?>

		       </tbody>
		     </table>
		</div>
	</div>



</div>





<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>