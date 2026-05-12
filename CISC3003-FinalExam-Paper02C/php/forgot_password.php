<?php include 'connect.php'; ?>
<form method="post">
    <h1>Reset Password</h1>
    <input type="email" name="email" required>
    <button>Send Reset Link</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    $expire = date("Y-m-d H:i:s", strtotime("+15 minutes"));

    $stmt = $pdo->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE email=?");
    $stmt->execute([$token, $expire, $email]);

    // 寄送重置郵件
    require '../vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lin20041115@gmail.com';
    $mail->Password = 'zhduycbwuamdcdaw';
    $mail->SMTPSecure = PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('lin20041115@gmail.com', 'CISC3003');
    $mail->addAddress($email);
    $mail->Subject = 'Password Reset';
    $mail->Body = "Reset: http://localhost/CISC3003-FinalExam-Paper02C/php/reset_password.php?token=$token";
    $mail->send();

    echo "<p>Reset link sent!</p>";
}
?>