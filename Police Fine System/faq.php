<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Fine System - FAQ</title>
    <link rel="stylesheet" href="faq.css">
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
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="faq.php" class="active">FAQ</a></li>
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
        <section class="hero-section faq-hero">
            <div class="container">
                <h1>Frequently Asked Questions</h1>
                <p>Find quick answers to the most common questions about the Police Fine System, including how to pay fines, appeal violations, and general inquiries.</p>
            </div>
        </section>

        <section class="faq-content-section">
            <div class="container">
                <div class="faq-category">
                    <h2>General Questions</h2>
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">
                                How does the Police Fine System work?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                The Police Fine System is an online platform launched by the Sri Lanka Police to modernize traffic fine management. It allows citizens to easily inquire, view, and pay their police violations securely from anywhere, providing a transparent and efficient service.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Is my personal information secure on this platform?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Yes, we utilize advanced encryption and security protocols to protect your personal and financial information. Our system is designed with robust security measures to ensure your peace of mind.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Is the service available 24/7?  
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Yes, the online system is available at any time for checking fines, paying, or submitting appeals.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                What if I encounter technical issues while using the system?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                If you experience any technical difficulties, please refer to our "Contact Us" page for support options, including our support email and hotline number. Our team is ready to assist you.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-category">
                    <h2>Fine Inquiry and Payment</h2>
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">
                                How can I inquire about a fine?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                You can check your fines by going to the "Pay Fines" page after logging in. All fines related to your account will be displayed there automatically.


                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                What payment methods are accepted?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                We accept payments through credit and debit cards. Please enter your card details on the "Pay Fines" page to complete the transaction securely.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Can I get a refund after paying my fine?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Fines are non-refundable. If you believe the fine was issued in error, you must file an appeal before making the payment.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Can I pay my fine in installments?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                No. Fines must be paid in full as a single payment. Partial payments are not accepted.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                How long does it take for a payment to be processed?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Payments are processed immediately. You can check your fine details and payment status directly in your account on the website after payment.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-category">
                    <h2>Fine Appeal Process</h2>
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">
                                How do I appeal a traffic fine?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Visit the "Appeal Fine" section on our website, fill out the form with your details and reason for appeal, and submit it. Your request will be reviewed by the relevant authorities, and you’ll be notified of the outcome.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Is there a fee for submitting an appeal?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                No. Submitting an appeal for a traffic fine is free of charge. However, if your appeal is unsuccessful, the original fine must still be paid within the stipulated time to avoid additional penalties.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                How long does the appeal process take?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                The appeal review process can vary depending on the complexity of the case and the volume of appeals. You will be notified of the status and outcome of your appeal via the contact information provided.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-category">
                    <h2>Traffic Violation Types</h2>
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">
                                What are the common types of traffic violations covered by this system?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                The system covers various types of traffic violations, including but not limited to speeding, parking violations, disobeying traffic signals, and improper lane changes. Each violation is typically identified by a specific code.
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">
                                Where can I find details about specific violation codes and their penalties?
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-body">
                                Details about specific violation codes and their corresponding penalties are available in the "View Fine Details" section after you inquire about a fine, or through official traffic law publications.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-promo-section">
            <div class="container">
                <div class="contact-promo-content">
                    <h3>Still Can't Find Your Answer?</h3>
                    <p>If your question isn't answered here, don't hesitate to reach out to our support team.</p>
                    <a href="contact.php" class="btn btn-outline">Contact Us</a>
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
                        <li><a href="contact.php">Contact Us</a></li>
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
        document.addEventListener('DOMContentLoaded', function() {
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const accordionItem = header.parentElement;
                    const accordionBody = header.nextElementSibling;
                    const icon = header.querySelector('i');

                    // Close all other open accordions in the same category
                    const currentCategory = accordionItem.closest('.faq-category');
                    currentCategory.querySelectorAll('.accordion-item.active').forEach(item => {
                        if (item !== accordionItem) { // Only close others
                            item.classList.remove('active');
                            item.querySelector('.accordion-body').style.maxHeight = null;
                            item.querySelector('.accordion-header i').classList.remove('fa-chevron-up');
                            item.querySelector('.accordion-header i').classList.add('fa-chevron-down');
                        }
                    });

                    // Toggle current accordion
                    accordionItem.classList.toggle('active');
                    if (accordionItem.classList.contains('active')) {
                        accordionBody.style.maxHeight = accordionBody.scrollHeight + "px"; // Set to actual scroll height
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    } else {
                        accordionBody.style.maxHeight = null; // Collapse
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                });
            });
        });
    </script>
</body>
</html>
