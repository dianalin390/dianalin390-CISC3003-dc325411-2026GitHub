<?php 
include 'connect.php';
if(isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    header("Location: login.php");
}
?>

<form method="post">
    <h1>Set New Password</h1>
    <input type="password" name="password" required>
    <button>Update Password</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
    $stmt->execute([$new, $token]);
    echo "<p>Password updated! <a href='login.php'>Login</a></p>";
}
?>