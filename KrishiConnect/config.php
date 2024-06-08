<?php
$host = 'localhost';
$db = 'krishi_connect';
$user = 'root'; // Change this if you have a different username
$pass = ''; // Change this if you have a password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
