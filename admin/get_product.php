<?php
include('database.php');

$product_id = $_GET['id'];

$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch();

echo json_encode($product);
?>
