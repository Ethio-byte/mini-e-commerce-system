<?php
// includes/cart_items_partial.php
if (!isset($products)) {
    $products = require __DIR__ . '/../data/products.php';
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)): ?>
    <div class="empty-cart-msg">Your cart is empty.</div>
<?php else:
    foreach ($cart as $id => $qty):
        $product = $products[$id];
?>
    <div class="cart-item" data-id="<?php echo $id; ?>">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <div class="item-details">
            <h4><?php echo $product['name']; ?></h4>
            <p><?php echo number_format($product['price'] * 54.5, 2); ?> ETB</p>
            <div class="quantity-controls">
                <button class="qty-btn minus" data-id="<?php echo $id; ?>">-</button>
                <span class="qty"><?php echo $qty; ?></span>
                <button class="qty-btn plus" data-id="<?php echo $id; ?>">+</button>
            </div>
        </div>
        <button class="remove-item-btn remove-item" data-id="<?php echo $id; ?>" title="Remove item">
            <i class="far fa-trash-can"></i>
        </button>
    </div>
<?php endforeach; endif; ?>
