<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage extends CI_Controller {
   public $options = array();
   public function __construct(){
	parent::__construct();
	$this->load->helper('json');
        // Poll option definitions
	$this->options[1] = 'jQuery';
	$this->options[2] = 'Ext JS';
	$this->options[3] = 'Dojo';
	$this->options[4] = 'Prototype';
	$this->options[5] = 'YUI';
	$this->options[6] = 'mootools';

	// Column definitions
	define('OPT_ID', 0);
	define('OPT_TITLE', 1);
	define('OPT_VOTES', 2);

   }

   public function index(){
      $this->load->view('include/header');

	if ($this->input->post('poll')) 
	  $this->_poll_submit();
	else if ($this->input->post('vote')) 
	  $this->_poll_ajax();
	else 
	  $this->_poll_default();
	
      $this->load->view('include/footer');
	}
   public function _poll_ajax() {

	  $id = $this->input->post('vote');
	  
	  $this->db->distinct();
	  $_result = $this->db->get_where('vote_ips',array('ip'=>$_SERVER['REMOTE_ADDR']));
	  $ip_result = $_result->result_row();	  

	  if (empty($ip_result)) {
	    $ip[0] = $_SERVER['REMOTE_ADDR'];
	    $this->db->insert('vote_ips', $ip);
	    
	    if ($id != 'none') {
	      $row = $db->selectUnique(VOTE_DB, OPT_ID, $id);
	      if (!empty($row)) {
		$new_votes = $row[OPT_VOTES]+1;    
		$db->updateSetWhere(VOTE_DB, array(OPT_VOTES => $new_votes), new SimpleWhereClause(OPT_ID, '=', $id));
	      }
	      else if ($this->options[$id]) {
		$new_row[OPT_ID] = $id;
		$new_row[OPT_TITLE] = $this->options[$id];
		$new_row[OPT_VOTES] = 1;
		$db->insert(VOTE_DB, $new_row);
	      }
	    }
	  }
	  
	  $rows = $db->selectWhere(VOTE_DB, new SimpleWhereClause(OPT_ID, "!=", 0), -1, new OrderBy(OPT_VOTES, DESCENDING, INTEGER_COMPARISON));
	  print json_encode($rows);
	}


	function _poll_submit() {
	  
	  $id = $this->input->post('poll');
	  $id = str_replace("opt", '', $id);
	  
	  $ip_result = $db->selectUnique(IP_DB, 0, $_SERVER['REMOTE_ADDR']);
	  
	  if (!$this->input->cookie('vote_id')) && empty($ip_result)) {
	    $row = $db->selectUnique(VOTE_DB, OPT_ID, $id);
	    if (!empty($row)) {
	      $ip[0] = $_SERVER['REMOTE_ADDR'];
	      $db->insert(IP_DB, $ip);
	      
		$cookie = array(
		    'name'   => 'vote_id',
		    'value'  => $id,
		    'expire' => time()+31556926,
		);

		$this->input->set_cookie($cookie);
	      
	      $new_votes = $row[OPT_VOTES]+1;
	      $db->updateSetWhere(VOTE_DB, array(OPT_VOTES => $new_votes), new SimpleWhereClause(OPT_ID, '=', $id));
	      
	      $this->_poll_return_results($id);
	    }
	    else if ($this->options[$id]) {
	      $ip[0] = $_SERVER['REMOTE_ADDR'];
	      $db->insert(IP_DB, $ip);
	      
		$cookie = array(
		    'name'   => 'vote_id',
		    'value'  => $id,
		    'expire' => time()+31556926,
		);

		$this->input->set_cookie($cookie); 
	      
	      $new_row[OPT_ID] = $id;
	      $new_row[OPT_TITLE] = $this->options[$id];
	      $new_row[OPT_VOTES] = 1;
	      $db->insert(VOTE_DB, $new_row);
	      
	      $this->_poll_return_results($id);
	    }
	  }
	  else {
	    $this->_poll_return_results($id);
	  }
	}


	function _poll_default() {
	  
	  $ip_result = $db->selectUnique(IP_DB, 0, $_SERVER['REMOTE_ADDR']);
	  
	  if (!isset($_COOKIE['vote_id']) && empty($ip_result)) {
	    $this->load->view();
	  }  
	  else {
	    $this->_poll_return_results($_COOKIE['vote_id']);
	  }
	}


	public function _poll_return_results($id = NULL) {
	  
	    $html = $this->load->view('poll','',TRUE);
	    $results_html = "<div id='poll-container'><div id='poll-results'><h3>Poll Results</h3>\n<dl class='graph'>\n";
	    
	    $rows = $db->selectWhere(VOTE_DB,
	      new SimpleWhereClause(OPT_ID, "!=", 0), -1,
	      new OrderBy(OPT_VOTES, DESCENDING, INTEGER_COMPARISON));

	    foreach ($rows as $row) {
	      $total_votes = $row[OPT_VOTES]+$total_votes;
	    }
	    
	    foreach ($rows as $row) {
	      $percent = round(($row[OPT_VOTES]/$total_votes)*100);
	      if (!$row[OPT_ID] == $id) {
		$results_html .= "<dt class='bar-title'>". $row[OPT_TITLE] ."</dt><dd class='bar-container'><div id='bar";
	        $results_html .= $row[OPT_ID] ."'style='width:$percent%;'>&nbsp;</div><strong>$percent%</strong></dd>\n";
	      } else {
		$results_html .= "<dt class='bar-title'>". $row[OPT_TITLE] ."</dt><dd class='bar-container'><div id='bar". $row[OPT_ID]; 
	        $results_html .= "' style='width:$percent%;background-color:#0066cc;'>&nbsp;</div><strong>$percent%</strong></dd>\n";
	      }
	    }
	    
	    $results_html .= "</dl><p>Total Votes: ". $total_votes ."</p></div></div>\n";
	    
	    $results_regex = '/<div id="poll-container">(.*?)<\/div>/s';
	    $return_html = preg_replace($results_regex, $results_html, $html);
	    print $return_html;
	}



}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
