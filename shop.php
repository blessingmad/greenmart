<?php
// Include database connection file
include "config/db.php";
// Include functions file
include "includes/functions.php";
// Include the header file
include "includes/header.php";

// Fetch all products from the products table in the database
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<h2 style="text-align:center; margin-bottom: 20px;">Store Products</h2>

<!-- Products container -->
<div class="products-container">
<?php 
// Loop through each product and display its details
while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="product">
    <img src="image/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">

    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
    <p><strong>Price:</strong> R<?php echo number_format($row['price'], 2); ?></p>
    <p><strong>Stock:</strong> <?php echo (int)$row['stock']; ?></p>

    <form action="action/add_to_cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <button type="submit">Add to Cart</button>
    </form>
</div>

<?php } ?>
</div>

<!-- Inline CSS for layout -->
<style>
.products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
    margin: 0 auto;
}

.product {
    flex: 1 1 calc(33.333% - 20px); /* 3 per row */
    box-sizing: border-box;
    border: 1px solid #ccc;
    padding: 15px;
    text-align: center;
    transition: transform 0.2s;
    background-color: #f9f9f9;
}

.product:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.product img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

/* Responsive for tablets */
@media screen and (max-width: 768px) {
    .product {
        flex: 1 1 calc(50% - 20px); /* 2 per row */
    }
}

/* Responsive for mobile */
@media screen and (max-width: 480px) {
    .product {
        flex: 1 1 100%; /* 1 per row */
    }
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #0056b3;
}
</style>

<?php include "includes/footer.php"; ?>
