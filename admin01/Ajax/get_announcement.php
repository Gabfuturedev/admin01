<?php
// Initialize database connection
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");
if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate input
$announcement_id = mysqli_real_escape_string($announcement_con, $_GET['id']);

// Fetch announcement details from database
$sql = "SELECT * FROM announcement WHERE id = '$announcement_id'";
$result = mysqli_query($announcement_con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $response = array(
        'status' => 'success',
        'announcement' => array(
            'title' => $row['title'],
            'announcement_content' => $row['announcement_content']
        )
    );
} else {
    $response = array('status' => 'error');
}

mysqli_close($announcement_con);
header('Content-Type: application/json');
echo json_encode($response);
?>
