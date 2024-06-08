<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $amount = $_POST['amount'];
    $email = $_POST['email'];

    // Process payment logic would go here
    // For simplicity, let's assume payment is successful

    // Send booking confirmation email
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'meeshi0623@gmail.com'; // SMTP username
        $mail->Password = 'wfeb mfne vndq nmtr'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(false); // Set email format to HTML
        $mail->Subject = 'Booking Confirmation';
        $mail->Body    = "Thank you for your booking!\n\n" .
                         "Amount: $" . $amount . "\n" .
                         "Vehicle: Mahindra Tractor\n" .
                         "Owner: Anantkumar\n" .
                         "Contact Number: 6789605533\n";

        $mail->send();
        echo "<h2>Payment Successful</h2>";
        echo "<p>Thank you for your payment! Booking confirmation email has been sent to $email.</p>";
    } catch (Exception $e) {
        echo "<h2>Payment Successful</h2>";
        echo "<p>Thank you for your payment! However, there was an issue sending the booking confirmation email.</p>";
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect back to payment page if accessed directly
    header("Location: index.html");
    exit();
}
?>
