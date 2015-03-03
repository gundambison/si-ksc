<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Unknown
 * @copyright	Copyright (c) 2008 - 2012, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.7
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter MyLanguage Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/wiki/Language_Library_Extension/
 */

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */	
if (  ! function_exists('line_with_param'))
{

	function line_with_param($line, $params)
    {
		$CI =& get_instance();
		
		$line = $CI->lang->line($line);
		 
        if($line !== false)
        {
            if(is_array($params))$line = vsprintf ($line, $params);
            else $line = sprintf ($line, $params);
        }
        return $line;
		 
    }
}

if (  ! function_exists('show'))
{	
	function show($key,$params=array())
	{		
		return line_with_param($key,$params);	
	}
	
}