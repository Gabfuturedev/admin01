<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'announcementDB');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the note content is received via POST request
if (isset($_POST['noteContent'])) {
    $noteContent = mysqli_real_escape_string($con, $_POST['noteContent']);
    $timestamp = date('Y-m-d H:i:s'); // Current timestamp

    // Insert the note into the database
    $sql = "INSERT INTO notes (content, created_at) VALUES ('$noteContent', '$timestamp')";
    
    if (mysqli_query($con, $sql)) {
        echo "Note saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
