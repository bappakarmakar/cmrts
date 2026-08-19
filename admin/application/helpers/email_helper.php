<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/******************** MODIFIED BY JIT ON 08-09-2018 ********************/

if (!function_exists('send_email'))
{
	function send_email($email_id = NULL, $email_message = NULL, $email_subject=NULL,$cc_mail_list=NULL)
	{
		if($email_id != NULL || $email_message != NULL)
		{
			$mail_to=$email_id;
			$subject=$email_subject;
			$message=$email_message;
			$mail_cc=$cc_mail_list;
			
			$CI =& get_instance();
			$CI->load->library('email');
			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'relay.nic.in';
			$config['smtp_port'] = 25;
			$config['smtp_user'] = 'support.tetsd-wb@gov.in';
			$config['smtp_pass'] = 'Tetsd@123';
			$config['mailtype']  = 'html'; 	
			$CI->email->initialize($config);
			$CI->email->from('wbscvetadmin@gov.in', 'WBSCVET Portal');		
			$CI->email->to($mail_to);
			$CI->email->cc($mail_cc);			
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
/* Added by Koustabh on 24/09/2018 starts */ 
if ( ! function_exists('send_email_inspection'))
{
    function send_email_inspection($email_id_inspection = NULL, $email_message_inspection = NULL)
	{	
    	if($email_id_inspection != NULL || $email_message_inspection != NULL)
		{
			$email_subject = $email_message_inspection['title'];
			$email_message = $email_message_inspection['message'];
			$email_status=send_email($email_id_inspection,$email_message,$email_subject);
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
 
/* Added by Koustabh on 24/09/2018 ends */
/* Added by Koustabh on 27/09/2018 starts */ 
if ( ! function_exists('send_email_reminder'))
{
    function send_email_reminder($email_id_inspection = NULL, $email_message_inspection = NULL)
	{	
    	if($email_id_inspection != NULL || $email_message_inspection != NULL)
		{
			$email_subject = $email_message_inspection['title'];
			$email_message = $email_message_inspection['message'];
			$email_status=send_email($email_id_inspection,$email_message,$email_subject);
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
 
/* Added by Koustabh on 27/09/2018 ends */
/* Added by Koustabh on 28/09/2018 starts */
	if ( ! function_exists('send_email_intimation_tc'))
	{
	    function send_email_intimation_tc($email_id_intimation = NULL, $email_message_intimation = NULL)
		{	
	    	if($email_id_intimation != NULL || $email_message_intimation != NULL)
			{
				$email_subject = $email_message_intimation['title'];
				$email_message = $email_message_intimation['message'];
				$email_status=send_email($email_id_intimation,$email_message,$email_subject);
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
/* Added by Koustabh on 28/09/2018  ends */

/* Added by Koustabh on 01/10/2018 starts */
	if ( ! function_exists('send_email_feedback_to_inspector'))
	{
	    function send_email_feedback_to_inspector($email_id_inspector = NULL, $email_message_inspector = NULL)
		{	
	    	if($email_id_inspector != NULL || $email_message_inspector != NULL)
			{
				$email_subject = $email_message_inspector['title'];
				$email_message = $email_message_inspector['message'];
				$email_status=send_email($email_id_inspector,$email_message,$email_subject);
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
/* Added by Koustabh on 01/10/2018  ends */
/* Added by Koustabh on 09/10/2018 starts */
if ( ! function_exists('send_email_reject_to_tp'))
	{
	    function send_email_reject_to_tp($email_id_tp = NULL, $email_message_tp = NULL)
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
/* Added by Koustabh on 09/10/2018 ends */
/* Added by Koustabh on 11/10/2018 starts */
	if ( ! function_exists('send_email_to_employer'))
	{
	    function send_email_to_employer($email_id_employer = NULL, $email_message_employer = NULL)
		{	
	    	if($email_id_employer != NULL || $email_message_employer != NULL)
			{
				$email_subject = $email_message_employer['title'];
				$email_message = $email_message_employer['message'];
				$email_status=send_email($email_id_employer,$email_message,$email_subject);
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
/* Added by Koustabh on 11/10/2018 ends */
 
