<?php
session_start();
include('dbconnect.php');

$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Get all pending fines for this user
$sql = "SELECT id, fine_type, fine_amount FROM fine WHERE user_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$fines = [];
$totalAmount = 0;
while ($row = $result->fetch_assoc()) {
    $fines[] = $row;
    $totalAmount += $row['fine_amount'];
}
$stmt->close();

// If no pending fines
if (empty($fines)) {
    echo "<script>alert('No pending fines found.'); window.location.href='pay_fines.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Police Fine System - Pay All Fines</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="pay_now.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="icon" href="Images/Logo.png" />
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="header-logo">
                    <img src="Images/Logo.png" alt="Police Logo">
                    <span>Police Fine System</span>
                </div>
                <nav class="header-nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
                        <li><a href="pay_now.php" class="active">Pay Now</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="header-icon-link"><i class="fas fa-user-circle"></i> Logout</a>
                <?php else: ?>
                <a href="login.php" class="header-icon-link"><i class="fas fa-user-circle"></i> Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

<div class="container">
    <h2>Pay All Pending Fines</h2>

    <div style="padding:10px; background:#f9f9f9; border:1px solid #ddd; margin-bottom:20px;">
        <h3>Total Amount: Rs. <?php echo number_format($totalAmount, 2); ?></h3>
    </div>

    <ul>
        <?php foreach ($fines as $fine): ?>
            <li>
                <?php echo htmlspecialchars($fine['fine_type']); ?> - Rs. <?php echo number_format($fine['fine_amount'], 2); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="process_payment.php" method="POST">
        <?php foreach ($fines as $fine): ?>
            <input type="hidden" name="fine_ids[]" value="<?php echo (int)$fine['id']; ?>">
        <?php endforeach; ?>
        <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">

        <label>Card Holder Name</label>
        <input type="text" name="card_name" pattern="^[A-Za-z ]+$" title="Give in Letters" required>

        <label>Card Number</label>
        <input type="text" name="card_number" maxlength="19" pattern="\d{16}" title="Enter a 16-digit card number" required>

        <label>Expiry Date (MM/YYYY)</label>
        <input type="text" name="expiry_date" placeholder="MM/YYYY" pattern="^(0[1-9]|1[0-2])\/[0-9]{4}$" title="Enter a valid expiry date in MM/YYYY format" required>

        <label>CVV</label>
        <input type="password" name="cvv" maxlength="4" pattern="\d{3,4}" title="Enter 3 or 4-digit CVV" required>

        <button type="submit">Pay Now</button>
    </form>
</div>

<footer class="footer" style="margin-top: 50px;">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section about">
                    <h4>About Police Fine System</h4>
                    <p>A joint initiative by the Sri Lanka Police to modernize and streamline the process of managing and paying traffic fines digitally.</p>
                </div>
                <div class="footer-section links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section contact-info">
                    <h4>Contact Info</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Police Headquarters, Colombo 01, Sri Lanka</p>
                    <p><i class="fas fa-phone-alt"></i> +94 11 2XXX XXX</p>
                    <p><i class="fas fa-envelope"></i> info@policefine.lk</p>
                </div>
                <div class="footer-section social">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom" style="text-align:center; margin-top: 20px;">
                <p>&copy; 2025 Police Fine System. All rights reserved.</p>
                <p>Powered by |Government/Police Authority Name|</p>
            </div>
        </div>
    </footer>

</body>
</html>
