<?php

class Retail extends Eloquent 
{

	/**
	 * Set Connection String For Model
	 * @var string
	 */
	public static $connection = 'sisters';
	/**
	 * Set the Table Name for the Database
	 * @var string
	 * @access public
	 */
	public static $table = 'oc_retail';
	
	/**
	 * Set the Timestamps Default values (Disabled)
	 * @var boolean
	 * @access public
	 */
	public static $timestamps = false;
}