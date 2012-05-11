<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------------
| Base Class Configuration
|------------------------------------------------------------------------------
| 
|
*/
$config['javascript']['minify']		                = TRUE;
$config['javascript']['namespace']       		= "window.";
$config['javascript']['generate_files']		        = FALSE;
$config['javascript']['root_url']                       = $this->config->base_url()."/assets/js/";
$config['javascript']['root_dir']		        = get_include_path()."assets/js/";		// path on the filesystem where to store the js files

/*
|------------------------------------------------------------------------------
| JQuery Plugins & Scripts
|------------------------------------------------------------------------------
*/
$config['javascript']['scripts'] = array();
$config['javascript']['scripts']['jquery'] = array(
    "files" => array(
        'https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js'
    )
);
$config['javascript']['scripts']['jquery_ui'] = array(
    "files" => array(
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js',
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css'    
    )
);
$config['javascript']['scripts']['backbone'] = array(
    "files" => array('backbone.31337','underscore','underscore.string','json2'),
);
//==========ui components=======================================================
$config['javascript']['scripts']['ui_accordian'] = array(
    "options" => array(
        "disabled" => false,
        "active" =>  '',
        "animated" => 'slide',
        "autoHeight" => true,
        "clearStyle" => false,
        "collapsible" =>  false,
        "event" => 'click',
        "fillSpace" => false,
        "header" => '> li > :first-child,> :not(li):even',
        "icons" => "{ 'header': 'ui-icon-triangle-1-e', 'headerSelected': 'ui-icon-triangle-1-s' }",
        "navigation" => false,
        "navigationFilter" => ''
    )
);
$config['javascript']['scripts']['ui_autocomplete'] = array(
    "options" => array(
        "disabled" => false,
        "appendTo" => "body",
        "autoFocus" => false,
        "delay" => 300,
        "minLength" => 1,
        "position" => { my: "left top", at: "left bottom", collision: "none" },
        "source" => ''
    )
);
$config['javascript']['scripts']['ui_button'] = array(
    "options" => array(
        "disabled" => false,
        "text" => true,
        "icons" => { primary: null, secondary: null },
        "label" => ''
    )
);
$config['javascript']['scripts']['ui_datepicker'] = array(
    "options" => array(
        "disabled" => false,
        "altField" => '',
        "altFormat" => '',
        "appendText" =>  '',
        "autoSize" => false,
        "buttonImage" => '',
        "buttonImageOnly" => false,
        "buttonText" => '...',
        "calculateWeek" => $.datepicker.iso8601Week,
        "changeMonth" => false,
        "changeYear" =>  false,
        "closeText" => 'Done',
        "constrainInput" => true,
        "currentText" => 'Today',
        "dateFormat" => 'mm/dd/yy',
        "dayNames" => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        "dayNamesMin" => ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        "dayNamesShort" => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        "defaultDate" => null,
        "duration" => 'normal',
        "firstDay" => 0,
        "gotoCurrent" => false,
        "hideIfNoPrevNext" => false,
        "isRTL" => false,
        "maxDate" => null,
        "minDate" => null,
        "monthNames" => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        "monthNamesShort" => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        "navigationAsDateFormat" => false,
        "nextText" => 'Next',
        "numberOfMonths" => 1,
        "prevText" => 'Prev',
        "selectOtherMonths" => false,
        "shortYearCutoff" => '+10',
        "showAnim" => 'show',
        "showButtonPanel" => false,
        "showCurrentAtPos" => 0,
        "showMonthAfterYear" => false,
        "showOn" => 'focus',
        "showOptions" => {},
        "showOtherMonths" => false,
        "showWeek" => false,
        "stepMonths" => 1,
        "weekHeader" => 'Wk',
        "yearRange" => 'c-10:c+10',
        "yearSuffix" => ''
    )
);
$config['javascript']['scripts']['ui_dialog'] = array(
    "options" => array(
        "disabled" => false,
        "autoOpen" => true,
        "buttons" => "{ } || [ ]",
        "closeOnEscape" => true,
        "closeText" => 'close',
        "dialogClass" => '',
        "draggable" => true,
        "height" => 'auto',
        "hide" => null,
        "maxHeight" => false,
        "maxWidth" => false,
        "minHeight" => 150,
        "minWidth" => 150,
        "modal" => false,
        "position" => 'center',
        "resizable" => true,
        "show" => null,
        "stack" => true,
        "title" => '',
        "width" => 300,
        "zIndex" => 1000
    )
);
$config['javascript']['scripts']['ui_draggable'] = array(
    "options" => array(
        "disabled"=>false,
        "addClasses"=>true,
        "appendTo"=>'parent',
        "axis"=>false,
        "cancel"=>'input || option',
        "connectToSortable"=>false,
        "containment"=>false,
        "cursor"=>'auto',
        "cursorAt"=>false,
        "delay"=>0,
        "distance"=>1,
        "grid"=>false,
        "handle"=>false,
        "helper"=>'original',
        "iframeFix"=>false,
        "opacity"=>false,
        "refreshPositions"=>false,
        "revert"=>false,
        "revertDuration"=>500,
        "scope"=>'default',
        "scroll"=>true,
        "scrollSensitivity"=>20,
        "scrollSpeed"=>20,
        "snap"=>false,
        "snapMode"=>'both',
        "snapTolerance"=>20,
        "stack"=>false,
        "zIndex"=>false
    )
);
$config['javascript']['scripts']['ui_droppable'] = array(
    "options" => array(
        "disabled" => false,
        "accept" => '*',
        "activeClass" => false,
        "addClasses" => true,
        "greedy" => false,
        "hoverClass" => false,
        "scope" => 'default',
        "tolerance" =>'intersect'
    )
);
$config['javascript']['scripts']['ui_position'] = array(
    "options" => array()
);
$config['javascript']['scripts']['ui_progressBar'] = array(
    "options" => array(
        "disabled" => false,
        "value" => 0
    )
);
$config['javascript']['scripts']['ui_resizable'] = array(
    "options" => array(
        "disabled" => false,
        "alsoResize" => false,
        "animate" => false,
        "animateDuration" => 'slow',
        "animateEasing" => 'swing',
        "aspectRatio" => false,
        "autoHide" => false,
        "cancel" => ':input,option',
        "containment" => false,
        "delay" => 0,
        "distance" => 1,
        "ghost" => false,
        "grid" => false,
        "handles" => 'e, s, se',
        "helper" => false,
        "maxHeight" => null,
        "maxWidth" => null,
        "minHeight" => 10,
        "minWidth" => 10
 
    )
);
$config['javascript']['scripts']['ui_selectable'] = array(
    "options" => array(
        "disabled" => false,
        "autoRefresh" => true,
        "cancel" => ':input,option',
        "delay" => 0,
        "distance" => 0,
        "filter" => '*',
        "tolerance" => 'touch'
    )
);
$config['javascript']['scripts']['ui_slider'] = array(
    "options" => array(
        "disabled" => false,
        "animate" => false,
        "max" => 100,
        "min" => 0,
        "orientation" => 'horizontal',
        "range" => false,
        "step" => 1,
        "value" => 0,
        "values" => null
    )
);
$config['javascript']['scripts']['ui_sortable'] = array(
    "options" => array(
        "disabled" => false,
        "appendTo" => 'parent',
        "axis" => false,
        "cancel" => ':input,button'
        "connectWith" => false,
        "containment" =>  false,
        "cursor" =>  'auto',
        "cursorAt" => false,
        "delay" =>  0,
        "distance" => 1,
        "dropOnEmpty" => true,
        "forceHelperSize" => false,
        "forcePlaceholderSize" =>  false,
        "grid" => false,
        "handle" => false,
        "helper" => 'original',
        "items" => '> *',
        "opacity" => false,
        "placeholder" =>  false,
        "revert" =>  false,
        "scroll" => true,
        "scrollSensitivity" => 20,
        "scrollSpeed" => 20,
        "tolerance" => 'intersect',
        "zIndex" =>  1000
    )
);
$config['javascript']['scripts']['ui_spinner'] = array(
    "files" => array(),
    "options" => array(
        "min" => null,
        "max" => null,
        "allowNull" => false,
        "group" => '',
        "point" => '.',
        "prefix" => '',
        "suffix" => '',
        "places" => null, // null causes it to detect the number of places in step
        "defaultStep" => 1, // real value is 'step', This value is used to detect if passed value should override HTML5 attribute
        "largeStep" => 10,
        "mouseWheel" => true,
        "increment" => 'slow',		
        "className" => null,
        "showOn" => 'always',
        "width" => 16,
        "upIconClass" => "ui-icon-triangle-1-n",
        "downIconClass" => "ui-icon-triangle-1-s"
    )
);
$config['javascript']['scripts']['ui_swappable'] = array(
    "files" => array(),
    "options" => array(
        "disabled" => false,
        "appendTo" => 'parent',
        "axis" => false,
        "cancel" => ':input,button'
        "connectWith" => false,
        "containment" =>  false,
        "cursor" =>  'auto',
        "cursorAt" => {top: -1},
        "delay" =>  0,
        "distance" => 1,
        "dropOnEmpty" => true,
        "forceHelperSize" => false,
        "forcePlaceholderSize" =>  false,
        "grid" => false,
        "handle" => false,
        "helper" => 'original',
        "items" => '.swappable_item',
        "opacity" => false,
        "placeholder" =>  false,
        "revert" =>  false,
        "scroll" => true,
        "scrollSensitivity" => 20,
        "scrollSpeed" => 20,
        "tolerance" => 'intersect',
        "zIndex" =>  1000
    )
);
$config['javascript']['scripts']['ui_tabs'] = array(
    "options" => array(
        "disabled" => false,
        "ajaxOptions" => null,
        "cache" => false,
        "collapsible" => false,
        "cookie" => null,
        "deselectable" => false,
        "disabled" => [],
        "event" => 'click',
        "fx" => null,
        "idPrefix" => 'ui-tabs-',
        "panelTemplate" => '<div></div>',
        "selected" => 0,
        "spinner" => '<em>Loading&#8230;</em>',
        "tabTemplate" => '<li><a href="#{href}"><span>#{label}</span></a></li>'
    )
);

