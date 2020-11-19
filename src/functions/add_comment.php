<?php

$parentId = $_POST['parentId'];
$topicId  = $_POST['topicId'];
$body     = $_POST['text'];

$mysqli = new Mysqli($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE'], $_ENV['MYSQL_PORT']);
$mysqli->query("SET NAMES utf8");
$mysqli->query("INSERT INTO `comments` (`parent_id`, `topic_id`, `body`) VALUES('{$parentId}', '{$topicId}', '{$body}')");
