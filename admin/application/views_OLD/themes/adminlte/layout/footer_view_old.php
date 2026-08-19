
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Designed & Developed by<a href="javascript:void(0);"> NIC</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 

<!-- SlimScroll -->
 <script src="<?php echo $this->config->item('theme_uri');?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Extra JS -->
<?php foreach ($this->js_foot as $jsf) {?>
<script src="<?php echo $jsf ?>"></script>
<?php } ?>
 
<!-- FastClick -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item('theme_uri');?>dist/js/adminlte.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>assets/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>assets/DataTables/datatables.min.js"></script> 
<!-- <script src="<?php //echo $this->config->item('theme_uri');?>assets/js/jquery.validate.min"></script> -->
<script src="<?php echo $this->config->item('theme_uri');?>assets/js/jquery.steps.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>plugins/bs-stepper/js/bs-stepper.min.js"></script> 
<script src="<?php echo $this->config->item('theme_uri');?>assets/js/jquery.repeater.min.js"></script> 
<!-- <script src="<?php //echo $this->config->item('theme_uri');?>plugins/bs-stepper/js/bootstrap.min.js"></script>  --> 
<!-- AdminLTE for demo purposes --> 
<script>
/*$(function() {
    $('#course1').change(function() {
        console.log($(this).val());
    }).multipleSelect({
        width: '100%',
		placeholder: 'Please select job role'
    });
});*/
</script>
<!-- <script type="text/javascript">
document.onkeydown = function(e) {
    if(event.keyCode == 123) {
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
       return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
       return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
       return false;
    }
}
</script>
<script type="text/javascript">
$(document).bind("contextmenu",function(e) {
    e.preventDefault();
});
</script> -->
<script type="text/javascript">
$(document).keypress(
    function(event){
     if (event.which == '13') {
       event.preventDefault();
       $("#j").focus();
    }
});
</script>
<script type="text/javascript">
$('.datepicker').datepicker({
  changeMonth: true,
  changeYear: true,
  yearRange: '1900:+0',
  dateFormat: 'dd/mm/yy', 
  maxDate: '0'
});
</script>
<script>
$(window).scroll(function(){
    if ($(window).scrollTop() >= 80) {
        $('.content-header').addClass('fixed-header');
        $('.form-btn').addClass('fixed-header-btn');
       
    }else {
         $('.content-header').removeClass('fixed-header');
        $('.form-btn').removeClass('fixed-header-btn');
    }
});
</script>
<script>
$(window).scroll(function(){
    if ($(window).scrollTop() >= 80) {
        $('.sidebar').addClass('fixed-sidebar');
    }else {
         $('.sidebar').removeClass('fixed-sidebar');
    }
});
</script>
<script type="text/javascript">
$('table').DataTable({
  "paging":true,
  "scrollX": false,
  "info": false,
  "ordering": true,
  "searching": true
});
</script>
</body>
</html>