//===========navigation=========================================================
$config['javascript']['scripts']['jbar'] = array(
    "files"   => array('jquery.jbar','jbar.css')
);

//===========input==============================================================
$config['javascript']['scripts']['hotkeys'] = array(
    "files"   => array('hotkeys'),
    "options" => array()
);
$config['javascript']['scripts']['field'] = array(
    "files"   => array ('field'),
    "options" => array()
);
$config['javascript']['scripts']['calculate'] = array(
    "dom"     =>".hotkeys",
    "files"   => array ('hotkeys.js'),
    "options" => array()
);
$config['javascript']['scripts']['mask'] = array(
    "dom"   => ".mask",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['time'] = array(
    "dom"   => ".time",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['colorPicker'] = array(
    "dom"   => ".colorPicker",
    "files"   => array(),
    "options" => array()
);
//==========sliders=============================================================
$config['javascript']['scripts']['piecemaker'] = array(
    "dom"   => "#piecemaker",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['cub3r'] = array(
    "dom"   => "#cub3r",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['roundabout'] = array(
    "dom"     =>"#roundabout",
    "files"   => array (
        'roundabout.js',
        'roundabout_shapes.js'
    ),
    "options" => array()
);
$config['javascript']['scripts']['slideDeck'] = array(
    "dom"     => "#slideDeck",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['pageslide'] = array(
    "dom"     =>"#pageSlide",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['nivo'] = array(
    "dom"     =>"#nivo",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['parallax'] = array(
    "dom"     =>"#parallax",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['dualSlider'] = array(
    "dom"     =>"#dualSlider",
    "files"   => array(),
    "options" => array()
);

//=========ui effects
$config['javascript']['scripts']['grumble'] = array(
    "dom"     =>".grumble",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['growl'] = array(
    "dom"     =>".growl",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['zoom'] = array(
    "dom"     =>".zoom",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['flightboard'] = array(
    "dom"     =>".flightboard",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['flip'] = array(
    "dom"     =>".flip",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['slideTo'] = array(
    "dom"     =>".slideTo",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['fancybox'] = array(
    "dom"     =>"",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['shuffleLetters'] = array(
    "dom"     =>"",
    "files"   => array(),
    "options" => array()
);
$config['javascript']['scripts']['scrollFollow'] = array(
    "dom"     =>"",
    "files"   => array(),
    "options" => array()
);
//=========third party apps=====================================================
$config['javascript']['apps']['ckeditor'] = array(
    "dom" => "",
    "files" => array(''),
    "options" => array('')
);
$config['javascript']['apps']['editarea'] = array(
    "dom" => "",
    "files" => array(''),
    "options" => array('')
);
$config['javascript']['apps']['mindmaps'] = array(
    "dom" => "",
    "files" => array(''),
    "options" => array('')
);
$config['javascript']['apps']['svgedit'] = array(
    "dom" => "",
    "files" => array(''),
    "options" => array('')
);
/*
|------------------------------------------------------------------------------
| Auto Sense Settings
|------------------------------------------------------------------------------

    *really lazy loading
    *   this list is matched against the html, and plugins are loaded based on the presence of
    *   id and class attributes

*/


/*
|------------------------------------------------------------------------------
| Autoload libraries
|------------------------------------------------------------------------------
| 
| You can load some libraries every time you load the Jquery Class.
| Just add the name in the autoload array, the plugin must be configured properly
| in $config['javascript']['libraries']
|
*/
$config['javascript']['LABjs'] = $config['javascript']['root_dir']."ext/lab.js";
$config['javascript']['autoload'] = array();

/*
|------------------------------------------------------------------------------
| Jquery Functions Dictionary
|------------------------------------------------------------------------------
| 
| Here you can add some functions with the %s where you want the code to be inserted
| Useful to have multiple insertion using the add_script function
|
*/

$config['javascript']['functions'] = array(
    "main"        => "%s",
    "document_ready" => "$(function (){ %s });"
);
