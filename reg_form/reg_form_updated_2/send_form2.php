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

$delimiter = '||'; // выбираем разделитель
if (strpos($name, $delimiter) !== false ||
    strpos($surname, $delimiter) !== false ||
    strpos($email, $delimiter) !== false ||
    strpos($phone, $delimiter) !== false ||
    strpos($topic, $delimiter) !== false ||
    strpos($payment_method, $delimiter) !== false ||
    strpos($newsletter, $delimiter) !== false)
{
    header('Location: forma.php?error=1');
    exit;
}

$data = implode($delimiter, [
    date('Y-m-d H:i:s'),
    $_SERVER['REMOTE_ADDR'],
    $name,
    $surname,
    $email,
    $phone,
    $topic,
    $payment_method,
    $newsletter,
]) . PHP_EOL;

$file_name = 'records/registrations.txt';
$file = fopen($file_name, 'a');
fwrite($file, $data);
fclose($file);

header('Location: forma.php?success=1');
exit;
?>