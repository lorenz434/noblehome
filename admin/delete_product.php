<?php
include 'database.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "DELETE FROM products WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='product_admin.php';</script>";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
?>
