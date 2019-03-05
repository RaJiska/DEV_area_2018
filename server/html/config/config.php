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
			'new_comment' => [
				"description" => "Awaits a new comment on a given gallery",
				"arguments" => [
					"Gallery ID" => "(string) The ID of the gallery",
					"Date" => "(int) The date at which new comments will trigger the action"
				]
			],
			'score_above_or_eq' => [
				"description" => "Awaits for the image / gallery to have a score above or equal to the one provided in parameters",
				"arguments" => [
					"Gallery ID" => "(string) The ID of the gallery",
					"Score" => "(int) Score"
				]
			],
			'score_below' => [
				"description" => "Awaits for the image / gallery to have a score below to the one provided in parameters",
				"arguments" => [
					"Gallery ID" => "(string) The ID of the gallery",
					"Score" => "(int) Score"
				]
			]
		],
		'twitter' => [
			'new_tweet',
			'new_follower',
			'new_follower_request'
		],
		'github' => [
			'new_commit' => [
				"description" => "Awaits for a new commit to happen on a given repository",
				"arguments" => [
					"Owner" => "(string) The user owning the repository",
					"Repository" => "(string) The repository name",
					"Date" => "(int) The date at which new commits will trigger the action"
				]
			]
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
			'follow_tag' => [
				"description" => "Follows a given tag",
				"arguments" => [
					"Tag" => "(string) The tag to follow"
				]
			],
			'unfollow_tag' => [
				"description" => "Unfollow a given tag",
				"arguments" => [
					"Tag" => "The tag to unfollow"
				]
			],
			'comment' => [
				"description" => "Post a comment on a given gallery",
				"arguments" => [
					"Gallery ID" => "(string) The Gallery ID to post the comment on",
					"Text" => "(string) The text of the comment to post"
				]
			],
			'uncomment' => [
				"description" => "Remove one of your own comment",
				"arguments" => [
					"Comment ID" => "(int) The comment ID you wish to remove"
				]
			],
			'favorite_album' => [
				"description" => "Add an album to the favorites",
				"arguments" => [
					"Album ID" => "(string) The ID if the album"
				]
			],
			'upload_image' => [
				"description" => "Upload an image / gallery",
				"arguments" => [
					"Image" => "(string) A base64 encoded image"
				]
			],
			'delete_image' => [
				"description" => "Delete an image",
				"arguments" => [
					"Image ID" => "(string) The ID of the image to be deleted"
				]
			]
		],
		'twitter' => [
			'tweet'
		],
		'github' => [
			'star_repo' => [
				"description" => "Stars a repository",
				"arguments" => [
					"Owner" => "(string) The user owning the repository",
					"Repository" => "(string) The repository name",
				]
			],
			'unstar_repo' => [
				"description" => "Unstar a repository",
				"arguments" => [
					"Owner" => "(string) The user owning the repository",
					"Repository" => "(string) The repository name"
				]
			]
		],
		'openweathermap' => [

		],
		'trello' => [
			'create_board' => [
				"description" => "Create a trello board",
				"arguments" => [
					"Board Name" => "(string) The name of the board to be created"
				]
			]
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