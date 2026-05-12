<?php 
include 'connect.php';
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?=$_SESSION['user_name']?>!</h1>
        <h3>Your Account Dashboard</h3>
        <p>Thank you for using our system.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>

    <footer>
        CISC3003 Web Programming: LIN CHO KIO +DC325411 + 2026
    </footer>
</body>
</html>