<?php
// collection.php
require_once 'includes/header.php';
$categories = require 'data/categories.php';
$all_products = require 'data/products.php';

$category_id = $_GET['id'] ?? '';

if (!isset($categories[$category_id])) {
    header('Location: index.php');
    exit;
}

$category = $categories[$category_id];
$products = array_filter($all_products, function($p) use ($category_id) {
    return $p['category'] === $category_id;
});
?>

<main>
    <section class="collection-hero">
        <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="container hero-inner">
            <nav class="breadcrumb">
                <a href="index.php">Collections</a> 
                <span>/</span>
                <strong class="active"><?php echo $category['name']; ?></strong>
            </nav>
            <h1 class="collection-title"><?php echo $category['name']; ?></h1>
            <div class="collection-meta">
                <span class="dept-label">Department / <?php echo str_pad(array_search($category_id, array_keys($categories)) + 1, 2, '0', STR_PAD_LEFT); ?></span>
                <p class="collection-desc"><?php echo $category['description']; ?></p>
            </div>
        </div>
    </section>

    <div class="container">
        <section class="product-grid" style="margin-top: 4rem;">
            <?php foreach ($products as $product): 
                $price_parts = explode('.', number_format($product['price'], 2));
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="description"><?php echo $product['description']; ?></p>
                        <div class="price">
                            <small>ETB</small><?php echo number_format($product['price'] * 54.5, 2); ?>
                        </div>
                        <button class="btn-lazarus btn-add-to-cart" data-id="<?php echo $product['id']; ?>">
                            Add to Bag
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</main>

<script src="assets/js/app.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
