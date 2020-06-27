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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"></link>
</head>
<body>
    