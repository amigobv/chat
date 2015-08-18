<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 28.07.2015
 * Time: 14:22
 */
class Controller extends BaseObject {

    const REQUEST_METHOD = 'POST';
    const ACTION_PARAM = 'action';

    const PAGE = 'page';

    const ACTION_LOGIN = 'login';
    const ACTION_LOGOUT = 'logout';
    const ACTION_REGISTRATION = 'registrate';

    const USR_NAME = 'username';
    const USR_PASSWORD = 'password';

    const POST_MSG = 'postMessage';

    private static $instance = false;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Controller();
        }

        return self::$instance;
    }

    private function __construct() {

    }

    public function invokePostAction() {
        if ($_SERVER['REQUEST_METHOD'] != self::REQUEST_METHOD) {
            throw new Exception("Controller can only handle " . self::REQUEST_METHOD . ' requests');
            return null;
        } else if (!isset($_REQUEST[self::ACTION_PARAM])) {
            throw new Exceptioon(self::ACTION_PARAM . ' parameter is not specified');
        }

        $action = $_REQUEST[self::ACTION_PARAM];

        switch($action) {
            case self::ACTION_LOGIN:
                if (!AuthenticationManager::authenticate($_REQUEST[self::USR_NAME], $_REQUEST[self::USR_PASSWORD])) {
                    $this->forwardRequest(['Invalid user information provided']);
                }

                Util::redirect();
                break;

            case self::ACTION_LOGOUT:
               if (AuthenticationManager::isAuthenticated()) {
                    AuthenticationManager::signOut();
                }

                Util::redirect();
                break;

            case self::ACTION_REGISTRATION:
                //TODO: create new user

                Util::redirect();
                break;

            case self::POST_MSG:

                break;
        }
    }

    public function forwardRequest(array $errors = null, $target = null) {
        if ($target == null) {
            if (!isset($_REQUEST[self::PAGE])) {
                throw new Exception("Missing target to forward");
            }
            $target = $_REQUEST[self::PAGE];
        }

        if (count($errors) > 0) {
            $target .= '$errors=' . urlenconde(serialize($errors));
        }
        header('location: ' . $target);
        exit();
    }
}