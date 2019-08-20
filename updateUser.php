<?php
session_start();
include 'functions.php';
$msg = [];

$newLogin = htmlspecialchars(trim($_POST['login']));
$email = htmlspecialchars(trim($_POST['email']));

$msg = checkLogin($newLogin, $msg);
$msg = checkEmail($email, $msg);

if (count($msg) > 0)
{
	$_SESSION['msg'] = $msg;
	header('Location: profile.php');
	exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

if ($newLogin != $_SESSION['login'])
{
	$msg = checkUniqueLogin($pdo, $newLogin, $msg);
}

if ($email != $_SESSION['email'])
{
	$msg = checkUniqueEmail($pdo, $email, $msg);
}

if (count($msg) == 0)
{
	$name = ($_POST['filename']);
	if ($_FILES['image']['name'])
	{
		$fileToDelite = $name;
		$name = uploadImage($_FILES['image']);
		if ($fileToDelite)
		{
			$path = 'uploads/' . $fileToDelite;
			unlink($path);
		}
	}
	$statement = $pdo->prepare("UPDATE `users` SET `login` = :newLogin, `email` = :email, `filename` = :filename WHERE `login` = :login");
	$values = ['newLogin' => $newLogin, 'email' => $email, 'filename' => $name, 'login' => $_SESSION['login']];
	$statement->execute($values);
	$_SESSION['login'] = $newLogin;
	$_SESSION['email'] = $email;
	$msg[] = 'Данные успешно изменены.';
	$_SESSION['msg'] = $msg;
}
else
{
	$_SESSION['msg'] = $msg;
}
header('Location: profile.php');