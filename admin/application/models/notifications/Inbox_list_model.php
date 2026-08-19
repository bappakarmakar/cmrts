<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Inbox_list_model extends CI_Model
{
    public function __construct()
    { 
      parent::__construct(); 
    }

    public function inbox_list()
    {
        $query = $this->db->select('cmnd.sl_no, cmnd.message, cmnd.sending_time, cmnd.page_link, cmnd.status, shl.stake_holder_details, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name')
            ->from('cm_notification_details AS cmnd')
            ->join('cm_stake_holder_login AS shl', 'cmnd.sender_by = shl.stake_holder_login_id_pk', 'left')
            ->where('cmnd.receiver_by' , $this->session->userdata('stake_holder_login_id_pk'))
            ->order_by('cmnd.sl_no','desc')
            ->get();

        return $query->result_array();
    }

    public function inbox_view_list($notification_id)
    {
        $query = $this->db->select('cmnd.sl_no, cmnd.page_link')
            ->from('cm_notification_details AS cmnd')
            ->where('MD5(CAST(sl_no AS character varying))=', $notification_id)
            ->get()->row();

        $uploaded_array = array(
            'status' => 1
        );
        $this->db->where('MD5(CAST(sl_no AS character varying))=', $notification_id)->update('cm_notification_details', $uploaded_array);
        return $query;
    }
}
?>
