<?php

class Lead extends Eloquent 
{
	/**
	 * Set the Table Name for the Database
	 * @var string
	 * @access public
	 */
	public static $table = 'lead';

	/**
	 * Set the Timestamps Default values (Disabled)
	 * @var boolean
	 * @access public
	 */
	public static $timestamps = false;

	/**
	 * get Columns of the table
	 * @param string $page_name  landing page name
	 * @return array columns of array
	 */
	public static function columns($page_name, $cols = 'lead_columns')
	{
		return Config::get($page_name . "." . $cols);
	}

	/**
	 * Validation for the Model
	 * @param  array $input 
	 * @param string $page_name  landing page name
	 * @return bool  True if valid and vice versa
	 */
	public static function validate($input, $page_name, $rules = 'lead_rules')
	{
		$rules = json_decode(sprintf(json_encode(Config::get($page_name . "." . $rules)), $input['county'], $input['county']));
		return Validator::make($input, $rules);
	}
}