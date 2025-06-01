<?php
$host = 'localhost';
$db   = 'freelancermarket';
$user = 'root'; // OpenServer uchun odatda 'root'
$pass = 'root';     // OpenServerda parol odatda yo‘q

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bazaga ulanishda xatolik: " . $e->getMessage());
}
