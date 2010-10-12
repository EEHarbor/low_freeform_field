<?php if ( ! defined('EXT')) exit('Invalid file request');

// Get config file
require(PATH_THIRD.'low_freeform_field/config.php');


/**
* Low Freeform Field Fieldtype
*
* @package		low-freeform-field
* @version		1.0.1
* @author		Lodewijk Schutte ~ Low <low@loweblog.com>
* @copyright	Copyright (c) 2010, Low
*/
class Low_freeform_field_ft extends EE_Fieldtype {

	/**
	* Info array
	*
	* @var	array
	*/
	var $info = array(
		'name'		=> LOW_FFF_NAME,
		'version'	=> LOW_FFF_VERSION
	);

	// --------------------------------------------------------------------

	/**
	* PHP4 Constructor
	*
	* @see	__construct()
	*/
	function Low_freeform_field_ft()
	{
		$this->__construct();
	}

	// --------------------------------------------------------------------

	/**
	* PHP5 Constructor
	*
	* @return	void
	*/
	function __construct()
	{
		parent::EE_Fieldtype();
	}

	// --------------------------------------------------------------------

	/**
	* Displays the field in publish form
	*
	* @param	string
	* @param	bool
	* @return	string
	*/
	function display_field($data, $cell = FALSE)
	{
		// Load helper
		$this->EE->load->helper('form');

		// Get fields from DB
		$query = $this->EE->db->query("SELECT name, label FROM exp_freeform_fields ORDER BY field_order ASC");

		// Generate drop down
		$options = array('' => '--');
		foreach ($query->result_array() AS $row)
		{
			$options[$row['name']] = $row['label'];
		}

		// Field name depending on Matrix cell or not
		$field_name = $cell ? $this->cell_name : $this->field_name;

		return form_dropdown($field_name, $options, $data);
	}

	// --------------------------------------------------------------------

	/**
	* Displays the field in matrix
	*
	* @param	string
	* @return	string
	*/
	function display_cell($cell_data)
	{	
		return $this->display_field($cell_data, TRUE);
	}

	// --------------------------------------------------------------------
	
	/**
	* Displays the field in Low Variables
	*
	* @param	string
	* @return	string
	*/
	function display_var_field($var_data)
	{
		return $this->display_field($var_data);
	}

	// --------------------------------------------------------------------

}

// End of file ft.low_freeform_field_ft.php