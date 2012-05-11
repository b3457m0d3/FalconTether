<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('set_type'))
{
	function set_type($type){
	    header("Content-type : ".$type);
	}
}
if ( ! function_exists('start_wrapper'))
{
	function start_wrapper(){
	    echo "(function(){".PHP_EOL;
	}
}
if ( ! function_exists('end_wrapper'))
{
	function end_wrapper(){
		echo "})();".PHP_EOL;
	}
}
if ( ! function_exists('set_ns'))
{
	function set_ns($name,$object){
		return "$name = $object;".PHP_EOL;
	}
}
if ( ! function_exists('LAB_opts')){
    function LAB_opts($options){
        $rv = '$LAB.setGlobalDefaults({';
        if(count($options)>0) $rv .= join(',',$options);
        $rv .= '});';
        echo $rv;
    }
}
if ( ! function_exists('LAB_script')){
    function LAB_script($script=FALSE,$last=FALSE){
        $rv .= "";
        if(!$script) $rv .= "$LAB";
        else $rv .= ".script('".$script."')";
        if($last) $rv .= ";";
        return $rv;
    }
}
if ( ! function_exists('LAB_wait')){
    function LAB_wait($fn){
        echo PHP_EOL.".wait(function(){".$fn."});";
    }
}

/* End of file labjs_helper.php */
/* Location: ./system/helpers/labjs_helper.php */