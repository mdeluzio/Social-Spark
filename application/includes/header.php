<?php 
    include '/home2/markdevnucitrus/connection.php'; 
    
    if(isset($_SESSION['username'])) {
       $userLoggedIn =  $_SESSION['username'];
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
    <link rel="stylesheet" type="text/css" href="application/assets/css/bootstrap.css"></link>
    <link rel="stylesheet" type="text/css" href="application/assets/css/style.css"></link>

</head>
<body>
    
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Social Spark!</a>
        </div>
    </div>