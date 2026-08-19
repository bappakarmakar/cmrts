<?php 
class Check_status
{
    public function __construct($rules = array())
    {
        $this->CI =& get_instance();
        parent::__construct();
    }

    function get_cp1($date=array())
    {
        $res_array = array();
        if($date['cp_one_age']<18 && $data['cp_two_age']<18 && $data['publish_status'] == 102 && $data['cp_two_is_available']==1)
        {   
            if($data['cp_one_block_id'] == $data['cp_two_block_id'])
            {
                if($data['cp_one_is_home_visit']==1 &&  $cp_one_cwc_details->minor_sent != '4' && $data['cp_one_home_visit_minor_status'] != 1 && $data['deo_cp_one_stake_id_fk'] == $this->session->userdata('stake_holder_login_id_pk')){
                    $res_array['color'] = 'red'; 
                    $res_array['status'] = 'Home Visit Minor Pending'; 
                 }
                 if($data['cp_one_is_followup_visit']==1 &&  $cp_one_cwc_details->minor_sent != '4' && $data['cp_one_follow_up_visit_status'] != 1 && $data['cp_one_home_visit_minor_status'] == 1 && $data['deo_cp_one_stake_id_fk'] == $this->session->userdata('stake_holder_login_id_pk')){
                     $res_array['color'] = 'red'; 
                    $res_array['status'] = 'Follow-Up Visit Pending'; 
                 }
                 if($data['cp_one_is_followup_visit']==1 &&  $cp_one_cwc_details->minor_sent != '4' && $data['cp_one_follow_up_visit_status'] == 1 && $data['cp_one_home_visit_minor_status'] == 1 && $data['deo_cp_one_stake_id_fk'] == $this->session->userdata('stake_holder_login_id_pk')){
                     $res_array['color'] = 'green'; 
                    $res_array['status'] = 'Follow-Up Visit Completed'; 
                 }
      
            }
        }
        return $res_array;
    }

   
}