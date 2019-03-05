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
			'new_comment',
			'score_above_or_eq',
			'score_below'
		],
		'twitter' => [
			'new_tweet',
			'new_follower',
			'new_follower_request'
		],
		'github' => [
			'new_commit'
		],
		'openweathermap' => [
			'rain_in_city'
		],
		'trello' => [

		],
		'yammer' => [

		]
	],
	'actions_function' => [
		'facebook' => [

		],
		'imgur' => [
			'reqAction_newComment',
			'reqAction_scoreAboveOrEq',
			'reqAction_scoreBelow'
		],
		'twitter' => [
			'reqAction_newTweet',
			'reqAction_newFollower',
			'reqAction_newFollowerRequest'
		],
		'github' => [
			'reqAction_newCommit'
		],
		'openweathermap' => [
			'reqAction_rainInCity'
		],
		'trello' => [

		],
		'yammer' => [

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
			'tweet'
		],
		'github' => [
			'star_repo',
			'unstar_repo',
		],
		'openweathermap' => [

		],
		'trello' => [
			'create_board'
		],
		'yammer' => [

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
			'reqReaction_tweet'
		],
		'github' => [
			'reqReaction_starRepo',
			'reqReaction_unstarRepo',
		],
		'openweathermap' => [

		],
		'trello' => [
			'reqReaction_createBoard'
		],
		'yammer' => [

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
	],
	'openweathermap' => [
		'brief' => [
			'name' => 'openweathermap',
			'actions' => $config['actions']['actions_name']['openweathermap'],
			'reactions' => $config['reactions']['reactions_name']['openweathermap']
		],
		'keyid' => '43acdedfb0a9864db7785dd1c0307d77',
		'keysecret' => ''
	],
	'trello' => [
		'brief' => [
			'name' => 'trello',
			'actions' => $config['actions']['actions_name']['trello'],
			'reactions' => $config['reactions']['reactions_name']['trello']
		],
		'keyid' => '4620371a714f02f39fe4ac4db99bd5b1',
		'keysecret' => ''
	],
	'yammer' => [
		'brief' => [
			'name' => 'yammer',
			'actions' => $config['actions']['actions_name']['yammer'],
			'reactions' => $config['reactions']['reactions_name']['yammer']
		],
		'keyid' => 'QEEGJfAvkXOv6FVUXktQ',
		'keysecret' => 'TVh0R2oFrgclSLXo3DnRFfLckssRaMAJ0S1c3RLHHg'
	]
];

$config['api'] = [
	'facebook' => 'FacebookAPI',
	'imgur' => 'ImgurAPI',
	'twitter' => 'TwitterAPI',
	'github' => 'GithubAPI',
	'openweathermap' => 'OpenWeatherMapAPI',
	'trello' => 'TrelloAPI',
	'yammer' => 'YammerAPI'
];

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));