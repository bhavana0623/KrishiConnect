<?php
session_start();
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
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: homepageE.html");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <span>&lt;</span>
                <h1>KrishiConnect</h1>
            </div>
        </div>
        <div class="content">
            <div class="left-side">
                <div class="login-container">
                    <h2>Login</h2>
                    <?php if (isset($error_message)): ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit">Login</button>
                    </form>
                    <div class="register-link">
                        <p>Don't have an account? <a href="register.html">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="welcome-message">
                    <h2>Welcome back</h2>
                </div>
                <div class="image-container">
                    <img src="images/loginpic.png" alt="Image" class="login-image">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
