<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<script type="text/javascript">
  function previous() {
    window.history.back();
  }
</script>
<div class="content-wrapper">
  <section class="content-header" style="">
   <h1 style="margin-left: 35px;">Home Enquiry(minor) Overdue
  <span style="color: #070147;">
    <?php echo $title; ?>
  </span>
  /
      <?php
      if ($flag == 0) {
        echo "Due Today";
      } elseif ($flag == 1) {
        echo "Total Due";
      } elseif ($flag == 2) {
        echo "No. of days(1 - 7)";
      } elseif ($flag == 3) {
        echo "No. of days(8 - 15)";
      } elseif ($flag == 4) {
        echo "No. of days(16 - 30)";
      } elseif ($flag == 5) {
        echo "No. of days(31 - 60)";
      } elseif ($flag == 6) {
        echo "No. of days(61 - 90)";
      } elseif ($flag == 7) {
        echo "No. of days(>90)";
      }
      ?></h1>
    <ol class="breadcrumb" style="margin-right: 35px;">

      <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>

      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>
  <section class="content" style="margin: 35px;margin-top:0">
    <div class="box bottom-box">
      <div class="box-body">
        <div class="card-body " style="padding: 8px">

          <table id="table" class="table table-bordered table-striped">
            <thead>
              <tr class="custom_table_head">
                <th class="text-center">Sl. No.</th>
                <th class="text-center">Intervention ID</th>
                <th class="text-center">Intervention Date</th>
                <th class="text-center">Contracting Party Name</th>
                <th class="text-center">Male/Female</th>
                <th class="text-center">Scheduled Date</th>
                <th class="text-center">Age at Scheduled Date</th>
                <th class="text-center">No. of Days Overdue</th>
              </tr>

            </thead>

            <tbody>

              <?php
              $segregate_val = isset($_GET['segregate']) ? $_GET['segregate'] : $segregate; // check this one
              $from_date_val = isset($_GET['from_date']) ? $_GET['from_date'] : $from_date;
              $to_date_val = isset($_GET['to_date']) ? $_GET['to_date'] : $to_date;
              $flag = isset($_GET['flag']) ? $_GET['flag'] : $flag;
              $check_ward_gp = isset($_GET['check_ward_gp']) ? $_GET['check_ward_gp'] : (isset($check_ward_gp) ? $check_ward_gp : null);
              $block_id = isset($_GET['block_id']) ? $_GET['block_id'] : (isset($block_id) ? $block_id : null);
              $unique_id_val = isset($_GET['unique_id']) ? $_GET['unique_id'] : (isset($unique_id) ? $unique_id : null);

              $url_download = base_url() . "admin/mis/home_enquiry_overdue_minor/Home_enquiry_minor_overdue/excel_download_for_count_details?segregate=" . $segregate . "&from_date=" . $from_date_val . "&to_date=" . $to_date_val . "&unique_id=" . $unique_id_val . "&flag=" . $flag . "&check_ward_gp=" . $check_ward_gp . "&block_id=" . $block_id;

              echo '<a href="' . $url_download . '" class="btn btn-success" style="margin-bottom: 15px;float:right;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>';
              ?>


              <?php
              $c = 1;
              if (count($report_result) > 0) {
                foreach ($report_result as $row) {
                  // echo "<pre>";print_r($row);
              ?>
                  <tr id="childAppend">

                    <td><?= $c++; ?></td>
                    <td><strong><?= $row->reporting_id; ?></strong></td>

                    <td><?= date('d-m-Y', strtotime($row->incident_date)); ?></td>
                    <td><?= $row->cp_name; ?></td>
                    <td><?php if ($row->cp_gender == 1) {
                          echo "M";
                        } elseif ($row->cp_gender == 2) {
                          echo "F";
                        } ?></td>
                    <td><?= date('d-m-Y', strtotime($row->calculated_date)); ?></td>
                    <!-- <td><?= "Home Enquiry- " . $row->fu_names; ?></td> -->
                    <td><?php echo age_diff_echo($row->cp_dob, $row->calculated_date); ?></td>
                    <td><?php echo scheduler_days_overdue_show($row->calculated_date); ?></td>
                  </tr>
                <?php }
              } else { ?>
                <tr>
                  <td colspan="14" align="center">
                    <font color="#990000"> No Intervention Found !!! </font>
                  </td>
                </tr>
              <?php  } ?>
            </tbody>

          </table>

        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    if ($.fn.dataTable.isDataTable('#table')) {
      $('#table').DataTable().destroy();
    }

    $('#table').DataTable({
      'paging': true,
      'responsive': true,
      'processing': true,
      'pageLength': 100,
      'lengthMenu': [25, 50, 100, 500]
    });
  });
</script>