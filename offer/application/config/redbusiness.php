<?php 

return array(
	'lead_columns' => array('title', 'firstname', 'lastname', 'email', 'telephone', 'address1', 'city', 'postcode','lead_generator', 'campaign', 'date_added', 'ip'),
	'lead_rules' => array(
		'title'          => 'required|in:mr,Mr,Miss,miss,Mrs,mrs',	
		'firstname'      => 'required|alpha',
		'lastname'       => 'required|alpha',
		'email'          => 'email',
		'telephone'      => 'required|numeric|phone:%s',
		'address1'       => '',
		'postcode'       => 'postcode:%s',
		'lead_generator' => 'required',
		'campaign'       => 'required',
		),
	'form_fields' => array(),
	'form_rules'  => array()
	);
?>