<?php
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message. Please try again.'); window.location.href='contact.php';</script>";
    }
}
?>
