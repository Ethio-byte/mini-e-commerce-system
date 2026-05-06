<?php
// api/update_cart.php
require_once '../includes/cart_logic.php';
$products = require '../data/products.php';

$action = $_POST['action'] ?? '';
$id = (int)($_POST['id'] ?? 0);
$qty = (int)($_POST['qty'] ?? 1);

if ($id > 0 && isset($products[$id])) {
    switch ($action) {
        case 'add':
            add_to_cart($id, $qty);
            break;
        case 'update':
            update_cart_quantity($id, $qty);
            break;
        case 'remove':
            remove_from_cart($id);
            break;
    }
}

// Return updated cart fragment and totals
ob_start();
include '../includes/cart_items_partial.php';
$html = ob_get_clean();

echo json_encode([
    'success' => true,
    'count' => get_cart_count(),
    'total' => number_format(get_cart_total($products), 2),
    'html' => $html
]);
