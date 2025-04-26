<?php
include '../database.php';

$booking_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($booking_id) {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: calendar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    <STYLE>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .booking-info {
            margin-top: 20px;
        }
        .booking-info p {
            font-size: 16px;
            line-height: 1.6;
        }
    </STYLE>
</head>
<body>

<div class="container">
    <h2>Booking Details</h2>
    <?php if ($booking): ?>
        <div class="booking-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking['phone']); ?></p>
            <p><strong>Date & Time:</strong> <?php echo date('F j, Y, g:i a', strtotime($booking['date_time'])); ?></p>
            <p><strong>Created At:</strong> <?php echo date('F j, Y, g:i a', strtotime($booking['created_at'])); ?></p>
        </div>
    <?php else: ?>
        <p>No booking found with the provided ID.</p>
    <?php endif; ?>
</div>

</body>
</html>
