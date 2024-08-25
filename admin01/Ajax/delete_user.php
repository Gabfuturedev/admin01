<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the POST data
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['userId'];

    // Establish a database connection
    $con = mysqli_connect('localhost', 'root', '', 'user');

    // Check connection
    if (!$con) {
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]));
    }

    // Update the status of the user to 3
    $sql = "UPDATE `users` SET `status` = 3 WHERE `id` = $userId";
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
