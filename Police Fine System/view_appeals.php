<?php
session_start();
include("dbconnect.php");

// Check if the user is logged in and is a police officer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'police') {
    echo "<script>
        alert('You must be logged in as a police to access this page.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

$isLoggedIn = true;
$fullName = $_SESSION['full_name'] ?? null;
$police_id = $_SESSION['user_id'];

// Use prepared statement to safely fetch appeals
$stmt = $conn->prepare("SELECT * FROM appeals WHERE police_id = ? ORDER BY submitted_at DESC");
$stmt->bind_param("i", $police_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Police Fine System - View Appeals</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="view_appeals.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="icon" href="Images/Logo.png" />
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="header-logo">
                    <img src="Images/Logo.png" alt="Police Logo" />
                    <span>Police Fine System</span>
                </div>
                <nav class="header-nav">
                    <ul>
                        <li><a href="police_home.php">Home</a></li>
                        <li><a href="police_home.php #aboutUsSection">About Us</a></li>
                        <li><a href="view_appeals.php" class="active">View Appeals</a></li>
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
        <h2>Appeals Received</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="appeal-card">
                    <strong><?= htmlspecialchars($row['salutation']) ?> <?= htmlspecialchars($row['name']) ?></strong><br />
                    <strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?><br />
                    <strong>Email:</strong> <?= !empty($row['email']) ? htmlspecialchars($row['email']) : 'N/A' ?><br />
                    <strong>Message:</strong>
                    <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                    <small><strong>Submitted on:</strong> <?= htmlspecialchars($row['submitted_at']) ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No appeals received yet.</p>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section about">
                    <h4>About Police Fine System</h4>
                    <p>A joint initiative by the Sri Lanka Police to modernize and streamline the process of managing and paying traffic fines digitally.</p>
                </div>
                <div class="footer-section links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="police_home.php">Home</a></li>
                        <li><a href="police_home.php #aboutUsSection">About Us</a></li>
                        <li><a href="view_appeals.php">View Appeals</a></li>
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
            <div class="footer-bottom">
                <p>&copy; 2025 Police Fine System. All rights reserved.</p>
                <p>Powered by |Sri Lanka Police Department|</p>
            </div>
        </div>
    </footer>
</body>
</html>
