<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Videos</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <style>
        .video-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
            max-height: 80vh; /* Set a max height */
            border-radius: 20px;
            background-color: white;
            padding: 20px;
            border: 1px solid #0D0A0B;
            margin-left: 12%;
            margin-top: 8%;
            overflow-y: auto; /* Enable scrolling if content overflows */
        }
        .videos {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
        }
        .video-item {
            width: 100%;
            max-width: 800px; /* Limit width for better readability */
            background-color: #FFE08F;
            border-radius: 10px;
            padding: 10px;
            box-sizing: border-box; /* Include padding and border in element's total width/height */
        }
        .video-item video {
            width: 100%;
            height: auto; /* Maintain the aspect ratio */
            border-radius: 10px;
            display: block; /* Prevent extra spacing under the video */
        }
        .action-buttons, .form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            flex-direction: row;
            width: 100%;
        }
        button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 40px;
            color: black;
            transition: color 0.3s ease;
        }
        @media (max-width: 768px) {
            .video-container {
                width: 90%;
                margin-left: 0;
                margin-top: 0;
                max-height: 60vh; /* Adjust height for mobile */
                padding: 10px;
            }
            .video-item {
                max-width: 100%; /* Ensure full width on smaller screens */
            }
        }
    </style>
</head>
<body>
<h1 class="label-dashboard">Monitor Videos </h1>
    <div class="video-container">
    
        <?php 
        $con = mysqli_connect('localhost', 'root', '', 'course_creation');
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['check_status'])) {
                $videoId = $_POST['video_id'];
                $status = 1; // Set status to 1 when checked
                updateVideoStatus($con, $videoId, $status);
            } elseif (isset($_POST['warn_status'])) {
                $videoId = $_POST['video_id'];
                $status = 3; // Set status to 3 when warned
                updateVideoStatus($con, $videoId, $status);
            } elseif (isset($_POST['delete_video'])) {
                $videoId = $_POST['video_id'];
                archiveVideo($con, $videoId);
                // deleteVideo($con, $videoId);
            }
        }
        
        // Fetch videos with status 0
        $sql = mysqli_query($con, "SELECT * FROM videolessons WHERE status = '0'");
        while ($row = mysqli_fetch_array($sql)) {
            echo "<div class='videos'>";
            echo "<div class='video-item'>";
            echo "<h2>Video ID: " . $row['videoId'] . "</h2>";
            echo "<video controls>";
            echo "<source src='" . $row['videoPath'] . "' type='video/mp4'>";
            echo "Your browser does not support the video tag.";
            echo "</video>";
            echo "<div class='action-buttons'>";
            echo "<form method='post' class='form' >";
            echo "<input type='hidden' name='video_id' value='" . $row['videoId'] . "'>";
            // echo "<button type='submit' name='check_status'><i class='bx bxs-check-square' style='color:#39ce2b'></i></button>";
           
            echo "<button type='submit' name='warn_status'><i class='bx bx-error' style='color:#9a2f3e'></i></button>";
            echo "<button type='submit' name='check_status'><i class='bx bxs-check-square' style='color:#39ce2b'></i></button>";
            echo "<button type='submit' name='delete_video'><i class='bx bx-trash' style='color:#9a2f3e'></i></button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        
        mysqli_close($con);
        
        function updateVideoStatus($con, $videoId, $status) {
            $updateSql = "UPDATE videolessons SET status = '$status' WHERE videoId = '$videoId'";
            if (mysqli_query($con, $updateSql)) {
                echo '<script>                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your announcement has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else {
                echo '<script>Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error saving announcement",
                        showConfirmButton: false,
                        timer: 1500
                    });</script>'. mysqli_error($con);
            }
        }
        
        function archiveVideo($con, $videoId) {
            $selectSql = "SELECT * FROM videolessons WHERE videoId = '$videoId'";
            $result = mysqli_query($con, $selectSql);
            if ($row = mysqli_fetch_array($result)) {
                $instructorEmail = $row['instructor_email'];
                $courseId = $row['course_Id'];
                $lessonNumber = $row['lessonNumber'];
                echo $videoPath = $row['videoPath']; // Ensure videoPath is fetched correctly
                
                // Insert into archive table
                $insertSql = "INSERT INTO achivevids (videoId, instructor_email, course_Id, lessonNumber,videoPath) 
                              VALUES ('$videoId', '$instructorEmail', '$courseId', '$lessonNumber', '$videoPath')";
                
                if (mysqli_query($con, $insertSql)) {
                    echo "Video archived successfully.";
                    $deleteSql = "DELETE FROM videolessons WHERE videoId = '$videoId'";
                    if (mysqli_query($con, $deleteSql)) {
                        echo "Video deleted successfully.";
                    } else {
                        echo "Error deleting video: " . mysqli_error($con);
                    }
                } else {
                    echo "Error archiving video: " . mysqli_error($con);
                }
            }
        }
        
        

        ?>
    </div>
</body>
</html>
