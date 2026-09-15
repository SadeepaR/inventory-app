<?php
require_once 'db.php';
header('Content-Type: application/json');

$query = trim($_GET['term'] ?? '');

if (empty($query)) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT id, product_name, price FROM products WHERE product_name LIKE ? LIMIT 5");
$stmt->execute(["%$query%"]);
$results = $stmt->fetchAll();

echo json_encode($results);