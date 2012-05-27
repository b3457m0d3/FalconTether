<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members extends CI_Controller {
	public $user_dirs = array();
	public $themes = array();
	public $selected;
	function __construct(){
		parent::__construct();
		$this->load->helper('directory');
		
		$permissions = array(
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
		$this->load->library('Users');
		$this->users->permissions($permissions);
		
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
	       if(method_exists($this,$method)) call_user_func_array(array(&$this, $method), $segments);
	       else redirect("/members");
	   } else redirect('/members');
        }

//Pages

	public function index(){
		$data = array();
		if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
		$this->load->view('include/header',$data);
      		$this->load->view('frontpage');
      		$this->load->view('include/footer');
	}
	public function content(){
	   $data = array();
	   if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
	   $this->load->view('include/header',$data);
	   $this->load->view('content');
	   $this->load->view('include/footer');
	     
	}
	
	public function project(){
           $data = array('markitup'=>TRUE);
           if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
	   $this->load->view('include/header',$data);
	   $this->load->view('editor');
	   $this->load->view('include/footer',$data);
	}
     
	
	public function countdown(){
	   $data = array();
	   if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
	   $this->load->view('include/header');
	   $this->load->view('countdown');
	   $this->load->view('include/footer');
	}
	
	public function products($time=NULL){
	   $data = array();
	   $data['productslider'] = TRUE;
	   if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
	   $this->load->view('include/header',$data);
	   $this->load->view('product_gallery');
	   $this->load->view('include/footer');
	}
     
	public function player(){
		$data = array('player'=>TRUE);
		if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
		$this->load->view('include/header',$data);
		$this->load->view("player");
		$this->load->view('include/footer');
	}
	public function privatexml(){
		$this->load->view("privateXML");
	}

//Upload Functions
	
	public function upload($dir=NULL){
		$da_ta = array();
		if($this->selected>0) $da_ta['theme'] = $this->themes[$this->selected];
		$this->load->view('include/header',$da_ta);
		if(is_null($dir)) $this->load->view('upload_tabs');
		else {
			$data = array('dir'=>$dir);
			$this->load->view('upload',$data);
		}
		$this->load->view('include/footer');
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
	   if(_check_dir($uploadDIR)){
		   
		   $this->uploads->expose_http();
	   }
	
	   
	
	}

//User Functions

        public function _user_files(){
		$uploadDIR = get_include_path()."assets/users/".$this->ezauth->user->username."/";
		return directory_map($uploadDIR);
	}
	public function profile($user=FALSE){
                $data = array();
                if($this->selected>0) $data['theme'] = $this->themes[$this->selected];
		$this->load->view('include/header');
		$this->load->view('user_profile',array('user'=>$user));
		$this->load->view('include/footer');
	}
	
	public function login($data = array()) {
	        $this->users->login($data);
	}
	public function register() {
		$this->users->register();		
	}
	public function reg_ok() {
	}
	public function logout() {
		$this->users->logout();
	}
	public function verify() {
		$this->users->verify();
	}
	public function changepw() {
		$this->users->changepw();
	}
	public function forgotpw1() {
		$this->users->forgotpw1();
	}
	public function forgotpw2() {
		$this->users->forgotpw2();
	}
	public function vanilla_auth(){
	     $this->users->vanilla_auth();
	}

	
}

/* End of file members.php */
/* Location: ./application/controllers/welcome.php */
