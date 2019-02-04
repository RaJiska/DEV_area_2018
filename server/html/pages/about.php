<?php
$data = [
	"client" => ["host" => $_SERVER['REMOTE_ADDR']],
	"server" => ["current_time" => time(), "services" => []]
];

echo json_encode($data, JSON_PRETTY_PRINT);