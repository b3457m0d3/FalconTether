<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage extends CI_Controller {

   public function index()
	{
      $this->load->view('include/header');
      $this->load->view('frontpage');
      $this->load->view('include/footer');
	}
   public function content($category=NULL){
      $data = array();
      if(!is_null($category)){
	 switch($category){
	    case '':
	         $data[]= '';
	       break;
	 }
      }
      $this->load->view('include/header');
      $this->load->view('content',$data);
      $this->load->view('include/footer');
	
   }
   public function project(){
      $this->load->view('include/header');
      $this->load->view('editor');
      $this->load->view('include/footer');
   }
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
