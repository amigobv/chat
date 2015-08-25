<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 25.08.2015
 * Time: 21:42
 */
require_once("/inc/bootstrap.php");

$action = isset($_REQUEST['action']) && $_REQUEST['action'] ? $_REQUEST['action'] : null;

if ($action) {
    Controller::getInstance()->invokePostAction();
}