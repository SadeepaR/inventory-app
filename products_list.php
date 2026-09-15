<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - EFL</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Product Catalog</h2>
            <a href="add_product.php" class="btn">+ Add Product</a>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="productSearch">Product Search</label>
            <input type="text" id="productSearch" placeholder="Type product name..." autocomplete="off">
            <div id="searchResults" class="search-results" style="display: none;"></div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td><?= $p['id']; ?></td>
                            <td><?= htmlspecialchars($p['product_name']); ?></td>
                            <td><?= htmlspecialchars($p['category']); ?></td>
                            <td>$<?= number_format($p['price'], 2); ?></td>
                            <td><?= $p['quantity']; ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $p['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete_product.php?id=<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No products found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<footer class="footer"><p>&copy; EFL Web System.</p></footer>
<script src="main.js"></script>
</body>
</html>