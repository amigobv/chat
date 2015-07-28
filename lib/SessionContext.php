<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 28.07.2015
 * Time: 14:14
 */
class SessionContext extends BaseObject {
    private static $exists = false;

    public static function create() {
        if (!self::exists) {
            self::$exists = session_start();
        }

        return self::exists;
    }
}
