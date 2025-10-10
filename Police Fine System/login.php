<?php
session_start();
include('dbconnect.php');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Valid login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'user') {
                header("Location: user_home.php");
                exit();
            } elseif ($user['role'] === 'police') {
                header("Location: police_home.php");
                exit();
            } else {
                echo "Unknown role detected.";
            }
        } else {
            echo "<script>alert('Invalid password.'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Police Fine System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="Images/Logo.png" />
</head>
<body>

    <!-- Header Start -->
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
                        <li><a href="login.php" class="active">Login</a></li>
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

    <main>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-left">
                <h2>Hello!</h2>
                <p>Sign in to your account</p>
                <form action="login.php" method="POST">
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <button type="submit" class="login-btn">Sign In</button>
                    <p class="create-account">Don't have an account? <a href="#" onclick="openRegisterPopup()"> Register</a></p>    
                <!-- Register Selection Modal -->
                <div id="registerPopup" class="modal-overlay" style="display:none;">
                    <div class="modal-content">
                        <h2>Select Registration Type</h2>
                        <div class="modal-buttons">
                            <button onclick="window.location.href='user_register.php'">User Register</button>
                            <button onclick="window.location.href='police_register.php'">Police Register</button>
                        </div>
                        <span class="modal-close" onclick="closeRegisterPopup()">&times;</span>
                    </div>
                </div>
                </form>
            </div>
            <div class="login-right">
                <h2>Welcome Back!</h2>
                <p>The Police Fine System is an efficient, secure platform designed to modernize traffic fine management and payments. It enables citizens to view, contest, and pay fines online while providing law enforcement with reliable tools to track violations, process appeals, and maintain accurate records..</p>
            </div>
        </div>
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
                        <a href="https://facebook.com/policefine"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/policefine"><i class="fab fa-twitter"></i></a>
                        <a href="https://linkedin.com/policefine"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://instagram.com/policefine"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Police Fine System. All rights reserved.</p>
                <p>Powered by |Government/Police Authority Name|</p>
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

        function openRegisterPopup() {
            document.getElementById("registerPopup").style.display = "flex";
        }

        function closeRegisterPopup() {
            document.getElementById("registerPopup").style.display = "none";
        }
    </script>
</body>
</html>
