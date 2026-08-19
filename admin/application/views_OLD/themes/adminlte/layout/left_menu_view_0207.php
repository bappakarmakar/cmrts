<style type="text/css">
.icon-button__badge {
  position: absolute;
  top: 15px;
  right: 76px;
  width: 17px;
  height: 17px;
  background: red;
  color: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}
.sub_menu_icon-button__badge {
   position: absolute;
   top: 52px;
   right: 127px;
   width: 15px;
   height: 15px;
   background: red;
   color: #ffffff;
   display: flex;
   justify-content: center;
   align-items: center;
   border-radius: 50%;
}
.treeview-menu li a p
   {text-wrap: wrap;
    display: flex;
    align-items: baseline;
    margin-bottom: 0;
}
.treeview-menu li a p i  
{
   margin-right: 5px;
}
</style>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <!-- <li class="header">MAIN NAVIGATION</li> -->
         <!-- Search Start -->
         <!-- Search End -->
         <li class="<?php echo check_menu('dashboard',1);?>">
            <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
         </li>
         <?php foreach ($this->menu as $menu){
            if($menu['parent_stake_holder_privilege_id'] == 0 && $menu['menu_status'] == 't'){
         ?>
         <li class="treeview <?php echo check_menu($menu['privilege_page'],1);?>">
            <a href="<?php echo $menu['privilege_page']?>">
            <i class="fa <?php echo $menu['icon']?>"></i> <span><?php echo $menu['stake_holders_privilege_details']?></span>
            <?php if($menu['stake_holders_privilege_details'] == 'Notifications'){
               $notification_count = $this->privilege_model->total_notification_count();
               if($notification_count[0]->tot_notification > 0){
            ?>
            <span class="icon-button__badge"><?php echo $notification_count[0]->tot_notification; ?></span>
            <?php } } ?>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <?php sub_menu($menu['cm_privilege_id_pk'], $this->menu) ?>
         </li>
         
         <?php } }
         function sub_menu($parent_id= NULL, $menu_array = array()){ ?>
         <ul class="treeview-menu">
            <?php foreach($menu_array as $sub_menu) {
               if($sub_menu['parent_stake_holder_privilege_id'] == $parent_id  && $sub_menu['menu_status'] == 't'){
            ?>
            <li class="<?php echo check_menu($sub_menu['privilege_page'],2);?>"><a href="<?php echo $sub_menu['privilege_page'] ?>"><p><i class="fa <?php echo $sub_menu['icon'] ?>"></i> <?php echo $sub_menu['stake_holders_privilege_details'] ?></p></a> 
            <?php sub_menu($sub_menu['cm_privilege_id_pk'], $menu_array) ?>

            <?php if($sub_menu['stake_holders_privilege_details'] == 'Inbox'){
               $ci = & get_instance();
               $notification_count = $ci->privilege_model->total_notification_count();
               if($notification_count[0]->tot_notification > 0){
            ?>
            <span class="sub_menu_icon-button__badge"><?php echo $notification_count[0]->tot_notification; ?></span>
            <?php } } ?>
            </li>
            <?php } } ?>
         </ul>
         <?php 
          }
          //echo check_menu('trainee/trainee_registration',1);
          //echo $this->uri->segment(1);
          function check_menu($page_name = NULL, $segment = 2){
          $ci = & get_instance();
          $arrs = explode('/',$page_name);
          if($arrs[$segment -1] == $ci->uri->segment($segment)){
          return  'active';
          }
           //return 'active';
          }
          ?>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>
<!-- =============================================== -->