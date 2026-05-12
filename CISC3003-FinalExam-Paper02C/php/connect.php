<?php
// 資料庫連接 (使用 prepared statement 防SQL注入)
$host = 'localhost';
$dbname = 'cisc3003_final_c';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("資料庫連接失敗: " . $e->getMessage());
}
session_start();
?>