<?php
// Start the session
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Fine System - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css" />
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
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
                        <li><a href="#aboutUsSection">About Us</a></li>
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
        <section class="hero">
            <div class="hero-content">
                <h1>Make Your Fine Here</h1>
                <p>Easily inquire, view, and pay your police violations securely from anywhere.</p>
                <?php if ($isLoggedIn): ?>
                <p>Welcome Home</p>
                <?php else: ?>
                <a href="#" onclick="openRegisterPopup()"><i class="fas fa-user-plus"></i> Register</a>
                <?php endif; ?>
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

            </div>
        </section>

        <section class="main-sections">
            <div class="container">
                <h2 class="section-title">Quick Actions</h2>
                <div class="action-cards-grid">
                    <div class="action-card">
                        <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                        <h3>Pay Your Fines</h3>
                        <p>Settle your outstanding violations quickly and securely online using various payment methods.</p>
                        <a href="pay_fines.php" class="cta-button">Pay Now</a>
                    </div>
                    <div class="action-card">
                        <div class="icon"><i class="fas fa-info-circle"></i></div>
                        <h3>View Fine Details</h3>
                        <p>Access comprehensive information about your fines, including date, location, and violation type.</p>
                        <a href="view_details.php" class="cta-button">View Details</a>
                    </div>
                    <div class="action-card">
                        <div class="icon"><i class="fas fa-edit"></i></div>
                        <h3>Appeal a Fine</h3>
                        <p>Submit an appeal if you believe a fine was issued in error or requires review.</p>
                        <a href="appeals.php" class="cta-button red">Appeal Now</a>
                    </div>
                    <div class="action-card">
                        <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                        <h3>Fine FAQs</h3>
                        <p>Find answers to frequently asked questions regarding fines, payments, and procedures.</p>
                        <a href="faq.php" class="cta-button">Read FAQs</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-us-section" id="aboutUsSection">
            <div class="container">
                <h2>About the Police Fine System</h2>
                <p>The <strong>Police Fine System</strong> is an initiative by the Sri Lanka Police to modernize and streamline the process of managing traffic violations and other regulatory fines. Our goal is to provide a transparent, efficient, and user-friendly platform for citizens to access information about their fines and fulfill their obligations.</p>
                <p>We are committed to enhancing public convenience and promoting road safety across Sri Lanka. This online portal aims to reduce the need for physical visits to police stations, offering a secure and accessible way to handle fines from the comfort of your home or on the go.</p>
                <p>This system is designed to serve all citizens, ensuring fair and consistent application of law while simplifying administrative procedures. We continuously work to improve our services and uphold the highest standards of integrity and security.</p>
            </div>
        </section>

        <section class="info-section">
            <div class="container">
                <h2 class="section-title">How It Works & Important Info</h2>
                <div class="info-grid">
                    <div class="info-block">
                        <h3><i class="fas fa-cogs"></i> How Our System Works</h3>
                        <p>Our online fine management system provides a seamless experience for citizens to interact with law enforcement regarding violations. From inquiry to payment or appeal, every step is designed for clarity and efficiency.</p>
                    </div>
                    <div class="info-block">
                        <h3><i class="fas fa-shield-alt"></i> Data Security & Privacy</h3>
                        <p>Your personal and financial information is protected with advanced encryption and security protocols. We adhere to strict data privacy regulations to ensure your peace of mind.</p>
                    </div>
                    <div class="info-block">
                        <h3><i class="fas fa-file-invoice-dollar"></i> Types of Police Fines</h3>
                        <p>This system handles various types of police fines including traffic violations (speeding, parking, red light) and other regulatory penalties issued by the police. Ensure you provide the correct identifier for inquiry.</p>
                    </div>
                </div>
            </div>
        </section>
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

        function openRegisterPopup() {
            document.getElementById("registerPopup").style.display = "flex";
        }

        function closeRegisterPopup() {
            document.getElementById("registerPopup").style.display = "none";
        }
    </script>
</body>
</html>
