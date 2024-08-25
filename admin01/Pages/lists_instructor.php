<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Add your CSS styling here */
        .applicant-container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            background-color: white;
            word-break: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        @media (max-width: 768px) {
            .applicant-container{
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            margin-bottom: 20px; 
            overflow: auto;
            margin-right: 15%;
            }
                table {
                border: 0;
            }

            table thead {
                display: none;
            }

            table, 
            tbody, 
            tr, 
            td {
                display: block;
                width: 100%;
            }

            tr {
                margin-bottom: 10px;
                border-bottom: 2px solid #ddd;
            }

            td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #ddd;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="applicant-container">
        <div class="applicant-list">
            <h1 class="label-dashboard">Instructor</h1>
            <input type="text" id="searchInstructor" placeholder="Search instructor...">
            <button id="searchButton">Search</button>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody id="instructorList">
                    <?php
                    // Enable error reporting
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    // Establish a database connection
                    $con = mysqli_connect('localhost', 'root', '', 'user');

                    // Check connection
                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch users with status '1'
                    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '1'");

                    // Loop through each user and display their information in a table row
                    while ($row = mysqli_fetch_array($sql)) {
                        // Escape output to prevent XSS
                        $fullname = htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8');
                        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                        $status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
                        $userId = $row['id']; // Assuming there's an 'id' column

                        echo "<tr>
                            <td data-label='Name'>$fullname</td>
                            <td data-label='Email' >$email</td>
                            <td data-label='Status'>$status</td>
                            <td data-label='Action'>
                                <a href='#' class='delete-link' data-user-id='$userId'>Delete</a>
                            </td>
                            <td data-label='Message'><i type='button' style='font-size: 1.5rem' id='message-$userId' data-user-id='$userId' data-fullname='$fullname' class='bx bx-message-dots'></i></td>
                        </tr>";
                    }

                    // Close the database connection
                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
    const searchQuery = document.getElementById('searchInstructor').value.trim();
    
    fetch('Ajax/fetch_instructor.php?search=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            const instructorList = document.getElementById('instructorList');
            instructorList.innerHTML = ''; // Clear the existing list

            if (data.length === 0) {
                instructorList.innerHTML = '<tr><td colspan="5">No instructors found.</td></tr>';
            } else {
                data.forEach(instructor => {
                    const { fullname, email, status, id } = instructor;
                    instructorList.innerHTML += `
                        <tr>
                            <td data-label='Name'>${fullname}</td>
                            <td data-label='Email'>${email}</td>
                            <td data-label='Status'>${status}</td>
                            <td data-label='Action'>
                                <a href='#' class='delete-link' data-user-id='${id}'>Delete</a>
                            </td>
                            <td data-label='Message'><i type='button' style='font-size: 1.5rem' id='message-${id}' data-user-id='${id}' data-fullname='${fullname}' class='bx bx-message-dots'></i></td>
                        </tr>`;
                });
            }
        })
        .catch(error => console.error('Error fetching instructors:', error));
});

    document.querySelectorAll('.delete-link').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            let userId = event.target.getAttribute('data-user-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this instructor?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete (update status to 3)
                    fetch('Ajax/delete_user.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ userId: userId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', 'The instructor has been deleted.', 'success')
                            .then(() => location.reload()); // Reload the page to see changes
                        } else {
                            Swal.fire('Failed', 'Failed to delete the instructor.', 'error');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    });

    document.querySelectorAll('.bx-message-dots').forEach(item => {
        item.addEventListener('click', event => {
            let userId = event.target.getAttribute('data-user-id');
            let fullname = event.target.getAttribute('data-fullname');
            let email = event.target.closest('tr').querySelector('td[data-label="Email"]').textContent.trim();

            Swal.fire({
                title: `Send a message to ${fullname}`,
                input: 'text',
                inputPlaceholder: 'Type your message here...',
                showCancelButton: true,
                confirmButtonText: 'Send',
                cancelButtonText: 'Cancel',
                preConfirm: (message) => {
                    if (!message) {
                        Swal.showValidationMessage('Please enter a message');
                    } else {
                        fetch('Ajax/send_message.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ userId: userId, email: email, fullname: fullname, message: message })
                        })
                        .then(response => response.text())
                        .then(text => {
                            console.log('Raw response:', text);
                            try {
                                const data = JSON.parse(text);
                                if (data.success) {
                                    Swal.fire('Message sent!', '', 'success');
                                } else {
                                    Swal.fire('Failed to send message', '', 'error');
                                }
                            } catch (error) {
                                console.error('JSON parse error:', error);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
