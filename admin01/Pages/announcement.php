<?php
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set('UTC'); // Set your timezone as needed

// Get current date
$current_date = date('Y-m-d');

// Update announcements where publish_date is less than or equal to current_date
$update_query = "UPDATE announcement SET Status = 1 WHERE publish_date <= '$current_date' AND Status = 0";

if (mysqli_query($announcement_con, $update_query)) {
    // echo "Announcements updated successfully.<br>";
} else {
    echo "Error updating announcements: " . mysqli_error($announcement_con) . "<br>";
}

// Update announcements where expiration_date is less than or equal to current_date
$delete_query = "UPDATE announcement SET Status = 2 WHERE expiration_date <= '$current_date' AND Status = 1";

if (mysqli_query($announcement_con, $delete_query)) {
    // echo "Expired announcements updated successfully.<br>";
} else {
    echo "Error updating expired announcements: " . mysqli_error($announcement_con) . "<br>";
}

mysqli_close($announcement_con);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
   <style>
    

.announcement-container {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5%;
    margin-top: 5%;
    background-color: #F3EFF5;

    
    
}

.add-announcement {
    width: 200px;
    height: 40px;
    background-color: white;
    border: 1px solid black;
    border-radius: 10px;
    align-items: center;
    padding: 10px;
    display: flex;
    cursor: pointer;
    background-color: #72B01D;
    margin-left: 60%;
    margin-bottom: 10px;
}
.announcement-board, .publish-announcement {
    width: 80%;
    /* height: 100%; */
    display: flex;
    flex-direction: column;
    gap: 10px;
    border: 1px solid black;
    overflow: auto;
    background-color: white;
    border-radius: 20px;
    align-items: center;
    padding: 20px;
    margin-bottom: 20px;
    
    
}

.announcement-form {
    display: none;
    flex-direction: column;
    gap: 10px;
    width: 50%;
    padding: 20px;
    background-color: #F3EFF5;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.25);
    position: absolute;
    z-index: 1;
    height: 600px;

}

.announcement-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 30%;
}

.announcement-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 100%;
}

.announcement-form button {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.announcement-form button:hover {
    background-color: #45a049;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #C75F5F;
}.announcement-box {
    width: 80%;
    display: flex;
    flex-direction: column;
    /* /* justify-content: space-between; */
    gap: 10px; 
    border: 1px solid black;
    /* background-color: white; */
    border-radius: 20px;
    padding: 20px;
    word-wrap: break-word; /* Ensure long words wrap */
}.publish-box{
    width: 80%;
    display: flex;
    flex-direction: column;
    /* /* justify-content: space-between; */
    gap: 10px; 
    border: 1px solid black;
    /* background-color: white; */
    border-radius: 20px;
    padding: 20px;
    word-wrap: break-word; /* Ensure long words wrap */
}
.announcement-board{
    width: 80%;
    min-height: 800px; /* Limit width for better readability */
    border-radius: 10px;
    padding: 10px;
}.publish-announcement{
    width: 80%;
    min-height: 800px; /* Limit width for better readability */
    border-radius: 10px;
    padding: 10px;
}.announcement-box{
    width: 80%;
    max-height: 800px; /* Limit width for better readability */
    border-radius: 10px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    /* gap: 10px; */
    
}img{
    max-width: 90%;
    max-height: 70%;
    object-fit: cover;
    border-radius: 10px;
    
}

.announcement-form label {
    font-weight: bold;
    font-size: 20px;
    word-wrap: break-word; /* Ensure long labels wrap */
    text-align: center; /* Center-align labels */
}@media (max-width: 768px) {
    .announcement-board, .publish-announcement {
        width: 90%;
        height: 90%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px solid black;
        overflow: auto;
        background-color: white;
        border-radius: 20px;
        align-items: center;
        padding: 20px;
        margin-bottom: 20px;
    }.announcement-container {
    width: 90%;
    height: 90%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5%;
    margin-top: 5%;
    background-color: #F3EFF5;

    
    
}.add-announcement{
    width: 200px;
    height: 40px;
    background-color: white;
    border: 1px solid black;
    border-radius: 10px;
    align-items: center;
    padding: 20px;
    display: flex;
    cursor: pointer;
    background-color: #72B01D;
    margin-left: 30%;
}.announcement-form {
    display: none;
    flex-direction: column;
    gap: 10px;
    width: 80%;
    padding: 20px;
    background-color: white;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.25);
    position: absolute;
    z-index: 1;
    height: 600px;

}

.announcement-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 30%;
}

