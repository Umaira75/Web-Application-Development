<?php
session_start();
include("dbconnect.php");

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;

// Ensure user is logged in and is a regular user (not police)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    echo "<script>
        alert('You must be logged in as a user to access this page.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// Fetch police officers
$police_officers = $conn->query("SELECT id, fullname FROM users WHERE role = 'police'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Fine System - Appeals</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="appeals.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <li><a href="user_home.php">Home</a></li>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
                        <li><a href="appeals.php" class="active">Appeal Fine</a></li>
                        <li><a href="user_home.php #aboutUsSection">About Us</a></li>
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

<main class="main-content-area">
    <div class="form-content-wrapper">
        <form action="submit_appeal.php" method="POST" enctype="multipart/form-data">
            <label for="police_id" class="required-label">Select Police Officer</label>
            <select name="police_id" id="police_id" required>
                <option value="">Select officer</option>
                <?php while ($row = $police_officers->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['fullname']) ?></option>
                <?php endwhile; ?>
            </select>

            <label for="salutation" class="required-label">Salutation</label>
            <select id="salutation" name="salutation" required>
                <option value="">Select an option</option>
                <option>Mr</option>
                <option>Ms</option>
                <option>Mdm</option>
                <option>Dr</option>
            </select>

            <label for="name" class="required-label">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email (optional)</label>
            <input type="email" id="email" name="email">

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="xxx xxx xxx" pattern="\d{9}" maxlength="9" required>

            <label for="message" class="required-label">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <input type="hidden" name="user_id" value="<?= isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : '' ?>">

            <button type="submit" class="submit-btn">Submit now</button>
        </form>
    </div>
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
                        <li><a href="user_home.php">Home</a></li>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
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
            <div class="footer-bottom">
                <p>&copy; 2025 Police Fine System. All rights reserved.</p>
                <p>Powered by |Sri Lanka Police Department|</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>