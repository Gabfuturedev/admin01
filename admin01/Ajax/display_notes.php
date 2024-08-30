<?php
$con = mysqli_connect('localhost', 'root', '', 'announcementDB');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

$notes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $notes[] = $row;
}

echo json_encode($notes);

mysqli_close($con);
?>
