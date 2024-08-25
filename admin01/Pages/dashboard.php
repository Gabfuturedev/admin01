<?php 
$con = mysqli_connect('localhost','root','','user');
if(!$con){
    die("connection failed".mysqli_connect_error());
}
// counting all the user 
$sql = "SELECT COUNT(*) as total_count FROM `users`";
$result = mysqli_query($con, $sql);

// Fetch the result as an associative array
$row = mysqli_fetch_assoc($result);

// Get the total count from the array
$totalnumber = $row["total_count"];

// Output the total number
// counting active students
$sqlstudent = "SELECT COUNT(*) as total_student FROM `users` WHERE `status` = '0'";
$resultstudent = mysqli_query($con, $sqlstudent);

// Fetch the result as an associative array
$rowstudent = mysqli_fetch_assoc($resultstudent);

// Get the total count from the array
$totalstudents = $rowstudent["total_student"];

//counting all the professor
$sqlprofessor = "SELECT COUNT(*) as total_professor FROM `users` WHERE `status` = '1'";
$resultprofessor = mysqli_query($con, $sqlprofessor);
$rowprofessor = mysqli_fetch_assoc($resultprofessor);
$totalprofessor = $rowprofessor["total_professor"];

$sqlapplicants = "SELECT COUNT(*) as total_applicant FROM `users` WHERE `status` = '2'";
$resultapplicants = mysqli_query($con, $sqlapplicants);
$rowapplicants = mysqli_fetch_assoc($resultapplicants);
$totalapplicants = $rowapplicants["total_applicant"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body style="background-color: #F3EFF5;" >
    <h1 class="label-dashboard" >Dashboard</h1>
   <div class="dashboard-container">
   <div class="card-item">
        <p class="label-totaluser" >Total Users</p>
        <p class="total-user" ><?php echo $totalnumber; ?></p>
   </div>
    <div class="card-item">
        <p class="label-totaluser" >Students</p>
        <p class="total-user" ><?php echo $totalstudents; ?></p>   
    </div>
    <div class="card-item">
        <p class="label-totaluser" >Instructors</p>
        <p class="total-user" ><?php echo $totalprofessor; ?></p>
    </div>
    <div class="card-item">
    <p class="label-totaluser" >Total Users</p>
    <p class="total-user" ><?php echo $totalapplicants; ?></p>
    </div>
   </div>
</body>
</html>