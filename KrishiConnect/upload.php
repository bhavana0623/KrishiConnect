<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if files were uploaded
    if (isset($_FILES['aadhar']) && isset($_FILES['license'])) {
        // Create directory if it doesn't exist
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Handle Aadhar upload
        $aadharPath = $uploadDir . basename($_FILES['aadhar']['name']);
        if (move_uploaded_file($_FILES['aadhar']['tmp_name'], $aadharPath)) {
            echo "Aadhar uploaded successfully. ";
        } else {
            http_response_code(400);
            echo "Failed to upload Aadhar. ";
        }

        // Handle License upload
        $licensePath = $uploadDir . basename($_FILES['license']['name']);
        if (move_uploaded_file($_FILES['license']['tmp_name'], $licensePath)) {
            echo "License uploaded successfully.";
        } else {
            http_response_code(400);
            echo "Failed to upload License.";
        }
    } else {
        http_response_code(400);
        echo "No files were uploaded.";
    }
} else {
    http_response_code(405);
    echo "Invalid request method.";
}
?>
