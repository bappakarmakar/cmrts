
                  <?php 
                  $c = 1;
                   if(!empty($follow_up_visits_total_details)){
                  foreach($follow_up_visits_total_details as $value){
                    if($value->fv_status == 0)
                    {
                       $value->action = "Edit Draft Form";
                    }
                    else if($value->fv_status == 1|| $value->fv_status == 4 )
                    {
                       $value->action = "Edit Form";
                    }
                    else
                    {
                       $value->action = "";
                    }
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
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo $value->cp_1_age; ?></td>
                     
                     <td><?php if($value->followup_date != ''){?><?php echo date('d-m-Y', strtotime($value->followup_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <td><?php echo $value->age_on_folllowup; ?></td>
                     <!-- <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td> -->
                     <td><?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     
                     <td>
                       <?php if($value->fv_status==1)
                       {echo 'Saved';}elseif ($value->fv_status==2) {echo 'Forwarded';}else if($value->fv_status==3){echo 'Published';}elseif ($value->fv_status==4) {echo 'Reverted'; } else{echo "saved as drafts";} ?>
                        <?php if($value->fv_status == 4)
                        { ?>
                          <br>
                          <a class="" onclick="view_revert_reason('<?php echo ($value->revert_reason); ?>')">
                            <i class="fa fa-eye"></i>
                          </a>
                          <?php 
                        } ?>
                     </td>
                     <td>
                        <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            <li role="presentation">
                              <!-- <a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal_<?php echo $c; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a> -->

                              <a class="" onclick="view_details('<?php echo base64_encode($value->follow_up_sl_no); ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details
                            </a>


                            </li>

                            <?php if(($value->fv_status == 0 ||$value->fv_status==1 || $value->fv_status==4)&& $this->session->userdata('stake_id_fk')==4){ ?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('admin/reporting/follow_up_visit/Follow_up_visit_form/edit/') ?><?php echo base64_encode($value->follow_up_sl_no); ?>">
                                    <i class='fa fa-edit'></i>
                                  <?php echo $value->action ; ?>
                                </a>
                              </li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Delete_followupVisit('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-trash"></i> Delete </a></li>
                              <?php } ?>

                              <?php if($value->fv_status ==1 && $this->session->userdata('stake_id_fk')==4){ ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Forward_followup('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-forward"></i> Forward Follow-Up Visit</a></li>
                              </li>
                              <?php }
                              else if ($value->fv_status ==2 && ($this->session->userdata('stake_id_fk')==2 || $this->session->userdata('stake_id_fk')==6))
                              {
                                ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Publish_followup('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-forward"></i> Publish Follow-up Visit</a></li>
                                </li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="revert_back_follow_up_visit('<?php echo base64_encode($value->follow_up_sl_no); ?>')"><i class="fa fa-backward"></i> Revert Follow-up Visit</a></li>
                                <?php  
                              }  
                            ?>
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } }else{ ?>
                    <tr>
                      <td colspan="9">No data Found.</td>
                    </tr>
                  <?php } ?>
               