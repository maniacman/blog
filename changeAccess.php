<?php
$id = $_GET['id'];
$access = $_GET['access'];
$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');
$statement = $pdo->prepare("UPDATE `comments` SET `access` = :access WHERE `id` = :id");
($access == 'allowed') ? $access = 'denied' : $access = 'allowed';
$values = ['access' => $access, 'id' => $id];
$statement->execute($values);
header('Location: admin.php');