<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Assets {
	public $css = array();
	public $fonts = array();
	public $imgs = array();
	public $dir = array();
	public $options,$fs,$scale,$cdn,$LAB,$ready;
	public function __construct($config=array()){
		$this->ci =& get_instance();
		$this->db =& $this->ci->db;
		if(!empty($config)) foreach($config as $k => $v){ $this->$k = $v; }
		else show_error("Assets Config File is Missing or is Empty");
		
		$this->cdn = array(
			"jquery"=>"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js",
			"jqueryui"=>"https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"
		);
		
		//Asset Location Data
		$this->dir['fonts'] = "$this->assets_folder/fonts";
		$this->dir['tpl'] = "$this->assets_folder/public/templates";
		$this->dir['js'] = "$this->assets_folder/js";
		
		$this->fs = get_include_path()."/assets/";
		$this->LAB = array();
		$this->ready = array();
		
        //===========================================================
        //    Upload Options
        //===========================================================
		
	$this->uploads = "$this->assets_folder/public/uploads";
	$this->thumbs = "$this->assets_folder/public/uploads/thumbs";
	$this->options = array(
            'script_url'              => site_url("e1/do_upload"),
            'upload_dir'              => $this->uploads."/",
            'upload_url'              => site_url($this->uploads)."/",
            'thumb_dir'               => $this->thumbs."/",
            'thumb_url'               => site_url($this->thumbs)."/",
            'thumb_width'             => 80,
            'thumb_height'            => 80,
            'param_name'              => 'files',
            'max_file_size'           => null,
            'min_file_size'           => 1,
            'accept_file_types'       => '/.+$/i',
            'max_number_of_files'     => null,
            'discard_aborted_uploads' => true
        );
        
    }
    public function _get_dir($asset){
	return site_url($this->dir[$asset]);
    }
    
    
//XXXXXXXXXXXXX{+[ FONTS ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX	
	public function font_list(){
		foreach($this->fonts as $font){
			echo $font."<br>";
		}
	}
//XXXXXXXXXXXXX{+[ IMAGES ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function create_scaled_image($file_name) {
        $file_path = $this->options['upload_dir'].$file_name;
        $new_file_path = $this->options['thumb_dir'].$file_name;
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) return false;
        $scale = min($this->options['thumb_width'] / $img_width,$this->options['thumb_height'] / $img_height);
        if ($scale > 1) $scale = 1;
        $new_width = $img_width * $scale;
        $new_height = $img_height * $scale;
        $new_img = @imagecreatetruecolor($new_width, $new_height);
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg': case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                break;
            default: $src_img = $image_method = null;
        }
        $success = $src_img 
        && @imagecopyresampled($new_img,$src_img,0, 0, 0, 0,$new_width,$new_height,$img_width,$img_height) 
        && $write_image($new_img, $new_file_path);
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }
//XXXXXXXXXXXXX{+[ UPLOAD/MANAGE FILES ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function reroute(){
		//change upload path
	}
	public function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'].$file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
	    $file->ext = pathinfo($file_path,PATHINFO_EXTENSION);
            $file->url = $this->options['upload_url'].rawurlencode($file->name);
            if($file->ext == "jpg" || $file->ext == "gif" || $file->ext == "png"){
		$file->thumbnail_url = $this->options['thumb_url'].rawurlencode($file->name);
	    } else {
		
	    }
            $file->delete_url = $this->options['script_url'].'?file='.rawurlencode($file->name);
            $file->delete_type = 'DELETE';
            return $file;
        }
        return null;
    }
    public function get_file_objects() {
        return array_values(array_filter(array_map(
            array($this, 'get_file_object'),
            scandir($this->options['upload_dir'])
        )));
    }
    public function has_error($uploaded_file, $file, $error) {
        if ($error) return $error;
        if (!preg_match($this->options['accept_file_types'], $file->name)) return 'acceptFileTypes';
        if ($uploaded_file && is_uploaded_file($uploaded_file)) $file_size = filesize($uploaded_file);
        else $file_size = $_SERVER['CONTENT_LENGTH'];
        if ($this->options['max_file_size'] && ($file_size > $this->options['max_file_size'] || $file->size > $this->options['max_file_size'])) {
            return 'maxFileSize';
        }
        if ($this->options['min_file_size'] && $file_size < $this->options['min_file_size'])  return 'minFileSize';
        if (is_int($this->options['max_number_of_files']) && (count($this->get_file_objects()) >= $this->options['max_number_of_files'])) {
            return 'maxNumberOfFiles';
        }
        return $error;
    }
    private function handle_file_upload($uploaded_file, $name, $size, $type, $error) {
        $file = new stdClass();
        $file->name = trim(basename(stripslashes($name)), ".\x00..\x20");
	  preg_match("/\.([^\.]+)$/",$file->name,$matches);
        $file->size = intval($size);
        $file->type = $type;
        $error = $this->has_error($uploaded_file, $file, $error);
        if (!$error && $file->name) {
            $file_path = $this->options['upload_dir'].$file->name;
            $append_file = !$this->options['discard_aborted_uploads'] && is_file($file_path) && $file->size > filesize($file_path);
            clearstatcache();
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                if ($append_file) file_put_contents($file_path,fopen($uploaded_file, 'r'),FILE_APPEND);
                else  move_uploaded_file($uploaded_file, $file_path);
            } else {
                file_put_contents( $file_path,fopen('php://input', 'r'),$append_file ? FILE_APPEND : 0 );
            }
            $file_size = filesize($file_path);
            if ($file_size === $file->size) {
                $file->url = $this->options['upload_url'].rawurlencode($file->name);
                    if ($this->create_scaled_image($file->name, $this->options)) {
                        $file->{'thumb_url'} = $this->options['upload_url']
                            .rawurlencode($file->name);
                    }
                }
            } else if ($this->options['discard_aborted_uploads']) {
                unlink($file_path);
                $file->error = 'abort';
            }
            $file->size = $file_size;
            $file->delete_url = $this->options['script_url'].'?file='.rawurlencode($file->name);
            $file->delete_type = 'DELETE';
        
        return $file;
    }
    public function get() {
        $file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null; 
        if ($file_name) $info = $this->get_file_object($file_name);
        else $info = $this->get_file_objects();
        header('Content-type: application/json');
        echo json_encode($info);
    }
    public function post() {
        $upload = isset($_FILES[$this->options['param_name']]) ?
            $_FILES[$this->options['param_name']] : array(
                'tmp_name' => null, 'name' => null, 'size' => null,'type' => null, 'error' => null
            );
        $info = array();
        if (is_array($upload['tmp_name'])) {
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    isset($_SERVER['HTTP_X_FILE_NAME']) ? $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                    isset($_SERVER['HTTP_X_FILE_SIZE']) ? $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                    isset($_SERVER['HTTP_X_FILE_TYPE']) ? $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index],
                    $upload['error'][$index]
                );
            }
        } else {
            $info[] = $this->handle_file_upload(
                $upload['tmp_name'],
                isset($_SERVER['HTTP_X_FILE_NAME']) ? $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'],
                isset($_SERVER['HTTP_X_FILE_SIZE']) ? $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'],
                isset($_SERVER['HTTP_X_FILE_TYPE']) ? $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'],
                $upload['error']
            );
        }
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        echo json_encode($info);
    }
    public function iRd($file){
        return (is_file($file) && $file[0] !== '.' && unlink($file)) ? "TRUE" : "FALSE";
    }
    public function delete() {
        $file_name = isset($_GET['file']) ? basename(stripslashes($_GET['file'])) : null;
        $file_path = $this->options['upload_dir'].$file_name; 
        $thumb_path = $this->options['thumb_dir'].$file_name; 
        $success = $this->iRd($file_path);
        if ($success) $this->iRd($thumb_path);
        header('Content-type: application/json');
        echo json_encode(array($success));
    }
    /**********************
    *@file - path to zip file
    *@destination - destination directory for unzipped files*/
    public function unzip_file($file, $destination){
	$zip = new ZipArchive();
	//if($zip->open($file) !== TRUE){ die (Could not open archive); }
	$zip->extractTo($destination);
	$zip->close();
	echo 'Archive extracted to directory';
    }
    public function editXML($path){
            /* With simplexml, open an entire file (use XMLReader for big files) 
	    Example : <root><s name="abc">value</s>....</root>*/
	    $xml = simplexml_load_file($path);
	    //find the elemnt by attribute's value (name=..)
	    $result = $xml->xpath('//s[@name="'.$element_name.'"]'); 
	    //heres the trick - the first result of xpath, and the node value (stored in [0])
	    $result[0][0] = $new_value; 
	    //here you can do a foreach, to cross over all results (all "s" elements with the same name"
	     if ($xml->asXML($xml_source_path) === false)
		    {
		    throw new Exception('Cannot save values into "'.$path.'"',99);
	    }
	    return true;
    }
