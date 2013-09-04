<?php if ( ! defined('EXT')) exit('Invalid file request');

// Get config file
require(PATH_THIRD.'low_freeform_field/config.php');


/**
 * Low Freeform Field Fieldtype
 *
 * @package        low_freeform_field
 * @author         Lodewijk Schutte ~ Low <hi@gotolow.com>
 * @copyright      Copyright (c) 2010-2013, Low
 */
class Low_freeform_field_ft extends EE_Fieldtype {

	/**
	 * Info array
	 *
	 * @var	array
	 */
	public $info = array(
		'name'         => LOW_FFF_NAME,
		'version'      => LOW_FFF_VERSION,
		'var_requires' => array('freeform' => '3.0.0')
	);

	// --------------------------------------------------------------------

	/**
	 * Displays the field
	 *
	 * @access     private
	 * @param      string
	 * @param      bool
	 * @return     string
	 */
	private function _display_field($data, $cell = FALSE)
	{
		static $rows;

		// Get the rows from the DB
		if (is_null($rows))
		{
			// Init rows
			$rows = array('' => '--');

			// Do query
			$query = $this->EE->db->select($this->_get_attrs())
				->from('freeform_fields')
				->order_by('field_order')
				->get();

			foreach ($query->result() AS $row)
			{
				$rows[$row->name] = $row->label;
			}
		}

		// Field name depending on Matrix cell or not
		$field_name = $cell ? $this->cell_name : $this->field_name;

		// Load helper
		$this->EE->load->helper('form');

		return form_dropdown($field_name, $rows, $data);
	}

	// --------------------------------------------------------------------

	private function _get_attrs()
	{
		static $fields;

		if ( ! $fields)
		{
			$this->EE->load->library('addons');
			$modules = $this->EE->addons->get_installed('modules');
			$version = $modules['freeform']['module_version'];

			$fields = (version_compare($version, '4.0.0', '>='))
				? array('`field_name` as `name`', '`field_label` as `label')
				: array('name', 'label');
		}

		return $fields;
	}

	// --------------------------------------------------------------------

	/**
	 * Displays the field in publish form
	 *
	 * @access     private
	 * @param      string
	 * @return     string
	 */
	public function display_field($data)
	{
		return $this->_display_field($data, TRUE);
	}

	/**
	 * Displays the field in matrix
	 *
	 * @param	string
	 * @return	string
	 */
	public function display_cell($cell_data)
	{
		return $this->_display_field($cell_data, TRUE);
	}

	/**
	 * Displays the field in Low Variables
	 *
	 * @param	string
	 * @return	string
	 */
	public function display_var_field($var_data)
	{
		return $this->_display_field($var_data);
	}

	// --------------------------------------------------------------------

}

// End of file ft.low_freeform_field_ft.php