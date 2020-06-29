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
    
    
    </div>
</body>
</html>