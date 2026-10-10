<?php
require_once 'db.php';
require_once 'header.php';

try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 3");
    $featuredProducts = $stmt->fetchAll();
} catch (PDOException $e) {
    $featuredProducts = [];
}
?>

<section class="hero">
    <div class="hero-content">
        <h1>Authentic Local Products, Directly to Your Doorstep</h1>
        <p>Explore handcrafted Ethiopian clothing, premium Yirgacheffe coffee, and traditional accessories.</p>
        <a href="products.php" class="btn-primary">Browse All Products</a>
    </div>
</section>

<section class="featured-section">
    <h2>Featured Local Products</h2>
    <div class="product-grid">
        <?php if (!empty($featuredProducts)): ?>
            <?php foreach ($featuredProducts as $product): ?>
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
            <p>No featured products available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'footer.php'; ?>