<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: products_list.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) { die("Product not found."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $price    = $_POST['price'];
    $quantity = $_POST['quantity'];
    $desc     = trim($_POST['description']);
    $supplier = !empty($_POST['supplier_id']) ? $_POST['supplier_id'] : null;

    $update = $pdo->prepare("UPDATE products SET product_name=?, category=?, price=?, quantity=?, description=?, supplier_id=? WHERE id=?");
    $update->execute([$name, $category, $price, $quantity, $desc, $supplier, $id]);
    header("Location: products_list.php");
    exit;
}
$suppliers = $pdo->query("SELECT id, supplier_name FROM suppliers")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - EFL</title>
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
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>
<main class="container">
    <div class="card">
        <h2>Edit Product</h2>
        <div id="clientErrors" class="alert alert-error" style="display: none;"></div>
        <form id="productForm" action="edit_product.php?id=<?= $id; ?>" method="POST">
            <div class="form-group">
                <label for="product_name">Product Name *</label>
                <input type="text" name="product_name" id="product_name" value="<?= htmlspecialchars($product['product_name']); ?>">
            </div>
            <div class="form-group">
                <label for="category">Category *</label>
                <input type="text" name="category" id="category" value="<?= htmlspecialchars($product['category']); ?>">
            </div>
            <div class="form-group">
                <label for="price">Price *</label>
                <input type="number" step="0.01" name="price" id="price" value="<?= $product['price']; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity *</label>
                <input type="number" name="quantity" id="quantity" value="<?= $product['quantity']; ?>">
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id">
                    <option value="">-- No Supplier --</option>
                    <?php foreach ($suppliers as $s): ?>
                        <option value="<?= $s['id']; ?>" <?= ($s['id'] == $product['supplier_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($s['supplier_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"><?= htmlspecialchars($product['description']); ?></textarea>
            </div>
            <button type="submit" class="btn">Update Product</button>
        </form>
    </div>
</main>
<footer class="footer"><p>&copy; EFL Web System.</p></footer>
<script src="main.js"></script>
</body>
</html>