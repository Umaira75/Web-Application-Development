<?php
session_start();
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = (int)($_POST['user_id'] ?? 0);
    $fine_types = $_POST['fine_types'] ?? [];
    $description = $_POST['description'] ?? '';
    $issued_by = $_SESSION['user_id']; // police ID
    $status = "pending";

    // Fixed prices for each fine type
    $finePrices = [
        "Speeding" => 1500,
        "No Helmet" => 1300,
        "Illegal Parking" => 1200,
        "No License" => 1000,
        "Signal Violation" => 1750,
        "Overloading Vehicle" => 1600,
        "Drunk Driving" => 5000,
        "Expired Insurance" => 1800,
        "Using Mobile While Driving" => 1000,
        "Driving Without Seatbelt" => 1300,
        "Vehicle Not Registered" => 1200,
        "Failure to stop at pedestrian crossings" => 1400,
        "Failure to stop at railway crossings" => 1400,
        "Pollution Certificate Missing" => 1500,
        "Driving on Wrong Side" => 1000,
        "No Headlights at Night" => 1250,
        "Illegal U-turn" => 1300,
        "No Helmet (Motorcyclists)" => 1300,
        "Excessive emissions such as smoke" => 1600,
        "Traveling on the sidewalk" => 1200,
        "Driving Without Side Mirrors" => 1250,
        "Unauthorized Racing on Public Roads" => 5000,
        "Illegal Overtaking" => 1800

    ];

    if ($user_id <= 0 || empty($fine_types)) {
        echo "<script>alert('Please select a user and at least one fine type.'); window.history.back();</script>";
        exit;
    }

    // Check user exists
    $userCheck = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $userCheck->bind_param("i", $user_id);
    $userCheck->execute();
    $userCheck->store_result();
    if ($userCheck->num_rows === 0) {
        echo "<script>alert('Selected user does not exist.'); window.history.back();</script>";
        exit;
    }
    $userCheck->close();

    // Insert each fine
    $stmt = $conn->prepare("
        INSERT INTO fine (user_id, fine_type, fine_amount, description, issued_by, status) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    foreach ($fine_types as $type) {
        $amount = $finePrices[$type] ?? 0;
        $stmt->bind_param("isdsss", $user_id, $type, $amount, $description, $issued_by, $status);
        $stmt->execute();
    }

    $stmt->close();

    echo "<script>alert('Fines issued successfully'); window.location.href='police_home.php';</script>";
}
?>
