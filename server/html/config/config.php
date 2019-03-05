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
			"new_comment",
			"score_above_or_eq",
			"score_below"
		],
		'twitter' => [

		]
	],
	'actions_function' => [
		'facebook' => [

		],
		'imgur' => [
			"reqAction_newComment",
			"reqAction_scoreAboveOrEq",
			"reqAction_scoreBelow"
		],
		'twitter' => [

		]
	]
];

$config['reactions'] = [
	'reactions_name' => [
		'facebook' => [

		],
		'imgur' => [
			'follow_tag',
			'unfollow_tag',
			'comment',
			'uncomment',
			'favorite_album',
			'upload_image',
			'delete_image'
		],
		'twitter' => [

		]
	],
	'reactions_function' => [
		'facebook' => [

		],
		'imgur' => [
			'reqReaction_followTag',
			'reqReaction_unfollowTag',
			'reqReaction_comment',
			'reqReaction_uncomment',
			'reqReaction_favoriteAlbum',
			'reqReaction_uploadImage',
			'reqReaction_deleteImage'
		],
		'twitter' => [

		]
	]
];

/* Services */
$config['services'] = [
	'facebook' => [
		'brief' => [
			'name' => 'facebook',
			'actions' => $config['actions']['actions_name']['facebook'],
			'reactions' => $config['reactions']['reactions_name']['facebook']
		],
		'keyid' => '648470835603551',
		'keysecret' => ''
	],
	'imgur' => [
		'brief' => [
			'name' => 'imgur',
			'actions' => $config['actions']['actions_name']['imgur'],
			'reactions' => $config['reactions']['reactions_name']['imgur']
		],
		'keyid' => '21cc07288d6ea72',
		'keysecret' => 'df09325752c0352f8395ca6f361e795b1da84423'
	],
	'twitter' => [
		'brief' => [
			'name' => 'twitter',
			'actions' => $config['actions']['actions_name']['twitter'],
			'reactions' => $config['reactions']['reactions_name']['twitter']
		],
		'keyid' => 'oGBlfZ2W73pTm8kV4SgVDIu3w',
		'keysecret' => 'insert here'
	]
];

$config['api'] = [
	'facebook' => 'FacebookAPI',
	'imgur' => 'ImgurAPI',
	'twitter' => 'TwitterAPI'
];

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));