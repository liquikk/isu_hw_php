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
<a href="forma.php">Форма</a>
<form action="delete.php" method="post">
  <table>
    <tr>
      <th>Имя файла</th>
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
    foreach (glob("records/*.txt") as $file_name) {
      $file = fopen($file_name, "r");
      $name = fgets($file);
      $surname = fgets($file);
      $email = fgets($file);
      $phone = fgets($file);
      $topic = fgets($file);
      $payment_method = fgets($file);
      $newsletter = fgets($file);
      fclose($file);
      $f_name = substr($file_name, 8);
      echo "<tr>";
      echo "<td>$f_name</td>";
      echo "<td>$name</td>";
      echo "<td>$surname</td>";
      echo "<td>$email</td>";
      echo "<td>$phone</td>";
      echo "<td>$topic</td>";
      echo "<td>$payment_method</td>";
      echo "<td>$newsletter</td>";
      echo "<td><input type='checkbox' name='delete_list[]' value='$file_name'></td>";
      echo "</tr>";
    }
    ?>
  </table>
  <input type="submit" value="Удалить выбранные заявки">
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