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
.rotate {
    transform: rotate(-90deg);
}

.aignicon
{
  white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
    width: 100%;
}
.bold
{
  font-weight: bold;
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
              $parent_menu_id = array_column($this->menu, 'parent_stake_holder_privilege_id');
             if (in_array($menu['cm_privilege_id_pk'], $parent_menu_id)){ ?>

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

             <?php }else{ ?>  

            <li class="nav-item">
                          <a href="<?php echo $menu['privilege_page']?>" class="nav-link">
                            <i class="nav-icon fas <?php echo $menu['icon']?>"></i>
                            <p><?php echo $menu['stake_holders_privilege_details']?></p>
                          </a>
                        </li> 
            <?php } ?>
      
        
         
         <?php } }
         function sub_menu($parent_id= NULL, $menu_array = array()){
          $parent_menu_id = array_column($menu_array, 'parent_stake_holder_privilege_id');
        ?>
         <ul class="treeview-menu">
            <?php foreach($menu_array as $sub_menu) {
               if($sub_menu['parent_stake_holder_privilege_id'] == $parent_id  && $sub_menu['menu_status'] == 't'){
                if (in_array($sub_menu['cm_privilege_id_pk'], $parent_menu_id)){ ?>

               

                  <li class="treeview" >
                <a href="javascript:void(0)" class="nav-link custom-nav-link txt">
                

                    <i class="nav-icon fas <?php echo $sub_menu['icon']?>"></i>
                    <span class="boldtxt"><?php echo $sub_menu['stake_holders_privilege_details']?></span>

                    <span class="pull-right-container pull-right-container2 ">
                    <i class="fa fa-angle-left pull-right" id="angle"></i>
                  </span>
                    
                </a>
            <?php sub_menu($sub_menu['cm_privilege_id_pk'], $menu_array)?>
          </li>


              <?php  }else{ ?>

                <li class="nav-item">
                    <a href="<?php echo $sub_menu['privilege_page'] ?>" class="nav-link custom-nav-link ">
                        <i class="far <?php echo $sub_menu['icon'] ?> nav-icon "></i>
                        <span class="aignicon"><?php echo $sub_menu['stake_holders_privilege_details'] ?></span>
                    </a>
                </li>
              <?php  } ?>




            











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

<script>


  $(document).ready(function() {
    $('.pull-right-container2').click(function() {
        $('#angle').toggleClass('rotate');
        $('.boldtxt').css('font-weight', 'bold');
    });
    $('.txt').click(function() {
      
        $('.boldtxt').toggleClass('bold');
    });
});
</script>