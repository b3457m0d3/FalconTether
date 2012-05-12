<?php

class Mixpanel
{
    public $api_url = 'http://mixpanel.com/api';
    private $version = '2.0';
    private $api_key;
    private $api_secret;
    public $api_token;

    public $init, $trackers, $CI, $site;
    
    
    public function __construct(){
	$this->CI =& get_instance();
        $this->CI->config->load('mixpanel');
	$this->api_key=$this->CI->config->item('mixpanel_key');
        $this->api_secret=$this->CI->config->item('mixpanel_secret');
        $this->api_token =$this->CI->config->item('mixpanel_token');
	$this->site = $this->CI->config->item('mixpanel_site');
	$this->trackers = array();
    }
    
    public function saveTrackers(){
	foreach($this->trackers as $index=>$code){ 
	    $data = array(
		'id' => '',
		'snippet' => $code,
		'site' => 'tarantism.us'
	    );
	 
	    if($this->CI->db->insert('trackers', $data)){
		unset($this->trackers[$index]);
	    }
	}
    }
    public function get_trackers($raw=TRUE){
	$html = "";
	$query = $this->CI->db->get_where('trackers',array('site'=>$this->site));
	if($query->num_rows()>0){
	    foreach($query->result() as $row){
		if(!$raw) $html .= "<code>";
		$html .= $row->snippet;
		if(!$raw) $html .= "</code>";
	    }
	}
	return $html;
    }
    public function add_tracker($options){
	extract($options);
	if(!isset($type) || $type == '') $type = "std";
	if(!isset($props) || $props == '') $props = "{}";
	
	switch($type){
	    case 'std':
		$this->trackers[]= "mixpanel.track('$event', '$props', '$func');\n";
		break;
	    case 'links':
		$this->trackers[]= "mixpanel.track_links('$css', '$event', '$props');\n";
		break;
	    case 'forms':
		$this->trackers[]= "mixpanel.track_forms('$css', '$event', '$props');\n";
		break;
	}
	$this->saveTrackers();
	
    }
   
    public function request($methods, $params) {
        if (!isset($params['api_key']))   $params['api_key'] = $this->api_key;
        $params['format'] = 'json';
        if (!isset($params['expire'])) {
            $current_utc_time = time() - date('Z');
            $params['expire'] = $current_utc_time + 600; // Default 10 minutes
        }
        
        $param_query = $this->_params($params);
        $sig = $this->signature($params);
        $request_url = $this->url($methods,$sig,$params);
        
	
        
    }
    public function url($methods,$sig,$params){
        $uri = '/' . $this->version . '/';
        $uri .= (is_array($methods)) ? join('/', $methods) : $methods . '/';
        $request_url = $uri . '?sig=' . $sig . $params;
        return $request_url;
    }
    private function signature($params) {
        $params = $this->_params($params);
        ksort($params);
        $param_string ='';
        foreach ($params as $param => $value) {
            $param_string .= $param . '=' . $value;
        }
        return md5($param_string . $this->api_secret);
    }
    
    public function _params($params){
         $param_query = '';
        foreach ($params as $param => &$value) {
            if (is_array($value))
                $value = json_encode($value);
            $param_query .= '&' . urlencode($param) . '=' . urlencode($value);
        }
         return $param_query;
    }
 
}
?>
