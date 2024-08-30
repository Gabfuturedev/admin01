<?php 
$con = mysqli_connect('localhost', 'root', '', 'course_creation');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported Videos</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F3EFF5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin: 20px;
            font-size: 2.5em;
            color: #333;
        }
        .report-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        .video-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            height: 300px; /* Fixed height for video */
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .video-container video {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
        .description {
            text-align: center;
            margin: 10px 0;
            font-size: 1.2em;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0;
        }
        .actions button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.5em;
            transition: color 0.3s;
        }
        .actions button.approve {
            color: #39ce2b;
        }
        .actions button.delete {
            color: #9a2f3e;
        }
        .reason {
            background-color:#C75F5F;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
            text-align: center;
            font-size: 1em;
        }
        @media (max-width: 768px) {
            .video-container {
                height: 200px; /* Adjust video height for smaller screens */
            }
        }
    </style>
</head>
<body>
    <h1 class="label-dashboard" >Reported Videos</h1>
    <?php 
    $sql = "SELECT vr.videoId, vr.timestamp, vr.reportTime, vl.videoPath, vr.reason
            FROM video_reports vr
            JOIN videolessons vl ON vr.videoId = vl.videoId
            WHERE vr.status = 0";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $videoId = $row['videoId'];
            $timestamp = $row['timestamp'];
            $videoPath = $row['videoPath'];
            $reason = $row['reason'];

            // Convert the timestamp to seconds
            list($minutes, $seconds) = explode(':', $timestamp);
            $startTime = ($minutes * 60) + $seconds;
        ?>
        <div class="report-item">
            <div class="video-container">
                <video id="video_<?php echo $videoId; ?>" controls>
                    <source src="<?php echo $videoPath; ?>" type="video/mp4">
                </video>
            </div>
            <div class="description">
                <button style="padding: 10px" onclick="playVideoFromTimestamp(<?php echo $videoId; ?>, <?php echo $startTime; ?>)">
                    Play from <?php echo $timestamp; ?>
                </button>
            </div>
            <div class="actions">
                <button class="approve" onclick="approveReport(<?php echo $videoId; ?>)">
                    <i class='bx bxs-check-square'></i>
                </button>
                <button class="delete" onclick="deleteReport(<?php echo $videoId; ?>)">
                    <i class='bx bx-trash'></i>
                </button>
            </div>
            <div class="reason"><?php echo $reason; ?></div>
        </div>
        <?php
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
    ?>
    <script>
        function playVideoFromTimestamp(videoId, startTime) {
            var video = document.getElementById('video_' + videoId);
            video.currentTime = startTime;
            video.play();
        }

        function approveReport(videoId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'Ajax/approve_report.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    Swal.fire('Success', 'Report approved for video ID: ' + videoId, 'success');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    Swal.fire('Error', 'Error approving report', 'error');
                }
            };
            xhr.send('videoId=' + videoId);
        }

        function deleteReport(videoId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'Ajax/delete_report.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    Swal.fire('Success', 'Report deleted for video ID: ' + videoId, 'success');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    Swal.fire('Error', 'Error deleting report', 'error');
                }
            };
            xhr.send('videoId=' + videoId);
        }
    </script>
</body>
</html>
<?php 
mysqli_close($con);
?>
