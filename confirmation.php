<?php
// confirmation.php
require_once 'includes/auth_logic.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$order_data = $_SESSION['pending_order'] ?? null;

if (!$order_data) {
    header('Location: index.php');
    exit;
}

require_once 'includes/header.php';

$order_total = get_cart_total($products) * 54.5;
$customer_name = htmlspecialchars($order_data['name']);
$payment_method = htmlspecialchars($order_data['payment_method']);

// Clear the cart after successful order
$_SESSION['cart'] = [];
// Clear pending order
unset($_SESSION['pending_order']);
?>

<main class="container">
    <div style="text-align: center; padding: 12rem 2rem; max-width: 600px; margin: 0 auto;">
        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 2rem; font-weight: 200;">SUCCESS</div>
        <h1>Thank you, <?php echo $customer_name; ?>.</h1>
        <p style="color: var(--text-muted); margin: 1.5rem 0 3rem; font-weight: 300; font-size: 1.1rem;">
            Your order of <strong><?php echo number_format($order_total, 2); ?> ETB</strong> has been successfully processed via <strong><?php echo $payment_method; ?></strong>. 
            A confirmation of your acquisition has been sent to your email.
        </p>
        
        <?php if ($payment_method === 'Bank Transfer'): ?>
            <div style="background: #fff; border: 1px solid var(--border); padding: 2rem; margin-bottom: 3rem; text-align: left;">
                <h3 style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; color: var(--accent);">Bank Transfer Instructions</h3>
                <p style="font-size: 0.9rem; margin-bottom: 0.5rem;">Please transfer the total amount to one of our accounts:</p>
                <ul style="list-style: none; font-size: 0.9rem; color: var(--text-muted);">
                    <li><strong>CBE:</strong> 1000123456789 (Lazarus Store)</li>
                    <li><strong>Awash Bank:</strong> 01320123456700 (Lazarus Store)</li>
                    <li><strong>Dashen Bank:</strong> 5678901234567 (Lazarus Store)</li>
                </ul>
                <p style="font-size: 0.8rem; margin-top: 1rem; font-style: italic;">Note: Your order will be shipped once the transfer is verified.</p>
            </div>
        <?php endif; ?>

        <a href="index.php" class="btn-lazarus">Return to Collection</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
