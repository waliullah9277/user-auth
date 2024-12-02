<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav class="menu-bar">
            <div class="logo">
                <h2 class="logo_design"><a href="home.php">REVISION</a></h2>
            </div>
            <ul>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php else: ?>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; 2024 Waliullah. All rights reserved.</p>
    </footer>
</body>

</html>