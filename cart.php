<?php
// cart.php
require_once 'includes/header.php';

// Safety check for products
if (!isset($products)) {
    $products = require 'data/products.php';
}

$cart = get_cart();
?>

<main class="container">
    <div style="margin-top: 4rem; margin-bottom: 2rem;">
        <h1 style="text-transform: uppercase; letter-spacing: 5px; font-weight: 800; font-size: 2.5rem;">Shopping Bag</h1>
        <p style="color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem; margin-top: 1rem;">Review your selected acquisitions</p>
    </div>

    <div class="cart-page-container">
        <div class="cart-table-section">
            <?php if (empty($cart)): ?>
                <div style="padding: 4rem; text-align: center; background: var(--white); border: 1px solid var(--border);">
                    <i class="fas fa-shopping-bag" style="font-size: 3rem; color: var(--border); margin-bottom: 1.5rem;"></i>
                    <p style="color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px;">Your bag is currently empty.</p>
                    <a href="index.php" class="btn-lazarus" style="width: auto; padding: 12px 30px; margin-top: 2rem; display: inline-flex;">Continue Shopping</a>
                </div>
            <?php else: ?>
                <div class="cart-items-list">
                    <?php foreach ($cart as $id => $qty): 
                        $product = $products[$id]; ?>
                        <div class="cart-page-item" data-id="<?php echo $id; ?>">
                            <div class="item-img-box">
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            </div>
                            <div class="item-info">
                                <div class="item-main">
                                    <h3><?php echo $product['name']; ?></h3>
                                    <p class="item-cat"><?php echo $product['category']; ?></p>
                                </div>
                                <div class="item-actions">
                                    <div class="quantity-controls">
                                        <button class="qty-btn minus" data-id="<?php echo $id; ?>">-</button>
                                        <span class="qty"><?php echo $qty; ?></span>
                                        <button class="qty-btn plus" data-id="<?php echo $id; ?>">+</button>
                                    </div>
                                    <button class="btn-remove-modern remove-item" data-id="<?php echo $id; ?>">
                                        <i class="far fa-trash-can"></i>
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                            <div class="item-price-total">
                                <strong><?php echo number_format($product['price'] * $qty * 54.5, 2); ?> ETB</strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="cart-summary-section">
            <div class="summary-card">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span><?php echo number_format(get_cart_total($products) * 54.5, 2); ?> ETB</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Calculated at checkout</span>
                </div>
                <hr>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="cart-page-total"><?php echo number_format(get_cart_total($products) * 54.5, 2); ?> ETB</span>
                </div>
                
                <a href="checkout.php" class="btn-lazarus" style="margin-top: 2rem; padding: 18px;">
                    Proceed to Payment
                </a>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <p style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">
                        Secure Checkout Guaranteed
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="assets/js/app.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
