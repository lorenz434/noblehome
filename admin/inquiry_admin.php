<?php
include('../database.php');

$query = "SELECT id, name, LEFT(message, 50) AS message_preview, email, is_read FROM inquiry ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);


include 'sidebar_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry List</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/inquiry_admin.css">
</head>
<style>
    .chat-item.unread {
    background-color: #f9f9f9; /* Light yellow */
    font-weight: bold;
        }
        .chat-item.read {
            background-color: #e2e3e5; /* Light gray */
            font-weight: normal;
        }
</style>
<body>
   
<div class="chat-container">
        <!-- Inquiry List -->
        <div class="chat-list">
        <?php while ($chat = mysqli_fetch_assoc($result)): ?>
    <div class="chat-item <?php echo $chat['is_read'] ? 'read' : 'unread'; ?>" onclick="viewChat('<?php echo htmlspecialchars($chat['id']); ?>')">
        <div class="chat-preview">
            <strong><?php echo htmlspecialchars($chat['name']); ?></strong>
            <span><?php echo htmlspecialchars($chat['message_preview']); ?>...</span>
        </div>
    </div>
<?php endwhile; ?>

        </div>

        <!-- Chat Details -->
        <div class="chat-details" id="chat-details">
            <h3>Inquiry Details</h3>
            <div id="full-chat">
                <p>Select an inquiry to view full details.</p>
            </div>
            <!-- Reply Section -->
            <div id="reply-section" style="display:none;">
                <h4>Reply to Inquiry</h4>
                <form id="replyForm" method="POST" action="send_reply.php">
                    <textarea name="reply_message" placeholder="Write your reply here..." rows="5" required></textarea>
                    <input type="hidden" name="inquiry_id" id="inquiry-id">
                    <button type="submit" class="submit-button">Send Reply</button>
                    <div id="loading-indicator" style="display:none; margin-top:10px;">
                        <span class="spinner"></span> Sending reply...
                    </div>
                    <div id="reply-status" style="margin-top:10px;"></div>
                </form>
            </div>

            </div>
        </div>
    </div>

    <script>
 function viewChat(id) {
    fetch('get_inquiry_details.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            const chatDetails = document.getElementById('full-chat');
            const replySection = document.getElementById('reply-section');

            // Clear previous reply
            document.getElementById('replyForm').reset();
            document.getElementById('reply-status').textContent = '';
            document.getElementById('loading-indicator').style.display = 'none';

            if (data.error) {
                chatDetails.innerHTML = `<p>${data.error}</p>`;
                return;
            }

            chatDetails.innerHTML = `
                <div><label>Purpose:</label><p>${data.product_name}</p></div>
                <div><label>Name:</label><p>${data.name}</p></div>
                <div><label>Email:</label><p>${data.email}</p></div>
                <div><label>Phone:</label><p>${data.phone}</p></div>
                <div><label>Client's Message:</label><p>${data.message}</p></div>
            `;

            // Mark this item as read in the UI
            const allItems = document.querySelectorAll('.chat-item');
            allItems.forEach(item => {
                item.classList.remove('active');
            });
            const clickedItem = document.querySelector(`.chat-item[onclick*="'${id}'"]`);
            if (clickedItem) {
                clickedItem.classList.remove('unread');
                clickedItem.classList.add('read');
            }

            // Show reply form
            replySection.style.display = 'block';
            document.getElementById('inquiry-id').value = id;
        });

    // Optional: Send a separate request to mark as read in the DB
    fetch(`mark_as_read.php?id=${id}`);
}



    document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('send_reply.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display success or error message
    })
    .catch(error => {
        console.error('Error:', error);
    });
});




document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const loadingIndicator = document.getElementById('loading-indicator');
    const replyStatus = document.getElementById('reply-status');

    loadingIndicator.style.display = 'block';
    replyStatus.textContent = '';
    replyStatus.classList.remove('error');

    fetch('send_reply.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        loadingIndicator.style.display = 'none';
        replyStatus.textContent = data;
        if (data.toLowerCase().includes('failed')) {
            replyStatus.classList.add('error');
        }
    })
    .catch(error => {
        loadingIndicator.style.display = 'none';
        replyStatus.textContent = 'An error occurred while sending the reply.';
        replyStatus.classList.add('error');
        console.error('Error:', error);
    });
});

    </script>

</body>
</html>
