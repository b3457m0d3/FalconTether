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
 * Example
 *
 * @package  Jquery-Visualization
 * @subpackage Controller
 * @since 1.0
 * @author  Justin Halwa jjhalwa@gmail.com**/
class Example  extends CI_Controller {


  var $data = array();
  public function __construct()
  {
    parent::__construct();
    $this->load->library('javascript');
    $this->load->library('visualize');
    $this->visualize->_init();
    $elem = 'table';
    $type = 'bar';
    $cfg = array('width' => '420px');
    $this->visualize->render($elem, $type, $cfg);
    $this->jquery->script();
    $this->jquery->_compile();
    $this->data['pageTitle'] = "Defualt Visualize View";
    $this->data['headerInsert'] = $this->visualize->visData['header'];
    
  }
  /**
   * undocumented function
   *
   * @return void
   * @author    **/
  function Index()
  {
    $this->load->view('visualize_index.php', $this->data);
  }

}
// End File classname .php
