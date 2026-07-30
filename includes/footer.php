<?php
// footer.php - GreenMart footer
?>

<style>
/* Footer Styles - Earth Brown Theme */
.footer {
    background-color: #8B5E3C; /* rich earth brown */
    color: #f3f4f6;            /* light text for contrast */
    padding: 40px 20px;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-between; /* Left / Center / Right */
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    flex: 1;
    min-width: 200px;
    margin: 10px;
}

.footer-section h4 {
    margin-bottom: 15px;
    color: #ffffff;
    font-size: 18px;
}

.footer-section p {
    margin: 5px 0;
}

.footer-section ul {
    list-style: none; /* remove bullets */
    padding: 0;
    margin: 0;
    text-align: center; /* center links for the middle section */
}

.footer-section ul li {
    margin: 8px 0;
}

.footer-section ul li a {
    color: #f3f4f6;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #D9CBA0; /* lighter earth tone hover */
}

.footer-bottom {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    border-top: 1px solid #704A32; /* darker brown line */
    padding-top: 15px;
}

/* Responsive: stack footer sections on mobile */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .footer-section {
        margin: 15px 0;
    }

    .footer-section ul {
        text-align: center;
    }
}
</style>

<footer class="footer">
    <div class="footer-container">

        <!-- Left Section -->
        <div class="footer-section">
            <h4>GreenMart</h4>
            <p>Your trusted online grocery shop for fresh and affordable products.</p>
        </div>

        <!-- Center Section -->
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>

        <!-- Right Section -->
        <div class="footer-section">
            <h4>Contact</h4>
            <p>Email: support@greenmart.co.za</p>
            <p>Phone: +27 50 4321 1234</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> GreenMart. All rights reserved.</p>
     <p class="footer-credit">Built and maintained by Diamond Pinnacles IT Solutions.</p>
    </div>
</footer>

