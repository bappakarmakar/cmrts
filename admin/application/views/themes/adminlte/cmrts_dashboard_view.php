<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style type="text/css">
.small-box>.inner {
height: 150px;
box-shadow: 1px 2px 30px #00000030;
    border: 1px solid #ffffffd1;
}
.small-box>.inner p{
color: #fff;
font-size: 20px;
text-align: center;
    font-family: sans-serif;

}

.count_one {
background: #00ccff;
color: #ffffff;
}
.count_two {
background: #339933;
color: #ffffff;
}
.count_three {
background: #e6b800;
color: #ffffff;
}
.count_four {
background: #dd4b39;
color: #ffffff;
}
.small-box p {
font-size: 16px;
font-weight: normal;
}
.d-flex
{
display: flex;
justify-content: space-between;
margin-bottom: 20px;
align-items: center;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php $this->load->view('errors/message'); ?>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box count_one">
                        <div class="inner">
                            <div class="d-flex">
                                <div class="count_icon">
                                    <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                </div>
                                <h3><?php echo $Complaints_Received_Count[0]->complaints_received_total_count; ?></h3>
                            </div>
                            
                            <p>Interventions conducted</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box count_two">
                        <div class="inner">
                            <div class="d-flex">
                                <div class="count_icon">
                                    <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                </div>
                                <h3><?php echo $Child_Marriage_Prevented_Count[0]->child_marriage_prevented_total_count; ?></h3>
                            </div>
                            <p>Marriages Prevented</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box count_three" style="max-height: 164px;">
                        <div class="inner">
                            <div class="d-flex">
                                <div class="count_icon">
                                    <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                </div>
                                <h3><?php echo $Child_Marriage_Cannot_Prevented_Count[0]->child_marriage_cannot_prevented_total_count; ?></h3>
                            </div>
                            <p style="margin-top: -6px;">Marriages Not Prevented</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box count_one">
                        <div class="inner">
                            <div class="d-flex">
                                <div class="count_icon">
                                    <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                </div>
                               <a href="<?php echo base_url('admin/dashboard/Generate_legacy_scheduler'); ?>" class="btn btn-success">Generate</a>
                            </div>
                            
                            <p>Legacy Scheduler Generate</p>
                        </div>
                    </div>
                </div> 

                <!-- Code Added 23-03-2025 Start -->
                <?php //if($this->session->userdata('stake_id_fk') == '3') { ?>
                    <div class="col-lg-4 col-4">
                        <a href="<?php echo base_url()?>admin/Generate_scheduler_for_legacy_data/scheduler_generate_till_21_years/">
                            <div class="small-box count_four" style="background-color: orrange;color: #fff">
                                <div class="inner">
                                    <div class="d-flex" style="margin-bottom: 0">
                                        <div class="count_icon">
                                            <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                        </div>
                                    </div>
                                    <p style="margin-bottom: 0"> Scheduler Generate </p>
                                        <div class="text-center">
                                            <button class="btn btn-md" style="background-color: #99110073;border: none;hover">Click on</button>
                                        </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php //} ?>
                 <!-- Code Added 23-03-2025 END -->


                <!-- Code Added 23-03-2025 Start -->
                <!-- <?php if($this->session->userdata('stake_id_fk') == '3') { ?>
                    <div class="col-lg-4 col-4">
                        <a href="<?php echo base_url()?>admin/Generate_scheduler_for_legacy_data/scheduler_generate_by_dist/">
                            <div class="small-box count_four" style="background-color: orrange;color: #fff">
                                <div class="inner">
                                    <div class="d-flex" style="margin-bottom: 0">
                                        <div class="count_icon">
                                            <img src="<?php echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                                        </div>
                                    </div>
                                    <p style="margin-bottom: 0"> Scheduler Generate </p>
                                        <div class="text-center">
                                            <button class="btn btn-md" style="background-color: #99110073;border: none;hover">Click on</button>
                                        </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?> -->
                 <!-- Code Added 23-03-2025 END -->

                <!-- <div class="col-lg-6 col-6">
                    <div class="small-box count_four">
                        <div class="inner">
                            <div class="count_icon">
                                <img src="<?php //echo $this->config->item('theme_uri');?>dist/img/dash_children_icon.png" class="img-responsive">
                            </div>
                            <h3>45</h3>
                            <p>Rejected Child Marriage complaints</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
</script>
<script type="text/javascript">
function close_address_modal()
{
location.reload();
}
</script>
<script type="text/javascript">
$('table').DataTable();
// Forward Section
function Forward_Details(rr_id){
swal({
title: "Forward to BDO?",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Forward it",
cancelButtonClass: "btn-danger",
cancelButtonText: "No, Cancel",
closeOnConfirm: false,
closeOnCancel: false,
showLoaderOnConfirm: true
},
function(isConfirm){
if(isConfirm){
var incident_id = rr_id;
$.ajax({
url:"reporting/incident/incident_list/forward_bdo",
method:"GET",
data:{incident_id:incident_id},
dataType:"JSON",
success:function(response)
{
swal("Forwarded!", "Forward success to BDO", "success");
setTimeout(function(){
window.location.reload();
}, 2000);
}
});
} else {
swal("Cancelled", "Forward cancel to BDO!", "error");
setTimeout(function(){
window.location.reload();
}, 1500);
}
});
}
// Publish Section
function Publish_Incident(rr_id){
swal({
title: "Publish?",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Publish it",
cancelButtonClass: "btn-danger",
cancelButtonText: "No, Cancel",
closeOnConfirm: false,
closeOnCancel: false,
showLoaderOnConfirm: true
},
function(isConfirm){
if(isConfirm){
var incident_id = rr_id;
$.ajax({
url:"reporting/incident/incident_list/publish_deo",
method:"GET",
data:{incident_id:incident_id},
dataType:"JSON",
success:function(response)
{
swal("Published!", "Publish success", "success");
setTimeout(function(){
window.location.reload();
}, 2000);
}
});
} else {
swal("Cancelled", "Publish cancel!", "error");
setTimeout(function(){
window.location.reload();
}, 1500);
}
});
}
// Transfer CCI to CMPO Details
function Transfer_CCI_Details(rr_id){
swal({
title: "Transfer to CCI?",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Transfer it",
cancelButtonClass: "btn-danger",
cancelButtonText: "No, Cancel",
closeOnConfirm: false,
closeOnCancel: false,
showLoaderOnConfirm: true
},
function(isConfirm){
if(isConfirm){
var incident_id = rr_id;
$.ajax({
url:"reporting/incident/incident_list/Transfer_CCI_To_CMPO",
method:"GET",
data:{incident_id:incident_id},
dataType:"JSON",
success:function(response)
{
swal("Transfered!", "Transfer to CCI success", "success");
setTimeout(function(){
window.location.reload();
}, 2000);
}
});
} else {
swal("Cancelled", "Transfer to CCI cancel!", "error");
setTimeout(function(){
window.location.reload();
}, 1500);
}
});
}
</script>