<?php  
    include("application/includes/header.php");
    
    if(isset($_GET['profile_username'])) {
        $username = $_GET['profile_username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $user_array = mysqli_fetch_array($user_details_query);
        
        $num_friends = (substr_count($user_array['friend_array'], ",")) -1;
    }
    
?>
    <style type="text/css">
        .wrapper {
            margin-left: 0;
            padding-left: 0;
        }
    </style>

    <div class="profile_left">
        <img class="profile_page_img" src="<?= $user_array['profile_pic'] ?>">
        
        <div class="profile_info">
            <p><?= "Posts: " . $user_array['num_posts']; ?></p>
            <p><?= "Likes: " . $user_array['num_likes']; ?></p>
            <p><?= "Friends: " . $num_friends; ?></p>
        </div>
        
    </div>

    <div class="main_column column">
        <?= $username; ?>
        
       
    </div>
    
    </div>
</body>
</html>