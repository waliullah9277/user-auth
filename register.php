<?php
require 'db.php';
require 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check for duplicate username
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Username already exists. Please choose a different username.";
        header("Location: register.php");
        exit();
    }

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Email already exists. Please use a different email address.";
        header("Location: register.php");
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match. Please try again.";
        header("Location: register.php");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Account created successfully!";
            $_SESSION['action'] = 'register';
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
            header("Location: register.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="form_container">
        <?php if (isset($_SESSION['message'])): ?>
            <?php
            $color = (isset($_SESSION['action']) && $_SESSION['action'] === 'register') ? 'green' : 'red';
            ?>
            <p style="color: <?= $color; ?>;"><?= $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message'], $_SESSION['action']); ?>
        <?php endif; ?>
        <form method="POST" action="">
            <h2>Register</h2>

            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>