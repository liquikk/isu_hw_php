<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

$conn = new mysqli("localhost", "makar", "123", "forma");

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

# Обновляем время последней активности
if (!isset($_SESSION['last_activity'])) {
  $_SESSION['last_activity'] = time();
}

# Сколько времени прошло с момента последней активности
$inactiveTime = (time() - ($_SESSION['last_activity']));

# Если прошло более 1 мин бездействия, разлогиниваем пользователя
if ($inactiveTime > 60) {
  session_destroy();
  header('Location: login.php');
  session_write_close();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Админка</title>
 <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
    }
    a {
    display: block;
    color: blue;
    text-decoration: none;
    }
  </style>
</head>
<body>
<form action="admin.php" method="post">
  <input type="hidden" name="action" value="logout">
  <input type="submit" value="Выход" style="float: right;">
</form>
<a href="forma.php">Форма</a>
<form action="delete.php" method="post">
  <table>
    <tr>
      <th>Имя участника</th>
      <th>Фамилия участника</th>
      <th>Email участника</th>
      <th>Телефон участника</th>
      <th>Тематика</th>
      <th>Метод оплаты</th>
      <th>Рассылка</th>
      <th><input type="checkbox" id="select_all"> Выбрать все</th>
    </tr>
    <?php
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT registrations.id, registrations.name, registrations.surname, registrations.email, registrations.phone, subjects.name AS subject_name, payments.name AS payment_name, registrations.newsletter
            FROM registrations
            INNER JOIN subjects ON registrations.subject_id = subjects.id
            INNER JOIN payments ON registrations.payment_id = payments.id
            WHERE registrations.is_deleted = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $surname = $row['surname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $subject = $row['subject_name'];
        $payment = $row['payment_name'];
        $newsletter = $row['newsletter'];
        $checkbox = '<input type="checkbox" name="delete_list[]" value="' . $id . '"> Удалить';

        echo "<tr>";
        echo "<td>$name</td>";
        echo "<td>$surname</td>";
        echo "<td>$email</td>";
        echo "<td>$phone</td>";
        echo "<td>$subject</td>";
        echo "<td>$payment</td>";
        echo "<td>$newsletter</td>";
        echo "<td>$checkbox</td>";
        echo "</tr>";
      }
    }
    else{
      echo "<tr><td colspan='8'>Нет доступных записей</td></tr>";
    }

    $conn->close();
    ?>
  </table>
  <input type="submit" value="Выполнить выбранное">
</form>
<script>
document.getElementById("select_all").addEventListener("click", function () {
  var checkboxes = document.getElementsByName("delete_list[]");
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = document.getElementById("select_all").checked;
  }});
</script>
</body>
</html>