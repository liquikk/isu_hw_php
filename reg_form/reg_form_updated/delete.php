<?php
if (empty($_POST['delete_list'])) {
  header('Location: admin.php?error=1');
  exit;
}
$file_name = 'records/registrations.txt';
$file = fopen($file_name, "r");
$new_file = fopen('records/registrations_new.txt', 'w');
while (!feof($file)) {
  $line = fgets($file);
  $line = trim($line);
  if (!empty($line)) {
    $data = explode('||', $line);
    if (in_array($line, $_POST['delete_list'])) {
      $line = implode('||', array_slice($data, 0, 9)) . '||deleted';
    }
    if ($line !== 'deleted') {
      fwrite($new_file, $line . PHP_EOL);
    }
  }
}
fclose($file);
fclose($new_file);
rename("records/registrations_new.txt", "records/registrations.txt");
header('Location: admin.php');
exit;
?>