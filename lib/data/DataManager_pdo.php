<?php

/**
 * DataManager
 * PDO Version
 *
 *
 * @package
 * @subpackage
 * @author     John Doe <jd@fbi.gov>
 */
class DataManager {

    private static $__connection;

    /**
     * connect to the database
     *
     * note: alternatively put those in parameter list or as class variables
     *
     * @return connection resource
     */
    private static function getConnection() {
        if (!isset(self::$__connection)) {
            self::$__connection = new PDO('mysql:host=localhost;dbname=fh_2015_scm4_1310307036;charset=utf8', 'root', '');
        }
        return self::$__connection;
    }

    /**
     * place query
     *
     * note: using prepared statements
     * see the filtering in bindValue()
     *
     * @return mixed
     */
    private static function query($connection, $query, $parameters = array()) {
        $statement = $connection->prepare($query);
        $i = 1;
        foreach ($parameters as $param) {
            if (is_int($param)) {
                $statement->bindValue($i, $param, PDO::PARAM_INT);
            }
            if (is_string($param)) {
                $statement->bindValue($i, $param, PDO::PARAM_STR);
            }
            $i++;
        }
        $statement->execute();
        return $statement;
    }

    /**
     * get the key of the last inserted item
     *
     * @return integer
     */
    private static function lastInsertId($connection) {
        return $connection->lastInsertId();
    }

    /**
     * retrieve an object from the database result set
     *
     * @param object $cursor result set
     * @return object
     */
    private static function fetchObject($cursor) {
        return $cursor->fetchObject();
    }

    /**
     * remove the result set
     *
     * @param object $cursor result set
     * @return null
     */
    private static function close($cursor) {
        $cursor->closeCursor();
    }

    /**
     * close the database connection
     *
     * note: not needed
     *
     * @param object $cursor resource of current database connection
     * @return null
     */
    private static function closeConnection($connection) {

    }

    /**
     * get the channels
     *
     * @return array of Channel-items
     */
    public static function getChannels() {
        $channels = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT channelId, name FROM channel;");
        while ($ch = self::fetchObject($res)) {
            $channels[] = new Channel($ch->channelId, $ch->name);
        }
        self::close($res);
        self::closeConnection($con);
        return $channels;
    }

    public static function getChannelById($chId) {
        $channel = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT channelId, name FROM channel WHERE channelId = ?", array($chId));

        if ($ch = self::fetchObject($res)) {
            $channel = new Channel($ch->channelId, $ch->name);
        }

        self::close($res);
        self::closeConnection($con);
        return $channel;
    }

    public static function getChannelByName($channelName) {
        $channel = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT channelId, name FROM channel WHERE name LIKE ?", array("%" . $channelName . "%"));

        if ($ch = self::fetchObject($res)) {
            $channel = new Channel($ch->channelId, $ch->name);
        }

        self::close($res);
        self::closeConnection($con);
        return $channel;
    }

    /**
     * get the posts per channel
     *
     * note: see how prepared statements replace "?" with array element values
     *
     * @param integer $channelId numeric id of the channel
     * @return array of item-items
     */
    public static function getPostsByChannel($channelId) {
        $posts = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT messageId, authorId, title, content, important FROM message WHERE channelId = ?;", array($channelId));
        while ($message = self::fetchObject($res)) {
            $posts[] = new Book($message->messageId, $message->authorId, $channelId, $message->title, $message->content, $message->important);
        }
        self::close($res);
        self::closeConnection($con);
        return $posts;
    }

    /**
     * get the posts per search term
     *
     * note: search via LIKE
     *
     * @param string $term search term: post title string match
     * @return array of Post-items
     */
    public static function getPostBySearchCriteria($term) {
        $posts = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT messageId, authorId, channelId, title, content, important FROM message WHERE title LIKE ?;", array("%" . $term . "%"));
        while ($message = self::fetchObject($res)) {
            $posts[] = new Book($message->messageId, $message->author, $message->channelId, $message->title, $message->content, $message->important);
        }
        self::close($res);
        self::closeConnection($con);
        return $posts;
    }


    /**
     * get the User item by id
     *
     * @param integer $userId uid of that user
     * @return User |Â false
     */
    public static function getUserById($userId) {
        $user = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT userId, firstName, lastName, username, passwordHash FROM person WHERE userId = ?;", array($userId));
        if ($u = self::fetchObject($res)) {
            $user = new User($u->userId, $u->firstName, $u->lastName, $u->username, $u->passwordHash);
        }
        self::close($res);
        self::closeConnection($con);
        return $user;
    }

    /**
     * get the User item by name
     *
     * @param string $userName name of that user - must be exact match
     * @return User |Â false
     */
    public static function getUserByUsername($username) {
        $user = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT userId, firstName, lastName, username, passwordHash FROM person WHERE username = ?;", array($username));

        if ($u = self::fetchObject($res)) {
            $user = new User($u->userId, $u->firstName, $u->lastName, $u->username, $u->passwordHash);
        }
        self::close($res);
        self::closeConnection($con);
        return $user;
    }

    public static function getUsersByChannelId($channelId) {
        $ids = array();
        $users = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT personId FROM register WHERE channelId = ?;", array($channelId));
        while ($ch = self::fetchObject($res)) {
            $ids[] = $ch->personId;
        }

        self::close($res);
        self::closeConnection($con);

        foreach ($ids as $id) {
            $users[] = self::getUserById($id);

        }

        return $users;
    }


    public static function getChannelsByUserId($userId) {
        $channels = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT channelId FROM register WHERE personId = ?;", array($userId));
        while ($ch = self::fetchObject($res)) {
            $channels[] = self::getChannelById($ch->channelId);
        }

        self::close($res);
        self::closeConnection($con);
        return $channels;
    }

    public static function registrateUser($userId, $channelId) {
        $con = self::getConnection();
        self::query($con, 'BEGIN');
        self::query($con, "INSERT INTO register (personId, channelId)
                           VALUES (?, ?);", array($userId, $channelId));
        self::query($con, 'COMMIT');
        self::closeConnection($con);
    }

    public static function saveNewUser($firstName, $lastName, $username, $password) {
        $con = self::getConnection();
        self::query($con, 'BEGIN');
        self::query($con, "INSERT INTO person (firstName, lastName, username, passwordHash)
                           VALUES (?, ?, ?, ?);",
                           array($firstName, $lastName, $username, $password));
        $userId = self::lastInsertId($con);
        self::query($con, 'COMMIT');

        self::closeConnection($con);
        return $userId;
    }
    /**
     * publish a message
     *
     * note: wrapped in a transaction
     *
     * @param integer $userId id of the ordering user
     * @param array $bookIds integers of book ids
     * @param string $nameOnCard cc name
     * @param string $cardNumber cc number
     * @return integer
     */
    public static function createOrder($userId, $bookIds, $nameOnCard, $cardNumber) {
        $con = self::getConnection();
        self::query($con, 'BEGIN;');
        self::query($con, "INSERT INTO orders (userId, creditCardNumber, creditCardHolder) VALUES (?, ?, ?);", array($userId, $cardNumber, $nameOnCard));
        $orderId = self::lastInsertId($con);
        foreach ($bookIds as $bookId) {
            self::query($con, "INSERT INTO orderedbooks (orderId, bookId) VALUES (?, ?);", array($orderId, $bookId));
        }
        self::query($con, 'COMMIT;');
        self::closeConnection($con);
        return $orderId;
    }
}