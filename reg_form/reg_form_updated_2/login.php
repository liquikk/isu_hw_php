<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получение логина и пароля из формы
  $login = $_POST['login'] ?? '';
  $password = $_POST['password'] ?? '';
  
  // Проверка логина и пароля в базе данных или файле
  if ($login === 'admin' && md5($password) === 'e120ea280aa50693d5568d0071456460') {
    // Авторизация пользователя, сохранение данных в сессию
    session_start();
    $_SESSION['is_logged_in'] = true;
    
    // Перенаправление на страницу администрирования
    header('Location: admin.php');
    exit;
  } else {
    // Пользователь не авторизован
    header('Location: login.php?error=1');
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Авторизация</title>
 <style>
  body{
    display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      border: 2px solid black;
  }
  </style>
</head>
<body>
<h1>Авторизация. u=admin; p=123asd.</h1>
<form action="login.php" method="post">
  <label for="login">Логин: </label>
  <input type="text" name="login">
  <br>
  <label for="password">Пароль: </label>
  <input type="password" name="password">
  <br>
  <input type="submit" value="Войти">
</form>
</body>
</html>