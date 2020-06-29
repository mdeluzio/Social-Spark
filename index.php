<?php
    include("application/includes/header.php");
?>
    
    <div class="user_details column">
        <a href="#"><img src="<?php echo $user['profile_pic'] ?>"> </a>
        
        <div class="user_details_column_interior">
            <a href="#">
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