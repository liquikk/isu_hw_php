<?php
if (empty($_POST['delete_list'])) {
  header('Location: admin.php?error=1');
  exit;
}

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_list'])) {
    $delete_list = $_POST['delete_list'];

  
    $conn = new mysqli("localhost", "makar", "123", "forma");
  
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
    foreach ($delete_list as $id) {
      $sql = "UPDATE registrations SET is_deleted = 1 WHERE id = $id";
      $conn->query($sql);
    }
  
    $conn->close();
  }
  
  header('Location: admin.php');
  exit;

?>