<?php
session_start(); // Required to modify $_SESSION

include "../config/db.php";
include "../includes/functions.php";

// Get product ID from form
$product_id = $_POST['product_id'] ?? null;

if ($product_id) {
    addToCart($product_id);
}

// Redirect back to cart page
header("Location: ../cart.php");
exit;
