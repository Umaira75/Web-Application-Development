<?php
session_start();
include("dbconnect.php");

$salutation = $_POST['salutation'];
$name = $_POST['name'];
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'];
$message = $_POST['message'];
$user_id = $_POST['user_id'];
$police_id = $_POST['police_id'];

$stmt = $conn->prepare("INSERT INTO appeals (salutation, name, email, phone, message, user_id, police_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $salutation, $name, $email, $phone, $message, $user_id, $police_id);

if ($stmt->execute()) {
    echo "<script>alert('Appeal submitted successfully!'); window.location.href='appeals.php';</script>";
} else {
    echo "<script>alert('Error submitting appeal: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
