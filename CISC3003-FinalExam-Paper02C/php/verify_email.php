<?php
include 'connect.php';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $pdo->prepare("UPDATE users SET email_verified=1, token=NULL WHERE token=?");
    $stmt->execute([$token]);
    header("Location: login.php?verified=1");
}
?>