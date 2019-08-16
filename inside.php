<?php
session_start();
$msg = [];
include 'functions.php';

$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));

$_SESSION['login'] = $login;
$_SESSION['email'] = $email;

$msg = checkLogin($login, $msg);
$msg = checkPassword($password, $msg);

if (count($msg) > 0)
{
	$_SESSION['msg'] = $msg;
	header('Location: authorization.php');
	exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `login` = :login");
$values = ['login' => $login];
$statement->execute($values);
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
$hash = $users[0][password];
if((password_verify($password, $hash)))
{
	$_SESSION['id'] = $users[0][id];
	$_SESSION['auth'] = 'user';
	if ($login == 'admin')
	{
		$_SESSION['auth'] = 'admin';
	}
	header('Location: index.php');
	exit;
}
else
{
	$msg[] = 'Логин или пароль указаны неверно';
	$_SESSION['msg'] = $msg;
	header('Location: authorization.php');
	exit;
}

