<!DOCTYPE html>
<html>
<head>

	<base href="<?php echo base_url(); ?>admin/" />
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <title><?php echo $this->config->item('title');?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Extra CSS -->
  <!-- jQuery 3 -->
  <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
  <?php foreach($this->css_head as $hcss){ ?>
  <link rel="stylesheet" href="<?php echo $hcss; ?>">
  <?php } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/skins/_all-skins.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>assets/sweetalert/sweetalert.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>assets/DataTables/datatables.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>plugins/bs-stepper/css/bs-stepper.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  
</head>
<body class="sidebar-mini skin-green-light" data-base_url='<?php echo base_url()?>'>
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="javascript:void()" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><img src="<?php //echo $this->config->item('theme_uri');?>dist/img/sneha-chaye-app-icon.png" width="40" alt="User Image"></span> -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b <?php if($this->session->userdata('stake_id_fk') == '1'){?>style="font-size: 15px;"<?php } ?>>CMRTS <?php echo $this->session->userdata('stake_details'); ?></b></span>
    </a>
     
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

      <!-- PHP code to generate a download button -->
    
  
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo $this->config->item('theme_uri');?>dist/img/ub_logo.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!--<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>

                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>-->
           <li>
        <!--    <a class="btn btn-success" style="padding: 12px;margin-top: 2px;" href="<?php echo base_url('admin/files/SOP/CMRTS_USERMANUAL.pdf');?>" download>
               <i class="fa fa-download" aria-hidden="true"></i> Download User Manual
            </a>-->
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- <img src="<?php echo $this->config->item('theme_uri');?>dist/img/ub_logo.png" class="user-image" alt="User Image"> -->
              <!-- <span><?php //echo $this->session->userdata('stake_holder_details'); ?></span> -->
              <?php if($this->session->userdata('stake_id_fk') == '6'){?>
                <span><?php echo $district_details[0]['subdiv_name']; ?></span>
              <?php }elseif($this->session->userdata('stake_id_fk') == '1' || $this->session->userdata('stake_id_fk') == '5'){?>
                <?php echo $this->session->userdata('stake_holder_details'); ?>
              <?php }elseif($this->session->userdata('stake_id_fk') == '4' && $this->session->userdata('block') == '0'){ ?>
                <span><?php echo $district_details[0]['subdiv_name']; ?></span>
              <?php }else{ ?>
                 <span><?php if($district_details[0]['block_name'] != ''){?><?php echo $district_details[0]['block_name']; ?><?php }else{?><?php echo $district_details[0]['district_name']; ?><?php } ?></span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->config->item('theme_uri');?>dist/img/profile.png" class="img-circle" alt="User Image">
                <p>
                  <?php echo $this->session->userdata('stake_holder_details'); ?>
                  <small><?php echo $district_details[0]['district_name']; ?></small>
                  <?php if($this->session->userdata('stake_id_fk') == '6'){?>
                    <small><?php echo $district_details[0]['subdiv_name']; ?></small>
                  <?php } elseif($this->session->userdata('stake_id_fk') == '4' && $this->session->userdata('block') == '0') {?>
                    <small><?php echo $district_details[0]['subdiv_name']; ?></small>
                  <?php } else { ?>
                    <small><?php if($district_details[0]['block_name'] != ''){?><?php echo $district_details[0]['block_name']; ?><?php } ?></small>
                  <?php } ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!--<div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>-->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
              	<?php //if($this->session->stake_id_fk == 8){ ?>
                <div class="pull-left">
               <?php //if($this->session->userdata('stake_id_fk') == '4'){ ?> 
                  <!-- <a href="training_partner/profile" class="btn btn-default btn-flat">Profile</a> -->
               <?php  //} ?>
			         <?php //if($this->session->userdata('stake_id_fk') == '2'){ ?> 
                  <!-- <a href="inspection/inspector_view" class="btn btn-default btn-flat">Profile</a> -->
               <?php  //} ?>
			   
                </div>
                <?php //} ?>
                <div class="pull-right">
                  <a href="login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
         
        </ul>
         
      </div>
    </nav>
  </header>

  <!-- =============================================== -->