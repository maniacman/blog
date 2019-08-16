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

if (isset($_SESSION['login']))
{
    $login = $_SESSION['login'];
}
if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>  
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Регистрация</h1>
                <form action="insert.php" method="post">
                    <div class="form-group">
                        <label for="">Логин</label>
                        <input type="text" name="login" class="form-control" value="<?php echo $login;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Пароль</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Повторите пароль</label>
                        <input type="password" name="password2" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Ввод</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>