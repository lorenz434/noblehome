<?php
include('database.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "UPDATE inquiry SET is_read = 1 WHERE id = $id");
}
?>