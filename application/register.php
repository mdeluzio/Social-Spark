<?php include '/home2/markdevnucitrus/connection.php'; ?>

<?php

    $fname = ""; //First Name
    $lname = ""; // Last Name
    $em = ""; //Email
    $em2 = ""; //Email 2
    $password = ""; //Password
    $password2 = ""; //Password 2
    $date = ""; //Sign up date
    $error_array = []; //Holds error messages
    $reg_success = ""; //Holds success message for registration, or acts like a falsy boolean
    
    if(isset($_POST['register_button'])) {
        
        //Registration form values
        
        //First Name
        $fname = strip_tags($_POST['reg_fname']);
        $fname = str_replace(' ', '', $fname);
        $fname = ucfirst(strtolower($fname));
        $_SESSION['reg_fname'] = $fname;
        
        //Last Name
        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(' ', '', $lname);
        $lname = ucfirst(strtolower($lname));
        $_SESSION['reg_lname'] = $lname;
        
        //Email
        $em = strip_tags($_POST['reg_email']);
        $em = str_replace(' ', '', $em);
        $_SESSION['reg_email'] = $em;
        
        //Email 2
        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(' ', '', $em2);
        $_SESSION['reg_email2'] = $em2;
        
        //Password
        $password = strip_tags($_POST['reg_password']);
       
        //Password 2
        $password2 = strip_tags($_POST['reg_password2']);
        
        //Date
        $date = date("Y-m-d");
        
        //Check both emails match
        if($em == $em2) {
            //Check if email is a valid format
            if(filter_var($em, FILTER_VALIDATE_EMAIL)){
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);
                
                //Check if email already exists
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
                
                $num_rows = mysqli_num_rows($e_check);
                
                if($num_rows > 0) {
                    $em_in_use = "Email already in use<br>";
                    array_push($error_array, $em_in_use);
                }
                
            } else {
                $em_invalid_format = "Invalid email format<br>";
                array_push($error_array, $em_invalid_format);
            }
            
        } else{
            $em_dont_match = "Emails don't match<br>";
            array_push($error_array, $em_dont_match);
        }
        
        //Check first name is a proper length
        if(strlen($fname) > 25 || strlen($fname) < 2) {
            $fname_len_error = "Your first name must be between 2 and 25 characters<br>";
            array_push($error_array, $fname_len_error);
        }
        
        //Check last name is a proper length
        if(strlen($lname) > 25 || strlen($lname) < 2) {
            $lname_len_error = "Your last name must be between 2 and 25 characters<br>";
            array_push($error_array, $lname_len_error);
        }
        
        //Check that both passwords match
        if($password != $password2) {
            $password_match_error = "Your passwords do not match<br>";
            array_push($error_array, $password_match_error);
        } else {
            //Check that password only contains letters and numbers
            if(preg_match('/[^A-Za-z0-9]/', $password)) {
                $password_char_error = "Your password can only contain letters or numbers<br>";
                array_push($error_array, $password_char_error);
            }
        }
        
        //Check password is between 5 and 30 characters in length
        if(strlen($password) > 30 || strlen($password) < 5) {
            $password_len_error = "Your password must be between 5 and 30 characters<br>";
            array_push($error_array, $password_len_error);
        }
        
        if(count($error_array) == 0) {
            $password = md5($password);
            
            //Generate username
            $username = strtolower($fname . "_" . $lname);
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            $username_used_flag = 0;
            
            //If username exists add number to username
            $i = 0;
            while(mysqli_num_rows($check_username_query) != 0) {
                $i++;
                if(!$username_used_flag) {
                    $username_used_flag = 1;
                    $username = $username . "_" . $i;
                    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                } else {
                    $username = substr($username, 0, -1) . $i;
                    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                }
            }
            
            //Profile picture assignment
            $rand = rand(1, 2);
            
            $profile_pic = $rand == 1 ? "assets/images/profile_pics/defaults/head_deep_blue.png" : "assets/images/profile_pics/defaults/head_emerald.png";
            
            $insert_query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
            
            $reg_success = "<span class=\"reg_success\">Registration Successful!</span><br>";
            
            //Clear session variable
            $_SESSION['reg_fname'] = "";
            $_SESSION['reg_lname'] = "";
            $_SESSION['reg_email'] = "";
            $_SESSION['reg_email2'] = "";
            
        }
        
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social Spark!</title>
</head>
<body>
    
    <form action="register.php" method="POST" class="register_form">
        <input type="text"  id="reg_fname" name="reg_fname" placeholder="First Name"  
        value="<?php 
            if(isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
            } 
            ?>" 
        required>
        <br>
        <?php if(in_array($fname_len_error, $error_array)) echo $fname_len_error; ?>
        
        <input type="text" id="reg_lname" name="reg_lname" placeholder="Last Name"
            value="<?php 
                if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                } 
            ?>" 
        required>
        <br>
        <?php if(in_array($lname_len_error, $error_array)) echo $lname_len_error; ?>
        
        <input type="email"  id="reg_email" name="reg_email" placeholder="Email"
            value="<?php 
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                } 
            ?>" 
        required>
        <br>
        
        <input type="email" id="reg_email2" name="reg_email2" placeholder="Confirm Email"
            value="<?php 
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                } 
            ?>" 
        required>
        <br>
        <?php 
            if(in_array($em_in_use, $error_array)) echo $em_in_use;
            else if(in_array($em_invalid_format, $error_array)) echo $em_invalid_format;
            else if(in_array($em_dont_match, $error_array)) echo $em_dont_match; 
        ?>
        
        <input type="password"  id="reg_password" name="reg_password" placeholder="Password" required>
        <br>
        
        <input type="password" id="reg_password2" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <?php 
            if(in_array($password_match_error, $error_array)) echo $password_match_error;
            if(in_array($password_len_error, $error_array)) echo $password_len_error;
            if(in_array($password_char_error, $error_array)) echo $password_char_error;
        ?>
        
        <input type="submit" id="register_button" name="register_button" value="Register">
        <br>
        <?php if($reg_success) echo $reg_success; ?>
    </form>
    
    
    
    
    
    
    
</body>
</html>