<?php
// product_details.php - Detailed View & Order Submission
require_once 'db.php';
require_once 'header.php';

// 1. Get Product ID from URL parameter
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
$orderSuccess = false;
$orderError = '';

if ($product_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $product_id]);
        $product = $stmt->fetch();
    } catch (PDOException $e) {
        $product = null;
    }
}

// Handle Direct Order Request (Mandatory Functionality)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (!isset($_SESSION['user_id'])) {
        $orderError = "Please login to place an order.";
    } else {
        $user_id = $_SESSION['user_id'];
        $total_amount = $product['price'];

        try {
            $orderStmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (:user_id, :total_amount, 'Pending')");
            $orderStmt->execute([
                'user_id' => $user_id,
                'total_amount' => $total_amount
            ]);
            $orderSuccess = true;
        } catch (PDOException $e) {
            $orderError = "Failed to place order. Please try again.";
        }
    }
}
?>

<?php if ($product): ?>
    <div class="product-details-container">
        <div class="product-details-img">
            <img src="images/<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['title']); ?>">
        </div>
        <div class="product-details-info">
            <h2><?= htmlspecialchars($product['title']); ?></h2>
            <p class="category-badge"><?= htmlspecialchars($product['category']); ?></p>
            <p class="price-tag">ETB <?= number_format($product['price'], 2); ?></p>
            <p class="full-description"><?= htmlspecialchars($product['description']); ?></p>

            <?php if ($orderSuccess): ?>
                <div class="alert alert-success">
                    ✅ Order placed successfully! Status: Pending.
                </div>
            <?php endif; ?>

            <?php if (!empty($orderError)): ?>
                <div class="alert alert-danger">
                    ⚠️ <?= htmlspecialchars($orderError); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="order-form">
                <input type="hidden" name="place_order" value="1">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button type="submit" class="btn-primary btn-large">Place Order Now</button>
                <?php else: ?>
                    <a href="login.php" class="btn-secondary btn-large">Login to Purchase</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="error-box">
        <h2>Product Not Found</h2>
        <p>The product you are looking for does not exist.</p>
        <a href="products.php" class="btn-primary">Back to Products</a>
    </div>
<?php endif; ?>

<?php require_once 'footer.php'; ?>