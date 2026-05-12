<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

require 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// 這是老師的格式：寄給「你自己」
$to = '你的GMAIL@gmail.com';
$email_subject = "Contact Form: $subject";
$email_body = "
Name: $name<br>
Email: $email<br>
Message: $message
";

$sent = sendEmail($to, $email_subject, $email_body, $email, $name);

// B.05 PRG 模式
if ($sent) {
    header('Location: ../success.php?msg=sent');
} else {
    header('Location: ../index.php?error=failed');
}
exit;