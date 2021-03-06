<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fontface
{
	public $ci,$dir,$fonts,$loaded;
	function __construct()
	{
		//grab the CI super object
		$this->ci =& get_instance();
		//make sure our helpers are lined up
		$this->ci->load->helper('url_helper','html','directory');
		$this->ci->load->spark('cloudmanic-combine-1.0.1');
		//grab the list of available fonts
		$this->dir = get_include_path()."/assets/fonts/";
		$this->fonts = directory_map($this->dir,1);
		$this->loaded = array();
		

	}
	public function loadfont($font,$dom=NULL)
	{
		//setup future feature of passing in a desired class/element name e.g '.font' or 'h2,h3'
		if(is_null($dom)) $dom = ".".$font;
		if(in_array($font,$this->fonts)) $this->loaded[$dom] = $font;	
	}
	public function loadtags()
	{
                //use the spark to fuse all the css into one minified file
		foreach($this->loaded as $font){
			$this->ci->combine->css($this->dir.$font.'/stylesheet.css');
		}
		echo $this->ci->combine->build('css');
	}
	public function listfonts()
	{
		print_r($this->fonts);
	}
}

/* End of file Fontface.php */
/* Location: ./application/libraries/Fontface.php */

