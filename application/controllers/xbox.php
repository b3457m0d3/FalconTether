<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xbox extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	function index()
	{
		$this->rest->initialize(array('server' => 'https://xboxapi.com/json/'));

// Pull in an array of tweets
                $profile = $this->rest->get('profile/CuddleCandy/');
print_r($profile);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
