<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Заявка на участие в конференции</title>
 <style>
  body{
    display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      background-color: #f5f5f5;
  }
form {
    border-collapse: collapse;
    margin: 0;
    padding: 0;
}
form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}
form input[type="text"],
form input[type="email"],
form input[type="tel"],
form select {
    padding: 5px;
    border: 1px solid gray;
    border-radius: 5px;
    width: 300px;
    margin-bottom: 10px;
}
form label[for="newsletter"] {
  display: inline-block;
  width: 270px;
}
form input[name="newsletter"] {
  padding-right: 10px;
}
input[type="checkbox"]{
  padding-top: 100px;
}
form input[type="submit"] {
    background-color: blue;
    color: white;
    border: 0;
    border-radius: 5px;
    margin-top: 10px;
    padding: 10px;
    cursor: pointer;
}
a {
   display: block;
   margin-top: 20px;
   color: blue;
   text-decoration: none;
}
</style>
</head>
<body>
<h1>Заявка на участие в конференции</h1>
<form action="send_form2.php" method="post">
  <label for="name">Имя: </label>
  <input type="text" name="name" required>
  
  <label for="surname">Фамилия: </label>
  <input type="text" name="surname" required>

  <label for="email">Email: </label>
  <input type="email" name="email" required>

  <label for="phone">Телефон: </label>
  <input type="tel" name="phone" required>

  <label for="subject">Тематика: </label>
  <select name="subject_id" required>
    <option value="">Выберите тематику</option>
    <option value="1">Бизнес</option>
    <option value="2">Технологии</option>
    <option value="3">Реклама и Маркетинг</option>
  </select>

  <label for="payment">Метод оплаты:</label>
  <select name="payment_id" required>
    <option value="">Выберите метод оплаты</option>
    <option value="1">WebMoney</option>
    <option value="2">Яндекс.Деньги</option>
    <option value="3">PayPal</option>
    <option value="4">Кредитная карта</option>
  </select>
  <br>
  <label for="newsletter">Получать рассылку о конференции: </label>
  <input type="checkbox" name="newsletter" value="yes">
  <br>
  <input type="submit" value="Отправить заявку">
</form>
<a href="admin.php">Админка</a>
</body>
</html>
<?php
if (!isset($_SESSION['users'])) {
  $_SESSION['users'] = array();
}

if (!in_array(session_id(), $_SESSION['users'])) {
  $_SESSION['users'][] = session_id();
}
echo 'Количество пользователей по сессиям: ' . count($_SESSION['users']);
echo '<br/>';

$ip = $_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['visitors']) || !in_array($ip, $_SESSION['visitors'])) {
    $_SESSION['visitors'][] = $ip;
}
echo 'Количество уникальных посетителей: ' . count($_SESSION['visitors']);
echo '<br/>';

if (isset($_SESSION['page_views'])) {
  $_SESSION['page_views']++;
} else {
  $_SESSION['page_views'] = 1;
}
echo 'Количество загрузок страницы: ' . $_SESSION['page_views'];

if(isset($_GET['success']) && $_GET['success'] == '1'){
    echo '<script>alert("Заявка успешно отправлена!");</script>';
}
?>
