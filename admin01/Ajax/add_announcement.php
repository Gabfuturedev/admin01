<?php
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($announcement_con, $_POST['title']);
    $content = mysqli_real_escape_string($announcement_con, $_POST['announcement_content']);
    $date = mysqli_real_escape_string($announcement_con, $_POST['date']);
    $publish_date = mysqli_real_escape_string($announcement_con, $_POST['publish_date']);
    $expiration_date = mysqli_real_escape_string($announcement_con, $_POST['expiration_date']);
    $target_dir = "../image/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response = ["status" => "error", "message" => "Sorry, your file was not uploaded."];
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $image_path = mysqli_real_escape_string($announcement_con, $target_file);
            $sql = "INSERT INTO announcement (title, announcement_content, date, image_path, publish_date, expiration_date) VALUES ('$title', '$content', '$date', '$image_path','$publish_date','$expiration_date')";
            if (mysqli_query($announcement_con, $sql)) {
                $response = ["status" => "success"];
            } else {
                $response = ["status" => "error", "message" => "Error saving announcement: " . mysqli_error($announcement_con)];
            }
        } else {
            $response = ["status" => "error", "message" => "Sorry, there was an error uploading your file."];
        }
    }

    echo json_encode($response);
    mysqli_close($announcement_con);
}
?>
