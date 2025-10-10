<?php
session_start();
include('dbconnect.php');

$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;

// Ensure user is logged in and is a regular user (not police)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    echo "
<script>
        alert('You must be logged in as a user to access this page.');
        window.location.href = 'login.php';
</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM fine WHERE user_id = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Police Fine System - Pay Fine</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="pay_fines.css" />
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
                        <li><a href="pay_fines.php" class="active">Pay Fines</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
                        <li><a href="index.php #aboutUsSection">About Us</a></li>
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

    <main class="container">
        <h2>Pending Fines</h2>

        <?php
        $totalAmount = 0;
        $fineDetails = [];

        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $totalAmount += $row['fine_amount'];
        $fineDetails[] = $row;
        }
        }

        if (!empty($fineDetails)) :
        ?>
        <div class="total-fine" style="padding: 15px; background: #f8f9fa; border: 1px solid #ddd; margin-bottom: 20px;">
            <h3>Your Fine Amount: Rs. <?php echo number_format($totalAmount, 2); ?></h3>
        </div>

        <?php foreach ($fineDetails as $fine): ?>
        <div class="fine-card">
            <h3><?php echo htmlspecialchars($fine['fine_type']); ?> - Rs. <?php echo number_format($fine['fine_amount'], 2); ?></h3>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($fine['description']); ?></p>
            <p><strong>Issued On:</strong> <?php echo htmlspecialchars($fine['issued_date']); ?></p>
        </div>
        <?php endforeach; ?>

        <form action="pay_now.php" method="POST" style="margin-top: 20px;">
            <button type="submit">Pay All Now</button>
        </form>
        <?php else: ?>
        <p>No pending fines found.</p>
        <?php endif; ?>
    </main>


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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section contact-info">
                    <h4>Contact Info</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Police Headquarters, Colombo 01, Sri Lanka</p>
                    <p><i class="fas fa-phone-alt"></i> +94 11 271 7711</p>
                    <p><i class="fas fa-envelope"></i> info@policefine.lk</p>
                </div>
                <div class="footer-section social">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="https://facebook.com/policefine"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/policefine"><i class="fab fa-twitter"></i></a>
                        <a href="https://linkedin.com/policefine"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://instagram.com/policefine"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom" style="text-align:center; margin-top: 20px;">
                <p>&copy; 2025 Police Fine System. All rights reserved.</p>
                <p>Powered by |Sri Lanka Police Department|</p>
            </div>
        </div>
    </footer>
</body>
</html>
