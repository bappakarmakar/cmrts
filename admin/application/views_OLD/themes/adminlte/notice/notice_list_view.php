<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
  .list-item
{
  display: none; 
  background-color: #12386e;
  padding:0;
  border-radius: 5px;
  margin-top: 2px;
  z-index: 999;
  position: absolute;
  width: 94px;
}
.sweet-alert
{
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}
 .list-item .fa 
 {
  margin-right: 3px;
 }
  .list-item li 
  {
    list-style: none;
  padding: 5px 8px;
  clear: both;
  font-weight: 400;
  line-height: 1.42857143;
  color: #fff;
  width: 100%;
  white-space: nowrap;
  text-align: left;
  font-size: 12px;
  border-bottom: 1px solid #515151;
  cursor: pointer;
  transition: 0.3s;
  }
    .list-item li:hover 
    {
      background-color: #0003;
    }
  .list-item li a 
  {
  color: #fff;

  }
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  color: #000;
}

.select2
{
  width: 100%!important;
}

   @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  .modal-body {
     width: auto;
     height: auto;
     overflow: visible !important;  
   }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
    width:100%;
    height:100%;
  }
  .modal-content * {
      visibility: visible;
      overflow: visible;
    }
    .main-page * {
      display: none;
    }
    .modal {
      position: absolute;
      left: 0;
      top: 0;
      margin: 0;
      padding: 0;
      min-height: 550px;
      visibility: visible;
      overflow: visible !important; 
    }
    .modal-dialog {
      visibility: visible !important;
      overflow: visible !important; 
    }
  }
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
      font-size: 11px;
    }
    td {
      font-size: 12px;
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
      display: none;
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
    .dataTables_filter {
      display: block;
    }
    .short_txt
    {
      display: block;
  display: -webkit-box;
  max-width: 100%;
  height: 35px;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
      
    }
</style>
<div class="content-wrapper">
   <section class="content-header">

    <?php if($this->session->userdata('stake_id_fk')==1){ ?>
      <h1>Outbox</h1>
    <?php }else{ ?>
      <h1>Inbox</h1>
    <?php } ?>
 
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <div class="box-body">
          <div style="float: right;margin-bottom: 5px">
            <?php if($this->session->userdata('stake_id_fk')==1){ ?>

              <a href="<?php echo base_url('admin/notice/Notice'); ?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> New message</a>

              <a href="<?php echo base_url('admin/notice/Notice_list/message_pdf_download'); ?>" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>

              <a href="<?php echo base_url('admin/notice/Notice_list/download_excel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Download Excel</a>

            <?php } ?>
          </div>
          
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <!-- <th class="text-center">Message Status</th> -->
                     <th class="text-center">Date added / edited</th>
                     <th class="text-center">Date Published</th>
                     <th class="text-center">Title</th>
                     <th class="text-center">Content</th>
                     <th class="text-center">Target User</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  //if($this->session->userdata('stake_id_fk') == '1'){
 
                  $stack_id = $this->session->userdata('stake_id_fk');
                  $c = 1;
                  foreach($messages as $value){
                    //echo "<pre>"; print_r($value);
                  ?>
                  <tr>
                    <td><?php echo $c++; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($value['created_date'])); ?></td>
                    <td>
                      <?php
                        if($value['published_date']==null){
                          echo "Not Published";
                        }else{
                        echo date('d-m-Y', strtotime($value['published_date']));
                        }
                      ?>
                    </td>
                    <td class="text-left "><p class="short_txt"><?php echo $value['title'] ?></p></td>
                    <td class="text-left "><p class="short_txt"><?php echo $value['description'] ?></p></td>
                    <td class="text-left ">
                      <?php 
                        $target_user = get_user_name($value['notice_id_pk']);
                        $user_name = array_column($target_user, 'stake_details');
                        $user_data = implode(', ', $user_name);
                        echo $user_data;
                      ?>
                    </td>
                    <td>
 
                      <?php if($value['is_published']==0 && $stack_id == '1'){ ?>
                        <!-- Action Button Start -->
                         <button style="padding: 4px 12px;" type="submit" class="btn btn-primary act" name="submit" id="<?php echo $value['notice_id_pk'] ?>">Action <span class="caret"></span></button>

                         <ul class="list-item" id="ul_<?php echo $value['notice_id_pk'] ?>">
                          <!-- Edit Message -->
                          <li class="" id="edit_<?php echo $value['notice_id_pk']; ?>" onclick="edit_message(<?php echo $value['notice_id_pk']; ?>)" style=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</li>
                       
                          <!-- Delete Message -->
                          <li class="" id="delete_<?php echo $value['notice_id_pk']; ?>" onclick="delete_message(<?php echo $value['notice_id_pk']; ?>)" style=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</li>

                          <!-- Publish Message -->
                          <li class="" id="publish_<?php echo $value['notice_id_pk']; ?>" onclick="publish_message(<?php echo $value['notice_id_pk']; ?>)" style=""><i class="fa fa-share" aria-hidden="true"></i>Publish</li>
                    
                          <!-- view Message -->
                          <li class="y" id="view_<?php echo $value['notice_id_pk']; ?>" onclick="view_message(<?php echo $value['notice_id_pk']; ?>)" style=""><i class="fa fa-eye" aria-hidden="true"></i>View</li>
                    
                         </ul>
                        <!-- Action Button End -->
                        <?php }else{ ?>

                          <button class="btn btn-primary" id="view_<?php echo $value['notice_id_pk']; ?>" onclick="view_message(<?php echo $value['notice_id_pk']; ?>)" style="padding: 4px 12px;"><i class="fa fa-eye" aria-hidden="true"></i>View</button>

                        <?php } ?>
                    </td>

                  </tr>
                  <?php } //} ?>
                  
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
</div>


