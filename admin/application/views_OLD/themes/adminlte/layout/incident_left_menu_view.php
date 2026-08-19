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
.inc_list
{
  padding-left: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
}
.sub 
{
  padding-left: 10px;
  list-style: none;
}
.sub li 
{
  background-color: transparent !important;
  text-align: left!important;
  margin: 0px !important;

}
.sub li a 
{
  color: #000!important;
  font-size: 14px;
}
.dash-menu
{
  background-color: #12386e;
  border-top: 1px solid #fff;
}
.dash-menu a 
{
  color: #fff;
}
.fixed-sidebar
{
  position: fixed;
  top: 0;
}
</style>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <!-- <li class="header">MAIN NAVIGATION</li> -->
         <!-- Search Start -->
         <!-- Search End -->
         <ul class="tab-list">
            <li class="active" id="step_one"><a class="next_step" data-toggle="tab" href="#home">Intervention Details</a></li>
            <li class="" id="step_two"><a class="next_step" data-toggle="tab" href="#submenu1">Information First Received </a></li>
            <li class="" id="step_three"><a class="next_step" data-toggle="tab" href="#submenu2"> Local Persons Involved</a></li>
            <li class="" id="step_four"><a class="next_step" data-toggle="tab" href="#submenu3"> Officials Involved</a></li>
            <li class="" id="step_five"><a class="next_step" data-toggle="tab" href="#menu1">Contracting Party One</a></li>
            <li class="" id="step_six"><a class="next_step" data-toggle="tab" href="#menu2">Contracting Party Two</a></li>
         </ul>
         <?php 
         function check_menu($page_name = NULL, $segment = 1){
         $ci = & get_instance();
         $arrs = explode('/',$page_name);
            if($arrs[$segment -1] == $ci->uri->segment($segment)){
             return  'active';
            }
         }
         ?>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>
<!-- =============================================== -->