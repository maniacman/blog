<?php
session_start();
if (isset($_SESSION['role']))
{
	$role = $_SESSION['role'];
}
else
{
	$role = 'guest';
	$_SESSION['role'] = $role;
	$login = 'guest';
}
include 'functions.php';
$comments = getAllowedComments();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Homepage</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="#">Навигация</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Главная<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Побульоним</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Расценки</a>
				</li>
			</ul>
		</div>
		<form class="form-inline col-md-2">
			<input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
		</form>
		<a href="authorization.php" class="btn btn-secondary <?php if ($role != 'guest') echo ' d-none';?>">Войти</a>
		<a href="registration.php" class="btn btn-info <?php if ($role != 'guest') echo ' d-none';?>">Регистрация</a>

		<div class="dropdown <?php if ($role == 'guest') echo ' d-none';?>">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php if (isset($_SESSION['login'])) echo $_SESSION['login'];?>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="profile.php">Профиль</a>
				<a class="dropdown-item" href="exit.php">Выход</a>
			</div>
		</div>
	</nav>	

	<div class="container">
		<div class="row">
			<h1>Комментарии</h1>
		</div>
		<?php foreach ($comments as $key => $value): ?>
			<div class="row mt-3">
				<div class="col-md-2">
					<img src="uploads/<?php echo getUserPhoto($value[login]);?>" alt="..." class="img-thumbnail">
				</div>
				<div class="col-md-8">
					<?php echo $value[login] . '<br>';?>
					<?php echo date("d-m-Y", $value[datecomment]) . '<br>';?>
					<?php echo $value[comment] . '<br>';?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Оставить комментарий</h1>
				<form action="addComment.php" method="post">
					<div class="form-group">
						<label for="">Сообщение</label>
						<textarea name="message" class="form-control" maxlength="250"></textarea>
					</div>                      
					<div class="form-group">
						<button type="submit" class="btn btn-success">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>