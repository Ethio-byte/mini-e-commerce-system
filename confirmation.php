<?php
// confirmation.php
require_once 'includes/auth_logic.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$order_total = get_cart_total($products) * 54.5;
$customer_name = htmlspecialchars($_POST['name']);

// Clear the cart after successful order
$_SESSION['cart'] = [];
?>

<main class="container">
    <div style="text-align: center; padding: 12rem 2rem; max-width: 600px; margin: 0 auto;">
        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 2rem; font-weight: 200;">SUCCESS</div>
        <h1>Thank you, <?php echo $customer_name; ?>.</h1>
        <p style="color: var(--text-muted); margin: 1.5rem 0 3rem; font-weight: 300; font-size: 1.1rem;">Your order of <strong><?php echo number_format($order_total, 2); ?> ETB</strong> has been received. A confirmation of your acquisition has been sent to your email.</p>
        <a href="index.php" class="btn-lazarus">Return to Collection</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
