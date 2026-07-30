<?php
//include "config/db.php";
include "config/db.php";
//include helper functions and header
include "includes/functions.php";
//include header (navigation, html head, etc.)
include "includes/header.php";
//sql query to get products from database
$query = "SELECT * FROM products LIMIT 4";
//execute query and store result
$result = mysqli_query($conn, $query);
?>

<!-- HERO RIBBON -->
<section class="hero-ribbon">
    <!-- Hero image with overlay and text -->
    <img src="image/hero-grocery.jpg" alt="Fresh groceries" class="hero-img">
    <!-- Overlay and text content -->
    <div class="hero-ribbon-content">
        <h1>Fresh Groceries Delivered</h1>
        <p>Quality food • Great prices • Everyday essentials</p>
    </div>
</section>

<style>
/* Hero Ribbon/section Styles */
.hero-ribbon {
    position: relative;
    height: 160px;
    overflow: hidden;
    margin-bottom: 30px;
}
/*hero background image styles*/
.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.hero-ribbon::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
}
/* Content styles for text and centering */
.hero-ribbon-content {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    z-index: 1;
}
/* main heading and subheading styles */
.hero-ribbon h1 {
    font-size: 26px;
    margin-bottom: 5px;
}

.hero-ribbon p {
    font-size: 14px;
    opacity: 0.9;
}

/* Mobile */
@media (max-width: 480px) {
    .hero-ribbon {
        height: 120px;
    }

    .hero-ribbon h1 {
        font-size: 20px;
    }
}
</style>


<!-- Featured Products Section -->
<h2>Feature Products</h2>
<!-- products listing -->
<div class="products">
    
<?php 
// Loop through products and display them from the db
while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="product">
        <!-- Display product image, name, price, and add to cart form -->
        <img src="image/<?php echo $row['image']; ?>" width="150">
        <h3><?php echo $row['name']; ?></h3>
        <p>R<?php echo $row['price']; ?></p>
        <!-- Form to add product to cart, sends product_id to add_to_cart.php -->
        <form action="action/add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <!-- Add to Cart button -->
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<?php } ?>
</div>
<?php
// include footer (closing body and html tags, etc.)
include "includes/footer.php"; ?>
