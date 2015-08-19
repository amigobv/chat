<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 19.08.2015
 * Time: 22:28
 */

class ChatWall extends BaseObject {
    public static function add($postId) {
        $chat = self::getChat();
        $chat[$postId] = $postId;
        self::storeChat($chat);
    }

    private static function getChat() {
        return isset($_SESSION['chat']) && is_array($_SESSION['chat']) ? $_SESSION['chat'] : array();
    }
    public static function getAll() {
        return self::getChat();
    }

    public static function clear() {
        unset($_SESSION['chat']);
    }

    public static function storeChat(array $chat) {
        $_SESSION['chat'] = $chat;
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