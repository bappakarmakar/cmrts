<?php 
class NIC_Form_validation extends CI_Form_validation
{
    public function __construct($rules = array())
    {
        $this->CI =& get_instance();
        parent::__construct();
    }

    function is_date_valid($date){
        $date_parts = explode('/', $date);
        $day = intval($date_parts[0]);
        $month = intval($date_parts[1]);
        $year = intval($date_parts[2]);
        $checkdate = checkdate($month, $day, $year);
        if(empty($checkdate)){
            $this->CI->form_validation->set_message('is_date_valid', 'The %s is not a valid date.');
            return FALSE;
        }else {
            return TRUE;
        }
    }

    function is_phone_number_valid($value){
        if($value){
            $pattern = "/[6-9][0-9]{9}/";
            if (preg_match($pattern, $value)){
                return TRUE;
            }else{
                $this->CI->form_validation->set_message('is_phone_number_valid', 'The %s is not a valid mobile no.');
                return FALSE;
            }
        }else{
            return TRUE;
        }        
    }

    function is_valid_email($value){
        if($value){
            $pattern = "/[a-zA-Z0-9_\-\.]+[@][a-z]+[\.][a-z]{2,3}/";
            if (preg_match($pattern, $value)){
                return TRUE;
            }else{
                $this->CI->form_validation->set_message('is_valid_email', 'The %s is not a valid email.');
                return FALSE;
            }
        }else{
            return TRUE;
        }        
    } 

    public function is_title_validation($input) 
    {
        if (preg_match('/^[\w\s-]+$/', $input)) {
            return TRUE;
        }
        $this->CI->form_validation->set_message('is_title_validation', 'The {field} field can only contain alphanumeric,hyphen,underscore and spaces.');
        return FALSE;
        
    }

    public function is_script_validate($value)
    {
        if($value){
            $pattern = "/.+(script).+(alert).+(script).+|script/i";
            if (preg_match($pattern, $value)) {
                $this->CI->form_validation->set_message('is_script_validate', 'The {field} field cannot contain script tags.');
                return false;
            }else {
                return true;
            }
        }else {
           return true;  
        }
    }
}