<!-- View Message Modal Start -->
    <div id="message_modal" class="modal fade" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h4 class="modal-title" id="mtitle">View message </h4>
          </div>
          <div class="modal-body" style="padding: 25px">
            <div>  
                 <p><strong>Message Header :</strong><span id="header"></span></p>
                 <p><strong>Message Body :</strong> <span id="message"></span></p>
                 <p><strong>Date Created : </strong><span id="created_date"></span></p>
                 <p><strong>Date Published : </strong><span id="publish_date"></span></p>
                 
            </div>
          </div>
          <div class="modal-footer" style="text-align: right;">
          <button type="button" class="btn btn-danger" id="cls_msg_modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<!-- View Message Modal End -->

<!-- Update Message Modal Start -->
    <div id="update_modal" class="modal fade" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h4 class="modal-title" id="mtitle">Edit Message</h4>
          </div>
          <div class="modal-body" style="padding: 25px">
            <div>  
              <?php //echo "<pre>";print_r($user); ?>
              <input type="hidden" name="hidden_notice_id" id="hidden_notice_id">

              <div class="form-group row">
                <label class=" col-form-label" for="reason">Message Title<font color="red"> *</font></label>
                  <textarea name="title" id="title" class="form-control" autocomplete="off" placeholder="Message Title" maxlength="60"></textarea>
                  <span class="error" id="title_error"></span>
               </div>

              <div class="form-group row">
                <label class=" col-form-label" for="reason">Message<font color="red"> *</font><span style="font-size: 10px;color: green"><br>(Max 300 characters)</span></label>
                  <textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="Message" maxlength="300" style="height: 125px;"></textarea>
                  <span class="error" id="description_error"></span>
              </div>

              <div class="form-group row">
                <label class=" col-form-label">Target Users <font color="red"> *</font></label>
                  <?php
                    //echo "<pre>";print_r($user_id);
                    $user_stake_id_data = json_encode($user_id);
                  ?>
                <select class="form-control js-example-basic-multiple" name="user_id[]" id="user_id" multiple="multiple" style="cursor: not-allowed;width: 300px;">
                  <option value="">--Select Block / Municipality--</option>
                </select>
                <span class="error" id="user_error"></span>
              </div>

            </div>
          </div>
          <div class="modal-footer" style="text-align: right;">
            <button type="button" class="btn btn-danger" id="cls_update_modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="update_data()" ><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Save</button>
          </div>
        </div>
      </div>
    </div>
<!-- Update Message Modal End -->

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
$('table').DataTable();
</script>

<script>
  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });
</script>

<script>
  $('.act').click(function(){
    var elementId = $(this).attr('id');
    $('#ul_'+elementId).slideToggle();
  })

  $('#cls_msg_modal').click(function(){
    $('#message_modal').modal('hide');
  })

  $('#cls_update_modal').click(function(){
    $('#update_modal').modal('hide');
  })
</script>

