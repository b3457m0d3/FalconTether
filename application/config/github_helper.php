<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Github Buttons Helper
 *
 * @package       CodeIgniter
 * @subpackage    Helpers
 * @category      Helpers
 * @author        Jessie James Jackson Taylor

reference:
    $CI =& get_instance();

*/
//
if( !function_exists('git_btn') ){
    //type watch, fork or follow
    function git_btn($user,$repo,$type="watch",$count=TRUE,$large=TRUE){
        $vars = 'user='.$user.'&amp;repo='.$repo.'&amp;type='.$type;
        if ($count) $vars .= '&amp;count=true';
        if ($large) $vars .= '&amp;large=true';
        echo '<iframe src="http://markdotto.github.com/github-buttons/github-btn.html?'.$vars.'" allowtransparency="true" frameborder="0" scrolling="0" width="';
        echo ($type=='follow')?150:70;
        echo 'px" height="20px"></iframe>';
    }
    
}

