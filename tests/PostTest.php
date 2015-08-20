<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 18.08.2015
 * Time: 22:10
 */
include_once("../lib/BaseObject.php");
include_once("../lib/Entity.php");
include_once("../lib/User.php");
include_once("../lib/Channel.php");
include_once("../lib/Post.php");

$user = new User(0, "Daniel", "Rotaru", "RoDa", hash('sha1', "RoDa" . '|' . '1310307036'));

$channel = new Channel(0, "default");
$post1 = new Post(5, $channel->getID(), $user->getID(), "My first test", "Test Test Test!!!", false);
$post2 = new Post(6, $channel->getID(), $user->getID(), "My second test", "Test Test Test!!!", true);

echo $post1->getID() . " " . "Channel: " . $post1->getChannelId() . " " . $post1->getAuthor() .
    " " . $post1->getTitle() . " " . $post1->getContent() .
    " " . $post1->getStatus() . " " . (($post1->getProminence()) ? "Important" : "Normal") . "<br>";

$post1->setRead();
$post1->setProminence(true);

echo $post1->getID() . " " . "Channel: " . $post1->getChannelId() . " " . $post1->getAuthor() .
    " " . $post1->getTitle() . " " . $post1->getContent() .
    " " . $post1->getStatus() . " " . (($post1->getProminence()) ? "Important" : "Normal") . "<br>";
?>



