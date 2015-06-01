<?php 

return array(
	'lead_columns' => array('title', 'firstname', 'lastname', 'email', 'telephone', 'address1', 'city', 'postcode','lead_generator', 'campaign', 'date_added', 'ip'),
	'lead_rules' => array(
		'title'          => 'in:mr,Mr,Miss,miss,Mrs,mrs',	
		'firstname'      => 'alpha',
		'lastname'       => 'alpha',
		'email'          => 'required|email',
		'telephone'      => 'numeric|phone:%s',
		'postcode'       => 'postcode:%s',
		'lead_generator' => 'required',
		'campaign'       => 'required',
		),
	'form_fields' => array(),
	'form_rules'  => array()
	);
?>