//XXXXXXXXXXXXX{+[ LOAD THINGS ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	public function url($file,$level=""){
		if(!$level) $level = $this->default_level;
		$type = strtolower(substr(strrchr($file, '.'), 1));
		if(array_key_exists($type,$this->asset_types)){
			foreach($this->asset_types as $asset_type => $folder){
				if($type == $asset_type){
					$output = site_url("$this->assets_folder/$level/$folder").$file;
					return $output;
				}
			}
		} else show_error("$type is not a valid asset type");
	}

	public function head_tags($title,$css,$icon="",$meta=""){
		$output = '<title>'.$title.'</title>'.PHP_EOL.'<meta charset="utf-8">'.PHP_EOL;
		if($meta != ""){
			if(hash_key("description",$meta)) $output .= '<meta name="description" content="'.$meta['description'].'" />'.PHP_EOL;
			if(hash_key("keywords",$meta)) $output .= '<meta name="keywords" content="'.$meta['keywords'].'"/>'.PHP_EOL;
		}
		if($icon != "") $output .= '<link rel="icon" type="image/png" href="'.$icon.'" />'.PHP_EOL;
		if(count($css)>0){
			foreach($css as $link) $output .= "<link href='".site_url("$this->assets_folder/css/$link.css")."' rel='stylesheet' type='text/css' />".PHP_EOL;
		}
		echo $output;
	}

