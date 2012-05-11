<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
	}
	function index(){
		$this->load->view('top');
		$this->load->view('head-contact');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	function _oldindex()
	{
		$this->load->view('front');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');//|min_length[5]|max_length[12]|matches[otherfield]
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');//
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('contact');
		} else {
			$to = "withoutachord@tarantism.us";
			//$to = "b3457m0d3@interr0bang.net";
			$subject = 'New Message From '.$this->input->post('name'). ' on Adipa';
			$from = $this->input->post('email');
			$message = $this->input->post('comment');
			$message .= "<br><a href='".$this->input->post('url')."'>Link</a>";
			$message .= "<br>".$this->input->post('phone');
			if($this->_send_mail($to, $subject, $message, $from))
			        $this->load->view('formsuccess');
			else 
				$this->load->view('formfail');
		}
		$this->load->view('frontfoot');            
	}
	
	public function _send_mail($to, $subject, $message, $from) {
		$config['mailtype'] = 'html';
		$config['protocol'] = 'sendmail';
		$this->email->initialize($config);
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);	
		return ($this->email->send()) ? TRUE : FALSE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */