<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product-name'];
    $price = $_POST['product-price'];
    $description = $_POST['product-description'];
    $image = $_FILES['product-image']['name'];
    $target = 'uploads/' . basename($image);

    if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Product inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
