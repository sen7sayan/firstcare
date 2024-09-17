<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Messages_mail extends CI_Controller
{
	
	

	public function index()
	{
    	$this->load->library('email');   
        $config = array();
        $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
        $config['smtp_host']    = "ssl://smtp.googlemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
        $config['smtp_user']    = "techidatasolutions@gmail.com"; // client email gmail id
        $config['smtp_pass']    = "Techidata@54321"; // client password
        $config['smtp_port']    =  465;
        $config['smtp_crypto']  = 'ssl';
        $config['smtp_timeout'] = "";
        $config['mailtype']     = "html";
        $config['charset']      = "iso-8859-1";
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;
        $config['validate']     = FALSE;
        $this->load->library('email', $config); // intializing email library, whitch is defiend in system
    
        $this->email->set_newline("\r\n"); // comuplsory line attechment because codeIgniter interacts with the SMTP server with regards to line break
    
        $from_email = "info@shop24u.com"; // sender email, coming from my view page 
        $to_email = "techidata1@gmail.com"; // reciever email, coming from my view page
        //Load email library
    
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter'); 
        $this->email->message('The email send using codeigniter library');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
        //Send mail
        if($this->email->send()){
            echo "email_sent";
        }
        else{
            echo "email_not_sent";
            echo $this->email->print_debugger();  // If any error come, its run
        }
    }

	





}

 ?>