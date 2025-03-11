<?php

$host = 'localhost';
$db   = 'karyawan_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// get_employees.php
header('Content-Type: application/json');

require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM employees");
$data = $stmt->fetchAll();

echo json_encode(["data" => $data]);
?>
