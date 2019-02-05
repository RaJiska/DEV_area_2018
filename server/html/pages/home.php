<?php
require_once 'classes/Database.php';

echo "Hello World";
echo "lul";
$db = new Database();
if (!($db->query("INSERT INTO services (name) VALUES ('lel');")))
    echo "ERR";
echo "lel";