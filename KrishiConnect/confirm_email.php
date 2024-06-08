<?php
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

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Find the user with the token
    $sql = "SELECT user_id FROM email_confirmations WHERE token='$token' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // Update user's is_verified status
        $sql_update = "UPDATE users SET is_verified=1 WHERE id='$user_id'";

        if ($conn->query($sql_update) === TRUE) {
            // Delete the token from email_confirmations table
            $sql_delete = "DELETE FROM email_confirmations WHERE token='$token'";
            $conn->query($sql_delete);

            echo "Your email has been confirmed successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid token.";
    }
} else {
    echo "No token provided.";
}

$conn->close();
?>
