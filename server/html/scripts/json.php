<?php

function jsonError($msg)
{
	return json_encode(["status" => "ko", "msg" => $msg], JSON_PRETTY_PRINT);
}

function jsonMsg($field = null, $data = null)
{
	if ($field !== null)
		return json_encode(["status" => "ok", "msg" => "Data properly served", $field => $data ], JSON_PRETTY_PRINT);
	else
		return json_encode(["status" => "ok", "msg" => "Data properly served"], JSON_PRETTY_PRINT);
}