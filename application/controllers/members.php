<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members extends CI_Controller {
	public $user_dirs = array();
	public $themes = array();
	public $selected;
	function __construct(){
		parent::__construct();
		$this->load->helper('directory');
		$this->load->model('EzAuth_Model', 'ezauth');
		$this->ezauth->program = 'tarantism';
		$this->ezauth->auto_login();
		$this->ezauth->protected_pages = array(
		    //'edit'       	 =>    	'admin',
		    'upload'             =>     'user',
		    'doUpload'           =>     'user',
		    'changepw'		 =>	'user',
		    'project'            =>     'user',
		    'content'            =>     'user',
		    'show_files'         =>     'user',
		    'player'             =>     'user',
		    'privatexml'         =>     'user'

		);
		$this->user_dirs[]= "files";
		$this->user_dirs[]= "images";
		$this->user_dirs[]= "sketches";
		$this->user_dirs[]= "music";
		$this->themes[1]= "superhero";
		$this->themes[2]= "united";
		$this->themes[3]= "cyborg";
		$this->themes[4]= "cerulean";
		$this->themes[5]= "simplex";
		$this->selected = 0;//0=default
		
	}
        public function _remap($method) {
	   $auth = $this->ezauth->authorize($method, true);
	   $segments = array_slice($this->uri->segment_array(),2);
	   if ($auth['authorize'] == true){
	       if(method_exists($this,$method)) 
			call_user_func_array(array(&$this, $method), $segments);
	       else
			redirect("members");
	   } else redirect('/members');
        }
	public function index(){
		$data = array();
		if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
		$this->load->view('include/header',$data);
      $this->load->view('frontpage');
      $this->load->view('include/footer');
	}
	public function content(){
	   $data = array();
	   
	   $this->load->view('include/header');
	   $this->load->view('content',$data);
	   $this->load->view('include/footer');
	     
	}
	public function vanilla_auth(){
	     require_once APPPATH.'/third_party/functions.jsconnect.php';
		$clientID = "1234";
		$secret = "1234";

		$user = array();

		if (!empty($this->ezauth->user)) {

		   $user['uniqueid'] = $this->ezauth->user->id;
		   $user['name'] = $this->ezauth->user->username;
		   $user['email'] = $this->ezauth->user->email;
		   $user['photourl'] = $this->ezauth->user->photo;
		}

		$secure = true; 
		WriteJsConnect($user, $_GET, $clientID, $secret, $secure)
	}
	public function project(){
	   $this->load->view('include/header',array('markitup'=>TRUE));
	   $this->load->view('editor');
	   $this->load->view('include/footer',array('markitup'=>TRUE));
	}
     public function upload($dir=NULL){
	
	$this->load->view('include/header',array('upload'=>TRUE));
	if(is_null($dir)){
		$this->load->view('upload_tabs');
	} else {
		$data = array('dir'=>$dir);
		$this->load->view('upload',$data);
	}
	$this->load->view('include/footer');
     }
     
     public function countdown($time=NULL){
	$data = array();
	$data['countdown'] = array();
	if(!is_null($time)) $data['countdown']['time']= $time;
	$this->load->view('include/header',$data);
	$this->load->view('countdown');
	$this->load->view('include/footer');
     }
     
     public function products($time=NULL){
	$data = array();
	$data['productslider'] = TRUE;
	$this->load->view('include/header',$data);
	$this->load->view('product_gallery');
	$this->load->view('include/footer');
     }
     
     public function _check_dir($dir){
	if(!is_dir($dir))
		return (mkdir($dir, 0777))?TRUE:FALSE;
	else
		return TRUE;
     }
     
      public function player(){
	$data = array('player'=>TRUE);
	$this->load->view('include/header',$data);
	$this->load->view("player");
	$this->load->view('include/footer');
     }
    public function privatexml(){
	$this->load->view("privateXML");
     }
     
     public function doUpload($dir=NULL,$file=NULL){
        error_reporting(E_ALL | E_STRICT);
	if(is_null($dir) || !in_array($dir,$this->user_dirs)) $dir = "files";
	$dir = urlencode($dir);
	$user = urlencode($this->ezauth->user->username);
	$scriptURL = "/members/doUpload/".$dir."/";
	$userDIR = get_include_path()."assets/users/".$user;
	$uploadDIR = get_include_path()."assets/users/".$user."/".$dir."/";
	$uploadURL = "/assets/users/".$user."/".$dir."/";
	
	$this->uploads->options['script_url'] = $scriptURL;
	$this->uploads->options['upload_dir'] = $uploadDIR;
	$this->uploads->options['upload_url'] = $uploadURL;
	if($this->_check_dir($uploadDIR)){
		
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
		
		switch ($_SERVER['REQUEST_METHOD']) {
		    case 'OPTIONS':
			break;
		    case 'HEAD':
		    case 'GET':
			$this->uploads->get();
			break;
		    case 'POST':
			if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
			    $this->uploads->delete();
			} else {
			    $this->uploads->post();
			}
			break;
		    case 'DELETE':
			if(!is_null($file)){
			    $this->uploads->delete(rawurldecode($file));
			}
			break;
		    default:
			header('HTTP/1.1 405 Method Not Allowed');
		}
	}

	

     }
     function roster(){
	$this->load->view('login/top');
	$this->load->view('login/members');
	
	$this->load->view('login/bottom');
     }
     function edit(){
	$this->load->view('login/top');
	$action = $this->input->post('action');
	$gamertag = $this->input->post('gamertag');
	$id = $this->input->post('id');
	if($action !== FALSE && $id !== FALSE){
		switch($action){
			case 'Edit':
				$this->load->view('editProfile',array('id'=>$id));
				break;
			case 'Delete':
				$this->load->helper('directory');
				$query = $this->db->get_where('ez_users',array('id'=>$id));
				foreach($query->result() as $row){
					$username = $row->username;
				}
				if(delete_folder(get_include_path()."assets/users/".$username)){
					if($this->db->delete('ez_users',array('id'=>$id))){
						if($this->db->delete('userinfo',array('user_id'=>$id))){
							if($this->db->delete('ez_auth',array('user_id'=>$id))){
								if($this->db->delete('ez_access_keys',array('userid'=>$id))){
									echo $username." deleted";
								}
							}
						}
					}
				}
				break;
		}
	} else {
		if($id !== FALSE && $gamertag !== FALSE){
			
			$this->db->where('userid',$id);
			if($this->db->update('userinfo',array('gamertag'=>$gamertag))){
				echo "<h2>User Info Updated</h2>";
			}
		}
	}
	$this->load->view('login/bottom');
     }
        function _user_files(){
		
		$uploadDIR = get_include_path()."assets/users/".$this->ezauth->user->username."/";
		return directory_map($uploadDIR);
		
	}
	function profile($user=FALSE){
		$this->load->view('include/header');
		$this->load->view('user_profile',array('user'=>$user));
		
		$this->load->view('include/footer');
		
	}
	function show_files(){
		print_r($this->_user_files());
	}
	function add_gamertag(){
		$this->load->view('login/top');
		$gamertag = $this->input->post('gamertag-txt');
		if($gamertag !== FALSE){
			$this->db->where('userid',$this->ezauth->user->id);
			if($this->db->update('userinfo',array('gamertag'=>$gamertag))){
				echo "<h2><Gamertag Added/h2>";
				echo "<a href='/members/profile/".$this->ezauth->user->id."'>Back to Profile</a>";
			}
		}
		$this->load->view('login/bottom');
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
			redirect('/members/');    		
		    } else {
			$data['error_string'] = $login_ok['error'];
		    }

	        }
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
					'tarantism'	 =>	'user',
				),
				'password'  =>	$this->input->post('password')
			);
			
			$verify_yesno = ($this->input->post('verify')) ? true : false;
			$user_reg = $this->ezauth->register($inp, $verify_yesno);	
			if ($user_reg['reg_ok'] == 'yes' && $verify_yesno == true) {
				$v_code = $user_reg['code'];

				$message = '<p>To gain access, you must verify your e-mail
				address by clicking the link below or copying it and pasting it into your browser.</p><p>
				{unwrap}
				<a href="http://www.adipa.mobi/members/verify/'.$v_code.'" 
				title="Verify your e-mail address">http://www.adipa.mobi/members/verify/'.$v_code.'
				{/unwrap}</a></p>';
				
				$this->_send_mail($inp['ez_users']['email'], 'Verify your e-mail address!', $message);
			}
			if ($user_reg['reg_ok'] == 'yes') {
				$user = $inp['ezusers'];
				$un = $user['username'];
				$num = $this->db->get_where('counters',array('site'=>'adipa'));
				foreach($num->result() as $row){
					$count = $row->count;
				}
				$newcount = $count + 1;
				$this->db->where('site','adipa');
				$this->db->update('counters',array('count'=>$newcount));
				
				$folder = get_include_path()."assets/users/".$un."/";
				if(mkdir($folder, 0777)){
					if(mkdir($folder."main/", 0777)){
						redirect('/members/reg_ok');
					}
				}
			} else {
				$data['disp_error'] = 'Error:<br />' . $user_reg['error'];
			}
		}
		$this->load->view('login/register_view', $data);
	}
	
	public function reg_ok() {
		$this->load->view('login/reg_ok_view');
	}
	
	public function _send_mail($to, $subject, $message, $from = NULL) {
		$config['mailtype'] = 'html';
		$config['protocol'] = 'sendmail';
		$this->email->initialize($config);
		if(is_null($from)){
			$this->email->from('admin+noreply@adipa.mobi', 'AdipA');
		} else {
			$this->email->from($from, 'AdipA');
		}
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
	}
	
	public function logout() {
		$this->ezauth->logout();
		redirect('/members');
	}
	
	public function verify() {
		if ($this->ezauth->verify_email($this->uri->segment(3)) == true) {
			$this->load->view('login/verify_ok');
		} else {
			redirect('/members');
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
			$message = auto_link('here is your reset code: http://www.adipa.mobi/members/forgotpw2/'.$usr['reset_code']);
			$this->_send_mail($usr['email'], 'Reset Code', $message);
			$data['disp_message'] = 'A reset code was sent to your e-mail address. Check your e-mail!';
		}
		$this->load->view('login/forgotpw1', $data);
	}
	
	
	
	public function forgotpw2() {
		$reset_code = $this->uri->segment(3);
		if (empty($reset_code)) return false;
		$usr = $this->ezauth->reset_password($reset_code);
		$message = 'Username: '.$usr['username']. '. Here is your temporary password: '.$usr['temp_pw'];
		$this->_send_mail($usr['email'], 'Temporary Password', $message);
		$data['disp_message'] = 'Your temporary password was e-mailed to you. Check your e-mail!';
		$this->load->view('login/forgotpw2', $data);
	}
	
	public function changepw() {
		$data = array();
		$un = $this->ezauth->user->username;
		if ($un == 'admin' || $un == 'client') {
			$data['disp_error'] = 'You can\'t be logged in as "admin" or "client" when trying to change an account password.';
			$this->load->view('login/forgotpw2',$data);
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
		$this->load->view('login/changepw_view', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
