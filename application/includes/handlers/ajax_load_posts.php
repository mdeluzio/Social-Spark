<?php 
    include("/home2/markdevnucitrus/connection.php");
    include("../classes/User.php");
    include("../classes/Post.php");
    
    $limit = 10; //Number of posts to be loaded per call
    
    $posts = new Post($con, $_REQUEST['userLoggedIn']);
    $posts->loadPostsFriends();
?>