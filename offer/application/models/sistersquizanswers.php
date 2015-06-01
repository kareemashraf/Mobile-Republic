<?php

class Sistersquizanswers extends Eloquent 
{
	public static $connection = 'sisters';

	public static $table = 'quizusers';

	public static function columns()
	{
		return array('is_reader', 'looking_for', 'has_account', 'email', 'country');
	}
}