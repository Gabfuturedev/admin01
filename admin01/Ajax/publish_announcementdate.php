<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "announcementDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_date = date('Y-m-d H:i:s');

// Query to get announcements to be published
$sql = "UPDATE announcement SET Status = 1 WHERE publish_date <= '$current_date' AND Status = 0";

if ($conn->query($sql) === TRUE) {
    echo "Announcements published successfully.";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
