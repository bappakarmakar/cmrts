<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
/*   input[type="radio"] {
   cursor: not-allowed;
   }*/
   .star {
   color: red;
   font-size: 14px;
   }
   .mtop20 {
   margin-top: 20px;
   }
   .mbottom20 {
   margin-bottom: 20px;
   }
   .mright20 {
   margin-right: 20px;
   }
   .ttext {
   text-align: left !important;
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
   .count_one {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #00ccff;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_two {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #339933;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_three {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #e6b800;
   padding: 7px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_four {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #dd4b39;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
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
   .modal_table {
   background: #339933;
   color: #FFFFFF;
   }
   .modal_incident {
   background: #085876;
   color: #fff;
   }
   .dataTables_length {
   display: block;
   max-width: 100%;
   margin-bottom: 5px;
   font-weight: 700;
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
   .div-table .title,
   .table-tag .title {
   text-align: center;
   padding-bottom: 0.5em;
   font-size: 20px;
   font-weight: bold;
   }
   .datepicker {
   background: #fff;
   }
   .error {
   color: #a94442;
   }
   .fa-arrow-down {
   margin-left: 430px;
   }
   .custom-modal-header {
   background: #12386e;
   }
   .close {
   border-radius: 50px;
   background: #ffffff !important;
   width: 28px;
   height: 27px;
   color: red;
   }
   .label-div
   {
   display: flex;
   justify-content: end;
   }
   .inp
   {
   width: 24%;
   margin-left: 10px;
   }
   .otp-input-fields
   {
   display: flex;
   }
   .otp-input-fields input[type=number]
   {
   width: 20%;
   background-color: #0000000d;
   margin-right: 5px;
   outline: none;
   border: none;
   }
   .otp-input-fields {
   background-color: white;
   width: auto;
   display: flex;
   justify-content: center;
   gap: 10px;
   }
   .otp-input-fields input {
   height: 34px;
   width: 40px;
   background-color: transparent;
   border-radius: 0px;
   border: 1px solid #0b1b52;
   text-align: center;
   outline: none;
   font-size: 16px;
   border: 1px solid #ccc!important;
   }
   .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   margin: 0;
   }
   .otp-input-fields input[type=number] {
   -moz-appearance: textfield;
   }
   .otp-input-fields input:focus {
   border-width: 2px;
   border-color: #287a1a;
   font-size: 20px;
   }
   .des-loc
   {
   display: flex;
   flex-wrap: wrap;
   }
   .inp-radio
   {
   width: 28%;
   }
   .inp-inf
   {
   float: right;
   }
   .left-form
   {
   position: relative;
   }
   .Information_Received
   {
   position: absolute;
   right: 75px;
   top:0;
   text-align: right;
   }
   .Information_Received h5 
   {
   text-align: right;
   }
   #box-table
  {
  max-height: 360px;
  scrollbar-color: #3c8dbc8a #d9d9d9;
  scrollbar-width: thin;
  }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>User Change Request List (sent)</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
            <a href="<?php echo base_url()?>admin/user_change/user_change" class="btn btn-primary" style="margin-top: 8px; float: left; margin-left: 10px;margin-bottom: 12px;">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> New Request
            </a>
          <div class="box-body" id="box-table">
              <table class="table table-bordered table-hover" id="mytable">
                  <thead>
                      <!-- <tr class="custom_table_head">
                          <th colspan="5">Intervention</th>
                          <th colspan="6">Contracting Party 1</th>
                          <th colspan="6">Contracting Party 2</th>
                          <th colspan="1">Status</th>
                          <th colspan="1">Action</th>
                      </tr> -->
                      <tr class="custom_table_head">
                          <th class="text-center">Sl. No</th>
                          <th class="text-center">Request Date</th>
                          <th class="text-center">User Type</th>
                          <th class="text-center">UserName</th>
                          <th class="text-center">New User</th>
                          <th class="text-center">Phone No</th>
                          <th class="text-center">Email id</th>
                          <th class="text-center">Status</th>
                          <!-- <th class="text-center">Action</th> -->
                      </tr>
                  </thead>
                  <tbody id="childAppend">
                     <?php $c = 1; //echo "<pre>";print_r($requested_data);?>
                     <?php foreach($requested_data as $value) 
                     { ?>
                        <tr>
                            <td><?php echo $c++; ?></td>

                            <td><?php echo date('d-m-Y', strtotime($value['requested_time'])) ?></td>
                            <td><?php echo $value['stake_details'] ?></td>
                            <td><?php echo $value['login_id'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['musk_unmusk_mobile_no'] ?></td>
                            <td><?php echo $value['email_id'] ?></td>
                            <td <?=$value['style']; ?>><?php echo $value['description'] ?>
                            <?php if($value['status'] == 2)
                            { ?>
                                <br>
                                <a class="" onclick="view_revert_reason('<?php echo ($value['rejected_reason']); ?>')">
                                <i class="fa fa-eye"></i>
                                </a>
                                <?php 
                            } ?>
                            </td>
                        </tr>
                        <?php 
                     }?>
                  </tbody>
              </table>
          </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
</div>

      
</div>

<div id="revert_modal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <!-- <div class="upload-dynamic"></div> -->
    <div class="modal-dialog modal-lm">
           <!-- Modal content-->
           <div class="modal-content" id="mod">
              <div class="modal-header custom-modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Reason For Reject</h4>
              </div>
              <div class="modal-body">
                <!-- <p>Reason For Revert : </p> -->
                <p class="revert_val" style="word-break: break-all;"></p>
              </div>
            </div>
        <div class="modal-footer" style="background-color: #f4f4f4">
           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


<script type="text/javascript">
  function Approve_request(sl_no,stake_holder_login_id_fk) {
    // alert(sl_no);
    swal({
        title: "Approve Request?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, Approve it",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/user_change/user_change_list/approve_request/';
            $.ajax({
                url: url,
                method: "GET",
                data: {'sl_no': sl_no,'stake_holder_login_id_fk': stake_holder_login_id_fk},
                dataType: "JSON",
                success: function(response) {
                    swal("Forwarded!", "forward success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while forwarding", "error");
                    console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", "forward cancel!", "error");
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        } 
    });
}


</script>

<script type="text/javascript">
  function view_revert_reason(reason=null)
  {
    $('.revert_val').html(reason);
    $('#revert_modal').modal('show');
  }
</script>
