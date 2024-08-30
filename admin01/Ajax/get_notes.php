<?php
// Get the note ID from the query parameter
$id = $_GET['id'];

// Connect to the database
$mysqli = new mysqli("localhost", "username", "password", "announcementDB");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare and execute the query
$stmt = $mysqli->prepare("SELECT content FROM notes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($content);
$stmt->fetch();

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode(['content' => $content]);

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
