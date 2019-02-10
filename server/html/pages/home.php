<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';

echo "Hello World";

//$db = new Database();
$a = new User();
$a->id = 5;
echo $a->id;
// if (!($db->query("INSERT INTO services (name) VALUES ('lel');")))
//     echo "ERR";
// echo "lel";