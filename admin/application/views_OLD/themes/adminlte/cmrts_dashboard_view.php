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
table.dataTable thead th, table.dataTable thead td
{
    border:none;
   
}
table tr td a
{
     color: #000;
}

/* ------ HighChart By Bappa 29-04-2025 End ----------- */
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tbody tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}
/* --------- HighChart By Bappa 29-04-2025 End ---------- */
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
                            
                            <p>Interventions conducted </p>
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

            <!-- ------------  Add New Code 08_08_2024 START ------------- -->
            <div class="card" style="margin-top: 30px">
                <h4 style="font-weight: 400;">Download Forms</h4>
                <table class="table mt-5 table-striped" style="background-color: #fff;border: none" id="pdfdownload">
                    <thead>
                    <tr style="background-color:#0086d7;color: #fff">
                        <th></th>
                        <th class="text-center">Bengali</th>
                        <th class="text-center">English</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/Bengali_Follow_Up_Visit_Contracting_Party_Form_Jul_24.pdf'); ?>" download>Bengali Follow Up Visit Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i>
                        </td></a> 

                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/English_Follow_up_Visit_of_Minor_Contracting_Party_Jul_24.pdf'); ?>"download>English Follow-up Visit of Minor Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                     <tr>
                        <td></td>
                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/Bengali_HE_Adult_Contracting_Party_Form_Jul_24.pdf'); ?>"download>Bengali HE Adult Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i>
                        </td></a></td>
                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/English_HE_Adult_Contracting_Party_Jul_24.pdf'); ?>"download>English HE Adult Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i>
                        </td></a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/Bengali_HE_Minor_Contracting_Party_Form_Jul_24.pdf'); ?>"download>Bengali HE Minor Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i>
                        </td></a></td>
                        <td><a href="<?php echo base_url('/themes/cm_theme/child_marriage/image/cmrts_download_form/English_HE_Minor_Contracting_Party_Form_Jul_24.pdf'); ?>"download>English HE Minor Contracting Party Form <i class="fa fa-download" aria-hidden="true"></i>
                        </td></a></td>
                    </tr>
                </tbody>
                </table>
            </div>
            <!-- ------------ Add New Code 08_08_2024 END ------------- -->


        </div>

        <!-- Message Modal View -->
        <div id="notice_modal" class="modal fade" role="dialog" data-backdrop="static">
          <div class="modal-dialog">
            
            <div class="modal-content">
              <div class="modal-header">
                
                <h4 class="modal-title" id="mtitle">Important Message</h4>
              </div>
              <div class="modal-body" style="padding: 25px">
            
              <div class="form-group">  
                
                <ul style="list-style: none;padding: 0"class="p-0 m-0">
                <?php //echo "<pre>"; print_r($user_notice);
                    $i=1;
                    foreach($user_notice as $value){ ?>
                        <li style="margin-bottom: 5px; justify-content: start;align-items: baseline;" class="d-flex">
                            <p><?php echo $i ?></p>
                            <p><?php echo '. '.$value['description'].' ( '.date('d-m-Y', strtotime($value['published_date'])).' )'
                             ?></p>  
                        </li>
                    <?php $i++;
                        $get_array[] = $value['notice_id_pk'];
                    }
                    //print_r($get_array); 
                    $string = implode(',', $get_array);
                ?> 
                </ul>
                <input type="hidden" id="notice_data_array" name="notice" value="<?php echo $string; ?>">        
                <div class="checkbox">
                    <input type="checkbox" name="check" value="1" id="check" style="margin-left: 0">
                    <label>I have read and understood the above. </br> Do not show this message again. &nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                
              </div>
                
              </div>
              <div class="modal-footer" style="text-align: right;">
                <button type="button" class="btn btn-primary" id="accept_btn" onclick="accept_notice()">OK</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Message Modal View End -->


        <?php //print_r($cp_minor_adult_count); ?>
        <!-- HighChart By Bappa 29-04-2025 Start -->
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                A simple column chart comparing estimated data for minors and adults by year.
            </p>
        </figure>
        <!-- HighChart By Bappa 29-04-2025 End -->


    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var message_exist = "<?php echo count($user_notice) ?>";
    if(message_exist >0){  
      $('#notice_modal').modal('show');
    }
});
 
function close_address_modal(){
    location.reload();
}
</script>
<script>
function accept_notice(){
    var notice_data_array = $('#notice_data_array').val();
    var check             = $('#check').prop('checked') ? 1 : 0;
    if(check==0){
        $('#notice_modal').modal('hide'); 
    }else if(check==1){
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('admin/notice/notice/mark'); ?>',
            data: {'notice_data_array': notice_data_array,'is_checked': check},
            beforeSend: function() {
                $('#accept_btn').prop('disabled', true);
            },
            success: function(response) {
                if(response==1){
                    $('#notice_modal').modal('hide'); 
                }
            }
        });
    }
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


// Assuming you have initialized a DataTable
var table = $('#pdfdownload').DataTable();
// To destroy the DataTable
table.destroy();

</script>

<script type="text/javascript">
    // console.log(<?php echo json_encode($year); ?>);
    // console.log(<?php echo json_encode($cp_minor_count); ?>);
    // console.log(<?php echo json_encode($cp_adult_count); ?>);
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Minor vs adult count by year'
    },
    // subtitle: {
    //     text:
    //         'Source: <a target="_blank" ' +
    //         'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>'
    // },
    xAxis: {
        categories: <?php echo json_encode($year); ?>,
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '1000 thousand (K)'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 K)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Minor',
            data: <?php echo json_encode($cp_minor_count); ?>
        },
        {
            name: 'Adult',
            data: <?php echo json_encode($cp_adult_count); ?>
        }
    ]
});
</script>



