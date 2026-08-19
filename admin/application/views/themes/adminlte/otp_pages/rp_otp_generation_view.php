<?php $this->load->view($this->config->item('theme_uri').'layout/header_view');?>


<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
-->
<div class="content-wrapper">
<section class="content">
  <!-- Trigger the modal with a button -->
 <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->
  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" align="center">OTP VERIFICATION <?php //echo $_SESSION['secretotp'];?></h4>
        </div>
        <div class="modal-body">
		<?php if ($this->session->flashdata('success')) { ?>
        <pre class="bg-success" style="text-align: center; color:#007500;">
        <?php echo $this->session->flashdata('success'); ?>
        </pre>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
        <pre class="bg-danger" style="text-align: center; color:#D00;">
        <?php echo $this->session->flashdata('error'); ?>
        </pre>
        <?php } ?>
            <div class="container ">
    <div class="row">
        <div class="col-sm-6 ">
            <br>
           <?php $mobile_no = $_SESSION['mobile_no']; ?>
            <h4 class="text-center"><p class="lead" style="align:center"></p><p> Thanks for giving your details.A text message with OTP code has been 
sent to: ****** *** <?php echo substr($mobile_no,8,2);?></p>  <p></p></h4><br>
            
        <br>
       		<?php 
                	$attributes = array(
						"name"=>"veryfyotp",
                    	"id"=>"veryfyotp"
                	);
                	echo form_open('admin/login/verify',$attributes);?>
            
                <div class="row">                    
                <div class="form-group col-sm-8">
                	 <span style="color:red;"></span>                    
                     <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter your OTP number" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success">Verify OTP</button>
                </div>
                
                
               
                
                
            <?php echo form_close(); ?>
        <br><br>
        <div class="row">
                <div class="form-group col-md-12">
                    <strong> Haven't received the code yet? </strong>
                    <button type="submit" name="retry" id="retry-delivery" value="SMS_5332897f40039e8b" 
                    class="btn btn-warning">
                    Resend
                    </button>
                </div>
                </div>
        </div>
    </div>        
</div>
       
        </div>
        <div class="modal-footer">
         <!--<input type="submit" name="submit" id="submit" value="Yes" class="btn btn-success"/> -->
        <!-- <button type="button" class="btn btn-success" id="no">No</button>-->
<!--         <a  class="btn btn-danger" href="./Dashboard">Homepage</a>
-->        </div>
      </div>
      <?php echo form_close();?>
    </div>
  </div>
  
  </section>
</div>


<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
-->
<script src="<?php echo base_url();?>admin/assets/js/jquery.min.js"></script>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view');?>
<script>
$(document).ready(function(){
	
	$("#retry-delivery").click(function(){
		
		var phone = <?php echo $mobile_no; ?>;
		
		
		$.ajax({
					url: "./login/resend",
					type: "GET",
					data: {'phone' : phone},
					//dataType: "json",
					success:function(data) 
					{
						//alert(data);
						$("#retry-delivery").hide();
					},
					failure: function(data)
					{
						//alert(data);
					}
				});
	});
  
});
</script>