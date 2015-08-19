<?php

$__users = array(1 => new User(1, "Test", "User", "scm4", "a8af855d47d091f0376664fe588207f334cdad22"),
				2 => new User(2, "Daniel", "Rotaru", "guest", "guest"),
				3 => new User(3, "Robert", "Koeppe", "koeppe", "koeppe"),
				4 => new User(4, "Christian", "Gesswagner", "gesswagner", "gesswagner"),	
				5 => new User(5, "Manuell", "Buchinger", "buchinger", "buchinger")
);

$__channels = array(1 => new Channel(1, "General"),
                    2 => new Channel(2, "Backend"),
                    3 => new Channel(3, "Frontend"));

class DataManager extends BaseObject {
	public static function getUserById($id) {
		global $__users;
		
		foreach($__users as $user) {
			if ($user->getId() == $id) {
				return $user;
			}
		}
		
		return null;
	}
	
	public static function getUserByUsername($username) {
		global $__users;
		
		foreach($__users as $user) {
			if ($user->getUsername() == $username) {
				return $user;
			}
		}
		
		return null;
	}

    public static function getUsers() {
        global $__users;

        return $__users;
    }

    public static function getChannel($channelName) {
        global $__channels;

        foreach($__channels as $ch) {
            if ($ch->getName() == $channelName) {
                return $ch;
            }
        }

        return null;
    }

    public static function getChannels() {
        global $__channels;

        return $__channels;
    }
}



