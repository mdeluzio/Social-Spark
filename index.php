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
        
        <div class="posts_area"></div>
        <img id="loading" src="application/assets/images/icons/loading.gif"
        
    </div>
    
    <script>
        let userLoggedIn = '<?php echo $userLoggedIn ?>';
        
        $(document).ready(function() {
            $('#loading').show();
            
            //Original ajax request for loading first posts
            $.ajax({
                url: "application/includes/handlers/ajax_load_posts.php",
                type: "POST",
                data: "page=1&userLoggedIn=" + userLoggedIn,
                cache: false,
                success: function(data) {
                    $('#loading').hide();
                    $('.posts_area').html(data);
                }
            })
            
            $(window).scroll(function() {
                let height = $('.posts_area').height();
                let scroll_top = $(this).scrollTop();
                let page = $('.posts_area').find('.nextPage').val();
                let noMorePosts = $('.posts_area').find('.noMorePosts').val();
                
                if((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                   $('#loading').show();
  
                    let ajaxReq = $.ajax({
                        url: "application/includes/handlers/ajax_load_posts.php",
                        type: "POST",
                        data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                        cache: false,
                        success: function(response) {
                            $('.posts_area').find('.nextPage').remove();
                            $('.posts_area').find('.noMorePosts').remove();
                            $('#loading').hide();
                            $('.posts_area').append(response);
                        }
                    })
                } //End if
                
                return false;
            })
        })
        
    </script>
    
    
    
    </div>
</body>
</html>