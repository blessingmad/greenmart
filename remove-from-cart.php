<?php
session_start();
include "includes/functions.php";

$product_id = $_POST['product_id'] ?? null;
if ($product_id) {
    removeFromCart($product_id);
}

header("Location: cart.php");
exit;
