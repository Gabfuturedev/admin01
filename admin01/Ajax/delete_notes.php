<?php
$con = mysqli_connect('localhost', 'root', '', 'announcementDB');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Prepare and execute the SQL delete statement
    $sql = "DELETE FROM notes WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Note deleted successfully.";
    } else {
        echo "Error deleting note: " . mysqli_error($con);
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>
