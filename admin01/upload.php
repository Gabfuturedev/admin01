<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
</head>
<body>
    <h1>Upload Video</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="video">Select video to upload:</label>
        <input type="file" name="video" id="video" required>
        <br><br>
        <label for="instructor_email">Instructor Email:</label>
        <input type="email" name="instructor_email" id="instructor_email" required>
        <br><br>
        <label for="course_id">Course ID:</label>
        <input type="text" name="course_id" id="course_id" required>
        <br><br>
        <label for="lesson_number">Lesson Number:</label>
        <input type="number" name="lesson_number" id="lesson_number" required>
        <br><br>
        <input type="submit" value="Upload Video" name="submit">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $con = mysqli_connect('localhost', 'root', '', 'course_creation');
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_FILES['video'])) {
            if ($_FILES['video']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["video"]["name"]);
                $uploadOk = 1;
                $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if video file is an actual video by MIME type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $_FILES["video"]["tmp_name"]);
                finfo_close($finfo);

                if (strpos($mime, 'video/') === 0) {
                    echo "File is a video - " . $mime . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not a video.<br>";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["video"]["size"] > 500000000000000) {
                    echo "Sorry, your file is too large.<br>";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov" && $videoFileType != "wmv") {
                    echo "Sorry, only MP4, AVI, MOV, & WMV files are allowed.<br>";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars(basename($_FILES["video"]["name"])) . " has been uploaded.<br>";

                        // Insert into database
                        $instructor_email = $_POST['instructor_email'];
                        $course_id = $_POST['course_id'];
                        $lesson_number = $_POST['lesson_number'];

                        $sql = "INSERT INTO videolessons (instructor_email, course_Id, lessonNumber, videoPath) VALUES ('$instructor_email', '$course_id', '$lesson_number', '$target_file')";

                        if (mysqli_query($con, $sql)) {
                            echo "Video details saved to database.<br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.<br>";
                    }
                }
            } else {
                // Handle file upload errors
                $upload_errors = array(
                    UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
                    UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
                    UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
                    UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
                    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
                    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
                    UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
                );
                $error_message = isset($upload_errors[$_FILES['video']['error']]) ? $upload_errors[$_FILES['video']['error']] : "Unknown upload error.";
                echo "Error: " . $error_message . "<br>";
            }
        } else {
            echo "No file was uploaded.<br>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
