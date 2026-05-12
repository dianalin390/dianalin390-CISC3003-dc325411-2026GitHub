<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario C - User System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>User Registration & Login System</h1>
        <?php if(isset($_SESSION['user_id'])): ?>
            <p>You are logged in! <a href="php/dashboard.php">Go to Dashboard</a></p>
            <p><a href="php/logout.php">Logout</a></p>
        <?php else: ?>
            <p><a href="php/register.php">Sign Up</a> | <a href="php/login.php">Login</a></p>
        <?php endif; ?>
    </div>

    <!-- 教授要求的必填頁腳 -->
    <footer>
        CISC3003 Web Programming: Lin Cho Kio + DC325411 + 2026
    </footer>
</body>
</html>