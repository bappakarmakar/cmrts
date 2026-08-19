<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    th {
      font-size: 13px;
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
    .user_box {
        margin-bottom: 15px;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Users List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
                <div class="user_box">
                    <?php if($this->session->userdata('stake_id_fk') == '6'){?>
                        <!-- <a href="<?php echo base_url()?>admin/user_list/user/create_new_user" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create New Users</a> -->
                    <?php } ?>
                    <?php if($this->session->userdata('stake_id_fk') == '6' || $this->session->userdata('stake_id_fk') == '3' || $this->session->userdata('stake_id_fk') == '2'){
                        ?>
                        <a href="<?php echo base_url()?>admin/user_list/user/download_excel_list" class="btn btn-success" style="margin-left: 12px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                        <?php } ?>
                     
                </div>
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">User Type</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Username</th>
                     <th class="text-center">Mobile No</th>
                     <th class="text-center">District</th>
                     <?php if($this->session->userdata('stake_id_fk') != '1'){?><th class="text-center">Block / Municipality</th><?php } ?>
                     <th class="text-center">Status</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php $c = 1; 
                  foreach($user_details as $value){?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value['stake_details']; ?></td>
                     <td><?php echo $value['name']; ?></td>
                     <td><?php echo $value['login_id']; ?></td>
                     <td><?php echo $value['mobile_no']; ?></td>
                     <td><?php echo ucwords(strtolower($value['district_name'])); ?></td>
                     <?php if($this->session->userdata('stake_id_fk') != '1'){?>
                        <td>
                        <?php if($value['stake_id_fk'] == 6){ 
                            echo ucwords(strtolower($value['subdiv_name'])); 
                        }elseif($value['stake_id_fk'] == 4 && $value['subdiv_name'] != ''){ 
                            echo ucwords(strtolower($value['block_name'])); 
                        }else{ echo ucwords(strtolower($value['block_name'])); } ?>
                        </td>
                     <?php } ?>
                     <td>
                     <?php if($value['status'] == 1){
                        if($value['active_status'] == 1){?>
                           <a href="javascript:void()" class="btn btn-success" onClick="Deactivate_User('<?php echo $value['stake_holder_login_id_pk']; ?>')"><i class="fa fa-check" aria-hidden="true"></i> Active >></a>
                     <?php }else{?>
                           <a href="javascript:void()" class="btn btn-danger" onClick="Activate_User('<?php echo $value['stake_holder_login_id_pk']; ?>')"><i class="fa fa-times" aria-hidden="true"></i> Inactive</a>
                     <?php } } ?>
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
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
$('table').DataTable();
// Activated User
function Activate_User(stake_id) {
    swal({
        title: "Activate User?",
        text: "This action will activate the user. Do you want to proceed?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Activate",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function (isConfirm) {
        if (isConfirm) {
            var stake_holder_id = stake_id;
            $.ajax({
                url: "user_list/user/Activate_User",
                method: "GET",
                data: { stake_holder_id: stake_holder_id },
                dataType: "JSON",
                success: function (response) {
                    swal({
                        title: "Activated",
                        text: "Please inform the user over sms or email that the account has been activated.",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    }, function() {
                        window.location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    swal("Error", "Failed to activate user. Please try again later.", "error");
                }
            });
        } else {
            swal("Cancelled", "Activation cancelled.", "error");
            /*setTimeout(function () {
                window.location.reload();
            }, 1500);*/
        }
    });
}

// Deactivated User
// function Deactivate_User(stake_id){
//    swal({
//    title: "Deactivate user?",
//    text: "This action will Deactivate the user. Do you want to proceed?",
//    type: "warning",
//    showCancelButton: true,
//    confirmButtonClass: "btn-success",
//    confirmButtonText: "Deactivate",
//    cancelButtonClass: "btn-danger",
//    cancelButtonText: "Cancel",
//    closeOnConfirm: false,
//    closeOnCancel: false,
//    showLoaderOnConfirm: true
//  },
//  function(isConfirm){
//    if(isConfirm){
//        var stake_holder_id = stake_id;
//        $.ajax({
//            url:"user_list/user/Deactivate_User",
//            method:"GET",
//            data:{stake_holder_id:stake_holder_id},
//            dataType:"JSON",
//            success:function(response)
//            {
//                swal("Deactivated", "User has been deactivated successfully", "success");
//                setTimeout(function(){
//                   window.location.reload();
//                }, 2000);
//            }
//        });
//    } else {
//        swal("Cancelled", "Deactivate cancel to user!", "error");
//        setTimeout(function(){
//           window.location.reload();
//        }, 1500);
//    } 
//  });
// }
  
function Deactivate_User(stake_id) {
    swal({
        title: "Deactivate user?",
        text: "This action will deactivate the user. Do you want to proceed?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Deactivate",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function (isConfirm) {
        if (isConfirm) {
            var stake_holder_id = stake_id;
            $.ajax({
                url: "user_list/user/Deactivate_User",
                method: "GET",
                data: { stake_holder_id: stake_holder_id },
                dataType: "JSON",
                success: function (response) {
                    swal({
                        title: "Deactivated",
                        text: "User has been deactivated successfully.",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    }, function() {
                        window.location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    swal("Error", "Failed to deactivate user. Please try again later.", "error");
                }
            });
        } else {
            swal("Cancelled", "Deactivation cancelled.", "error");
            /*setTimeout(function () {
                window.location.reload();
            }, 1500);*/
        }
    });
}

</script>
