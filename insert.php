<?php
session_start();
include 'functions.php';
$msg = [];

$login = htmlspecialchars(trim($_POST['login']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

$_SESSION['login'] = $login;
$_SESSION['email'] = $email;

$msg = checkLogin($login, $msg);
$msg = checkEmail($email, $msg);
$msg = checkPassword($password, $msg);

if (count($msg) > 0)
{
	$_SESSION['msg'] = $msg;
	header('Location: registration.php');
	exit;
}

$password = password_hash($password, PASSWORD_DEFAULT);

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

$msg = checkUniqueLogin($pdo, $login, $msg);
$msg = checkUniqueEmail($pdo, $email, $msg);

if ($_POST['password'] !== $_POST['password2'])
{
	$msg[] = 'Пароли не совпадают. Попробуйте ещё раз.';
}

if (count($msg) == 0)
{
	$statement = $pdo->prepare("INSERT INTO `users` (role, login, email, password, filename) VALUES(:role, :login, :email, :password, :filename)");
	$values = ['role' => 'user', 'login' => $login, 'email' => $email, 'password' => $password, 'filename' => 'noob.jpg'];
	$statement->execute($values);
	$msg[] = 'Логин и пароль успешно сохранены. Авторизуйтесь, пожалуйста.';
	$_SESSION['msg'] = $msg;
	header('Location: authorization.php');
	exit;
}
else
{
	$_SESSION['msg'] = $msg;
	header('Location: registration.php');
	exit;
}
