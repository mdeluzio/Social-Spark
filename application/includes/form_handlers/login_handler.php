<?php

    $login_error_array = [];

    if(isset($_POST['login_button'])) {
        $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
        
        $_SESSION['log_email'] = $email; //Store email into session variable
        $password = md5($_POST['log_password']); //Get password
        
        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        $check_login_query = mysqli_num_rows($check_database_query);
        
        if($check_login_query == 1) {
            $row = mysqli_fetch_array($check_database_query);
            $username = $row['username'];
            
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
            exit();
        } else {
            $login_error = "Email or password was incorrect<br>";
            array_push($login_error_array, $login_error);
        }
        
    }

?>