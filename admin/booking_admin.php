<?php
include '../database.php';
include 'sidebar_admin.php';

$bookings = [];
$sql = "SELECT id, name, email, phone, date_time, status FROM booking";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $color = $row['status'] === 'approved' ? 'green' : 'red';

    $bookings[] = [
        'id' => $row['id'],
        'title' => $row['name'] . ' - ' . date('g:i A', strtotime($row['date_time'])),
        'start' => date('c', strtotime($row['date_time'])),
        'color' => $color,
        'allDay' => false,
        'name' => $row['name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'date_time' => date('F j, Y, g:i A', strtotime($row['date_time']))
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar</title>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/booking-admin.css?v=1.0">

</head>
<body>
    <!-- Left: Calendar -->
    <div class="main-container">
        <div class="page-title">
            <h3>Booking Calendar</h3>
        </div>
        <div id="calendar"></div>
    </div>

    <!-- Right: Approved & Pending -->
    <div class="side-wrapper">
        <div class="side-container">
            <h5>Approved Bookings</h5>
            <div id="container-approved"></div>
        </div>
        <div class="side-container">
            <h5>Pending Bookings</h5>
            <div id="container-pending"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="update_status.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Approve Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" id="bookingId">
                        <p><strong>Client's Name:</strong> <span id="clientName"></span></p>
                        <p><strong>Email:</strong> <span id="clientEmail"></span></p>
                        <p><strong>Phone Number:</strong> <span id="clientPhone"></span></p>
                        <p><strong>Date and Time:</strong> <span id="clientDateTime"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const bookings = <?php echo json_encode($bookings); ?>;

            $('#calendar').fullCalendar({
                defaultView: 'month',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                allDaySlot: false,
                events: bookings,
                eventRender: function(event, element) {
                    element.find('.fc-title').text(event.title);
                    element.find('.fc-time').text(moment(event.start).format("h:mm A"));
                    element.css('background-color', event.color);
                },
                eventClick: function(event) {
                    $('#bookingId').val(event.id);
                    $('#clientName').text(event.name);
                    $('#clientEmail').text(event.email);
                    $('#clientPhone').text(event.phone);
                    $('#clientDateTime').text(event.date_time);
                    const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                    modal.show();
                },
            });

            bookings.forEach(event => {
                const containerId = event.color === 'green' ? '#container-approved' : '#container-pending';
                $(containerId).append(`
                    <div class="booking-summary">
                        <strong>${event.name}</strong><br>
                        <small>${event.date_time}</small>
                    </div>
                `);
            });
        });
    </script>
</body>
</html>
