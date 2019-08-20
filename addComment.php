<?php
session_start();
$message = htmlspecialchars($_POST['message']);
if ($message == '')
{
	header('Location: index.php');
	exit;
}
$dateComment = $_SERVER['REQUEST_TIME'];

if (isset($_SESSION['login']) && $_SESSION['login'] != '')
{
	$login = $_SESSION['login'];
}
else
{
	$login = 'guest';
}

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');

$statement = $pdo->prepare("INSERT INTO `comments` (login, comment, datecomment, access) VALUES(:login, :comment, :datecomment, :access)");
$values = ['login' => $login, 'comment' => $message, 'datecomment' => $dateComment, 'access' => 'allowed'];
$statement->execute($values);
header('Location: index.php');
exit;

