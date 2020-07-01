<?php
    if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        //Tell the browser to redirect to the HTTPS URL.
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
        //Prevent the rest of the script from executing.
        exit;
    }

    include("application/includes/header.php");
    include("application/includes/classes/User.php");
    include("application/includes/classes/Post.php");
    
    if(isset($_POST['post'])) {
        $post = new Post($con, $userLoggedIn);
        $post->submitPost($_POST['post_text'], 'none');
        header("Location: index.php");
    }
?>
    
    <div class="user_details column">
        <a href="<?php echo $userLoggedIn;?>"><img src="<?php echo $user['profile_pic'] ?>"> </a>
        
        <div class="user_details_column_interior">
            <a href="<?php echo $userLoggedIn; ?>">
                <?php 
                    echo $user['first_name'] . " " . $user['last_name'];
                ?>
            </a>
            <p><?php echo "Posts: " . $user['num_posts']; ?></p>
            <p><?php echo "Likes: " . $user['num_likes']; ?></p>
        </div>
    </div>
    
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
            <hr>
        </form>
        
        
    </div>
    
    
    
    </div>
</body>
</html>