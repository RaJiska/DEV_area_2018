<?php
$services = [];

foreach ($GLOBALS['config']['services'] as $elem)
	array_push($services, $elem['brief']);

$data = [
	"client" => ["host" => $_SERVER['REMOTE_ADDR']],
	"server" => ["current_time" => time(), "services" => $services]
];

echo json_encode($data, JSON_PRETTY_PRINT);