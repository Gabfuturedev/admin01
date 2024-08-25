<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establish a database connection
$con = mysqli_connect('localhost', 'root', '', 'user');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user ID from the GET request
$userId = $_GET['userId'];

// Fetch messages for the specified user ID
$sql = "SELECT message, sent_at FROM messages WHERE user_id = '$userId' ORDER BY sent_at DESC";
$result = mysqli_query($con, $sql);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);

// Close the database connection
mysqli_close($con);
?>
