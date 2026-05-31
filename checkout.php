<?php
// checkout.php
require_once 'includes/auth_logic.php';
require_once 'includes/cart_logic.php';

// Requirement: Show sign in page if guest tries to checkout
if (!is_logged_in()) {
    header('Location: login.php?redirect=checkout.php&message=' . urlencode('Please sign in or create an account to complete your purchase.'));
    exit;
}

require_once 'includes/header.php';
$cart = get_cart();

if (empty($cart)) {
    header('Location: index.php');
    exit;
}

$user = get_logged_in_user();
?>

<main class="container">
    <div class="checkout-container">
        <section class="checkout-form">
            <h2 style="text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem;">Shipping Information</h2>
            <form action="confirmation.php" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required placeholder="John Doe" value="<?php echo htmlspecialchars($user['name']); ?>">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="john@example.com" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-group">
                    <label>Shipping Address</label>
                    <input type="text" name="address" required placeholder="123 Avenue">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" required>
                    </div>
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="text" name="zip" required>
                    </div>
                </div>
                <button type="submit" class="btn-lazarus" style="margin-top: 2rem;">Place Order</button>
            </form>
        </section>

        <section class="order-summary">
            <div style="background: white; padding: 2rem;">
                <h3 style="text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem;">Order Summary</h3>
                <?php foreach ($cart as $id => $qty): 
                    $product = $products[$id]; ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.9rem;">
                        <span style="text-transform: uppercase; letter-spacing: 0.5px;"><?php echo $product['name']; ?> (x<?php echo $qty; ?>)</span>
                        <strong><?php echo number_format($product['price'] * $qty * 54.5, 2); ?> ETB</strong>
                    </div>
                <?php endforeach; ?>
                <hr style="border: 0; border-top: 1px solid var(--border); margin: 1.5rem 0;">
                <div class="total">
                    <span>Total</span>
                    <span><?php echo number_format(get_cart_total($products) * 54.5, 2); ?> ETB</span>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="assets/js/app.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
