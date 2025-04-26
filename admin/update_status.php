<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include '../database.php';

if (isset($_POST['approve']) && isset($_POST['booking_id'])) {
    $id = mysqli_real_escape_string($conn, intval($_POST['booking_id']));

    $sql = "SELECT name, email, date_time FROM booking WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        die('Error fetching booking details: ' . mysqli_error($conn));
    }

    $booking = mysqli_fetch_assoc($result);

    if ($booking) {
        $client_name = $booking['name'];
        $client_email = $booking['email'];
        $client_date_time = $booking['date_time'];

        $approval_time = date('F j, Y, g:i A');

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'arme.jimenez.sjc@phinmaed.com';
            $mail->Password = 'aghx clrc xqmu umqp';  
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('no-reply@noblehome.com', 'Noblehome');
            $mail->addAddress($client_email, $client_name); 

            $mail->isHTML(true);
            $mail->Subject = 'Booking Approved';
            $mail->Body = "
                <h3>Hello $client_name,</h3>
                <p>Your booking has been successfully approved. Here are the details:</p>
                <ul>
                    <li>Booking ID: $id</li>
                    <li>Status: Approved</li>
                    <li>Client Selected Date and Time: " . date('F j, Y, g:i A', strtotime($client_date_time)) . "</li>
                    <li>Approval Time: $approval_time</li>
                </ul>
                <p>Thank you for choosing Noblehome!</p>
            ";

            if($mail->send()) {
                echo 'Approval email has been sent to the client.';
            } else {
                echo 'Failed to send email.';
            }

            $update_sql = "UPDATE booking SET status = 'approved' WHERE id = $id";
            if (mysqli_query($conn, $update_sql)) {
                echo 'Booking status updated successfully.';
            } else {
                echo 'Failed to update booking status. Error: ' . mysqli_error($conn);
            }

        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Booking not found.';
    }
}

header("Location: booking_admin.php");
exit;
?>
