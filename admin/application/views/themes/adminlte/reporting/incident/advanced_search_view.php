
<?php
   $c = 1;
   foreach($incident_details as $value){


      $incident_block_details = Get_Incident_List_CP_One_Block_Details($value->block);

        // print_r($incident_block_details);die;

        if(!empty($incident_block_details))
        {
          if($incident_block_details->rural_urban == 'U')
          {
            $incident_ward_gp_details = Get_Incident_List_Incident_Ward_Details($value->ward_gp);
          }
          else
          {
            $incident_ward_gp_details = Get_Incident_List_Incident_GP_Details($value->ward_gp);
          }
        }
        else
        {
          $incident_ward_gp_details = array();
        }
        // echo"<pre>";print_r($incident_ward_gp_details);die;
    
     $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);
   
     if(!empty($cp_one_block_details)){
       if($cp_one_block_details->rural_urban == 'U'){
         $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
       }else{
         $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
       }
     }else{
       $cp_one_ward_gp_details = array();
     }
   
     $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
     if(!empty($cp_two_block_details)){
       if($cp_two_block_details->rural_urban == 'U'){
         $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
       }else{
         $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
       }
     }else{
       $cp_two_ward_gp_details = array();
     }
   ?>
<tr>
   <td><?php echo $c++; ?></td>
   <td><?php echo $value->reporting_id; ?></td>
   <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>

   <td>
      <?php echo $value->incident_district;?>,<br>
      <?php echo $value->incident_block; ?>,<br>
      <?=($incident_ward_gp_details)?$incident_ward_gp_details->incident_ward_gp:'';?>
   </td>
   <td><?=($value)?$value->police_station:''?></td>
   <td><?php echo $value->cp_1_name; ?></td>
   <td><?php echo $value->cp_1_gender_value; ?></td>
   <td><?php echo $value->cp_1_age; ?></td>
   <?php if($value->cp_1_state == 1){?>
   <td>
      <?php echo $value->cp_1_district;?>,<br>
      <?php echo $value->cp_1_block?>,<br>
      <?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?>
   </td>
   <?php }else{ ?>
   <td><?php echo $value->cp_1_address;?></td>
   <?php } ?>
   <td><?=($value)?$value->cp_1_police_station:''?></td>
   <td><?php echo cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);?> </td>
   <td><?php echo $value->cp_2_name; ?></td>
   <td><?php echo $value->cp_2_gender_value; ?></td>
   <td><?php echo $value->cp_2_age; ?></td>
   <?php if($value->cp_2_state == 1){?>
   <td>
      <?php echo $value->cp_2_district;?>,<br>
      <?php echo $value->cp_2_block; ?>,<br>
      <?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?>
   </td>
   <?php }else{?>
   <td><?php echo $value->cp_2_address;?></td>
   <?php } ?>
   <td><?=($value)?$value->cp_2_police_station:''?></td>
   <?php if($value->cp_two_is_available==1)
    { 
      ?>  
      <td><?php echo cp_status($value->current_status, $value->cp_2_id_pk, $value->cp_2_age);?></td>
      <?php
    }elseif ($value->cp_two_is_available==2 || $value->cp_two_is_available =='') 
    {
      echo '<td>CP2 is not available</td>';
    }else
    {
      echo '<td></td>';
    }
   ?>
                  

    <td>
      <?php
      $created_at = $value->created_at;
      $current_status = $value->current_status;
      if($current_status==1 && !empty($created_at)){
         echo 'Saved';
      }else{
         echo Get_CP_Current_Status($value->current_status);
      }

       ?>
    </td>

   <td>
      <div class="dropdown" style="">
         <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
         <span class="caret"></span></button>
         <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->incident_id_pk?>"><i class="fa fa-eye" aria-hidden="true"></i>View Details</a></li>
            <!-- For DEO -->
            <?php if($this->session->userdata('stake_id_fk') == '4'){
               if($value->current_status == 1 && $value->created_at != ''){
               ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
            <?php if($value->delete_status == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
            <?php } ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Forward_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Forward</a></li>
            <?php } ?> 

            <!--------- Follow-Up Visit Start ---------->

            <?php if($value->current_status == 3){ 
              $CP_1_Homevisit = Get_CP_Homevisit_Details_Check($value->cp_1_id_pk);
              ?>    
            <?php if($value->cp_1_age < 18 && Get_CP_Homevisit_Count($value->cp_1_id_pk) > 0){?>
            <?php if(Get_CP_Address_details_Count($value->cp_1_id_pk) > 0){
               if(Get_CP_Address_details_block($value->cp_1_id_pk) == $this->session->userdata('block')){
                $CP_1_Homevisit_status = ($CP_1_Homevisit)?$CP_1_Homevisit['hv_status']:'';
                $CP_1_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_1_id_pk);
                if($CP_1_Homevisit_status==3 && $CP_1_Not_Followup_published_Count==0){
            ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit</a></li>
          <?php } ?>
            <?php }
               }elseif($this->session->userdata('block') == $value->cp_1_block_id){
                $CP_1_Homevisit_status = ($CP_1_Homevisit)?$CP_1_Homevisit['hv_status']:'';
                $CP_1_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_1_id_pk);
                if($CP_1_Homevisit_status==3 && $CP_1_Not_Followup_published_Count==0){
            ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit</a></li>
          <?php } ?>
            <?php } ?>  
            <?php } ?>

            <!------For CP 2------>

            <?php 
            $CP_2_Homevisit = Get_CP_Homevisit_Details_Check($value->cp_2_id_pk);
            if($value->cp_2_age < 18 && count($CP_2_Homevisit) > 0){?>
            <?php if(Get_CP_Address_details_Count($value->cp_2_id_pk) > 0){?>
            <?php if(Get_CP_Address_details_block($value->cp_2_id_pk) == $this->session->userdata('block')){
              $CP_2_Homevisit_status = ($CP_2_Homevisit)?$CP_2_Homevisit['hv_status']:'';
              $CP_2_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_2_id_pk);
              if($CP_2_Homevisit_status==3 && $CP_2_Not_Followup_published_Count==0){
            ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>
          <?php } ?>
            <?php } ?>
            <?php }elseif($this->session->userdata('block') == $value->cp_2_block_id){
              $CP_2_Homevisit_status = ($CP_2_Homevisit)?$CP_2_Homevisit['hv_status']:'';
              $CP_2_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_2_id_pk);
              if($CP_2_Homevisit_status==3 && $CP_2_Not_Followup_published_Count==0){
              ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>
          <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>

            <!---------- Follow-Up Visit End ------------>

            <!---------- Home Visit Start ----------->

            <?php if($value->current_status == 3){
               //home visit for cp 1
               if($value->cp_1_age < 18){
                 
                 if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 1 Home Enquiry Minor</a></li>
            <?php } ?> 
            <?php }else if($value->cp_1_age > 18){
               if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 1 Home Enquiry Adult</a></li>
            <?php } ?>
            <?php }
               //home visit for cp 2
               if($value->cp_2_age < 18){
                 if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Enquiry Minor</a></li>
            <?php } ?> 
            <?php }else if($value->cp_2_age > 18){
               if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Enquiry Adult</a></li>
            <?php } ?>
            <?php } ?>      
            <?php } ?>

            <!------------ Home Visit End ------------>

            <?php if($value->current_status == 3){
               if($value->cp_1_age < 18){
                 if($this->session->userdata('block') == $value->cp_1_block_id){
               ?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?php echo base64_encode($value->incident_id_pk);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li> -->
            <?php } }elseif($value->cp_2_age < 18){
               if($this->session->userdata('block') == $value->cp_2_block_id){?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?php echo base64_encode($value->incident_id_pk);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li> -->
            <?php } } ?>
            <?php } ?>
            <?php } ?>
            <!-- End DEO -->

            <!-- For BDO-->
            <?php if($this->session->userdata('stake_id_fk') == '2'){
               if($value->current_status == 1 || $value->current_status == 2){
               ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
            <?php if($value->delete_status == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
            <?php } ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
            <?php } ?>
            <?php if($value->current_status == 3){?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li>
            <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li> -->
            <?php } } ?>
            <!-- End BDO-->

            <!-- For SDO -->
            <?php if($this->session->userdata('stake_id_fk') == '6'){
               if($value->rural_urban == 'U'){
                 if($value->current_status == 1 || $value->current_status == 2){
               ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
            <?php if($value->delete_status == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
            <?php } ?>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
            <?php } ?>
            <?php if($value->current_status == 3){?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li>
            <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li> -->
            <?php } } } ?>
            <!-- End SDO -->

            <!-- For CMPO-->
            <?php if($this->session->userdata('stake_id_fk') == '3'){
               if($value->current_status == 1 || $value->current_status == 2){
               
               ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
            <?php if($value->delete_status == 0){?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
            <?php } ?>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
            <?php } ?>
            <?php if($value->current_status == 4){
               if($value->cp_1_age < 18){
               ?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_one_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 1 CWC Procedings</a></li> -->
            <?php } ?>
            <?php if($value->cp_two_is_available == 1 && $value->cp_2_age < 18){?>
            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_two_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 2 CWC Procedings</a></li> -->
            <?php } } } ?>
            <!-- End CMPO-->
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/print/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-print" aria-hidden="true"></i>Print</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/download/<?php echo base64_encode($value->reporting_id); ?>"><i class="fa fa-download" aria-hidden="true"></i>Download</a></li>
         </ul>
      </div>
   </td>
</tr>
<?php } ?>
               