<?php
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$topic = $_POST['topic'];
$payment_method = $_POST['payment_method'];
$newsletter = isset($_POST['newsletter']) ? 'да' : 'нет';

if (empty($name) || empty($surname) || empty($email) || empty($phone) || empty($topic) || empty($payment_method)) {
  header('Location: forma.php?error=1');
  exit;
}

$file_name = 'records/' . date('Y-m-d_H-i-s') . '_' . $surname . '_' . $name . '.txt';

$file = fopen($file_name, 'w');
fwrite($file, "$name\n");
fwrite($file, "$surname\n");
fwrite($file, "$email\n");
fwrite($file, "$phone\n");
fwrite($file, "$topic\n");
fwrite($file, "$payment_method\n");
fwrite($file, "$newsletter\n");
fclose($file);
header('Location: forma.php?success=1');
exit;
?>