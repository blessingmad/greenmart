<?php
// Include database & functions
include "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GreenMart</title>
    <link rel="stylesheet" href="style/main.css">
        <!-- Favicon -->
         
    <link rel="icon" type="image/x-icon" href="image/favicon.ico"> 

    <!-- Your CSS file -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header class="site-header">
    <!-- Logo section -->
    <div class="logo">
        <img src="image/greenmart-logo.png" alt="GreenMart Logo">
        <span class="brand-name">GreenMart</span>
    </div>

    <!-- Navigation -->
    <nav class="main-nav">
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="cart.php">Cart (<?php echo cartCount(); ?>)</a>
    </nav>
</header>

<hr>
