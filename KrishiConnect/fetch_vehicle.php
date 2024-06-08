<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "krishi_connect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the latest vehicle and owner details
$sql = "SELECT vehicles.brand, vehicles.model, vehicles.use_rate, owners.name AS owner_name, owners.email AS owner_email, owners.contact AS owner_contact, vehicles.image_path
        FROM vehicles
        JOIN owners ON vehicles.owner_id = owners.id
        ORDER BY vehicles.id DESC
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in JSON format
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

$conn->close();
?>


