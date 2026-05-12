<?php
// A.05: Process submitted form data with PHP
session_start();
include 'connect.php';

if (isset($_POST['submit_form'])) {
    // Get form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $interests = isset($_POST['interests']) ? implode(', ', $_POST['interests']) : '';
    
    // A.06: Validate form data using PHP Filter Functions
    $errors = [];
    
    // Validate name
    if (empty($fullname)) {
        $errors[] = "Full name is required";
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // If errors exist
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../index.php");
        exit();
    }
    
    // ------------------------------
    // A.07: Prevent SQL Injection
    // A.08: Use Prepared Statement
    // A.10: SQL INSERT INTO statement
    // ------------------------------
    
    $insertQuery = "INSERT INTO submissions
                   (fullname, email, message, department, gender, interests)
                   VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = mysqli_prepare($conn, $insertQuery);
    
    // Bind parameters (s = string)
    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $fullname,
        $email,
        $message,
        $department,
        $gender,
        $interests
        );
    
    // Execute
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Data submitted successfully! (Secure via Prepared Statement)";
    } else {
        $_SESSION['errors'] = ["Error: " . mysqli_error($conn)];
    }
    
    // Close connections
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>