<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
        </ol>
    </section>
    <section class="content">
           <?php if(isset($success_code)){ ?>
                
                <div class="alert alert-<?php echo $success_code ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $success_message ?>
                </div>
                
            <?php } ?>
       
        <?php echo form_open('admin/setting/profile',array('class' => 'user_create_form','name' => 'user_create_form', 'id' => 'user_create_form',"enctype"=> "multipart/form-data")) ?>
        
          <!-- Default box -->
            <div class="box box-success">


        <div class="box-header custom_box_header with-border">
            <h3 class="box-title">USER PROFILE</h3>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-sm-12">
                  <div class="box-body">

                          <!-- text input -->
                          <div class="col-sm-3">
                              <label>Name <sup style="color: #FF0000">*</sup>:</label></div>
                          <div class="col-sm-9">
                              <input type="text" id="stakeholder_name" name="stakeholder_name" value="<?php echo $profile[0]['name']?>" onkeypress="return isCharKey(event)" class="form-control" placeholder="Enter Name" >
                                        <?php echo form_error('stakeholder_name'); ?>
                          </div>
                  </div>

                  <div class="box-body">
                          <div class="col-sm-3">
                              <label>Designation <sup style="color: #FF0000">*</sup>:</label>
                          </div>
                          <div class="col-sm-9">
                              <input type="text" id="stakeholder_designation" name="stakeholder_designation" value="<?php echo $profile[0]['stake_holder_details']?>" onkeypress="return isCharKey(event)" class="form-control" placeholder="Enter Designation" readonly>
                                        
                          </div>
                  </div>
                          <!-- textarea -->
                 
                          <!-- text input -->
                  <div class="box-body">
                          <div class="col-sm-3">
                              <label>Mobile No <sup style="color: #FF0000">*</sup>:</label>
                          </div>
                          <div class="col-sm-9">
                              <input type="text" id="stakeholder_mobileno" name="stakeholder_mobileno" value="<?php echo $profile[0]['login_id']?>" onkeypress="return onlyNumbers(event)" class="form-control" placeholder="Enter Valid Mobile No"  maxlength="10">
                                       <?php echo form_error('stakeholder_mobileno'); ?>
                          </div>
                  </div>
                  <div class="box-body">
                          <div class="col-sm-3">
                              <label>E-mail Id <sup style="color: #FF0000">*</sup>:</label>
                          </div>
                          <div class="col-sm-9">
                              <input type="text" id="stakeholder_email" name="stakeholder_email" value="<?php echo $profile[0]['login_email']?>"  class="form-control" placeholder="Enter Valid E-Mail">
                                       <?php echo form_error('stakeholder_email'); ?>
                          </div>
                  </div>
                        <center><button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-submit"></i>Update</button></center>
                        <div style="margin-top:10px; height:10px;"></div>
                  </div>
              </div>

          </div>
        </div>


    </section>
     <!-- Modal -->
     
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script type="text/javascript">
         function onlyNumbers(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if(charCode==46)
                return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57 ) )
                return false;
            return true;
        }

        function isCharKey(e) {
            var AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            var k = document.all?parseInt(e.keyCode): parseInt(e.which);
            if (k!=13 && k!=8 && k!=0){
                if ((e.ctrlKey==false) && (e.altKey==false)) {
                    return (AllowableCharacters.indexOf(String.fromCharCode(k))!=-1);
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }
    </script>