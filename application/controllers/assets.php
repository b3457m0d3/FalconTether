<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Asset_controller extends CI_Controller {
		
	public function __construct(){
		parent::__construct();
		$this->load->config("assets");
	}
	
	function index($level,$file){
		$folder = $this->config->item("assets_path");
		if(preg_match("/\.([^\.]+)$/", $file, $t)) $type = $t[1];
		$files_path = "$this->folder/$level/$type/";
		$ext = ".$type";
		if($type == 'js' || $type == 'json'){
			Header("Content-type: text/javascript");
			}elseif($type == 'css'){
				Header ("Content-type: text/css");
			}
			require_once($files_path.$file.$ext);
		}
	
    function files($type="",$file){
		$folder = $this->config->item("upload_path");
		if(preg_match("/\.([^\.]+)$/", $file, $t)) $ext = $t[1];
        $type = ($type != "") ? "$type/" : "";
		$files_path = "$folder/$type/";
		switch($ext){
            case 'jpg': 
            case 'jpeg': Header("Content-type: image/jpeg");       break;
			case 'png':  Header ("Content-type: image/png");       break;
			case 'gif':    Header ("Content-type: image/gif");         break;
			case 'pdf':   Header ("Content-type: application/pdf");break;
			case 'zip':	   Header ("Content-type: application/zip"); break;
			case 'mp3': Header ("Content-type: audio/mpeg");     break;
        }
        require_once($files_path.$file);
    }
    
}
?>