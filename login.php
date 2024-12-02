<?php
require 'db.php';
require 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hash);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['message'] = "Account Login successfully!";
        $_SESSION['action'] = 'login';
        $_SESSION['action'] = 'register';
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
            <h2>Login</h2>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>

            <button type="submit">Log in</button>
        </form>
    </div>
</body>

</html>