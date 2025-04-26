<?php
include('../database.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $query = "SELECT id, name, email, phone, message, product_name FROM inquiry WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode([
            'id'          => $row['id'],
            'name'        => $row['name'],
            'email'       => $row['email'],
            'phone'       => $row['phone'],
            'message'     => $row['message'],
            'product_name' => $row['product_name']  
        ]);
    } else {
        echo json_encode(['error' => 'No record found']);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>
