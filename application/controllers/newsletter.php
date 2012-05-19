<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {
   
   public function __construct(){
      parent::__construct();
      $this->load->library('MCAPI');
      $this->load->model('EzAuth_Model', 'ezauth');
      $this->ezauth->program = $this->config->item('ezauth_program');
      $this->ezauth->auto_login();
      $this->ezauth->protected_pages = array(
	  //'edit'             =>  	'admin',
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
   public function campaign($cid=NULL,$data=NULL){
      if(!is_null($cid))
      switch($data){
	 case NULL:
	    redirect('');
	    break;
	 case "abuse":
	    print_r($this->MCAPI->campaignAbuseReports());
	    break;
	 case "advice":
	    print_r($this->MCAPI->campaignAdvice());
	    break;
	 case "analytics":
	    print_r($this->MCAPI->campaignNotOpenedAIM());
	    break;
	 case "bounce":
	    print_r($this->MCAPI->campaignBounceMessage());
	    break;
         case "bounces":
	    print_r($this->MCAPI->campaignBounceMessages());
	    break;
	 case "clicks":
	    print_r($this->MCAPI->campaignClickStats());
	    break;
	 case "orders":
	    print_r($this->MCAPI->campaignEcommOrders());
	    break;
	 case "eepurl":
	    print_r($this->MCAPI->campaignEepUrlStats());
	    break;
	 case "emailDomains":
	    print_r($this->MCAPI->campaignEmailDoaminPerformance());
	    break;
         case "geoOpens":
	    print_r($this->MCAPI->campaignGeoOpens());
	    break;
	 case "geoOpensForCountry":
	    print_r($this->MCAPI->campaignGeoOpensForCountry());
	    break;
	 case "members":
	    print_r($this->MCAPI->campaignGeoOpensForCountry());
	    break;
	 case "unsubscribes":
	    print_r($this->MCAPI->campaignGeoOpensForCountry());
	    break;
      }
   }
   public function campaigns(){
      print_r($this->MCAPI->campaigns());
   }
   public function campaignStats(){
      
   }
   public function campaignReports($data=NULL,$id){
      switch($data){
	 case NULL:
	    break;
	 case "click":
	    print_r($this->MCAPI->campaignClickDetailAIM());
	    break;
	 case "email":
	    print_r($this->MCAPI->campaignEmailStatsAIM());
	    break;
	 case "opened":
	    print_r($this->MCAPI->campaignNotOpenedAIM());
	    break;
	 case "notOpened":
	    print_r($this->MCAPI->campaignOpenedAIM());
	    break;
      }
      
   }
   public function campaignStats(){
      
   }
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
