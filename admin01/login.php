<?php
// Connect to the database
session_start();
$mysqli = new mysqli("localhost", "root", "", "announcementDB");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists and fetch password and ID
    $stmt = $mysqli->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "Username not found.";
        exit;
    }

    // Bind result to variables
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Get user IP address
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Record login time and IP address
        $login_time = date('Y-m-d H:i:s');

        $stmt = $mysqli->prepare("UPDATE admins SET ip_address = ?, login_time = ? WHERE username = ?");
        $stmt->bind_param("sss", $ip_address, $login_time, $username);
        $stmt->execute();

        // Store username and user ID in session
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $user_id;

        // Redirect to index.php
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid password.";
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
