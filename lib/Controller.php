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
    const USR_CHANNEL = 'channel';

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
            throw new Exception(self::ACTION_PARAM . ' parameter is not specified');
        }

        $action = $_REQUEST[self::ACTION_PARAM];

        switch($action) {
            case self::ACTION_LOGIN:
                if (!AuthenticationManager::authenticate($_REQUEST[self::USR_NAME], $_REQUEST[self::USR_PASSWORD])) {
                    $this->forwardRequest(['Invalid user information provided']);
                }

                //TODO: check category
                /*
                $channel = DataManager::getChannel($_REQUEST[self::USR_CHANNEL]);
                if ($channel) {
                    $user = DataManager::getUserByUsername($_REQUEST[self::USR_NAME]);
                    if (!$channel->isSubscribed($user)) {
                        throw new Exception('User is not registered in channel ' . $_REQUEST[self::USR_CHANNEL]);
                    }
                }*/

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
                //TODO: handle new post

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
            $target .= '$errors=' . urlencode(serialize($errors));
        }
        header('location: ' . $target);
        exit();
    }
}