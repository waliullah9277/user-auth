<?php
session_start();
session_unset();
$_SESSION['message'] = "Account logged out successfully!";
$_SESSION['action'] = 'logout';
header("Location: login.php");
exit();
?>

