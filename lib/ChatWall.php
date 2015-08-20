<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 19.08.2015
 * Time: 22:28
 */

class ChatWall extends BaseObject {
    public static function getName() {
        return $_SESSION['channel'];
    }

    public static function add($postId) {
        $chat = self::getChat();
        $chat[$postId] = $postId;
        self::storeChat($chat);
    }

    private static function getChat() {
        $ch = $_SESSION['channel'];
        return isset($_SESSION[$ch]) && is_array($_SESSION[$ch]) ? $_SESSION[$ch] : array();
    }
    public static function getAll() {
        return self::getChat();
    }

    public static function clear() {
        $ch = $_SESSION['channel'];
        unset($_SESSION[$ch]);
    }

    public static function storeChat(array $chat) {
        $ch = $_SESSION['channel'];
        $_SESSION[$ch] = $chat;
    }

    public static function remove($chatId) {
        $chat = self::getChat();
        unset($chat[$chatId]);
        self::storeChat($chat);
    }

    public static function contains($chatId) {
        return array_key_exists($chatId, self::getChat());
    }

    public static function size() {
        return sizeof(self::getChat());
    }
}