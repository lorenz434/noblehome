<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inquiry_id = $_POST['inquiry_id'];
    $reply_message = $_POST['reply_message'];

    // Fetch inquiry details
    $stmt = $conn->prepare("SELECT name, email FROM inquiry WHERE id = ?");
    $stmt->bind_param("i", $inquiry_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $inquiry = $result->fetch_assoc();

    if ($inquiry) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'arme.jimenez.sjc@phinmaed.com';
            $mail->Password = 'aghx clrc xqmu umqp';  
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('NobleHome@gmail.com', 'IT Man');
            $mail->addAddress($inquiry['email'], $inquiry['name']);

            // Embed the Noble Home logo image
            $mail->AddEmbeddedImage('../image/noblehomelogo.png', 'noblehome_logo'); // <-- path to your logo

            $mail->isHTML(true);
            $mail->Subject = 'Response to Your Inquiry';
            $mail->Body    = nl2br($reply_message) . '
                <br><br>
                <strong>Best regards,</strong><br>
                IT Man<br>
                <img src="cid:noblehome_logo" alt="Noble Home Icon" style="height:50px; margin-top:5px;"><br>
                <strong>Noble Home</strong>';
            $mail->AltBody = $reply_message;

            $mail->send();
            echo 'Reply has been sent successfully.';
        } catch (Exception $e) {
            echo "Failed to send reply. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Inquiry not found.';
    }
}
?>
