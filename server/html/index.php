<?php
require_once 'config/config.php';
require_once 'classes/PageManager.php';

$PageManager = new PageManager();
$PageManager->retrieve((isset($_GET['page']) ? $_GET['page'] : null));