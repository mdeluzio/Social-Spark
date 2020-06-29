<?php 
    include '/home2/markdevnucitrus/connection.php'; 
    
    if(isset($_SESSION['username'])) {
       $userLoggedIn =  $_SESSION['username'];
       $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
       $user = mysqli_fetch_array($user_details_query);
    } else {
        //temp code to control sessions before implementing logout functionality
        header("Location: application/register.php");
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Spark</title>
    
    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="application/assets/js/bootstrap.js"></script>
    
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <link rel="stylesheet" type="text/css" href="application/assets/css/bootstrap.css"></link>
    <link rel="stylesheet" type="text/css" href="application/assets/css/style.css"></link>

</head>
<body>
    
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Social Spark!</a>
        </div>
    
        <nav>
            <a class="my_profile_link" href="#">
                <?php echo $user["first_name"]; ?>
            </a>
            <a class="home_link" href="index.php">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a class="messages_link" href="#">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a class="notification_link" href="#">
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <a class="friends_link" href="#">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a class="settings_link" href="#">
                <i class="fa fa-cog fa-lg"></i>
            </a>
            <a class="settings_link" href="#">
                <i class="fa fa-sign-out fa-lg"></i>
            </a>
        </nav>
    </div>
    
    <div class="wrapper">
        
