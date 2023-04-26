<?php
if (empty($_POST['delete_list'])) {
  header('Location: admin.php?error=1');
  exit;
}
foreach ($_POST['delete_list'] as $file_name) {
  unlink($file_name);
}
header('Location: admin.php');
exit;
?>