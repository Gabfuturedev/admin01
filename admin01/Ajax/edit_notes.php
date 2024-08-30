<?php
$con = mysqli_connect('localhost', 'root', '', 'announcementDB');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id']) && isset($_POST['content'])) {
    $id = (int)$_POST['id'];
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $sql = "UPDATE notes SET content='$content' WHERE id=$id";

    if (mysqli_query($con, $sql)) {
        echo "Note updated successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
