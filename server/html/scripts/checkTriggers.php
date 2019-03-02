<?php
require_once 'config/config.php';
require_once 'classes/Trigger.php';

try {
	$Database = new Database();
	$res = $Database->execute("SELECT * FROM triggers WHERE enabled = 1;");
	while (($row = $res->fetch())) {
		$Trigger = new Trigger($Database);
		$Trigger->fill($row);
		/* TODO: Action Check & Reaction If Necessary */
	}
	
}
catch (Exception $e) {
	die("Fatal Error: " . $e->getMessage());
}