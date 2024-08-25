<?php
header('Content-Type: application/json');

// Establish a database connection
$con = mysqli_connect('localhost', 'root', '', 'user');

// Check connection
if (!$con) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Get the search query
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// SQL query to search for instructors
$sql = "SELECT * FROM `users` WHERE `status` = '1' AND (`fullname` LIKE '%$search%' OR `email` LIKE '%$search%')";

$result = mysqli_query($con, $sql);

$instructors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $instructors[] = [
        'fullname' => htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8'),
        'email' => htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'),
        'status' => htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'),
        'id' => $row['id']
    ];
}

// Output the JSON
echo json_encode($instructors);

// Close the database connection
mysqli_close($con);
?>