<script>
  function view_message(notice_id){
      $.ajax({
              url:"notice/Notice_list/get_message",
              method:"GET",
              data:{notice_id:notice_id},
              dataType:"JSON",
              success:function(response)
              {
                //console.log(response);
                $('#message_modal').modal('show');
                $("#header").text(response.title);
                $("#message").text(response.description);
                var datetime = response.created_date;
                var datePart = datetime.split(' ')[0];
                $("#created_date").text(datePart);

                if(response.is_published=='1'){
                  var publish_datetime = response.published_date;
                  var publish_date     = publish_datetime.split(' ')[0];
                  $("#publish_date").text(publish_date);
                }else{
                  $("#publish_date").text("Not Published");
                }
              }
          });
  }

</script>

<script>
  function edit_message(notice_id){

    var testArray = <?php echo $user_stake_id_data; ?>;
    //alert(testArray);
       $.ajax({
              url:"notice/Notice_list/get_edit_message_data",
              method:"GET",
              data:{notice_id:notice_id},
              dataType:"JSON",
              success:function(response)
              {
                //console.log(response);
                $('#update_modal').modal('show');
                $("#title").val(response[0].title);
                $("#description").val(response[0].description);
                $("#hidden_notice_id").val(response[0].notice_id_pk);
                 
                var stakeIdArray = [];
                $.each(response, function(index, value) {
                    stakeIdArray.push(value.stake_id_fk);
                });
                //var stakeIdString = stakeIdArray.join(',');
                $('#user_id').empty(); 
                  $.each(testArray, function(index, value) {
                      $('#user_id').append($('<option>', {
                          value: value.stake_id_pk,
                          text: value.stake_details
                      }));
                  });
                  $('#user_id').val(stakeIdArray).trigger('change');
              }
          });
  }

  function update_data(){
      var title       = $("#title").val();
      var description = $("#description").val();
      var user_id     = $("#user_id").val();
      var hidden_notice_id = $("#hidden_notice_id").val();
      //var array = user_id.split(',');
      var user_count  = user_id.length;
      var title_count = title.length;
      var description_cnt = description.length;
 
      if(title.trim()==""){
        $("#title_error").show();
        $("#title_error").text("Please write message title");
      }else if(description.trim()==""){
        $("#description_error").show();
        $("#description_error").text("Please write message description");
      }else if(user_count<1){
        $("#user_error").show();
        $("#user_error").text("Please select target user");
      }else{

        $("#title_error").hide();
        $("#description_error").hide();
        $("#user_error").hide();

          swal({
                title: "Are you sure you want to save this edit?",
                //type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes",
                cancelButtonClass: "btn-danger",
                cancelButtonText: "No",
                //closeOnConfirm: false,
                //closeOnCancel: false,
                showLoaderOnConfirm: true

              },
              function(isConfirm){
                if(isConfirm){
                  
                    $.ajax({
                        url:"notice/Notice_list/update_message",
                        method:"GET",
                        data:{title:title, description:description, user_id:user_id, notice_id:hidden_notice_id},
                        dataType:"JSON",
                        success:function(response)
                        {
                          if(response==1){
                            swal("Updated!", "Updated success", "success");
                            setTimeout(function(){
                               window.location.reload();
                            }, 2000);
                          }else{
                            swal("Cancelled!","Oops! something went wrong","error");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1500);
                          }

                        }
                    });
                } 
              });
      }

  }

  function publish_message(notice_id){

     swal({
      title: "Are you sure you want to publish this message?",
      //type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No",
      //closeOnConfirm: false,
      //closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
      if(isConfirm){
        var notice = notice_id;
          $.ajax({
              url:"notice/Notice_list/publish_message",
              method:"GET",
              data:{notice_id:notice},
              dataType:"JSON",
              success:function(response)
              {
                if(response==1){
                  swal("Published!", "Publish success", "success");
                  setTimeout(function(){
                     window.location.reload();
                  }, 2000);
                }
              }
          });
      } 
    });

  }
</script>
<script>
  function delete_message(notice_id){
      swal({
      title: "Are you sure to delete this message?",
      //type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No",
      //closeOnConfirm: false,
      //closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm){
            var notice = notice_id;
            $.ajax({
                url:"notice/Notice_list/inactive_message",
                method:"GET",
                data:{notice_id:notice},
                dataType:"JSON",
                success:function(response)
                {
                  if(response==1){
                    swal("Delete Successfully! ", "Delete Success", "success");
                    setTimeout(function(){
                       window.location.reload();
                    }, 2000);
                  }
                }
            });
        } 
    });
  }
</script>


