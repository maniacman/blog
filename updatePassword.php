<?php
session_start();
include 'functions.php';
$msg = [];

$id = $_SESSION['id'];
$currentPassword = htmlspecialchars(trim($_POST['currentPassword']));
$newPassword1 = htmlspecialchars(trim($_POST['newPassword1']));
$newPassword2 = htmlspecialchars(trim($_POST['newPassword2']));

$msg = checkPassword($currentPassword, $msg);
$msg = checkPassword($newPassword1, $msg);
$msg = checkPassword($newPassword2, $msg);

if ($newPassword1 != $newPassword2)
{
	$msg[] = 'Пароли не совпадают';
}

if (count($msg) > 0)
{
	$_SESSION['msg'] = $msg;
	header('Location: profile.php');
	exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :id");
$values = ['id' => $id];
$statement->execute($values);
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
$hash = $users[0][password];
if((password_verify($currentPassword, $hash)))
{
	$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');
	$statement = $pdo->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");
	$newPassword1 = password_hash($newPassword1, PASSWORD_DEFAULT);
	$values = ['password' => $newPassword1, 'id' => $id];
	$statement->execute($values);
	$msg[] = 'Новый пароль сохранен';
	$_SESSION['msg'] = $msg;
	header('Location: profile.php');
	exit;
}
else
{
	$msg[] = 'Текущий пароль указан неверно';
	$_SESSION['msg'] = $msg;
	header('Location: profile.php');
	exit;
}