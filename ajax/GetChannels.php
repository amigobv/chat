<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 19.08.2015
 * Time: 21:30
 */

echo json_encode($_POST['user']);

/*
if (isset($_POST['user']) && $_post['user']) {
    $user = $_POST['user'];

    if (!getUserByUsername($user)) {
        echo json_encode($user);
    } else {
        echo json_encode($user);
    }
}*/