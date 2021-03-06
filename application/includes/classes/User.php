<?php 
    class User {
        private $user;
        private $con;
        
        public function __construct($con, $user) {
            $this->con = $con;
            $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
            $this->user = mysqli_fetch_array($user_details_query);
        }
        
        public function getUsername() {
            return $this->user['username'];
        }
        
        public function getNumPosts() {
            $username = $this->getUsername();
            $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['num_posts'];
        }
        
        public function getFirstAndLastName() {
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['first_name'] . " " . $row['last_name'];
        }
        
        public function getProfilePic() {
            $username = $this->user['username'];
            $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['profile_pic'];
        }
        
        public function isClosed() {
            $username = $this->getUsername();
            $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            
            return $response = $row['user_closed'] == 'no' ? false : true;
        }
        
        public function isFriend($username_to_check) {
            $usernameComma = "," . $username_to_check . ",";
            
            if((strstr($this->user['friend_array'], $usernameComma)) || $username_to_check == $this->user['username']) { // check if user is your friend or if user is the current user
                return true;
            } else {
                return false;
            }
        }
    }


?>