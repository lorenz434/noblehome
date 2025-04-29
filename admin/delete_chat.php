<?php
include '../database.php'; // Connect to DB

if (isset($_GET['id'])) {
    $chat_id = intval($_GET['id']);

    // First, delete all replies related to this inquiry
    $deleteReplies = "DELETE FROM inquiry_replies WHERE inquiry_id = ?";
    $stmtReplies = $conn->prepare($deleteReplies);
    $stmtReplies->bind_param("i", $chat_id);
    $stmtReplies->execute();
    $stmtReplies->close();

    // Now, delete the inquiry itself
    $deleteInquiry = "DELETE FROM inquiry WHERE id = ?";
    $stmtInquiry = $conn->prepare($deleteInquiry);
    $stmtInquiry->bind_param("i", $chat_id);

    if ($stmtInquiry->execute()) {
        echo "<script>alert('Chat deleted successfully.'); window.location.href='inquiry_admin.php';</script>";
    } else {
        echo "<script>alert('Failed to delete chat.'); history.back();</script>";
    }

    $stmtInquiry->close();
} else {
    echo "<script>alert('No chat ID provided.'); history.back();</script>";
}

$conn->close();
?>
