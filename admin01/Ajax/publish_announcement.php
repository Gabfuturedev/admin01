<?php
// publish_announcement.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $announcement_id = $_POST['id'];

    // Database connection
    $announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

    if (!$announcement_con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update announcement status
    $publish_query = "UPDATE announcement SET Status = 1 WHERE id = ?";
    $stmt = $announcement_con->prepare($publish_query);
    $stmt->bind_param('i', $announcement_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    mysqli_close($announcement_con);
}
?>
