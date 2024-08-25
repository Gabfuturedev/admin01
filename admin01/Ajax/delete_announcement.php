<?php
// delete_announcement.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $announcement_id = $_POST['id'];

    // Database connection
    $announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

    if (!$announcement_con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete announcement
    $delete_query = "DELETE FROM announcement WHERE id = ?";
    $stmt = $announcement_con->prepare($delete_query);
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
