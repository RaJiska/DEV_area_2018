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

		],
		'github' => [

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

		],
		'github' => [

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

		],
		'github' => [

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

		],
		'github' => [

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
		'keysecret' => ''
	],
	'twitter' => [
		'brief' => [
			'name' => 'twitter',
			'actions' => $config['actions']['actions_name']['twitter'],
			'reactions' => $config['reactions']['reactions_name']['twitter']
		],
		'keyid' => 'oGBlfZ2W73pTm8kV4SgVDIu3w',
		'keysecret' => 'insert here'
	],
	'github' => [
		'brief' => [
			'name' => 'github',
			'actions' => $config['actions']['actions_name']['github'],
			'reactions' => $config['reactions']['reactions_name']['github']
		],
		'keyid' => 'defc017cb0cdfcc7bedf',
		'keysecret' => ''
	]
];

$config['api'] = [
	'facebook' => 'FacebookAPI',
	'imgur' => 'ImgurAPI',
	'twitter' => 'TwitterAPI',
	'github' => 'GithubAPI'
];

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));