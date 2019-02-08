<?php
/* Website Name */
$config['website'] = "AREA";

/* SQL Database */
$config['database']['host'] = 'localhost';
$config['database']['name'] = 'area';
$config['database']['user'] = 'area';
$config['database']['pass'] = 'hello';

/* Services */
$config['services']['facebook']['appid'] = '648470835603551';
$config['services']['facebook']['appsecret'] = '0e6871780cfc0b82657952d2fb0ec7f3';

/* JSON Messages */
$config['json']['error']['invalid_method'] = json_encode(array("status" => "ko", "msg" => "Invalid Method"));