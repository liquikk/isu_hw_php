<?php
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subjectId = $_POST['subject_id'];
$paymentId = $_POST['payment_id'];
$newsletter = isset($_POST['newsletter']) ? 'да' : 'нет';

$conn = new mysqli("localhost", "makar", "123", "forma");

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO registrations (name, surname, email, phone, subject_id, payment_id, newsletter) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $name, $surname, $email, $phone, $subjectId, $paymentId, $newsletter);

if ($stmt->execute()) {
    echo "Заявка успешно отправлена.";
} else {
    echo "Ошибка при отправке заявки: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: forma.php?success=1');
exit;
?>
