<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php';

$query = "SELECT 
            p.id AS product_id,
            p.product_name,
            p.category,
            p.price,
            s.supplier_name,
            s.contact_info
          FROM products p
          LEFT JOIN suppliers s ON p.supplier_id = s.id
          ORDER BY p.id DESC";

$records = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Join - EFL Logistics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <a href="dashboard.php" class="brand">EFL Inventory</a>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="products_list.php">Products</a>
            <a href="product_suppliers.php">Suppliers Join</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>
<main class="container">
    <div class="card">
        <h2>Product & Supplier Direct Directory (JOIN Query)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Supplier Name</th>
                    <th>Supplier Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($records) > 0): ?>
                    <?php foreach ($records as $r): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($r['product_name']); ?></strong></td>
                            <td><?= htmlspecialchars($r['category']); ?></td>
                            <td>$<?= number_format($r['price'], 2); ?></td>
                            <td><?= htmlspecialchars($r['supplier_name'] ?? 'Unassigned'); ?></td>
                            <td><?= htmlspecialchars($r['contact_info'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No records available.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<footer class="footer"><p>&copy; EFL Web System.</p></footer>
</body>
</html>