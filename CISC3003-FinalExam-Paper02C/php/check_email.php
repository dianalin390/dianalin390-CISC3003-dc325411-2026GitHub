<?php 
include 'connect.php';
$email = $_GET['email'];
$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);
if($stmt->rowCount() > 0) {
    echo "exists";
} else {
    echo "available";
}
?>