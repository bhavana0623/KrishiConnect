<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['brand-name'];
    $sql = "INSERT INTO brands (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Brand inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
