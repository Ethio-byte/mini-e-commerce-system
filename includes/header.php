<?php
// includes/header.php
require_once __DIR__ . '/cart_logic.php';
require_once __DIR__ . '/auth_logic.php';
$products = require __DIR__ . '/../data/products.php';
$user = get_logged_in_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAZARUS | Essential Goods</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" type="image/jpeg" href="assets/images/elogo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container nav-main">
            <a href="index.php" class="logo">
                <img src="assets/images/elogo.jpg" alt="LAZARUS" class="logo-img">
                <span>LAZARUS</span>
            </a>
            
            <div class="search-bar">
                <input type="text" placeholder="Search LAZARUS essentials...">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="nav-tools">
                <?php if ($user): ?>
                    <div class="user-dropdown">
                        <div class="nav-item">
                            <span>Welcome</span>
                            <strong><?php echo htmlspecialchars($user['name']); ?> <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i></strong>
                        </div>
                        <div class="dropdown-content">
                            <a href="account.php"><i class="fas fa-user-circle" style="margin-right: 10px;"></i> My Account</a>
                            <a href="orders.php"><i class="fas fa-box" style="margin-right: 10px;"></i> My Orders</a>
                            <hr style="border: 0; border-top: 1px solid var(--border);">
                            <a href="logout.php" style="color: #c53030;"><i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" style="text-decoration: none; color: inherit;">
                        <div class="nav-item">
                            <span>Membership</span>
                            <strong>Sign In</strong>
                        </div>
                    </a>
                    <a href="signup.php" style="text-decoration: none; color: inherit;">
                        <div class="nav-item">
                            <span>New Here?</span>
                            <strong>Join LAZARUS</strong>
                        </div>
                    </a>
                <?php endif; ?>
                
                <div class="nav-item">
                    <span>Inquiries</span>
                    <strong>Support</strong>
                </div>
                <div class="cart-trigger" id="cart-btn">
                    <i class="fas fa-shopping-bag"></i>
                    <span id="cart-count"><?php echo get_cart_count(); ?></span>
                    <strong>Bag</strong>
                </div>
            </div>
        </div>
    </header>

    <div id="cart-sidebar" class="sidebar">
        <div class="sidebar-header">
            <h3>Your Cart</h3>
            <button id="close-cart">&times;</button>
        </div>
        <div id="cart-items" class="cart-items-container">
            <!-- Cart items will be loaded here via AJAX or on page load -->
            <?php include __DIR__ . '/cart_items_partial.php'; ?>
        </div>
        <div class="sidebar-footer">
            <div class="total">
                <span>Total:</span>
                <span id="cart-total"><?php echo number_format(get_cart_total($products) * 54.5, 2); ?> ETB</span>
            </div>
            <a href="cart.php" class="btn btn-primary btn-block">View Shopping Bag</a>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
