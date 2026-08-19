<div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Follow Up Visit Data</h4>
            </div>
            <div class="modal-body">
               <div class="div-table">
                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">Mode of Enquiry :</div>
                     <div class="td"><?php if($follow_up_visits_details->mode_of_enquiry == 1){?>Phone Call<?php }elseif($follow_up_visits_details->mode_of_enquiry == 2){?>Video Call<?php }else{?>In Person<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Gender :</div>
                     <div class="td"><?php if($follow_up_visits_details->gender == 1){?>Male<?php }else{?>Female<?php } ?></div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col-sm-6">
                      <div class="title">Minor is enrolled in</div>
                       <div class="table">
                         <div class="tr">
                           <div class="td">Education :</div>
                           <div class="td"><?php if($follow_up_visits_details->education == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                         <div class="tr">
                           <div class="td">Kishori Group :</div>
                           <div class="td"><?php if($follow_up_visits_details->kishori_group == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                         <div class="tr">
                           <div class="td">Paid work :</div>
                           <div class="td"><?php if($follow_up_visits_details->paid_work == 1){?>Yes<?php }else{?>No<?php } ?></div>
                         </div>
                       </div>
                   </div>
                   <div class="col-sm-6">
                      <div class="title">If Yes, Frequency of Attendance</div>
                       <div class="table">
                        <?php if($follow_up_visits_details->education == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($follow_up_visits_details->education_frequency == 1){?>Rarely<?php }elseif($follow_up_visits_details->education_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>

                         <?php if($follow_up_visits_details->kishori_group == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($follow_up_visits_details->kishori_group_frequency == 1){?>Rarely<?php }elseif($follow_up_visits_details->kishori_group_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>

                         <?php if($follow_up_visits_details->paid_work == 1){?>
                         <div class="tr">
                           <div class="td"><?php if($follow_up_visits_details->paid_work_frequency == 1){?>Rarely<?php }elseif($follow_up_visits_details->paid_work_frequency == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                         </div>
                         <?php }else{?>
                          <div class="tr">
                           <div class="td">N/A</div>
                         </div>
                         <?php } ?>
                       </div>
                   </div>
                 </div>

                 <div class="title">Minor feels supported by</div>
                 <div class="table">
                   <div class="tr">
                     <div class="td">Parents :</div>
                     <div class="td"><?php if($follow_up_visits_details->parents_supported == 1){?>Rarely<?php }elseif($follow_up_visits_details->parents_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Family elders :</div>
                     <div class="td"><?php if($follow_up_visits_details->family_elders_supported == 1){?>Rarely<?php }elseif($follow_up_visits_details->family_elders_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Peers :</div>
                     <div class="td"><?php if($follow_up_visits_details->peers_supported == 1){?>Rarely<?php }elseif($follow_up_visits_details->peers_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Neighbours :</div>
                     <div class="td"><?php if($follow_up_visits_details->neighbours_supported == 1){?>Rarely<?php }elseif($follow_up_visits_details->neighbours_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Others :</div>
                     <div class="td"><?php if($follow_up_visits_details->others_supported == 1){?>Rarely<?php }elseif($follow_up_visits_details->others_supported == 2){?>Sometimes<?php }else{?>Regularly<?php } ?></div>
                   </div>
                 </div>

                 <div class="table">
                    <div class="tr">
                     <div class="td">If female, Minor is pregnant? :</div>
                     <div class="td"><?php if($follow_up_visits_details->minor_pregnant == 1){?>Yes<?php }elseif($follow_up_visits_details->minor_pregnant == 2){?>No<?php }else{?>N/A<?php } ?></div>
                   </div>
                   <?php if($follow_up_visits_details->minor_pregnant == 1){?>
                   <div class="tr">
                     <div class="td">If Yes, Stage of pregnancy (Trimester) :</div>
                     <div class="td"><?php if($follow_up_visits_details->stage_of_pregnancy == 1){?>First<?php }elseif($follow_up_visits_details->stage_of_pregnancy == 2){?>Second<?php }else{?>Third<?php } ?></div>
                   </div>
                   <?php } ?>
                 </div>

                 <div class="table">
                    <div class="tr">
                     <div class="td">Remarks :</div>
                     <div class="td"><?php echo $follow_up_visits_details->remarks; ?></div>
                   </div>
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>