<?php
session_start();
include('dbconnect.php'); // Make sure this file sets up $conn as your mysqli connection

// Check if police user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'police') {
    // Redirect to login if not logged in or not police
    header("Location: login.php");
    exit();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Police Fine System - Police Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="index.css" />
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
                        <li><a href="police_home.php" class="active">Home</a></li>
                        <li><a href="#aboutUsSection">About Us</a></li>
                        <li><a href="view_appeals.php">View Appeals</a></li>
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
                <h1>Issue and Manage Fines</h1>
                <p>Easily issue, manage, and track traffic fines securely from anywhere.</p>
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
                <!-- View Appeals Button -->
                <a href="view_appeals.php" class="hero-btn">
                    <i class="fas fa-file-alt"></i> View Appeals
                </a>
            </div>
        </section>

        <section class="issue-fine-section">
            <h2 style="text-align:center; margin-top: 30px;">Issue a Fine</h2>
            <form action="issue_fine.php" method="POST">
    <label for="user_id">Select User:</label>
    <select name="user_id" required>
    <option value="" disabled selected>-- Select User --</option>
    <?php
    $result = $conn->query("SELECT id, fullname, id_type, id_no FROM users WHERE role='user' ORDER BY fullname ASC");
    if ($result && $result->num_rows > 0) {
        while ($user = $result->fetch_assoc()) {
            $idInfo = "";
            if (!empty($user['id_type']) && !empty($user['id_no'])) {
                $idInfo = " (" . htmlspecialchars($user['id_type']) . " - " . htmlspecialchars($user['id_no']) . ")";
            }
            echo '<option value="' . (int)$user['id'] . '">' . htmlspecialchars($user['fullname']) . $idInfo . '</option>';
        }
    } else {
        echo '<option disabled>No users found</option>';
    }
    ?>
</select>

    <h3>Select Fines:</h3>
    <label><input type="checkbox" name="fine_types[]" value="Speeding"> Speeding - Rs.1500</label><br>
<label><input type="checkbox" name="fine_types[]" value="No Helmet"> No Helmet - Rs.1300</label><br>
<label><input type="checkbox" name="fine_types[]" value="Illegal Parking"> Illegal Parking- Rs.1200</label><br>
<label><input type="checkbox" name="fine_types[]" value="No License"> No License - Rs.1000</label><br>
<label><input type="checkbox" name="fine_types[]" value="Signal Violation"> Signal Violation - Rs.1750</label><br>
<label><input type="checkbox" name="fine_types[]" value="Overloading Vehicle"> Overloading Vehicle - Rs.1600</label><br>
<label><input type="checkbox" name="fine_types[]" value="Drunk Driving"> Drunk Driving - Rs.5000</label><br>
<label><input type="checkbox" name="fine_types[]" value="Expired Insurance"> Expired Insurance - Rs.1800</label><br>
<label><input type="checkbox" name="fine_types[]" value="Using Mobile While Driving"> Using Mobile While Driving - Rs.1000</label><br>
<label><input type="checkbox" name="fine_types[]" value="Driving Without Seatbelt"> Driving Without Seatbelt - Rs.1300</label><br>
<label><input type="checkbox" name="fine_types[]" value="Vehicle Not Registered"> Vehicle Not Registered - Rs.1200</label><br>
<label><input type="checkbox" name="fine_types[]" value="Failure to stop at pedestrian crossings"> Failure to stop at pedestrian crossings - Rs.1400</label><br>
<label><input type="checkbox" name="fine_types[]" value="Failure to stop at railway crossings"> Failure to stop at railway crossings - Rs.1400</label><br>
<label><input type="checkbox" name="fine_types[]" value="Pollution Certificate Missing"> Pollution Certificate Missing - Rs.1500</label><br>
<label><input type="checkbox" name="fine_types[]" value="Driving on Wrong Side"> Driving on Wrong Side - Rs.1000</label><br>
<label><input type="checkbox" name="fine_types[]" value="No Headlights at Night"> No Headlights at Night - Rs.1250</label><br>
<label><input type="checkbox" name="fine_types[]" value="Illegal U-turn"> Illegal U-turn - Rs.1300</label><br>
<label><input type="checkbox" name="fine_types[]" value="No Helmet (Motorcyclists)"> No Helmet (Motorcyclists) - Rs.1300</label><br>
<label><input type="checkbox" name="fine_types[]" value="Excessive emissions such as smoke"> Excessive emissions such as smoke - Rs.1600</label><br>
<label><input type="checkbox" name="fine_types[]" value="Traveling on the sidewalk"> Traveling on the sidewalk - Rs.1200</label><br>
<label><input type="checkbox" name="fine_types[]" value="Driving Without Side Mirrors"> Driving Without Side Mirrors - Rs.1250</label><br>
<label><input type="checkbox" name="fine_types[]" value="Unauthorized Racing on Public Roads"> Unauthorized Racing on Public Roads - Rs.5000</label><br>
<label><input type="checkbox" name="fine_types[]" value="Illegal Overtaking"> Illegal Overtaking - Rs.1800</label><br>


    <label>Description (optional):</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Issue Fine</button>
</form>
        </section>
    </main>

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
                        <li><a href="police_home.php">Home</a></li>
                        <li><a href="#aboutUsSection">About Us</a></li>
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
            <div class="footer-bottom" style="text-align:center; margin-top: 20px;">
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
