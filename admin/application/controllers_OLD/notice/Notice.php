<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Notice extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('notice/Notice_model');
    // $this->load->model('Register_model');
    // $this->load->model('common/Master_model');
    // $this->load->model('login_model');
  }   

  public function index(){

    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $check1['stake_holder_login_id_fk']=$this->session->userdata('stake_holder_login_id_pk');
    $data['user']= $user = $this->Notice_model->user_type();

    if($this->input->post('submit') == TRUE)
    {
        $config = array(
            array(
             'field' => 'title',
             'label' => 'title Name',
             'rules' => 'trim|required|max_length[60]'
            ),
            array(
             'field' => 'description',
             'label' => 'description',
             'rules' => 'trim|required|max_length[300]'
            ),
            array(
             'field' => 'user_id[]',
             'label' => 'target user',
             'rules' => 'required'
            ),
         );

         $this->form_validation->set_rules($config);
         $this->form_validation->set_error_delimiters('<div class="text-danger" style="float:left">', '</div>');
         if ($this->form_validation->run() == TRUE)
         {
              $data1['title']         = $this->input->post('title');
              $data1['description']   = $this->input->post('description');
              $data1['created_by_ip'] = $_SERVER['REMOTE_ADDR'];
              $data1['created_by']   = $this->session->userdata('stake_holder_login_id_pk');
              $data1['created_date'] = date('Y-m-d H:i:s');

              //print_r($data1);die;
              $last_insert_id = $last_row = $this->Notice_model->insert_notice($data1);
              $multiple_user = $this->input->post('user_id');

              foreach ($multiple_user as $stack_id) {
                  $insert_data = array(
                                  'notice_id_fk'=> $last_insert_id, 
                                  'stake_id_fk' => $stack_id                        
                                );
                  $this->Notice_model->insert_user_wise_message_data($insert_data);
              }
              $msg =  "Message save successfully";
              $this->session->set_flashdata('success', $msg);
              redirect('admin/notice/Notice_list');
          }
   
    } 
    $this->load->view($this->config->item('theme').'notice/notice_form_view', $data);
  }

  public function mark(){
    $notice_data = $_GET['notice_data_array'];
    $is_checked  = $_GET['is_checked'];
    $notice_array= explode(",", $notice_data);
   
    //echo "<pre>";print_r($_SESSION);
    $stake_id_fk        = $this->session->userdata('stake_id_fk');
    $stake_holder_login = $this->session->userdata('stake_holder_login_id_pk');
    $today_date         = date('Y-m-d H:i:s');
    $submitted_ip       = $_SERVER['REMOTE_ADDR'];

    if($is_checked==1){
      
      if(is_array($notice_array) || is_object($notice_array)) {

        foreach ($notice_array as $notice_id){
            //echo '-->>'.$notice_id.'-->>'.$stake_id_fk.'-->>'.$stake_holder_login.'</br>';
            $insert_data =array(
                            'notice_id_fk'  => $notice_id, 
                            'stake_id_fk'   => $stake_id_fk, 
                            'stake_holder_login_id_fk' => $stake_holder_login, 
                            'is_marked'     => 1, 
                            'marked_date'   => $today_date, 
                            'marked_by_ip'  => $submitted_ip,
                            'marked_by'     => $stake_holder_login                       
                          );
            $this->Notice_model->insert_accept_message_by_user($insert_data);
        }
        $status =1;
      }else{
        $status =0;
      }
    
    }else{
      $status =0;
    }
    echo json_encode($status);
    
  }

 /* private function validate_login($access = array())
  {
      if(in_array($this->session->userdata('stake_id_fk'), $access)){
          return 1;
      }else{
          $this->session->set_flashdata('error','Invalid request!');
          redirect('admin/dashboard');die;
      }
  }*/


}
