<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users{

	public $ci,$clientID,$secret;
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model('EzAuth_Model', 'ezauth');
		$this->ci->ezauth->program = 'tarantism';//$this->ci->config->item('ezauth_program');
		$this->ci->ezauth->auto_login();
		$this->clientID = "";
		$this->secret = "";
	}
	public function permissions($protected){
		$this->ci->ezauth->protected_pages=$protected;
	}
	public function login($data = array()) {
	        $rules['username'] = "required";
	        $this->ci->validation->set_rules($rules);
	        $fields['username'] = "Username";
	        $this->ci->validation->set_fields($fields);
	        if ($this->ci->validation->run()) {
	            $login_ok = $this->ci->ezauth->login();   
	            if ($login_ok['authorize'] == true) {
			$this->ci->ezauth->remember_user();		
			redirect('/members/');    		
		    } else {
			$data['error_string'] = $login_ok['error'];
		    }

	        }
	}
	public function authorize($page, $give_new_key){
		return $this->ci->ezauth->authorize($page, $give_new_key);
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
		$this->ci->validation->set_rules($rules);
		$this->ci->validation->set_fields($fields);
		if ($this->ci->validation->run()) {
			$inp = array(
				'ez_users' => array(
					'username'   =>	$this->ci->input->post('username'),	
					'first_name' =>	$this->ci->input->post('first_name'),	
					'last_name'  =>	$this->ci->input->post('last_name'),	
					'email'	     =>	$this->ci->input->post('email')			
				),
				'ez_access_keys' => array(			
					'tarantism'	 =>	'user',
				),
				'password'  =>	$this->ci->input->post('password')
			);
			
			$verify_yesno = ($this->ci->input->post('verify')) ? true : false;
			$user_reg = $this->ci->ezauth->register($inp, $verify_yesno);	
			if ($user_reg['reg_ok'] == 'yes' && $verify_yesno == true) {
				$v_code = $user_reg['code'];

				$message = '<p>To gain access, you must verify your e-mail address by clicking the link below or copying it and pasting';
				$message .= 'it into your browser.</p><p>';
				$message .= '{unwrap}<a href="http://www.adipa.mobi/members/verify/';
				$message .= $v_code.'" title="Verify your e-mail address">'.$this->ci->config->site_url.'/members/verify/'.$v_code.'{/unwrap}</a></p>';
				
				$this->_send_mail($inp['ez_users']['email'], 'Verify your e-mail address!', $message);
			}
			if ($user_reg['reg_ok'] == 'yes') {
				$user = $inp['ezusers'];
				$un = $user['username'];
				
				
				$folder = get_include_path()."assets/users/".$un."/";
				if(mkdir($folder, 0777)){
					if(mkdir($folder."main/", 0777)){
						redirect('/members/reg_ok');
					}
				}
			} else {
				$data['disp_error'] = 'Error:<br />' . $user_reg['error'];
			}
			$this->ci->load->view('login/register_view', $data);
		}
		
	}
	
	public function _send_mail($to, $subject, $message, $from = NULL) {
		$config['mailtype'] = 'html';
		$config['protocol'] = 'sendmail';
		$this->ci->email->initialize($config);
		if(is_null($from)){
			$this->ci->email->from($this->responseEmail);
		} else {
			$this->ci->email->from($from);
		}
		$this->ci->email->to($to);
		$this->ci->email->subject($subject);
		$this->ci->email->message($message);	
		$this->ci->email->send();
	}
	
	public function logout() {
		$this->ci->ezauth->logout();
		redirect('/members');
	}
	
	public function verify() {
		if ($this->ci->ezauth->verify_email($this->uri->segment(3)) == true) $this->ci->load->view('login/verify_ok');
		else redirect('/members');
	}
	
	public function forgotpw1() {
		$data = array();
		$fields = array( 'username' => 'trim', 'email' => 'trim' );
		$rules = array( 'username' => 'User name', 'email' => 'E-mail address' );
		$this->ci->validation->set_rules($rules);
		$this->ci->validation->set_fields($fields);
		if ($this->ci->validation->run()) {
			$user = $this->ci->ezauth->get_userid($this->input->post('username'), $this->input->post('email'));
			$usr = $this->ci->ezauth->get_reset_code($user['user_id']);
			$message = auto_link('here is your reset code: http://www.adipa.mobi/members/forgotpw2/'.$usr['reset_code']);
			$this->_send_mail($usr['email'], 'Reset Code', $message);
			$data['disp_message'] = 'A reset code was sent to your e-mail address. Check your e-mail!';
		}
		$this->ci->load->view('login/forgotpw1', $data);
	}
	
	
	public function forgotpw2() {
		$reset_code = $this->ci->uri->segment(3);
		if (empty($reset_code)) return false;
		$usr = $this->ci->ezauth->reset_password($reset_code);
		$message = 'Username: '.$usr['username']. '. Here is your temporary password: '.$usr['temp_pw'];
		$this->_send_mail($usr['email'], 'Temporary Password', $message);
		$data['disp_message'] = 'Your temporary password was e-mailed to you. Check your e-mail!';
		$this->ci->load->view('login/forgotpw2', $data);
	}
	
	public function changepw() {
		$data = array();
		$un = $this->ci->ezauth->user->username;
		if ($un == 'admin' || $un == 'client') {
			$data['disp_error'] = 'You can\'t be logged in as "admin" or "client" when trying to change an account password.';
			$this->ci->load->view('login/forgotpw2',$data);
			return;
		}
		$rules = array('old_password'=>'required','new_password'=>'required|matches[new_password2]','new_password2'=>'required');
		$fields = array('old_password'=>'Old Password','new_password'=>'New Password','new_password2'=>'Confirm New Password');
		$this->ci->validation->set_fields($fields);
		$this->ci->validation->set_rules($rules);
		if ($this->ci->validation->run()) {
			$result = $this->ci->ezauth->change_pw($this->ci->ezauth->user->id, $this->ci->input->post('old_password'), $this->ci->input->post('new_password'));
			if ($result) $data['disp_message'] = 'Password changed!'; else $data['disp_message'] = 'Password not changed.';
		}		
		$this->ci->load->view('login/changepw_view', $data);
	}
	public function vanilla_auth(){
		$clientID = $this->ci->config->item('sso_clientID');
		$secret = $this->ci->config->item('sso_secret');

		if (empty($this->ci->input->get)) {
			echo "show login form";
		} else {
			$get = array(
				'client_id' => $this->ci->input->get('client_id'),
				'timestamp' => $this->ci->input->get('timestamp'),
				'signature' => $this->ci->input->get('signature')
			);
			
		        $user = array();
			$user['uniqueid'] = $this->ci->ezauth->user->id;
			$user['name'] = $this->ci->ezauth->user->username;
			$user['email'] = $this->ci->ezauth->user->email;
			$user['photourl'] = $this->ci->ezauth->user->photo;
		}

		$secure = true; 
		$this->WriteJsConnect($user, $get, $clientID, $secret, $secure);
	}
	
	public function WriteJsConnect($User, $Request, $ClientID, $Secret, $Secure = TRUE) {
	   $User = array_change_key_case($User);
	   define('JS_TIMEOUT', 24 * 60);
	   // Error checking.
	   if ($Secure) {
	      // Check the client.
	      if (!isset($Request['client_id']))
		 $Error = array('error' => 'invalid_request', 'message' => 'The client_id parameter is missing.');
	      elseif ($Request['client_id'] != $ClientID)
		 $Error = array('error' => 'invalid_client', 'message' => "Unknown client {$Request['client_id']}.");
	      elseif (!isset($Request['timestamp']) && !isset($Request['signature'])) {
		 if (is_array($User) && count($User) > 0) {
		    // This isn't really an error, but we are just going to return public information when no signature is sent.
		    $Error = array('name' => $User['name'], 'photourl' => @$User['photourl']);
		 } else {
		    $Error = array('name' => '', 'photourl' => '');
		 }
	      } elseif (!isset($Request['timestamp']) || !is_numeric($Request['timestamp']))
		 $Error = array('error' => 'invalid_request', 'message' => 'The timestamp parameter is missing or invalid.');
	      elseif (!isset($Request['signature']))
		 $Error = array('error' => 'invalid_request', 'message' => 'Missing  signature parameter.');
	      elseif (($Diff = abs($Request['timestamp'] - $this->JsTimestamp())) > JS_TIMEOUT)
		 $Error = array('error' => 'invalid_request', 'message' => 'The timestamp is invalid.');
	      else {
		 // Make sure the timestamp hasn't timed out.
		 $Signature = md5($Request['timestamp'].$Secret);
		 if ($Signature != $Request['signature'])
		    $Error = array('error' => 'access_denied', 'message' => 'Signature invalid.');
	      }
	   }
	   
	   if (isset($Error)) $Result = $Error;
	   elseif (is_array($User) && count($User) > 0)  $Result = ($Secure === NULL) ? $User : $this->SignJsConnect($User, $ClientID, $Secret, TRUE);
	   else $Result = array('name' => '', 'photourl' => '');
	   
	   $Json = json_encode($Result);
	   
	   echo (isset($Request['callback'])) ? "{$Request['callback']}($Json)" : $Json;
	}
	
	public function SignJsConnect($Data, $ClientID, $Secret, $ReturnData = FALSE) {
	   $Data = array_change_key_case($Data);
	   ksort($Data);
	
	   foreach ($Data as $Key => $Value) {
	      if ($Value === NULL) $Data[$Key] = '';
	   }
	   
	   $String = http_build_query($Data);
	   $Signature = md5($String.$Secret);
	   
	   if ($ReturnData) {
	      $Data['client_id'] = $ClientID;
	      $Data['signature'] = $Signature;
	      return $Data;
	   } else {
	      return $Signature;
	   }
	}
	
	public function JsTimestamp() {
	   return time();
	}

	
}

/* End of file users.php */
