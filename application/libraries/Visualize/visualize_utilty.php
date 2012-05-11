<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Jquery-Visualize-Codeigniter-Library
 *
 * @package     Jquery-Visualize-Codeigniter-Library
 * @author   Justin Halwa  Copyright (c) 2012 ,    
 * @link      
This is free and unencumbered software released into the public domain.

Anyone is free to copy, modify, publish, use, compile, sell, or
distribute this software, either in source code form or as a compiled
binary, for any purpose, commercial or non-commercial, and by any
means.

In jurisdictions that recognize copyright laws, the author or authors
of this software dedicate any and all copyright interest in the
software to the public domain. We make this dedication for the benefit
of the public at large and to the detriment of our heirs and
successors. We intend this dedication to be an overt act of
relinquishment in perpetuity of all present and future rights to this
software under copyright law.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

For more information, please refer to <http://unlicense.org/>
 *
 * @since      Version 0.1
 * @filesource
 */

// ------------------------------------------------------------------------


/**
 * Visualize_Utility
 *
 * @package Visualize
 * @subpackage Controller
 * @since 1.0
 * @author  **/
abstract class Vis_Util {

  /**
   * undocumented function
   *
   * @return void
   * @author    **/
  function headerInsert()
  {
    $tg1 = '<script type="text/javascript" src="';
    $tg2 = '"></script>';
    $hd[]  = 'http://filamentgroup.github.com/EnhanceJS/enhance.js';
    $hd1[] = link_tag('css/visualize/visualize.css');
    $hd1[] = link_tag('css/visualize/visualize-dark.css');
    $hd[] = base_url() . 'js/visualize/visualize.jQuery.js';
    //$hd[] = base_url() . 'js/visualize/example.js';

    $out = '';
    foreach ($hd as $scrpt) {
      $out .= $tg1 . $scrpt . $tg2;
    }
    foreach ($hd1 as $css) {
      $out .=  $css;
    }
    
    return $out;
  }

  function defaultVisualize($element)
  {
    $out = "$('" . $element . "').visualize({type: 'bar', width: '420px'});";
    return $out;
  }
}

// End File Visualize_Utility .php
