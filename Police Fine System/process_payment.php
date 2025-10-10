<?php
session_start();
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<script>alert('Invalid request.'); window.location.href='pay_fines.php';</script>";
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve form data
$fine_ids = isset($_POST['fine_ids']) ? $_POST['fine_ids'] : [];
$total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;
$card_name = $_POST['card_name'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';

if (empty($fine_ids) || $total_amount <= 0) {
    echo "<script>alert('No fines selected or invalid amount.'); window.location.href='pay_fines.php';</script>";
    exit;
}

// Begin transaction for safety
$conn->begin_transaction();

try {
    // Mask card number (keep last 4 digits)
$masked_card_number = str_repeat('*', strlen($card_number) - 4) . substr($card_number, -4);

// Mask CVV completely (store as '***' or hash if needed)
$masked_cvv = str_repeat('*', strlen($cvv));

// Insert into payment table with masked info
$payment_sql = "INSERT INTO payment (user_id, total_amount, card_name, card_number, expiry_date, cvv, payment_date)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($payment_sql);
$stmt->bind_param("idssss", $user_id, $total_amount, $card_name, $masked_card_number, $expiry_date, $masked_cvv);
$stmt->execute();
$payment_id = $stmt->insert_id;
$stmt->close();

    // Mark fines as paid
    $placeholders = implode(',', array_fill(0, count($fine_ids), '?'));
    $types = str_repeat('i', count($fine_ids));
    $update_sql = "UPDATE fine SET status = 'paid', payment_id = ? WHERE id IN ($placeholders) AND user_id = ?";
    
    // Bind payment_id + fine_ids + user_id
    $params = array_merge([$payment_id], $fine_ids, [$user_id]);
    $bind_types = 'i' . $types . 'i';

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param($bind_types, ...$params);
    $stmt->execute();
    $stmt->close();

    // Commit transaction
    $conn->commit();

    echo "<script>alert('Payment successful. All selected fines have been marked as paid.'); window.location.href='pay_fines.php';</script>";
    exit;

} catch (Exception $e) {
    $conn->rollback();
    echo "<script>alert('Payment failed: " . addslashes($e->getMessage()) . "'); window.location.href='pay_fines.php';</script>";
    exit;
}
?>
