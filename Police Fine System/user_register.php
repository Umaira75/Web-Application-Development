<?php
session_start();
include('dbconnect.php');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $id_type = $conn->real_escape_string($_POST['id_type']);
    $id_no = $conn->real_escape_string($_POST['id_no']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    if ($password !== $confirm_password) {
        echo "
<script>alert('Passwords do not match.');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkQuery);
        if ($result && $result->num_rows > 0) {
            echo "
<script>alert('Email already registered. Please use a different email.');</script>";
        } else {
            $sql = "INSERT INTO users (fullname, id_type, id_no, email, phone, password, role)
                    VALUES ('$fullname', '$id_type', '$id_no', '$email', '$phone', '$hashed_password', '$role')";
            if ($conn->query($sql) === TRUE) {
                echo "
<script>alert('User registration successful!'); window.location.href = 'login.php';</script>";
            } else {
                echo "
<script>alert('Error: " . $conn->error . "');</script>";
            }
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Police Fine System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css" />
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
                        <li><a href="user_register.php" class="active">Register</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <a href="login.php" class="header-icon-link"><i class="fas fa-user-circle"></i> Login</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="left-panel">
            <h1>Police Fine System</h1>
            <p>Create your account to manage and pay fines efficiently.</p>
        </div>

        <div class="form-container">
            <form method="POST" action="user_register.php">
                <h2>User Register</h2>
                <input type="text" name="fullname" placeholder="Full Name" pattern="^[A-Za-z ]+$" titile="Give in Letters" required>

                <select id="id_type" name="id_type" required>
                    <option value="" disabled selected>Select an ID Type</option>
                    <option value="NIC" style="color: black;">NIC</option>
                    <option value="Passport" style="color: black;">Passport</option>
                    <option value="Driving Licence" style="color: black;">Driving Licence</option>
                </select>

                <input type="text" name="id_no" placeholder="ID Number" pattern="^[A-Za-z0-9]{5,20}$" title="Enter a valid ID number (5�20 letters or digits)"  required>
                <input type="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" title="Enter a valid email address" required>
                <input type="tel" name="phone" placeholder="Phone Number" pattern="\d{10}" title="Enter a valid 10-digit phone number"  required>
                <input type="password" name="password" placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Minimum 8 characters, at least one letter and one number" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Re-enter the password" required>
                <button type="submit" name="submit" class="btn">Register</button>
                <p><a href="login.php">Already have an account? Login</a></p>
            </form>


        </div>
    </div>

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
</body>
</html>
