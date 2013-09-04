<?php if ( ! defined('EXT')) exit('Invalid file request');

/**
 * Low Freeform Field Fieldtype
 *
 * @package		low-freeform-field
 * @version		1.0.1
 * @author		Lodewijk Schutte ~ Low <low@loweblog.com>
 * @copyright	Copyright (c) 2010, Low
 */
class Low_freeform_field extends Fieldframe_Fieldtype {

	/**
	 * Basic fieldtype info
	 *
	 * @var	array
	 */
	var $info = array(
		'name'      => 'Low Freeform Field',
		'version'   => '1.0.1',
		'desc'      => 'Shows a single drop down field with all available Freeform Fields',
		'docs_url'  => '',
		'no_lang'   => TRUE
	);

	// --------------------------------------------------------------------

	/**
	 * Displays the field in publish form
	 *
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function display_field($field_name, $field_data)
	{
		global $DSP, $DB;

		// Get fields from DB
		$query = $DB->query("SELECT name, label FROM exp_freeform_fields ORDER BY field_order ASC");

		// Generate drop down
		$out = $DSP->input_select_header($field_name);
		foreach ($query->result AS $row)
		{
			$out .= $DSP->input_select_option($row['name'], $row['label'], ($row['name'] == $field_data));
		}
		$out .= $DSP->input_select_footer();

		return $out;
	}

	// --------------------------------------------------------------------

	/**
	 * Displays the field in matrix
	 *
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function display_cell($cell_name, $cell_data)
	{
		return $this->display_field($cell_name, $cell_data);
	}

	// --------------------------------------------------------------------

	/**
	 * Displays the field in Low Variables
	 *
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function display_var_field($var_name, $var_data, $var_settings)
	{
		return $this->display_field($var_name, $var_data);
	}

	// --------------------------------------------------------------------

}

// End of file ft.low_freeform_field.php