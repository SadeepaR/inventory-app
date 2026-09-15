<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EFL Logistics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-container">
        <a href="dashboard.php" class="brand">EFL Inventory</a>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="products_list.php">Products</a>
            <a href="product_suppliers.php">Supplier Mapping</a>
            <a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
        </div>
    </div>
</nav>
<main class="container">
    <div class="card">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p></p>
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="products_list.php" class="btn">Manage Products</a>
            <a href="product_suppliers.php" class="btn">View Supplier Mappings</a>
        </div>
    </div>
</main>
<footer class="footer"><p>&copy; EFL Web System.</p></footer>
</body>
</html>