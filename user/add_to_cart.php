<?php
session_start();
include '../database.php';

// Get product_id from POST
if (!isset($_POST['product_id'])) {
    echo "No product selected.";
    exit;
}

$product_id = intval($_POST['product_id']);

// Set guest_id cookie if not set
if (!isset($_COOKIE['guest_id'])) {
    $guest_id = 'guest_' . uniqid();
    setcookie('guest_id', $guest_id, time() + (86400 * 30), "/");
} else {
    $guest_id = $_COOKIE['guest_id'];
}

// Check if product already exists in cart
$check_stmt = mysqli_prepare($conn, "SELECT quantity FROM cart WHERE guest_id = ? AND product_id = ?");
mysqli_stmt_bind_param($check_stmt, 'si', $guest_id, $product_id);
mysqli_stmt_execute($check_stmt);
$check_result = mysqli_stmt_get_result($check_stmt);

if ($row = mysqli_fetch_assoc($check_result)) {
    // Product exists — update quantity
    $new_qty = $row['quantity'] + 1;
    $update_stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE guest_id = ? AND product_id = ?");
    mysqli_stmt_bind_param($update_stmt, 'isi', $new_qty, $guest_id, $product_id);
    mysqli_stmt_execute($update_stmt);
} else {
    // New product — insert into cart
    $insert_stmt = mysqli_prepare($conn, "INSERT INTO cart (guest_id, product_id, quantity) VALUES (?, ?, 1)");
    mysqli_stmt_bind_param($insert_stmt, 'si', $guest_id, $product_id);
    mysqli_stmt_execute($insert_stmt);
}

// Redirect back to product details
header("Location: product_details.php?id=" . $product_id);
exit;
?>
