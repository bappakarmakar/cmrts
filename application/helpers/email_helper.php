<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/******************** MODIFIED BY JIT ON 08-09-2018 ********************/

if (!function_exists('send_email'))
{
	function send_email($email_id = NULL, $email_message = NULL, $email_subject=NULL)
	{
		if($email_id != NULL || $email_message != NULL)
		{
			$mail_to=$email_id;
			$subject=$email_subject;
			$message=$email_message;
			
			$CI =& get_instance();
			$CI->load->library('email');
			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'relay.nic.in';
			$config['smtp_port'] = 25;
			$config['smtp_user'] = 'support.tetsd-wb@gov.in';
			$config['smtp_pass'] = 'Tetsd@123';
			$config['mailtype']  = 'html'; 	
			$CI->email->initialize($config);
			$CI->email->from('ubportaladmin@gov.in', 'UTKARSH BANGLA Portal');		
			$CI->email->to($mail_to);	
			$CI->email->subject($subject);
			$CI->email->message($message);
		   
			if($CI->email->send())
			{
				return TRUE;			
			} 
			else
			{
				return FALSE;
			}
		}	
		else
		{
			return FALSE;
		}
	}
}



if ( ! function_exists('send_email_tp'))
{
    function send_email_tp($email_id_tp = NULL, $email_message_tp = NULL)
	{	
    	if($email_id_tp != NULL || $email_message_tp != NULL)
		{
			$email_subject = $email_message_tp['title'];
			$email_message = $email_message_tp['message'];
			$email_status=send_email($email_id_tp,$email_message,$email_subject);
			if($email_status==TRUE)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else 
		{
    		return FALSE;
    	}
	}    
}   
 
