<?php
session_start();
$products = array(
    array("name" => "Product 1", "price" => 10.00),
    array("name" => "Product 2", "price" => 20.00),
    array("name" => "Product 3", "price" => 15.00),
    // Add more products as needed
);

if (isset($_POST['update_cart'])) {
    $quantities = $_POST['quantity'];
    $_SESSION['cart'] = $quantities;
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array_fill(0, count($products), 0);
}

// Ensure that the cart array has entries for all products
$cart = array_pad($cart, count($products), 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Cart</title>
</head>

<body>
    <header>
        <!-- Header content here -->
    </header>
    <main>
        <h1>Your Cart</h1>
        <table>
            <tr>
                <th>Item</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            <?php
            $total = 0;
            for ($i = 0; $i < count($products); $i++) {
                $product = $products[$i];
                $quantity = $cart[$i];
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
            ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo "$" . number_format($product['price'], 2); ?></td>
                    <td>
                        <form method="post">
                            <input type="number" name="quantity[<?php echo $i; ?>]" value="<?php echo $quantity; ?>" min="0">
                            <button type="submit" name="update_cart">Update</button>
                        </form>
                    </td>
                    <td><?php echo "$" . number_format($subtotal, 2); ?></td>
                    <td><a href="?remove=<?php echo $i; ?>">Remove</a></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3">Total:</td>
                <td><?php echo "$" . number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </table>
    </main>
    <footer>
        <!-- Footer content here -->
    </footer>
</body>

</html>