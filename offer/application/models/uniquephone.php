<?php

class Uniquephone extends Eloquent 
{
	/**
	 * Set the Table Name for the Database
	 * @var string
	 * @access public
	 */
	public static $table = 'lead_unique_telephone';

	/**
	 * Set the Timestamps Default values (Disabled)
	 * @var boolean
	 * @access public
	 */
	public static $timestamps = false;
}