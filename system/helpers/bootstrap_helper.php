<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Twitter Bootstrap Helper
 *
 * @package       CodeIgniter
 * @subpackage    Helpers
 * @category      Helpers
 * @author        Jessie James Jackson Taylor

reference:
    $CI =& get_instance();

*/
//
if( !function_exists('icon') ){

    function icon($icon,$white=FALSE){
        $icon = str_replace(' ', '-', $icon);
        echo '<i class="icon-'.$icon.' ';
        if($white) echo 'icon-white';
        echo '"></i>';
    }
    
}
if( !function_exists('tabbable') ){

    function tabbable($tabs,$pos=null,$pref='tab'){
        $html = '<div class="tabbable'.(!is_null($pos))?' tabs-'.$pos:''.'">';
        $_tabs = '<ul class="nav nav-tabs">';
        $_panels = '<div class="tab-content">';
        $count = count($tabs);
        for($i=0;$i<=$count;$i++){
            if($i < 1){
                $_tabs   .= '<li class="active">';
                $_panels .= '<div class="tab-pane active" id="'.$pref.$i.'">';
            } else {
                $_tabs   .= '<li>';
                $_panels .= '<div class="tab-pane" id="'.$pref.$i.'">';
            }
            $_tabs .= '<a href="#'.$pref.$i.'" data-toggle="tab">'.$tabs[$i]['title'].'</a></li>';
            $_panels .= $tabs[$i]['content'];
        }
        $_tabs .= '</ul>';
        $_panels .= '</div></div>';
        switch($pos){
            case null:
            case 'left':
            case 'right':
                $html .= $_tabs;
                $html .= $_panels;
                break;
            case 'below':
                $html .= $_panels;
                $html .= $_tabs;
                break;  
        }
        $html .= '</div>';
        
    }
}
if( !function_exists('pager') ){

    function pager($links, $align = FALSE){

        echo '<ul class="pager">';
        echo '<li '.($align)?'class="previous"':''.'>';
        echo '<a href="'.$links[0][0].'" class="'.$links[0][2].'">'.$links[0][1].'</a></li>';
        echo '<li '.($align)?'class="next"':''.'>';
        echo '<a href="'.$links[1][0].'" class="'.$links[1][2].'">'.$links[1][1].'</a></li>';
        echo '</ul>';
        
    }
    
}
if( !function_exists('placeholder') ){

    function placeholder($size,$alt){
        echo '<div class="thumbnail"><img src="http://placehold.it/'.$size.'" alt="'.$alt.'"></a>';    
    }
    
}
if( !function_exists('progress') ){

    function progress($percent,$styles=array(null,null)){

        echo '<div class="progress'.(!is_null($styles[0]))?' '.$styles[0]:''.'">';
        echo '<div class="bar'.(!is_null($styles[1]))?' '.$styles[1]:''.'" style="width: '.$percent.'%;"></div>';
        echo '</div>';
    
    }
    
}
if( !function_exists('close') ){

    function close($a=TRUE,$modal=FALSE){

        if($a) echo '<a class="close" href="#">&times;</a>';
        else echo '<button class="close"'.($modal)?' data-dismiss="modal"':''.'>&times;</button>';
    
    }

}
if( !function_exists('modal') ){

    function modal($id,$content,$buttons,$fade=TRUE){
        echo '<div class="modal'.($fade)?' fade':''.'" id="'.$id.'">';
        echo '<div class="modal-header">';
        echo '<button class="close" data-dismiss="modal">×</button>';
        echo '<h3>'.$content[0].'</h3>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo $content[1].'</div>';
        echo '<div class="modal-footer">';
        foreach($buttons as $txt=>$)
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
        </div>
        </div>
?>