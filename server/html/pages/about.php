<?php

function getRealIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}

$services = [];

foreach ($GLOBALS['config']['services'] as $elem)
	array_push($services, $elem['brief']);

$data = [
	"client" => ["host" => getRealIpAddr()],
	"server" => ["current_time" => time(), "services" => $services]
];

echo json_encode($data, JSON_PRETTY_PRINT);