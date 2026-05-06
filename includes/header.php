<?php
// includes/header.php
require_once __DIR__ . '/cart_logic.php';
$products = require __DIR__ . '/../data/products.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAZARUS | Essential Goods</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container nav-main">
            <a href="index.php" class="logo">
                <i class="fas fa-infinite" style="margin-right: 8px;"></i>LAZARUS
            </a>
            
            <div class="search-bar">
                <input type="text" placeholder="Search LAZARUS essentials...">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="nav-tools">
                <div class="nav-item">
                    <span>Membership</span>
                    <strong>Join LAZARUS</strong>
                </div>
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
            <a href="checkout.php" class="btn btn-primary btn-block">Proceed to Payment</a>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
