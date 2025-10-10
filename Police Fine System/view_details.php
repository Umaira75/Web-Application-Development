<?php
session_start();
include("dbconnect.php");

$isLoggedIn = isset($_SESSION['user_id']);
$fullName = $isLoggedIn && isset($_SESSION['full_name']) ? $_SESSION['full_name'] : null;

// Check if the user is logged in
$user_id = $_SESSION['user_id'] ?? null;
$fullName = $_SESSION['full_name'] ?? null;

if (!$user_id) {
    echo "<script>
        alert('You must be logged in to view your details.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

$query = "
    SELECT f.id AS fine_id, f.description, f.fine_type, f.fine_amount, f.status,
           p.card_name, p.payment_date
    FROM fine f
    LEFT JOIN payment p ON f.payment_id = p.id
    WHERE f.user_id = ?
    ORDER BY f.id DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Fine System - My Fines & Payments</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="view_details.css" />
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

<h2 style="text-align:center;">My Fines & Payments</h2>

<table>
    <tr>
        <th>Fine ID</th>
        <th>Fine Type</th>
        <th>Amount (Rs.)</th>
        <th>Payment Status</th>
        <th>Payment Date</th>
        <th>Card Holder</th>
        <th>Discription</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['fine_id']); ?></td>
            <td><?php echo htmlspecialchars($row['fine_type']); ?></td>
            <td><?php echo htmlspecialchars($row['fine_amount']); ?></td>
            <td>
                <?php if ($row['status'] === 'paid'): ?>
                    <span class="paid">Paid</span>
                <?php else: ?>
                    <span class="unpaid">Not Paid</span>
                <?php endif; ?>
            </td>
            <td><?php echo $row['payment_date'] ? htmlspecialchars($row['payment_date']) : "-"; ?></td>
            <td><?php echo $row['card_name'] ? htmlspecialchars($row['card_name']) : "-"; ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>


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
