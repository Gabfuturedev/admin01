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
$sql = "SELECT * FROM contbl where status = 0";



$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                margin-right: px;
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
        <h1 style="text-align: center;" class="label-dashboard" >Applicants</h1>
        <form id="searchForm">
    <input type="text" id="searchInput" placeholder="Search by name, email, or city">
    <button type="submit">Search</button>
</form>


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
                        echo "<td data-label='Status' id='status_" . $row["id"] . "'>" . $status . "</td>";
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
        document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from reloading the page

    const searchQuery = document.getElementById('searchInput').value;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "Ajax/fetch_applicants.php?search=" + encodeURIComponent(searchQuery), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.querySelector("tbody").innerHTML = xhr.responseText; // Update the table body with the response
        }
    };
    xhr.send();
});
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
                    // If confirmed, send an AJAX request to update the status
                    updateStatus(id, status);
                }
            });
        }

        function updateStatus(id, status) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "Pages/update_application_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the status in the table without reloading
                    const statusText = status === 1 ? 'Approved' : 'Rejected';
                    document.getElementById(`status_${id}`).innerText = statusText;
                }
            };
            xhr.send(`id=${id}&status=${status}`);
        }
    
    </script>
</body>
</html>

<?php
$conn->close();
?>