//XXXXXXXXXXXXX{+[ MAKE THINGS ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	public function _new_stylesheet($name,$level="",$code){
	    $level = (!$level) ? $this->default_level : $level;
	    $file = "$this->assets_folder/$level/css/$name.js";
	    //check code for syntax errors
	    // before writing
	    /*
		$lint=new JSLEngine();
		if (!$lint->Lint($js)) {
		    echo "bad js code! full output:\n";
		    echo $lint->output();
		}
    
	    */
	    echo $name.(write_file($file,$code,'w+'))? " created" : " <span style='color:#f00'>NOT</span> created"; exit;
	}
	public function _new_script($name,$level="",$code){
	    $level = (!$level) ? $this->default_level : $level;
	    $file = "$this->assets_folder/$level/js/$name.js";
	    //check code for syntax errors
	    // before writing
	    /*
		$lint=new JSLEngine();
		if (!$lint->Lint($js)) {
		    echo "bad js code! full output:\n";
		    echo $lint->output();
		}
    
	    */
	    echo $name.(write_file($file,$code,'w+'))? " created" : " <span style='color:#f00'>NOT</span> created"; exit;
	}
		
	public function _new_template($name,$view,$load){
	    //make the directory
	    if(!$this->_create_directory($this->tpl_folder,$name)){
		return "FALSE";
	    } else {
		echo "$path/$name created";
		$data = read_file("$this->tpl_folder/templates/views/$view.php");
		$file = "$this->tpl_folder/$name/views/$name/$view.php";
		 //attempt to create the file
		return (write_file($file,$data,'w+')) ? "TRUE" : " FALSE"; 
	    }
	}
    
	public function _new_api($name,$table='',$fields="basic"){
         //  initialize the forge class
        $this->ci->load->dbforge();
        //load the template
        $data = read_file("$this->tpl_folder/api/api.php");
        $file = APPPATH."controllers/".$name."_api.php";
        
        //replace place holders
        $data = str_replace("<!? RESOURCE-ucfirst />",ucfirst($name),$data); 
        $data = str_replace("<!? RESOURCE />",$name,$data); 
         $data = str_replace("<!? TABLE />",((!$table || $table == "new") ? $name : $table),$data);  
         
         //  if the table needs to be created,
        if($table == "new" || !$table){
            $table = $name;
            $data = str_replace("<!? TABLE />",$table,$data); 
            //create a new table
            // add fields : 
                //$this->ci->dbforge->basic[] = array("name"=>array("type"=>"VARCHAR","constraint"=>100,"default"=>"anon"))
            $this->ci->dbforge->add_field($fields);
            if(!$this->ci->dbforge->create_table($table,"TRUE")) return "FALSE";
        }
        return (write_file($file,$data,"w+")) ? "TRUE" : "FALSE";
    }
	
	public function _make_assets($name,$level="",$tpl){
		//set the access level for assets
		$level = (!$level) ? $this->default_level : $level;
		//create a container for the file data
		$template_files = array();
		$template = get_filenames("$this->tpl_folder/$tpl/","TRUE");
		//loop through the files 
		foreach($template as $file){
			//grab the extensions
			if(preg_match("/\.([^\.]+)$/", $file, $t)) $type = $t[1];
			//read in the contents of the file
			$template_files[$type] = read_file($file);
		}
		//loop through and recreate the template structure for the new app
		foreach($template_files as $ext=>$data){
			//set the correct path for each new directory
			$path = ($ext == "php") ? APPPATH."views" : "$this->assets_folder/$level/$ext";
			//create the directory
			if(!$this->_create_directory($path,$name)){
				//fail message: directory
				echo "$path/$name <span style='color:#f00'>NOT</span> created"; exit;
			} else {
				//if created, specify the filename
				$file = "$path/$name/$name.$ext";
				//write the template data to the file 
				if(write_file($file,$data,'w+')){
					//success message
					echo "$file created\n";
				} else {
					//fail message: file
					echo "file $file <span style='color:#f00'>NOT</span> created"; exit;
				}
			} 
		}	
	}
	
	public function _create_directory($path,$name){
		if(!is_dir("$path/$name")){
			return (mkdir("$path/$name")) ? TRUE : FALSE;
		} else {
			return FALSE;
		}
	}
	
