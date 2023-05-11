<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
  header('Location: login.php');
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
    $file_name = 'records/registrations.txt';
    $file = fopen($file_name, "r");
    while (!feof($file)) {
      $line = fgets($file);
      $line = trim($line);
      if (!empty($line)) {
        $data = explode('||', $line);
        $name = $data[2];
        $surname = $data[3];
        $email = $data[4];
        $phone = $data[5];
        $topic = $data[6];
        $payment_method = $data[7];
        $newsletter = $data[8];
        $deleted = isset($data[9]) && $data[9] === 'deleted';
        $checkbox = $deleted ? '<input type="checkbox" name="restore_list[]" value="' . $line . '"> Восстановить' : '<input type="checkbox" name="delete_list[]" value="' . $line . '"> Удалить';
        if (!$deleted) {
          echo "<tr>";
          echo "<td>$name</td>";
          echo "<td>$surname</td>";
          echo "<td>$email</td>";
          echo "<td>$phone</td>";
          echo "<td>$topic</td>";
          echo "<td>$payment_method</td>";
          echo "<td>$newsletter</td>";
          echo "<td>$checkbox</td>";
          echo "</tr>";
        }
      }
    }
    fclose($file);
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