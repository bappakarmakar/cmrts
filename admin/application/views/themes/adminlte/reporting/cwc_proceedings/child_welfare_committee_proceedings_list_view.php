<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    th {
      font-size: 12px;
    }
    td {
      font-size: 13px;
    }
    .dataTables_length {
      display: block;
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
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>CWC Proceedings List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right;margin-right: 20px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>

         <a href="<?php echo base_url()?>admin/reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_download" class="btn btn-success download" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>

         <a href="<?php echo base_url()?>admin/reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_print" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Incident ID</th>
                     <th class="text-center">Minor Details</th>
                     <th class="text-center">Minor Sent to</th>
                     <th class="text-center">Case No</th>
                     <th class="text-center">Case Date</th>
                     <th class="text-center">District</th>
                     <th class="text-center">SD/Block</th>
                     <th class="text-center">CCI Name</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php 
                  $c = 1;
                  foreach($cwc_proceedings_details as $value){
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php if($value->minor_details == '1'){?>Contracting Party One<?php }else{?>Contracting Party Two<?php } ?></td>
                     <td><?php if($value->minor_sent == '4'){?>Institutional Care <?php } ?></td>
                     <td><?php echo $value->case_no; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->case_date)); ?></td>
                     <td><?php echo ucwords(strtolower($value->district_name)); ?></td>
                     <td><?php echo ucwords(strtolower($value->block_name)); ?></td>
                     <td><?php echo $value->cci_name; ?></td>
                     <td>
                         <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $c; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a></li>
                           
                            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php //echo base_url()?>admin/reporting/cwc_proceedings/child_welfare_committee_proceedings_list/edit/<?php //echo base64_encode($value->sl_no); ?>/<?php //echo base64_encode($value->minor_details); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li> -->
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
   <?php
   $k = 2;
   foreach($cwc_proceedings_details as $value){
   ?>
   <div id="viewModal<?php echo $k++; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">CWC Proceedings Data</h4>
            </div>
            <div class="modal-body">
               <div class="div-table">
                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">Incident ID :</div>
                     <div class="td"><?php echo $value->reporting_id; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Minor Details : </div>
                     <div class="td"><?php if($value->minor_details == '1'){?>Contracting Party One<?php }else{?>Contracting Party Two<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Minor Sent to : </div>
                     <div class="td"><?php if($value->minor_sent == '4'){?>Institutional Care <?php }?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Case No : </div>
                     <div class="td"><?php echo $value->case_no; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Case Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->case_date)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">State : </div>
                     <div class="td"><?php if($value->state == 19){?>West Bengal<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">District : </div>
                     <div class="td"><?php echo ucwords(strtolower($value->district_name)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">SD/Block : </div>
                     <div class="td"><?php echo ucwords(strtolower($value->block_name)); ?></div>
                   </div>
                    <div class="tr">
                     <div class="td">CCI Name : </div>
                     <div class="td"><?php echo $value->cci_name; ?></div>
                   </div>
                   <?php if($value->remarks != ''){?>
                   <div class="tr">
                     <div class="td">Remarks : </div>
                     <div class="td"><?php echo $value->remarks; ?></div>
                   </div>
                   <?php } ?>
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <!-- View End Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>