//XXXXXXXXXXXXX{+[ INTERFACE ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX        
	public function level_select(array $attr,$type){
		$type = ($type == "js") ? "scripts" : "styles"; 
		$method = "_{$type}_list";
		$tag = "<select class='chzn-select' multiple";
		foreach($attr as $name=>$val){
		    $tag.= " $name=\"$val\"";
		}
		$tag .= ">";
		foreach($this->$method() as $lvl=>$files){
		    $tag .= "<optgroup label=\"$lvl\">\n";
		    foreach((array)$files as $file){
			$tag .= "\t<option value=\"$file\">".basename($file)."</option>";
		    }
		    $tag .= "</optgroup>";
		}
		$tag .= "</select>";
		return $tag;
	}
//XXXXXXXXXXXXX{+[ MISC ]+}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	public function _tpl_list(){
		return directory_map($this->tpl_folder,1);
	}
    
        public function _view_list(){
		return get_filenames("$this->tpl_folder/files/views",TRUE);
	}
    
        public function _scripts_list(){
	    $levels = array(
		"public"=>get_filenames("$this->assets_folder/public/js",TRUE),
		"shared"=>get_filenames("$this->assets_folder/shared/js",TRUE),
		"admin"=>get_filenames("$this->assets_folder/admin/js",TRUE)
            );
	    return $levels;
	}
    
        public function _styles_list(){
	    $levels = array(
		"public"=>get_filenames("$this->assets_folder/public/css",TRUE),
		"shared"=>get_filenames("$this->assets_folder/shared/css",TRUE),
		"admin"=>get_filenames("$this->assets_folder/admin/css",TRUE)
            );
            return $levels;
	}
	
	public function _delete_directory($dirname) {
		if (is_dir($dirname))
		   $dir_handle = opendir($dirname);
		if (!$dir_handle)
		   return false;
		while($file = readdir($dir_handle)) {
		   if ($file != "." && $file != "..") {
		      if (!is_dir($dirname."/".$file))
			 unlink($dirname."/".$file);
		      else
			 delete_directory($dirname.'/'.$file);    
		   }
		}
		closedir($dir_handle);
		rmdir($dirname); return true;
	}
	

    
    public function getEmailMessage($v_code){
                return '<p>To gain 1337 access, you must verify your e-mail
				address by clicking the link below or copying it and pasting it into your browser.</p><p>
				{unwrap}
				<a href="http://www.interr0bang.net/e1/verify/'.$v_code.'" 
				title="Verify your e-mail address">http://www.interr0bang.net/e1/verify/'.$v_code.'
				{/unwrap}</a></p>';
    }
}
?>
