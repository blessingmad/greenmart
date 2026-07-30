<?php
session_start();
include "config/db.php";

// Get posted data
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$total = $_POST['total'];

// Insert order into `orders` table
mysqli_query($conn, "INSERT INTO orders (full_name, phone, email, total) 
                     VALUES ('$full_name', '$phone', '$email', '$total')");

$order_id = mysqli_insert_id($conn); // Get new order ID

// Insert each cart item into `order_items`
foreach ($_SESSION['cart'] as $product_id => $qty) {
    $product_result = mysqli_query($conn, "SELECT price FROM products WHERE product_id=$product_id");
    $product = mysqli_fetch_assoc($product_result);
    $price = $product['price'];

    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price)
                         VALUES ($order_id, $product_id, $qty, $price)");
}

// Clear cart
unset($_SESSION['cart']);

// Redirect to thank you page
header("Location: thank_you.php");
exit;
