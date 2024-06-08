<?php
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row['name'] . "<br>";
        echo "Price: " . $row['price'] . "<br>";
        echo "Description: " . $row['description'] . "<br>";
        echo "<img src='uploads/" . $row['image'] . "' width='100'><br><br>";
    }
} else {
    echo "No products found.";
}
?>
