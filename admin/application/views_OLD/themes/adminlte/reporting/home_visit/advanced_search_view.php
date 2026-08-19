
                  <?php 
                  $c = 1;
                  //echo "<pre>";print_r($home_visits_total_details);
                  if(!empty($home_visits_total_details)){
                  foreach($home_visits_total_details as $value){
                     if($value->cp_age<18)
                    {
                      // $data['home_visits_total_details']->$key['minor_adult_status'] = "Home Visit Minor Form";
                       $value->minor_adult_status = "Minor";
                       $value->url = base_url()."admin/reporting/home_visit/Home_visit_minor_form/edit/";
                    }
                    else
                    {
                      $value->minor_adult_status = "Adult";
                      $value->url = base_url()."admin/reporting/home_visit/home_visit_adult_form/edit/";
                    }

                    if($value->hv_status == 0)
                    {
                       $value->action = "Edit Draft Form";
                    }
                    else if($value->hv_status == 1)
                    {
                       $value->action = "Edit Form";
                    }
                    else
                    {
                       $value->action = "";
                    }

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_block);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo $value->cp_age; ?></td>
                     <td><?php if($value->home_enquiry_date != ''){?><?php echo date('d-m-Y', strtotime($value->home_enquiry_date)); ?><?php } ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <td><?php echo $value->age_of_home_enquiry; ?></td>
                     <td>
                        <?php echo $value->cp_district_name.",<br>".$value->cp_block_name.",<br>".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); ?>
                    </td>
                     <td><?php echo $value->cp_name; ?></td>
                     <td><?php echo $value->cp_gender_val; ?></td>
                     
                     <!-- <td><?php //echo $value->hv_status; ?></td> -->
                     <td><?php echo $value->minor_adult_status; ?></td>
                     <td><?php echo $value->status; ?>
                       <?php if($value->hv_status == 4)
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
                              <!-- <a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" onclick="view_details(<?php echo base64_encode($value->incident_id_fk);echo base64_encode($value->cp_type); echo base64_encode($value->cp_id_fk); ?>)" data-target="#viewModal"><i class="fa fa-eye" aria-hidden="true"></i>View History
                            </a> -->

                            <a class="" onclick="view_details('<?php echo base64_encode($value->home_visits_sl_no); ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details
                            </a>


                            <!-- <a class="" onclick="view_details('<?php echo base64_encode($value->incident_id_fk); ?>', '<?php echo base64_encode($value->cp_type); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>')"> -->
                            <!-- <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details -->
                            </a>

                            </li>
                            <?php if($value->hv_status == 0 ||$value->hv_status==1)
                            {
                              ?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo $value->url; ?><?php echo base64_encode($value->home_visits_sl_no); ?>">
                                    <i class='fa fa-edit'></i>
                                  <?php echo $value->action ; ?>
                                </a>
                              </li>
                              <?php
                            }
                              ?>

                               <?php if(($value->hv_status ==0 ||$value->hv_status ==1) && $this->session->userdata('stake_id_fk')==4)
                               {
                                ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Delete_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-trash"></i> Delete </a></li>
                                <?php
                              }
                                ?>

                            <?php if($value->hv_status ==1 && $this->session->userdata('stake_id_fk')==4)
                            {
                              ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Forward_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-forward"></i> Forward Home Enquiry</a></li>
                              </li>
                              <?php
                            }
                            else if ($value->hv_status ==2 && ($this->session->userdata('stake_id_fk')==2 || $this->session->userdata('stake_id_fk')==6))
                            {
                              ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Publish_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-forward"></i> Publish Home Enquiry</a></li>
                              </li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="Revertback_homeVisit('<?php echo base64_encode($value->home_visits_sl_no); ?>')"><i class="fa fa-forward"></i> Revert Back Home Enquiry</a></li> 
                              <?php  
                            }
                              ?>
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } }else{ ?>
                    <tr>
                      <td colspan="10">No data Found.</td>
                    </tr>

                  <?php } ?>
               