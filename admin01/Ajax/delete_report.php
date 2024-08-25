<?php
$con = mysqli_connect('localhost', 'root', '', 'course_creation');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['videoId'])) {
    $videoId = intval($_POST['videoId']);
    
    // Update the report status to approved (assuming you have a column for status in your `video_reports` table)
    $sql = "UPDATE video_reports SET status = 3 WHERE videoId = $videoId";
    if (mysqli_query($con, $sql)) {
        echo "Report approved";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
