<?php
// products.php - Full Products Listing with Category Filter
require_once 'db.php';
require_once 'header.php';

// Category Filter Logic
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

try {
    if (!empty($category)) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category ORDER BY id DESC");
        $stmt->execute(['category' => $category]);
    } else {
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    }
    $products = $stmt->fetchAll();

    // Fetch unique categories for the filter buttons
    $catStmt = $pdo->query("SELECT DISTINCT category FROM products");
    $categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $products = [];
    $categories = [];
}
?>

<div class="products-header">
    <h2>Our Local Product Collection</h2>
    <p>Discover high-quality, authentic Ethiopian items made by local artisans.</p>
</div>

<!-- Category Filter Buttons -->
<div class="category-filter-section">
    <div class="category-filter">
        <a href="products.php" class="filter-btn <?= empty($category) ? 'active' : '' ?>">All Categories</a>
        <?php foreach ($categories as $cat): ?>
            <a href="products.php?category=<?= urlencode($cat) ?>" class="filter-btn <?= $category === $cat ? 'active' : '' ?>">
                <?= htmlspecialchars($cat) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="product-grid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="images/<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['title']); ?>" class="product-img">
                <div class="product-info">
                    <h3><?= htmlspecialchars($product['title']); ?></h3>
                    <p class="category"><?= htmlspecialchars($product['category']); ?></p>
                    <p class="price">ETB <?= number_format($product['price'], 2); ?></p>
                    <a href="product_details.php?id=<?= $product['id']; ?>" class="btn-secondary">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found in this category.</p>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>