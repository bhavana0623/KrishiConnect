<?php
include 'config.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Category Name: " . $row['name'] . "<br><br>";
    }
} else {
    echo "No categories found.";
}

$conn->close();
?>
