<?php
// confirmation.php
require_once 'includes/cart_logic.php';
$products = require 'data/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$order_total = get_cart_total($products) * 54.5;
$customer_name = htmlspecialchars($_POST['name']);

// Clear the cart after successful order
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | LAZARUS</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .confirmation-msg {
            text-align: center;
            padding: 12rem 2rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .success-icon {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 2rem;
            font-weight: 200;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container nav-main">
            <a href="index.php" class="logo">LAZARUS</a>
        </nav>
    </header>

    <main class="container">
        <div class="confirmation-msg">
            <div class="success-icon">SUCCESS</div>
            <h1>Thank you, <?php echo $customer_name; ?>.</h1>
            <p style="color: var(--text-muted); margin: 1.5rem 0 3rem; font-weight: 300; font-size: 1.1rem;">Your order of <strong><?php echo number_format($order_total, 2); ?> ETB</strong> has been received. A confirmation of your acquisition has been sent to your email.</p>
            <a href="index.php" class="btn-lazarus">Return to Collection</a>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
