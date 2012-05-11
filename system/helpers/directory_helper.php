<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Directory Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/directory_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Create a Directory Map
 *
 * Reads the specified directory and builds an array
 * representation of it.  Sub-folders contained with the
 * directory will be mapped as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	int		depth of directories to traverse (0 = fully recursive, 1 = current dir, etc)
 * @return	array
 */
if ( ! function_exists('directory_map'))
{
	function directory_map($source_dir, $directory_depth = 0, $hidden = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$filedata	= array();
			$new_depth	= $directory_depth - 1;
			$source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

			while (FALSE !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ( ! trim($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
				{
					continue;
				}

				if (($directory_depth < 1 OR $new_depth > 0) && @is_dir($source_dir.$file))
				{
					$filedata[$file] = directory_map($source_dir.$file.DIRECTORY_SEPARATOR, $new_depth, $hidden);
				}
				else
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);
			return $filedata;
		}

		return FALSE;
	}
	function delete_folder($tmp_path){
		if(!is_writeable($tmp_path) && is_dir($tmp_path)){chmod($tmp_path,0777);}
		  $handle = opendir($tmp_path);
		while($tmp=readdir($handle)){
		  if($tmp!='..' && $tmp!='.' && $tmp!=''){
		       if(is_writeable($tmp_path."/".$tmp) && is_file($tmp_path."/".$tmp)){
			       unlink($tmp_path."/".$tmp);
		       }elseif(!is_writeable($tmp_path."/".$tmp) && is_file($tmp_path."/".$tmp)){
			   chmod($tmp_path."/".$tmp,0666);
			   unlink($tmp_path."/".$tmp);
		       }
		      
		       if(is_writeable($tmp_path."/".$tmp) && is_dir($tmp_path."/".$tmp)){
			      delete_folder($tmp_path."/".$tmp);
		       }elseif(!is_writeable($tmp_path."/".$tmp) && is_dir($tmp_path."/".$tmp)){
			      chmod($tmp_path."/".$tmp,0777);
			      delete_folder($tmp_path."/".$tmp);
		       }
		  }
		}
		closedir($handle);
		rmdir($tmp_path);
		if(!is_dir($tmp_path)){return true;}
		else{return false;}
	      }
}


/* End of file directory_helper.php */
/* Location: ./system/helpers/directory_helper.php */