<?php defined('BASEPATH') OR exit('No direct script access allowed');

class e1 extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('EzAuth_Model', 'ezauth');
		$this->ezauth->program = 'e1';
		$this->ezauth->auto_login();
		$this->ezauth->protected_pages = array(
		    'client'    	 =>    	'user',			
		    'admin'   		 =>    	'admin',			
		    'custom_page'  	 =>    	'store_manager',	
		    'changepw'		 =>	'user'
		);
	}
	
	public function index() {
		$this->load->view('e1/e1_home');
	}
	
	public function _remap($method) {
	        $auth = $this->ezauth->authorize($method, true);
	        if ($auth['authorize'] == true) {
			$segments = array_slice($this->uri->segment_array(),2);
			call_user_func_array(array(&$this, $method), $segments);
	        } else {
	            redirect('e1/login');
	        }
	}
	
	public function client() {
		$this->load->view('e1/client_view');
	}
	
	public function admin() {
		$this->load->view('e1/admin_view');
	}
	
	public function login($data = array()) {
	        $rules['username'] = "required";
	        $this->validation->set_rules($rules);
	        $fields['username'] = "Username";
	        $this->validation->set_fields($fields);
	        if ($this->validation->run()) {
	            $login_ok = $this->ezauth->login();   
	            if ($login_ok['authorize'] == true) {
			$this->ezauth->remember_user();		
			redirect('e1');    		
		    } else {
			$data['error_string'] = $login_ok['error'];
		    }

	        }
		$this->load->view('e1/login_view',$data);
	}
	
	public function register() {
		$data = array();
		$rules = array(
			'username'=>'trim|required|min_length[5]|max_length[30]',
			'email'=>'trim|required|valid_email',
			'password'=>'required|matches[password2]',  'password2'=>'required',
			'first_name'=>'trim', 'last_name'=>'trim'
		);
		$fields = array(
			'username'   => 'Username',
			'email'	     => 'E-mail address',
			'password'   =>	'Password',
			'password2'  =>	'Password Confirmation',
			'first_name' =>	'First Name',
			'last_name'  =>	'Last Name'
		);
		$this->validation->set_rules($rules);
		$this->validation->set_fields($fields);
		if ($this->validation->run()) {
			$inp = array(
				'ez_users' => array(
					'username'   =>	$this->input->post('username'),	
					'first_name' =>	$this->input->post('first_name'),	
					'last_name'  =>	$this->input->post('last_name'),	
					'email'	     =>	$this->input->post('email')			
				),
				'ez_access_keys' => array(			
					'e1'	 =>	'user',
				),
				'password'  =>	$this->input->post('password')
			);
			
			$verify_yesno = ($this->input->post('verify')) ? true : false;
			$user_reg = $this->ezauth->register($inp, $verify_yesno);	
			if ($user_reg['reg_ok'] == 'yes' && $verify_yesno == true) {
				$v_code = $user_reg['code'];

				$message = '<p>To gain 1337 access, you must verify your e-mail
				address by clicking the link below or copying it and pasting it into your browser.</p><p>
				{unwrap}
				<a href="http://www.interr0bang.net/e1/verify/'.$v_code.'" 
				title="Verify your e-mail address">http://www.interr0bang.net/e1/verify/'.$v_code.'
				{/unwrap}</a></p>';
				
				$this->_send_mail($inp['ez_users']['email'], 'Verify your e-mail address!', $message);
			}
			if ($user_reg['reg_ok'] == 'yes') {
				redirect('e1/reg_ok');
			} else {
				$data['disp_error'] = 'Error:<br />' . $user_reg['error'];
			}
		}
		$this->load->view('e1/register_view', $data);
	}
	
	public function reg_ok() {
		$this->load->view('e1/reg_ok_view');
	}
	
	public function _send_mail($to, $subject, $message) {
		$config['mailtype'] = 'html';
		$config['protocol'] = 'sendmail';
		$this->email->initialize($config);
		$this->email->from('admin+noreply@interr0bang.net', '1337 Bot');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
	}
	
	public function logout() {
		$this->ezauth->logout();
		redirect('e1');
	}
	
	public function verify() {
		if ($this->ezauth->verify_email($this->uri->segment(3)) == true) {
			$this->load->view('e1/verify_ok');
		} else {
			redirect('e1');
		}
	}
	
	public function forgotpw1() {
		$data = array();
		$fields = array( 'username' => 'trim', 'email' => 'trim' );
		$rules = array( 'username' => 'User name', 'email' => 'E-mail address' );
		$this->validation->set_rules($rules);
		$this->validation->set_fields($fields);
		if ($this->validation->run()) {
			$user = $this->ezauth->get_userid($this->input->post('username'), $this->input->post('email'));
			$usr = $this->ezauth->get_reset_code($user['user_id']);
			$message = auto_link('here is your reset code: http://www.interr0bang.net/e1/forgotpw2/'.$usr['reset_code']);
			$this->_send_mail($usr['email'], 'Reset Code', $message);
			$data['disp_message'] = 'A reset code was sent to your e-mail address. Check your e-mail!';
		}
		$this->load->view('e1/forgotpw1', $data);
	}
	
	public function forgotpw2() {
		$reset_code = $this->uri->segment(3);
		if (empty($reset_code)) return false;
		$usr = $this->ezauth->reset_password($reset_code);
		$message = 'Username: '.$usr['username']. '. Here is your temporary password: '.$usr['temp_pw'];
		$this->_send_mail($usr['email'], 'Temporary Password', $message);
		$data['disp_message'] = 'Your temporary password was e-mailed to you. Check your e-mail!';
		$this->load->view('e1/forgotpw2', $data);
	}
	
	public function changepw() {
		$data = array();
		$un = $this->ezauth->user->username;
		if ($un == 'admin' || $un == 'client') {
			$data['disp_error'] = 'You can\'t be logged in as "admin" or "client" when trying to change an account password.';
			$this->load->view('e1/forgotpw2',$data);
			return;
		}
		$rules = array('old_password'=>'required','new_password'=>'required|matches[new_password2]','new_password2'=>'required');
		$fields = array('old_password'=>'Old Password','new_password'=>'New Password','new_password2'=>'Confirm New Password');
		$this->validation->set_fields($fields);
		$this->validation->set_rules($rules);
		if ($this->validation->run()) {
			$result = $this->ezauth->change_pw($this->ezauth->user->id, $this->input->post('old_password'), $this->input->post('new_password'));
			if ($result) $data['disp_message'] = 'Password changed!'; else $data['disp_message'] = 'Password not changed.';
		}		
		$this->load->view('e1/changepw_view', $data);
	}
}