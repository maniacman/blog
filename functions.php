<?php
function checkLogin($login, $msg)
{
	if ($login == '')
	{
		$msg[] = 'Введите логин';
	}
	return $msg;
}

function checkEmail($email, $msg)
{
	if ($email == '')
	{
		$msg[] = 'Введите электронную почту';
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$msg[] = 'Электронная почта указана некорректно';
	}
	return $msg;
}

function checkPassword($password, $msg)
{
	if ($password == '')
	{
		$msg[] = 'Введите пароль';
	}
	return $msg;
}

function checkUniqueLogin($pdo, $login, $msg)
{
	$statement = $pdo->prepare("SELECT * FROM `users` WHERE `login` = :login");
	$values = ['login' => $login];
	$statement->execute($values);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	if(count($users) > 0)
	{
		$msg[] = 'Этот логин уже используется. Придумайте другой.';
	}
	return $msg;
}

function checkUniqueEmail($pdo, $email, $msg)
{
	$statement = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
	$val = ['email' => $email];
	$statement->execute($val);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	if(count($users) > 0)
	{
		$msg[] = 'Эта почта уже используется. Авторизуйтесь или введите другую.';
	}
	return $msg;
}

function uploadImage($image)
{
	$path = 'uploads';
	$extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
	$filename = DFileHelper::getRandomFileName($path, $extension);
	$target = $path . '/' . $filename . '.' . $extension;
	move_uploaded_file($_FILES['image']['tmp_name'], $target);
	$name = $filename . '.' . $extension;
	return $name;
}

class DFileHelper
{
	public static function getRandomFileName($path, $extension='')
	{
		$extension = $extension ? '.' . $extension : '';
		$path = $path ? $path . '/' : '';
		do {
			$name = md5(microtime() . rand(0, 9999));
			$file = $path . $name . $extension;
		} while (file_exists($file));
		return $name;
	}
}