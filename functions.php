<?php
//Валидация вводимого логина
function checkLogin($login, $msg)
{
	if ($login == '')
	{
		$msg[] = 'Введите логин';
	}
	return $msg;
}

//Валидация вводимого email
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

//Валидация вводимого пароля
function checkPassword($password, $msg)
{
	if ($password == '')
	{
		$msg[] = 'Введите пароль';
	}
	return $msg;
}

//Проверка вводиомго логина на уникальность
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

//Проверка вводиомго email на уникальность
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


//возвращает уникальное имя для загружаемого файла
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
//создает имя файла, и если оно уникальное (такого файла нет в папке) то возвращает его.
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

//возвращает массив всех комментариев
function getAllComments()
{
	$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');
	$comments = $pdo->query("SELECT * FROM `comments`")->fetchAll(PDO::FETCH_ASSOC);
	return $comments;
}


//возвращает массив только разрешенных комментариев
function getAllowedComments()
{
	$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', '');
	$comments = $pdo->query("SELECT * FROM `comments` WHERE `access` = 'allowed'")->fetchAll(PDO::FETCH_ASSOC);
	return $comments;
}

//получая логин пользователя возвращает имя файла с фоткой пользователя
function getUserPhoto($login)
{
	if ($login == 'guest')
	{
		$fileName = 'guest.jpg';
	}
	else
	{
		$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', ''); 
		$statement = $pdo->prepare("SELECT * FROM `users` WHERE `login` = :login");
		$values = ['login' => $login];
		$statement->execute($values);
		$user = $statement->fetchAll(PDO::FETCH_ASSOC);
		$fileName = $user[0]['filename'];
	}
	return $fileName;
}

