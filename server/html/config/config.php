<?php
/* Website Name */
$config['website'] = "AREA";

/* SQL Database */
$config['database']['host'] = 'localhost';
$config['database']['name'] = 'area';
$config['database']['user'] = 'area';
$config['database']['pass'] = 'hello';

$config['actions'] = [
	'actions_name' => [
		'facebook' => [

		],
		'imgur' => [
			'account_gallery_favorites'
		]
	],
	'actions_function' => [
		'facebook' => [

		],
		'imgur' => [
			'req_accountGalleryFavorites'
		]
	]
];

/* Services */
$config['services'] = [
	'facebook' => [
		'brief' => [
			'name' => 'facebook',
			'actions' => $config['actions']['actions_name']['facebook'],
			'reactions' => []
		],
		'keyid' => '648470835603551',
		'keysecret' => '0e6871780cfc0b82657952d2fb0ec7f3'
	],
	'imgur' => [
		'brief' => [
			'name' => 'imgur',
			'actions' => $config['actions']['actions_name']['imgur'],
			'reactions' => []
		],
		'keyid' => '21cc07288d6ea72',
		'keysecret' => '59fe535430b90c34ec9e59eaebf2369e3b329a0c'
	]
];

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));