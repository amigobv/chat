<?php
require_once("/inc/bootstrap.php");

$view = isset($_REQUEST['view']) && $_REQUEST['view'] ? $_REQUEST['view'] : 'welcome';
$action = isset($_REQUEST['action']) && $_REQUEST['action'] ? $_REQUEST['action'] : null;

if ($action) {
    Controller::getInstance()->invokePostAction();
}

$file = '/views/' . $view . '.php';
if (file_exists(__DIR__ . $file)) {
    require($file);
}



