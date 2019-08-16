<?php
session_start();
include 'functions.php';
$msg = [];

$id = $_SESSION['id'];
$login = htmlspecialchars(trim($_POST['login']));
$email = htmlspecialchars(trim($_POST['email']));

$msg = checkLogin($login, $msg);
$msg = checkEmail($email, $msg);

if (count($msg) > 0)
{
	$_SESSION['msg'] = $msg;
	header('Location: profile.php');
	exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

if ($login != $_SESSION['login'])
{
	$msg = checkUniqueLogin($pdo, $login, $msg);
}

if ($email != $_SESSION['email'])
{
	$msg = checkUniqueLogin($pdo, $email, $msg);
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
	$statement = $pdo->prepare("UPDATE `users` SET `login` = :login, `email` = :email, `filename` = :filename WHERE `id` = :id");
	$values = ['login' => $login, 'email' => $email, 'filename' => $name, 'id' => $id];
	$statement->execute($values);
	$_SESSION['login'] = $login;
	$_SESSION['email'] = $email;
}
else
{
	$_SESSION['msg'] = $msg;
}
header('Location: profile.php');