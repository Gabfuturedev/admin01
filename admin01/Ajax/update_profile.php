<?php
// session_start(); // Start session at the beginning

if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$userId = $_SESSION['id']; // Make sure you use the same variable name

echo "Welcome, " . htmlspecialchars($username) . " (ID: " . htmlspecialchars($userId) . ")";
$conn = mysqli_connect("localhost", "root", "", "announcementDB");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        die("All fields are required.");
    }

    // Debugging information (Remove in production)
    // echo "Full Name: " . htmlspecialchars($fullname) . "<br>";
    // echo "Email: " . htmlspecialchars($email) . "<br>";
    // echo "Username: " . htmlspecialchars($username) . "<br>";
    // echo "Password: " . htmlspecialchars($password) . "<br>";
    // echo "User ID: " . htmlspecialchars($user_id) . "<br>";

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update user info
    $stmt = $conn->prepare("UPDATE admins SET full_name = ?, email = ?, username = ?, password = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("ssssi", $fullname, $email, $username, $hashed_password, $user_id);

    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: /admin/index.php?settings&status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
