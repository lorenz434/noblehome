<?php
include('../database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Update the 'is_read' field to 1 (mark as read)
    $query = "UPDATE inquiry SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>
