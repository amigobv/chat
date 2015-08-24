<?php

class AuthenticationManager extends BaseObject {
    public static function authenticate($username, $password, $channel) {
        $user = DataManager::getUserByUserName($username);

        if ($user != null && $user->getPassword() == self::getHash($username, $password)) {
            $channels = DataManager::getChannelsByUserId($user->getID());

            foreach($channels as $ch) {
                if ($ch->getName() === $channel) {
                    $_SESSION['user'] = $user->getId();
                    return true;
                }
            }
        }

        self::signOut();
        return false;
    }

    public static function signOut() {
        unset($_SESSION['user']);
    }

    public static function getAuthenticatedUser() {
        return self::isAuthenticated() ? DataManager::getUserById($_SESSION['user']) : null;
    }

    public static function isAuthenticated() {
        return isset($_SESSION['user']) && $_SESSION['user'];
    }

    public static function getHash($username, $password) {
        return hash('sha1', $username . '|' . $password);
    }
}