<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/PHPMailer.php';
require './src/SMTP.php';
require './src/Exception.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "krishi_connect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $confirm_password = $_POST['confirm-password'];

    // Check if password and confirm password match
    if ($_POST['password'] !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    $sql = "INSERT INTO users (username, contact, email, password) VALUES (?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $contact, $email, $password);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'meeshi0623@@gmail.com';
            $mail->Password = 'wfeb mfne vndq nmtr'; // Use App Password if 2FA is enabled
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('your_email@gmail.com', 'KrishiConnect');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body    = "Dear $username,<br><br>Thank you for registering at KrishiConnect.<br>Your registration was successful. You can now log in using your credentials.<br><br>Regards,<br>KrishiConnect Team";

            $mail->send();
            header("Location: loginE.html"); // Redirect to English login page after sending the email
            exit();
        } catch (Exception $e) {
            echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
