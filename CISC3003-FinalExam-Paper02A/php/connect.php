<?php
// Database connection for Scenario A
// A.09: Database & Table created via phpMyAdmin

$host = 'localhost';
$dbname = 'cisc3003_scenarioA';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($conn, 'utf8');
?>