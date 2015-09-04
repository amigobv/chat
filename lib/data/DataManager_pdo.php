<?php

/**
 * DataManager
 * PDO Version
 *
 *
 * @package
 * @subpackage
 * @author
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
        $res = self::query($con, "SELECT messageId, authorId, title, content, status FROM message WHERE channelId = ?;", array($channelId));
        while ($message = self::fetchObject($res)) {
            if ($message->status != Status::DELETED) {
                $status = self::getPostStatus($message->messageId);

                $post = new Post($message->messageId, $channelId, $message->authorId, $message->title, $message->content, $status);
                $posts[] = $post;
            }
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

    public static function getRegistrationId($userId, $channelId) {
        $id = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT regId FROM register WHERE personId = ? AND channelId = ?", array($userId, $channelId));
        if ($reg = self::fetchObject($res)) {
            $id = $reg->regId;
        }

        self::close($res);
        self::closeConnection($con);
        return $id;
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
    public static function publishMessage($userId, $channelId, $title, $content, $status) {
        $con = self::getConnection();

        $users = self::getUsersByChannelId($channelId);
        self::query($con, 'BEGIN;');
        self::query($con, "INSERT INTO message (authorId, channelId, title, content, status) VALUES (?, ?, ?, ?, ?);",
                          array($userId, $channelId, $title, $content, $status));
        $postId = self::lastInsertId($con);

        foreach($users as $user) {
            self::query($con, "INSERT INTO chatwall (chId, postId, authorId, status) VALUES (?, ?, ?, ?)",
                          array($channelId, $postId, $userId, Status::UNREAD));
        }
        self::query($con, 'COMMIT;');
        self::closeConnection($con);

        return $postId;
    }

    public static function changePostStatus($id, $status) {
        $con = self::getConnection();
        self::query($con, 'BEGIN');
        self::query($con, "UPDATE chatwall SET status = ? WHERE postId = ?;", array($status, $id));
        self::query($con, 'COMMIT');
        self::closeConnection($con);
    }

    public static function getPostStatus($postId) {
        $status = null;
        $con = self::getConnection();
        $res = self::query($con, "SELECT status FROM chatwall WHERE postId = ?;", array($postId));
        if ($stat = self::fetchObject($res)) {
            $status = $stat->status;
        }
        self::close($res);
        self::closeConnection($con);
        return $status;
    }

    /**
     * Attention: the returned messages do not contain any message text. Should only be used for the message id,
     * the author and the status of a message in wall.
     * @return array|Post
     */
    public static function getAllUnreadPostsByUserId($userId) {
        $unreadPosts = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT chId, postId, authorId, status FROM chatwall WHERE status = ? AND (NOT authorId = ?);", array(Status::UNREAD, $userId));
        while ($stat = self::fetchObject($res)) {
            $unreadPosts[] = new Post($stat->postId, null, $stat->authorId, null, null, $stat->status);
        }
        self::close($res);
        self::closeConnection($con);
        return $unreadPosts;
    }

    public static function getAllUnansweredPosts($channelId) {
        $unreadPosts = array();
        $con = self::getConnection();
        $res = self::query($con, "SELECT chId, postId, authorId, status FROM chatwall WHERE chId = ?;", array($channelId));
        while ($stat = self::fetchObject($res)) {
            if ($stat->status == Status::UNREAD || $stat->status == Status::READ) {
                $unreadPosts[] = new Post($stat->postId, null, $stat->authorId, null, null, $stat->status);
            }
        }
        self::close($res);
        self::closeConnection($con);
        return $unreadPosts;
    }
}