.announcement-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 100%;
}

.announcement-form button {
    padding: 10px;
    background-color: #72B01D;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
}

   </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="announcement-container">
    <!-- <h1 class="title-announcement" style="color:#0D0A0B">Announcement</h1> -->
        <button class="add-announcement"><i class='bx bx-plus-circle bx-flip-horizontal' style='color:#F3EFF5;font-size: 24px;margin-right: 10px;'  ></i> <p style='color:#F3EFF5;font-size: 12px'> Add Announcement</p></button>
<form class="announcement-form" id="announcementForm" enctype="multipart/form-data">
    <button type="button" class="close-button">X</button>
    <label for="title">Announcement Title</label>
    <input type="text" name="title" placeholder="Title" required />
    <label for="announcement_content">Announcement Details</label>
    <textarea name="announcement_content" placeholder="Details" required></textarea>
    <label for="file">Upload Image</label>
    <input type="file" name="file" id="file" required />
    <label for="publish_date">Publish Date:</label>
    <input type="date" id="publish_date" name="publish_date" >
    <label for="publish_date">Due Until:</label>
    <input type="date" id="expiration_date" name="expiration_date" >
    <input type="hidden" name="date" id="date" />
    <button type="submit">Submit</button>
</form>
<!-- <h4 class="label-announcement" style="color:#0D0A0B">Announcement</h4> -->
        <div class="announcement-board">
            <h3>Announcements</h3>  
            <hr>
            <!-- Existing announcements will be inserted here -->
            <?php
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

$announcement_query = "SELECT * FROM announcement WHERE Status = 0 ORDER BY date DESC";
$announcement_result = mysqli_query($announcement_con, $announcement_query);

if (mysqli_num_rows($announcement_result) > 0) {
    while ($row = mysqli_fetch_assoc($announcement_result)) {
        echo "<div class='announcement-box' data-id='" . $row['id'] . "' data-title='" . $row['title'] . "' data-content='" . $row['announcement_content'] . "' data-date='" . $row['date'] . "' data-image='" . (!empty($row['image_path']) ? './image/' . basename($row['image_path']) : '') . "'>";
        echo "<p class='announcement-date'><strong>Date:</strong> " . $row['date'] . "</p>";
        echo "<p class='publish-date'><strong>Publish Date:</strong> " . $row['publish_date'] . "</p>";
        echo "<h3 class='announcement-title'>" . $row['title'] . "</h3>";
        echo "<p class='announcement-content'>" . $row['announcement_content'] . "</p>";
        if (!empty($row['image_path'])) {
            echo "<img src='./image/" . basename($row['image_path']) . "' alt='Announcement Image' style='max-width: 100%; height: auto;' />";
        }
        echo "</div>";
    }
} else {
    echo "<p>No announcements found.</p>";
}

mysqli_close($announcement_con);
?>



        </div>
    <div class="publish-announcement" >
        <h3>Publish Announcement</h3>
        <hr>
        <!-- Existing announcements will be inserted here -->
        <?php
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

$announcement_query = "SELECT * FROM announcement WHERE Status = 1 ORDER BY date DESC";
$announcement_result = mysqli_query($announcement_con, $announcement_query);

if (mysqli_num_rows($announcement_result) > 0) {
    while ($row = mysqli_fetch_assoc($announcement_result)) {
        echo "<div class='publish-box' data-id='" . $row['id'] . "' data-title='" . $row['title'] . "' data-content='" . $row['announcement_content'] . "' data-date='" . $row['date'] . "' data-image='" . (!empty($row['image_path']) ? './image/' . basename($row['image_path']) : '') . "'>";
        echo "<p class='announcement-date'><strong>Date:</strong> " . $row['date'] . "</p>";
        echo "<h3 class='announcement-title'>" . $row['title'] . "</h3>";
        echo "<p>" . $row['announcement_content'] . "</p>";
        if (!empty($row['image_path'])) {
            echo "<img src='./image/" . basename($row['image_path']) . "' alt='Announcement Image' style='max-width: 100%; height: auto;' />";
        }
        echo "</div>";
    }
} else {
    echo "<p>No announcements found.</p>";
}

