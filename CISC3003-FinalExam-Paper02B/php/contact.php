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

$to = 'lin20041115@gmail.com';
$emailSubject = "Contact Form: $subject";
$emailBody = "
Name: $name<br>
Email: $email<br>
Message: $message
";

$sent = sendEmail($to, $emailSubject, $emailBody, $email, $name);

if ($sent) {
    header('Location: ../php/success.php');
} else {
    header('Location: ../index.php?error=failed');
}
exit;