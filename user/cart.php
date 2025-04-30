<?php
include '../database.php';

if (!isset($_COOKIE['guest_id'])) {
    $guest_id = 'guest_' . uniqid();
    setcookie('guest_id', $guest_id, time() + (86400 * 30), "/");
} else {
    $guest_id = $_COOKIE['guest_id'];
}

$stmt = mysqli_prepare($conn, "
    SELECT p.*, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.guest_id = ?
");
mysqli_stmt_bind_param($stmt, 's', $guest_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    echo "<p class='empty-cart'>Your cart is empty.</p>";
    exit;
}

include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lazada Style Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>

<h2 class="cart-title">My Shopping Cart</h2>

<div class="cart-container">
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="cart-item">
        <img src="../image/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
        <div class="item-details">
            <div class="item-name"><?= htmlspecialchars($row['product_name']) ?></div>
            <div class="quantity-controls">
                <button>-</button>
                <input type="text" value="<?= $row['quantity'] ?>" readonly>
                <button>+</button>
            </div>
        </div>
        <button class="delete-btn">Remove</button>
    </div>
<?php endwhile; ?>
</div>

<button id="inquireAllBtn" class="inquire-all-btn">Inquire All Products</button>


</body>
</html>

