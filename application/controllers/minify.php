<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Minify
 *
 * A minification driver system for CodeIgniter
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * @package     ci-minify
 * @author      Eric Barnes
 * @copyright   Copyright (c) Eric Barnes. (http://ericlbarnes.com/)
 * @license     http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link        http://ericlbarnes.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Example Controller
 *
 * @subpackage	Controllers
 */
class Minify extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->driver('minify');
	}

	function index()
	{
		$file = APPPATH.'/assets/js/application.js';
		echo $this->minify->js->min($file);
	}

	public function combine($dir)
	{
		echo $this->minify->combine_directory($dir);
	}
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */
