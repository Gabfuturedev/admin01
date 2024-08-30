<?php 
    session_start(); 
    // Start the session

    if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
        // If the user is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
    
    $username = $_SESSION['username'];
    $userid = $_SESSION['id'];
    //  Use $_SESSION['id'] instead of $id
    // echo "Welcome, " . htmlspecialchars($username) . " (ID: " . htmlspecialchars($userid) . ")";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="left-side">
        <div class="burger-menu" id="burger-menu" onclick="openNav()">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <div class="nav-bar" id="nav-bar">
            <h4  class="user-admin" style="color:#f3eff5;display:flex;flex-direction:row;gap: 5px;margin-top: 10%;margin-left: 5%;">
                <img src="channels4_profile.jpg" class="profile-pic" alt="">
                <span style="color:#f3eff5;line-height: 50px;" ><?php echo htmlspecialchars($username) ?></span> 
                <span><form action="" method="get"><a href="index.php?settings"><i class='bx bx-cog' style='color:#f3eff5;line-height: 50px;' ></i></a></form></span> </h4>
            <hr style="color:#f3eff5;width: 60%;margin-left: 23%;position: absolute;margin-top: 25%;"  >
            <h4 class="label-menu" >Menu</h4>
            <ul>
                <form action="" method="get">
                <li><a href="index.php?Pages/teshdash.php"  class="nav-item"><i class='bx bxs-dashboard' style='color:#f3eff5;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'  ></i> Dashboard</a></li>
                <li><a href="index.php?users" class="nav-item" ><i class='bx bx-user' style='color:#f3eff5;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'></i> Applicants</a></li>
                <li><a href="index.php?jobs" class="nav-item" ><i class='bx bx-chalkboard' style='color:#f3eff5;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'> </i> Instructors</a></li>
                <li><a href="index.php?announcement" class="nav-item" ><i class='bx bx-bell' style='color:#f3eff5;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'  > </i> Announcement</a></li>
                <li><a href="index.php?monitor_vids" class="nav-item" ><i class='bx bx-show' style='color:#f3eff5;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'  > </i> Monitor Videos</a></li>
                <li><a href="index.php?Logout" class="nav-item" ><i class='bx bx-exit' style='color:#c75f5f;font-size: 20px;margin-left: 5%;margin-bottom: 5%;'  > </i> Logout</a></li>
                </form>
                
            </ul>
        </div>
    </div>
    <div class="main-content">
        <!-- dito lagay yung mga included pages  -->
        <?php 
     if(isset($_GET['Pages/testdash.php'])){
        include 'teshdash.php';
     }elseif(isset($_GET['users'])){
        include 'Pages/lists_applications.php';
     }elseif(isset($_GET['jobs'])){
        include 'Pages/lists_instructor.php';
     }elseif(isset($_GET['announcement'])){
        include 'Pages/announcement.php';
     }elseif(isset($_GET['monitor_vids'])){
        include 'Pages/reported_videos.php';
     }elseif(isset($_GET['settings'])){
        include 'Pages/settings.php';
     }elseif(isset($_GET['Logout'])){
        header("Location:logout.php") ;
     }else{
        include 'Pages/teshdash.php';
     }
     ?> 
    </div>
</body>
<script>
    document.addEventListener('click', function(event) {
        const navBar = document.getElementById('nav-bar');
        const burgerMenu = document.getElementById('burger-menu');
        
        if (!navBar.contains(event.target) && !burgerMenu.contains(event.target)) {
            navBar.classList.remove('active');
        }
    });

    function openNav() {
        document.getElementById('nav-bar').classList.toggle('active');
    }
    document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-item');
    let isActiveSet = false;

    // Set the active class based on the current URL
    const currentUrl = window.location.href;
    navItems.forEach(item => {
        if (currentUrl.includes(item.getAttribute('href'))) {
            item.classList.add('active');
            isActiveSet = true;
        }
    });

    // If no other items match the current URL, set Dashboard as the default active
    if (!isActiveSet) {
        document.querySelector('.nav-item[href="index.php?Pages/dashboard.php"]').classList.add('active');
    }

    // Add click event to each nav-item
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all nav-items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to the clicked nav-item
            this.classList.add('active');
        });
    });
});


</script>

</html>
