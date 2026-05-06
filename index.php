<?php
// index.php
require_once 'includes/header.php';
$categories = require 'data/categories.php';
?>

    <main>
        <section class="hero-lazarus">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1600&q=80" alt="Banner">
            <div class="container hero-content">
                <h1>The Lazarus Collections</h1>
                <p>Discover our curated departments of excellence.</p>
            </div>
        </section>

        <div class="container">
            <section class="category-grid">
                <?php foreach ($categories as $category): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                        </div>
                        <div class="product-info">
                            <h3><?php echo $category['name']; ?></h3>
                            <p class="description"><?php echo $category['description']; ?></p>
                            <a href="collection.php?id=<?php echo $category['id']; ?>" class="btn-lazarus" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                View Collection
                            </a>
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
