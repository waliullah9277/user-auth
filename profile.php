<?php
require 'db.php';
require 'index.php';

// $login_success_message = "";
// if (isset($_SESSION['login_success']) && !isset($_SESSION['user_id'])) {
//     $login_success_message = $_SESSION['login_success'];
//     unset($_SESSION['login_success']); // Clear the message after displaying
//     header("Location: login.php");
//     exit();
// }

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$stmt = $conn->prepare("SELECT name, username, email, phone FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($name, $username, $email, $phone);
$stmt->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <div class="profile_container">
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green;"><?= $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <h1>Welcome, <?php echo $name; ?>!</h1>
        <h4>Username: <?php echo $username; ?></h4>
        <h4>Email: <?php echo $email; ?></h4>
        <h4>Phone: <?php echo $phone; ?></h4>
    </div>
</body>

</html>