<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter HTML5 Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author 		Phillip Jackson
 */

// ------------------------------------------------------------------------

/**
 * Text Date Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_date'))
{
	function form_date($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'date', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

/**
 * File Upload Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_file'))
{
	function form_file($data = '', $value = '', $extra = '')
	{
		$defaults = array('type' => 'file', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}