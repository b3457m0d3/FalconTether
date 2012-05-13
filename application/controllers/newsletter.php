<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {
   
   public function __construct(){
      parent::__construct();
      $this->load->model('EzAuth_Model', 'ezauth');
      $this->ezauth->program = $this->config->item('ezauth_program');
      $this->ezauth->auto_login();
      $this->ezauth->protected_pages = array(
	  //'edit'       	 =>    	'admin',
	  'upload'             =>     'user',
	  'doUpload'           =>     'user',
	  'changepw'	       =>     'user',
	  'project'            =>     'user',
	  'content'            =>     'user',
	  'show_files'         =>     'user',
	  'player'             =>     'user',
	  'privatexml'         =>     'user'

      );
   }
   public function index(){
      $this->load->view('include/header');
      $this->load->view('mcapi/home');
      $this->load->view('include/footer');
   }
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
