<?php
session_start();
if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'moder')
{
	header('Location: index.php');
}
include 'functions.php';
$comments = getAllComments();
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
		<a class="navbar-brand" href="#">Админка</a>
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
			<div class="col-md-12">
				<h1>Админ панель</h1>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Фото</th>
							<th>Логин</th>
							<th>Дата</th>
							<th>Комментарий</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($comments as $key => $value): ?>
							<tr>
								<td><img src="uploads/<?php echo getUserPhoto($value[login]);?>" alt="..." class="img-thumbnail" width="400"></td>
								<td><?php echo $value[login] . '<br>';?></td>
								<td><?php echo date("d-m-Y", $value[datecomment]) . '<br>';?></td>
								<td><?php echo $value[comment] . '<br>';?></td>
								<td>
									<a href="changeAccess.php?id=<?php echo $value[id];?>&access=<?php echo $value[access];?>" class="btn <?php if ($value[access] == 'allowed') echo 'btn-success">Запретить'; else echo 'btn-warning">Разрешить';?></a>
									<a href="deleteComment.php?id=<?php echo $value[id];?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Удалить</a>
								</td>
							</tr>							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>