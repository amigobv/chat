<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 31.07.2015
 * Time: 14:09
 */
if (AuthenticationManager::isAuthenticated()) {
    AuthenticationManager::signOut();
}

Util::redirect("index.php");