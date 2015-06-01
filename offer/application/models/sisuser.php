<?php

class Sisuser extends Eloquent 
{
	public static $connection = 'sisters';
	
	/**
	 * Set the Table Name for the Database
	 * @var string
	 * @access public
	 */
	public static $table = 'oc_customer';
	
	/**
	 * Set the Timestamps Default values (Disabled)
	 * @var boolean
	 * @access public
	 */
	public static $timestamps = false;

	/**
	 * Validation for the Model
	 * @param  array $input 
	 * @return bool  True if valid and vice versa
	 */
	public static function validate_user($input)
	{
		$rules = array('email' => 'required','password' => 'required');

		return Validator::make($input, $rules);
	}

	public static function validate_extra($input)
	{
		$rules = array(
				'firstname' 		=> 'required',
				'lastname' 		=> 'required',
				'business_name' 	=> 'required',
				'address1' 		=> 'required',
				'city' 			=> 'required',
				'county' 		=> 'required',
				'email' 			=> 'required',
				'telephone' 		=> 'required',
				'password' 		=> 'required',
				'sisters_quan' 	=> 'required',
				'discover_quan' 	=> 'required',
			);

		return Validator::make($input, $rules);
	}
}