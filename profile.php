<?php
session_start();
if (count($_SESSION['msg']) > 0)
{
	foreach ($_SESSION['msg'] as $msg)
	{
		echo $msg . '<br>';
	}
	$_SESSION['msg'] = [];
}
$login = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<?php
	$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8;', 'root', ''); 
	$statement = $pdo->prepare("SELECT * FROM `users` WHERE `login` = :login");
	$values = ['login' => $login];
	$statement->execute($values);
	$user = $statement->fetchAll(PDO::FETCH_ASSOC);
	?>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-4">
				<h1>Профиль пользователя</h1>
				<form action="updateUser.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Имя</label>
						<input type="text" name="login" class="form-control" value="<?php echo $user[0][login];?>">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" name="email" class="form-control" value="<?php echo $user[0][email];?>">
					</div>
					<div class="form-group">
						<label for="">Аватар</label>
						<input type="file" name="image" class="form-control">
					</div>
					<input type="hidden" name="filename" value="<?php echo $user[0][filename];?>">
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Редактировать</button>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<img src="uploads/<?php echo $user[0]['filename'];?>" alt="..." class="img-thumbnail">
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Безопасность</h1>
				<form action="updatePassword.php" method="post">
					<div class="form-group">
						<label for="">Текущий пароль</label>
						<input type="password" name="currentPassword"class="form-control" value="">
					</div>
					<div class="form-group">
						<label for="">Новый пароль</label>
						<input type="password" name="newPassword1"class="form-control" value="">
					</div>
					<div class="form-group">
						<label for="">Подтверждение пароля</label>
						<input type="password" name="newPassword2"class="form-control" value="">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>