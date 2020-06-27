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
</head>
<body>
    
