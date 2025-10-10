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
    <title>Privacy Policy - Police Fine System</title>
    <link rel="stylesheet" href="privacy_policy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="Images/Logo.png" />
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-left">
                <div class="header-logo">
                    <img src="Images/Logo.png" alt="Police Logo">
                    <span data-lang-key="systemTitle">Police Fine System</span>
                </div>
                <nav class="header-nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php #aboutUsSection">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="privacy_policy.php" class="active">Privacy Policy</a></li>
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

    <main class="privacy-policy-page-wrapper">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Privacy Policy</h1>
                <p>Your privacy is important to us. This document outlines how we collect, use, and protect your information.</p>
            </div>
        </section>

        <section class="content-and-sidebar-container">
            <aside class="sidebar-nav">
                <h3>Policy Sections</h3>
                <ul>
                    <li><a href="#intro" class="active">Introduction</a></li>
                    <li><a href="#info-collection">Information We Collect</a></li>
                    <li><a href="#info-usage">How We Use Your Info</a></li>
                    <li><a href="#log-cookies">Log Files & Cookies</a></li>
                    <li><a href="#third-party">Third-Party Disclosures</a></li>
                    <li><a href="#data-rights">Your Data Rights</a></li>
                    <li><a href="#children">Children's Information</a></li>
                    <li><a href="#changes">Changes to Policy</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </aside>

            <article class="privacy-content-article">
                <p class="intro-paragraph" id="intro">At the Police Fine System, accessible from policefine.lk, your privacy is a top priority. This Privacy Policy outlines the types of information we collect and how it's used and protected when you interact with our services.</p>
                <p>By using our website, you consent to the terms of this Privacy Policy.</p>

                <h2 id="info-collection">1. Information We Collect</h2>
                <p>The personal information we request and the reasons for its collection will be explicitly clear to you at the point of request.</p>
                <ul>
                    <li><strong>Account Registration:</strong> When creating an account, we may collect contact details such as your name, address, email, and phone number.</li>
                    <li><strong>Direct Communication:</strong> If you contact us directly, we might receive additional information like your name, email, phone number, message content, attachments, and any other details you choose to share.</li>
                    <li><strong>Service Usage:</strong> For services like 'Pay Fines' or 'Appeal Fine', we collect relevant data including fine ID, NIC/driver's license number, and offense specifics.</li>
                    <li><strong>Payment Data:</strong> While third-party gateways process payments, we may receive confirmation of your payment status.</li>
                </ul>

                <h2 id="info-usage">2. How We Use Your Information</h2>
                <p>We use the collected information for various purposes:</p>
                <ul>
                    <li>To operate, maintain, and provide our website services.</li>
                    <li>To enhance, personalize, and expand our website's functionality.</li>
                    <li>To analyze website usage patterns and understand user behavior.</li>
                    <li>To develop new features, services, and functionalities.</li>
                    <li>To communicate with you directly or via partners, including for customer support, updates, and promotional content.</li>
                    <li>To prevent and detect fraudulent activities.</li>
                    <li>To process your fine payments and appeals efficiently.</li>
                    <li>To ensure compliance with all applicable legal and regulatory requirements.</li>
                </ul>

                <h2 id="log-cookies">3. Log Files & Cookies</h2>
                <h3>Log Files:</h3>
                <p>The Police Fine System utilizes standard log files, a common practice among hosting services for analytics. These files record visitor information such as IP addresses, browser types, ISP, date/time stamps, referring/exit pages, and click counts. This data is not linked to personally identifiable information and is used for trend analysis, site administration, tracking user movement, and demographic insights.</p>
                <h3>Cookies:</h3>
                <p>Like most websites, we use 'cookies'. These small data files store visitor preferences and track accessed pages. This information helps us optimize your experience by customizing web content based on your browser type and other relevant data.</p>

                <h2 id="third-party">4. Third-Party Disclosures</h2>
                <p>This Privacy Policy applies solely to our website. It does not extend to other advertisers or third-party websites. We advise you to consult the respective Privacy Policies of these third-party services for detailed information on their practices and how to opt-out of certain options.</p>
                <p>You have the option to disable cookies through your individual browser settings. Specific instructions for managing cookies can be found on your browser's official website.</p>

                <h2 id="data-rights">5. Your Data Protection Rights</h2>
                <p>We are committed to ensuring you are fully aware of your data protection rights. As a user, you are entitled to the following:</p>
                <ul>
                    <li><strong>Right to Access:</strong> You can request copies of your personal data. A small administrative fee may apply.</li>
                    <li><strong>Right to Rectification:</strong> You can request corrections to inaccurate information or completion of incomplete data.</li>
                    <li><strong>Right to Erasure:</strong> Under certain conditions, you can request the deletion of your personal data.</li>
                    <li><strong>Right to Restrict Processing:</strong> Under certain conditions, you can request that we limit the processing of your personal data.</li>
                    <li><strong>Right to Object to Processing:</strong> Under certain conditions, you can object to our processing of your personal data.</li>
                    <li><strong>Right to Data Portability:</strong> Under certain conditions, you can request the transfer of your collected data to another organization or directly to you.</li>
                </ul>
                <p>We will respond to your request within one month. To exercise any of these rights, please contact us using the details below.</p>

                <h2 id="children">6. Children's Information</h2>
                <p>Protecting children online is a significant priority for us. We encourage parents and guardians to actively observe, participate in, and guide their children's internet activities.</p>
                <p>The Police Fine System does not knowingly collect Personally Identifiable Information from children under 13. If you believe your child has provided such information on our website, please contact us immediately. We will promptly make every effort to remove such data from our records.</p>

                <h2 id="changes">7. Changes to This Policy</h2>
                <p>This Privacy Policy may be updated periodically. We advise you to review this page regularly for any changes. All changes become effective immediately upon being posted on this page. We will notify you of any updates by publishing the new Privacy Policy here.</p>

                <h2 id="contact">8. Contact Us</h2>
                <p>For any questions or suggestions regarding our Privacy Policy, please feel free to reach out:</p>
                <ul>
                    <li><strong>Email:</strong> info@policefine.lk</li>
                    <li><strong>Phone:</strong> +94 11 271 7711</li>
                    <li><strong>Address:</strong> Police Headquarters, Colombo 01, Sri Lanka</li>
                </ul>
            </article>
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
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
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
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('.privacy-content-article h2');
            const navLinks = document.querySelectorAll('.sidebar-nav ul li a');

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50% 0px', // Highlight when section hits middle of viewport
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Remove active class from all links
                        navLinks.forEach(link => link.classList.remove('active'));
                        // Add active class to the current section's link
                        const id = entry.target.id;
                        const correspondingLink = document.querySelector(`.sidebar-nav ul li a[href="#${id}"]`);
                        if (correspondingLink) {
                            correspondingLink.classList.add('active');
                        }
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });

            // Smooth scroll for sidebar links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    document.querySelector(targetId).scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Update active class immediately on click
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Set initial active state for the first section
            if (navLinks.length > 0) {
                navLinks[0].classList.add('active');
            }
        });
    </script>
</body>
</html>