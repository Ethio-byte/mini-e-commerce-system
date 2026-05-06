<?php
// includes/cart_logic.php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function get_cart() {
    return $_SESSION['cart'];
}

function add_to_cart($product_id, $quantity = 1) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

function remove_from_cart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

function update_cart_quantity($product_id, $quantity) {
    if ($quantity <= 0) {
        remove_from_cart($product_id);
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

function get_cart_count() {
    return array_sum($_SESSION['cart']);
}

function get_cart_total($products) {
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $qty) {
        if (isset($products[$id])) {
            $total += $products[$id]['price'] * $qty;
        }
    }
    return $total;
}
