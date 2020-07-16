<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"></link>
</head>
<body>
    
    <?php
        include '/home2/markdevnucitrus/connection.php'; 
        include("includes/classes/User.php");
        include("includes/classes/Post.php");
        
        
        if(isset($_SESSION['username'])) {
           $userLoggedIn =  $_SESSION['username'];
           $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
           $user = mysqli_fetch_array($user_details_query);
        } else {
            header("Location: application/register.php");
        }
    ?>
    
    <script>
        function toggle() {
            let element = document.getElementById("comment_section");
            
            if(element.style.display == "block") { 
                element.stye.display = "none"; // If showing, hide it
            } else {
                element.style.display = "block"; // If not showing, show it
            }
        }
    </script>
    
    <?php 
        //Get id of post
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        
        $user_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id='$post_id'");
        $row = mysqli_fetch_array($user_query);
        
        $posted_to = $row['added_by'];
        
        if(isset($_POST['postComment' . $post_id])) {
            $post_body = $_POST['post_body'];
            $post_body = mysqli_escape_string($con, $post_body);
            $date_time_now = date("Y-m-d H:i:s");
            $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', '$post_id')");
            echo "<p>Comment Posted!</p>";
        }
    ?>
    
    <form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
        <textarea name="post_body"></textarea>
        <input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
    </form>
    
    <!-- Load Comments -->
    <?php
        $get_comments= mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id ASC");
        $count = mysqli_num_rows($get_comments);
        if($count != 0) {
            
            while($comment = mysqli_fetch_array($get_comments)) {
                $comment_body = $comment['post_body'];
                $posted_to = $comment['posted_to'];
                $posted_by = $comment['posted_by'];
                $date_added = $comment['date_added'];
                $removed = $comment['removed'];
                
                //Timeframe
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_added); // Time of post
                $end_date = new DateTime($date_time_now); // Current Time
                $interval = $start_date->diff($end_date);
                if($interval->y >= 1){
                    if($interval == 1) {
                        $time_message = $interval->y . " year ago"; //1 year ago
                    } else {
                        $time_message = $interval->y . " years ago"; //more than 1 year ago
                    }
                } 
                else if($interval->m >= 1) { //less than one year old, but at least a month old
                    if ($interval->d == 0) { 
                        $days = " ago"; //less than 1 day ago
                    } 
                    else if ($interval->d == 1) {
                        $days = $interval->d . " day ago"; // 1 day ago
                    } 
                    else {
                        $days = $interval->d . " days ago"; // more than 1 day ago
                    }
                    
                    if($interval->m == 1) { //now check how many months old
                        $time_message = $interval->m . " month" . $days; //1 month ago
                    } 
                    else {
                        $time_message = $interval->m . " months" . $days; // more than 1 month ago
                    }
                } 
                else if($interval->d >= 1) { //less than one month old, but at least one day old
                    if ($interval->d == 1) {
                        $time_message = "Yesterday"; // 1 day ago
                    } 
                    else {
                        $time_message = $interval->d . " days ago"; // more than 1 day ago
                    }
                }
                else if($interval->h >= 1) {
                    if($interval->h == 1) {
                        $time_message = $interval->h . " hour ago"; // 1 hour ago
                    }
                    else {
                        $time_message = $interval->h . " hours ago"; // more than 1 hour ago
                    }
                }
                else if($interval->i >= 1) {
                    if($interval->i == 1) {
                        $time_message = $interval->i . " minute ago"; // 1 minute ago
                    }
                    else {
                        $time_message = $interval->i . " minutes ago"; // more than 1 minute ago
                    }
                }
                else {
                    if($interval->s < 30) {
                        $time_message = "Just now"; // less than 30 seconds ago
                    }
                    else {
                        $time_message = $interval->s . " seconds ago"; // 30 seconds or more seconds ago
                    }
                } //END if
                $user_obj = new User($con, $posted_by);
            } //End While
        }
    
    ?>
    
    <div class="comment_section">
        <a href="../<?php echo $posted_by; ?>" target="_parent"><img src=""></a>
    </div>
    
    

    
</body>
</html>