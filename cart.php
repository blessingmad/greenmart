<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include functions and database files
include "includes/functions.php";
include "config/db.php"; 
include "includes/header.php"; // header with cart count

$cart = getCart(); // get current cart usually returns an associative array of product_id => quantity

// --------------------------
// 1. Handle quantity update
// --------------------------
if (isset($_POST['update_cart'])) {
    //loop through posted quantities and update cart
    foreach ($_POST['quantities'] as $id => $qty) {
        // If quantity is zero or less, remove item from cart
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } 
        // Otherwise, update to new quantity
        else {
            $_SESSION['cart'][$id] = (int)$qty;
        }
    }
    //Refreshing the page to reflect changes and avoid resubmission
    header("Location: cart.php");
    exit;
}

// --------------------------
// 2. Handle order placement
// --------------------------
if (isset($_POST['place_order'])) {
    //get customer details
    $full_name = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    //check if cart is not empty and details are provided
    if (!empty($cart) && $full_name && $phone && $email) {
        //  Insert customer details and get customer ID
        $stmt = mysqli_prepare($conn, "INSERT INTO customers (full_name, phone, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $full_name, $phone, $email);
        mysqli_stmt_execute($stmt);
        //get newly inserted customer ID
        $customer_id = mysqli_insert_id($conn); // get the new customer ID
        mysqli_stmt_close($stmt);

        // Calculate total amount in cart
        $total = 0;
        //loop through cart items to calculate total
        foreach ($cart as $id => $qty) {
            //fetchproduct price from database using prepared statement
            $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE product_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $product = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            // Add to total amount
            if ($product) {
                $total += $product['price'] * $qty;
            }
        }

        // Save order, cart contents as JSON for storage, insert into orders table
        $cart_json = json_encode($cart);
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (customer_id, cart, total) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isd", $customer_id, $cart_json, $total);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Clear cart after successful order placement
        unset($_SESSION['cart']);

        // Show success message
        echo "<p>Order placed successfully! Thank you, " . htmlspecialchars($full_name) . ".</p>";
    } else {
        echo "<p>Please fill in all details and make sure your cart is not empty.</p>";
    }
}
?>

<h2>Your Cart</h2>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <form method="post">
        <table border="1" cellpadding="10">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php
            $total_price = 0;
            foreach ($cart as $id => $qty):
                // Fetch product using prepared statement
                $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE product_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $product = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);

                if (!$product) continue;

                $subtotal = $product['price'] * $qty;
                $total_price += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>R<?= number_format($product['price'], 2) ?></td>
                <td>
                    <input type="number" name="quantities[<?= $id ?>]" value="<?= $qty ?>" min="0">
                </td>
                <td>R<?= number_format($subtotal, 2) ?></td>
                <td>
                    <form method="post" action="remove-from-cart.php">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total:</strong></td>
                <td colspan="2"><strong>R<?= number_format($total_price, 2) ?></strong></td>
            </tr>
        </table>
        <br>
        <button type="submit" name="update_cart">Update Quantities</button>
    </form>

    <h3>Customer Details</h3>
    <form method="post">
        <label>Full Name: <input type="text" name="fullname" required></label><br><br>
        <label>Phone Number: <input type="text" name="phone" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <button type="submit" name="place_order">Place Order</button>
    </form>
<?php endif; ?>
<?php include "includes/footer.php"; ?>