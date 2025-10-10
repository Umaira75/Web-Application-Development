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
    <title>Police Fine System - Contact Us</title>
    <link rel="stylesheet" href="contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        <li><a href="index.php #aboutUsSection">About Us</a></li>
                        <li><a href="contact.php" class="active">Contact Us</a></li>
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
        <section class="hero-section contact-hero">
            <div class="container">
                <h1>Get in Touch with Us</h1>
                <p>We're here to help! Reach out to us through the following channels for assistance, inquiries, or feedback regarding your police fines.</p>
            </div>
        </section>

        <section class="contact-details-section">
            <div class="container">
                <div class="contact-card">
                    <i class="fas fa-phone-alt icon"></i>
                    <h3>Call Us</h3>
                    <p>For immediate assistance or general inquiries, please call our support hotline.</p>
                    <p><strong>Hotline:</strong> +94 11 271 7711</p>
                    <p><strong>Emergency:</strong> 119</p>
                    <a href="tel:+94 11 271 7711" class="btn btn-primary"><i class="fas fa-phone-volume"></i> Call Now</a>
                </div>
                <div class="contact-card">
                    <i class="fas fa-envelope icon"></i>
                    <h3>Email Us</h3>
                    <p>Send us your questions or detailed concerns via email. We aim to respond within 24 hours.</p>
                    <p><strong>General Inquiries:</strong> info@policefine.lk</p>
                    <p><strong>Support:</strong> support@policefine.lk</p>
                    <a href="mailto:info@policefine.lk" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Email</a>
                </div>
                <div class="contact-card">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <h3>Visit Us</h3>
                    <p>If you prefer in-person support, find our main office location below.</p>
                    <p><strong>Address:</strong> Police Headquarters, Colombo 01, Sri Lanka</p>
                    <p><strong>Working Hours:</strong> Mon-Sun, 24 hours</p>
                    <a href="https://maps.app.goo.gl/example" target="_blank" class="btn btn-primary"><i class="fas fa-location-arrow"></i> Get Directions</a>
                </div>
            </div>
        </section>

        <section class="contact-form-section">
            <div class="container">
                <h2>Send Us a Message</h2>
                <p>Have a specific question or feedback? Fill out the form below and we'll get back to you as soon as possible.</p>
                <form class="contact-form" action="save_message.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                    <div class="form-group full-width">
                        <button type="submit" class="btn btn-submit">Send Message</button>
                    </div>
                </form>
            </div>
        </section>

        <section class="faq-promo-section">
            <div class="container">
                <div class="faq-promo-content">
                    <h3>Still Have Questions?</h3>
                    <p>Check out our Frequently Asked Questions section for quick answers to common queries.</p>
                    <a href="faq.php" class="btn btn-outline">View FAQs</a>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pay_fines.php">Pay Fines</a></li>
                        <li><a href="appeals.php">Appeal Fine</a></li>
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
</body>
</html>
