<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Create Account</h1>
        <form method="post" id="signupForm">
            <div>
                <label>Full Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" id="email" required>
                <div id="emailCheck"></div>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <footer>
        CISC3003 Web Programming: LIN CHO KIO + DC325411 + 2026
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // C.02 伺服器端驗證
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));

    // C.06 檢查郵箱是否重複
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if($check->rowCount() > 0) {
        echo "<script>alert('Email already exists');</script>";
        exit;
    }

    // C.03 存入資料庫 (prepared statement 防SQL注入)
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, token) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $token]);

    // C.08 發送驗證郵件
    require '../vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lin20041115@gmail.com';
    $mail->Password = 'zhduycbwuamdcdaw';
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('lin20041115@gmail.com', 'CISC3003 System');
    $mail->addAddress($email);
    $mail->Subject = 'Verify Your Email';
    $mail->Body = "Click to verify: http://localhost/CISC3003-FinalExam-Paper02C/php/verify_email.php?token=$token";

    $mail->send();
    echo "<script>alert('Registered! Please check your email to verify.'); window.location='login.php';</script>";
}
?>