mysqli_close($announcement_con);
?>



    </div>
        </div>
   

   
</body>
</html>
<script>
        // to show the form 
        document.querySelector('.add-announcement').addEventListener('click', function() {
            document.querySelector('.announcement-form').style.display = 'flex';
        });
        // to hide the form 
        document.querySelector('.close-button').addEventListener('click', function() {
            document.querySelector('.announcement-form').style.display = 'none';
        });
        // to get the time automatically and add announcement 
        document.querySelector('#announcementForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const currentTimestamp = new Date().toISOString().slice(0, 19).replace('T', ' ');
            document.getElementById('date').value = currentTimestamp;

            const formData = new FormData(this);

            fetch('Ajax/add_announcement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your announcement has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
        location.reload();
    }, 1500);
                            

                   
                    document.querySelector('.announcement-form').reset();
                    document.querySelector('.announcement-form').style.display = 'none';
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Error saving announcement",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error saving announcement",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    // pop up when got clicked
    document.querySelectorAll('.announcement-box').forEach(box => {
    box.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const content = this.getAttribute('data-content');
        const date = this.getAttribute('data-date');
        const image = this.getAttribute('data-image');

        Swal.fire({
            title: title,
            html: `
                <div style="border: 1px solid #ccc; padding: 20px; border-radius: 20px;">
                    ${image ? `<img src="${image}" alt="Announcement Image" style="max-width: 100%; height: auto; margin-bottom: 10px;" />` : ''}
                    <p>${content}</p>
                </div>
                <p><strong>Date:</strong> ${date}</p>
                <div class="action-buttons">
                      <button class="swal2-confirm" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="publishAnnouncement(${id})">Publish</button>
                    <button class="swal2-cancel" style="background-color: #d33; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="deleteAnnouncement(${id})">Delete</button>
                </div>`,
            showConfirmButton: false,
            showCancelButton: false,
        });
    });
});
document.querySelectorAll('.publish-box').forEach(box => {
    box.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const content = this.getAttribute('data-content');
        const date = this.getAttribute('data-date');
        const image = this.getAttribute('data-image');

        Swal.fire({
            title: title,
            html: `
                <div style="border: 1px solid #ccc; padding: 20px; border-radius: 20px;">
                    ${image ? `<img src="${image}" alt="Announcement Image" style="max-width: 100%; height: auto; margin-bottom: 10px;" />` : ''}
                    <p>${content}</p>
                </div>
                <p><strong>Date:</strong> ${date}</p>
                <div class="action-buttons">
                    
                    <button class="swal2-cancel" style="background-color: #d33; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="deleteAnnouncement(${id})">Delete</button>
                </div>`,
            showConfirmButton: false,
            showCancelButton: false,
        });
    });
});
        function publishAnnouncement(id) {
            fetch('Ajax/publish_announcement.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id,
            })
            .then(response => response.text())
            .then(result => {
                if (result === 'success') {
                    Swal.fire('Published!', 'The announcement has been published.', 'success').then(() => {
                        location.reload(); // Reload the page to reflect changes
                    });
                } else {
                    Swal.fire('Error', 'There was an error publishing the announcement.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'There was an error publishing the announcement.', 'error');
            });
        }

        function deleteAnnouncement(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('Ajax/delete_announcement.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id=' + id,
                    })
                    .then(response => response.text())
                    .then(result => {
                        if (result === 'success') {
                            Swal.fire('Deleted!', 'The announcement has been deleted.', 'success').then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        } else {
                            Swal.fire('Error', 'There was an error deleting the announcement.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'There was an error deleting the announcement.', 'error');
                    });
                }
            });
        }
</script>