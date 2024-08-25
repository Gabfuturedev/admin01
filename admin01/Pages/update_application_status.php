<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all applications
$sql = "SELECT * FROM contbl";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application List</title>
    <style>
        .applicant-container {
            width: 90%;
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
        }

        th {
            background-color: #f2f2f2;
        }

        @media (max-width: 768px) {
            .applicant-container{
                margin-top: 20px;
                display: flex;
                flex-direction: column;
                margin-bottom: 20px; 
                overflow: auto;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            background-color: white;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="applicant-container">
        <h2 style="text-align: center;">List of Applications</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Street Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Zip Code</th>
                    <th>Application Letter</th>
                    <th>CV</th>
                    <th>Picture</th>
                    <th>Valid ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = "Pending";
                        if ($row["status"] == 1) {
                            $status = "Approved";
                        } elseif ($row["status"] == 2) {
                            $status = "Rejected";
                        }
                        echo "<tr>";
                        echo "<td data-label='ID'>" . $row["id"] . "</td>";
                        echo "<td data-label='Name'>" . $row["firstName"] . "</td>";
                        echo "<td data-label='Email'>" . $row["email"] . "</td>";
                        echo "<td data-label='Contact Number'>" . $row["conNum"] . "</td>";
                        echo "<td data-label='Street Address'>" . $row["streetAddress"] . "</td>";
                        echo "<td data-label='City'>" . $row["city"] . "</td>";
                        echo "<td data-label='Province'>" . $row["province"] . "</td>";
                        echo "<td data-label='Zip Code'>" . $row["zipCode"] . "</td>";
                        echo "<td data-label='Application Letter'><a href='#' onclick='openModal(\"" . $row["appLetter"] . "\")'>View</a></td>";
                        echo "<td data-label='CV'><a href='#' onclick='openModal(\"" . $row["cv"] . "\")'>View</a></td>";
                        echo "<td data-label='Picture'><a href='#' onclick='openModal(\"" . $row["picture"] . "\")'>View</a></td>";
                        echo "<td data-label='Valid ID'><a href='#' onclick='openModal(\"" . $row["valId"] . "\")'>View</a></td>";
                        echo "<td data-label='Date'>" . $row["date"] . "</td>";
                        echo "<td data-label='Status'>" . $status . "</td>";
                        echo "<td data-label='Action'>
                            <a href='#' onclick='confirmAction(" . $row["id"] . ", 1)'>Approve</a> | 
                            <a href='#' onclick='confirmAction(" . $row["id"] . ", 2)'>Reject</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='15'>No applications found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Document" style="width:100%;">
        </div>
    </div>

    <script>
        function openModal(imageSrc) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }

        function confirmAction(id, status) {
            const statusText = status === 1 ? 'approve' : 'reject';
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to ${statusText} this application?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yes, ${statusText} it!`,
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to PHP script to update the status
                    window.location.href = `Pages/update_application_status.php?id=${id}&status=${status}`;
                }
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
