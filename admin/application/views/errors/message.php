<?php if($this->session->flashdata('warning') != ""){ ?>
    <div class="alert alert-warning"> 
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('warning'); unset($_SESSION['warning']); ?>
    </div>            
<?php } ?>
<?php if($this->session->flashdata('error') != ""){ ?>
    <div class="alert alert-error">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('error'); unset($_SESSION['error']); ?>
    </div>            
<?php } ?>
<?php if($this->session->flashdata('success') != ""){ ?>
    <div class="alert alert-success">
         <i class="fa fa-check" aria-hidden="true"></i>
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <?php echo $this->session->flashdata('success'); unset($_SESSION['success']); ?>
    </div>            
<?php } ?>
<?php if($this->session->flashdata('info') != ""){ ?>
    <div class="alert alert-info"> 
         <i class="fa fa-info-circle" aria-hidden="true"></i>
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('info'); unset($_SESSION['info']); ?>
    </div>
<?php } ?> 