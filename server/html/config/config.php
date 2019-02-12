<?php
/* Website Name */
$config['website'] = "AREA";

/* SQL Database */
$config['database']['host'] = 'localhost';
$config['database']['name'] = 'area';
$config['database']['user'] = 'area';
$config['database']['pass'] = 'hello';

/* Services */
$config['services'] = [
	'facebook' => [
		'brief' => [
			'name' => 'facebook',
			'actions' => [],
			'reactions' => []
		],
		'keyid' => '648470835603551',
		'keysecret' => '0e6871780cfc0b82657952d2fb0ec7f3'
	],
	'imgur' => [
		'brief' => [
			'name' => 'imgur',
			'actions' => [],
			'reactions' => []
		],
		'keyid' => '',
		'keysecret' => ''
	]
];

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));