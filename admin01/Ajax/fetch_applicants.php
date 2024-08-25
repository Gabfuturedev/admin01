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

// Handle search query
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM contbl WHERE status = 0";
if ($search) {
    $sql .= " AND (firstName LIKE '%$search%' OR email LIKE '%$search%' OR city LIKE '%$search%')";
}

$result = $conn->query($sql);

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

$conn->close();
?>
