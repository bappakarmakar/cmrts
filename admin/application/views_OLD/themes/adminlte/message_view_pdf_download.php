<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Print List</title>
      <base href="<?php echo base_url(); ?>admin/" />
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
      <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
      </head>
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 90%;
}
    #mytable{
      margin-top: 25px;
      margin-right: 5px;
      margin-left: 5px;
}
</style>

<body style="background-color:;">
<h1 style="text-align: center; ">INBOX</h1>         
<table class="table table-bordered table-hover" id="mytable">
   <thead style="background-color:#1adbbb ;"  >
      <tr class="custom_table_head" >
         <th class="text-center">Sl. No</th>
         <th class="text-center">Date added/edited</th>
         <th class="text-center">Date Published</th>
         <th class="text-center" style="width:300px;">Title</th>
         <th class="text-center" style="width:600px;">Content</th>
         <th class="text-center" style="width:100px;">Target User</th>
      </tr>
   </thead>
      <?php $i=1; ?>
      <?php foreach($messages as $au) { ?>
         <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $au['created_date']; ?></td>
               <td><?php echo $au['published_date']; ?></td>
               <td><?php echo $au['title']; ?></td>
               <td><?php echo $au['description']; ?></td>
               <td class="text-center ">
                <?php 
                  $target_user = get_user_name($au['notice_id_pk']);
                  $user_name = array_column($target_user, 'stake_details');
                  $user_data = implode(', ', $user_name);
                  echo $user_data;
                ?>
               </td>
         </tr>
      <?php $i++; } ?>
   </table>
</body>
</html>
 
<script type="text/javascript"> 
   var base_url = $('#base').val();
   // //alert(base_url);
   window.print();
   // window.onafterprint = function(event) {
   //   window.location.href = base_url+'admin/notice/notice_list/message_pdf_download';
   // };
</script>