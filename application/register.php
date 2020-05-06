<?php 
    include '/home2/markdevnucitrus/connection.php';
    include 'includes/form_handlers/login_handler.php';
    include 'includes/form_handlers/register_handler.php';
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social Spark!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>
<body>
    
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>Social Spark</h1>
                Login or sign up below
            </div>
            <!--Login Form -->
            <form action="register.php" method="POST" class="login_form">
                <input type="email" name="log_email" id="log_email" placeholder="Email address" value="<?php 
                    if(isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];
                    } 
                    ?>" 
                required>
                <br>
                
                <input type="password" name="log_password" id="log_password" placeholder="Password">
                <br>
                
                <input type="submit" id="login_button" name="login_button" value="Login">
                <br>
                <?php if(in_array($login_error, $login_error_array)) echo $login_error; ?>
            </form>
            
            <!--Register Form -->
            <form action="register.php" method="POST" class="register_form">
                <input type="text"  id="reg_fname" name="reg_fname" placeholder="First Name"  
                value="<?php 
                    if(isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    } 
                    ?>" 
                required>
                <br>
                <?php if(in_array($fname_len_error, $reg_error_array)) echo $fname_len_error; ?>
                
                <input type="text" id="reg_lname" name="reg_lname" placeholder="Last Name"
                    value="<?php 
                        if(isset($_SESSION['reg_lname'])) {
                            echo $_SESSION['reg_lname'];
                        } 
                    ?>" 
                required>
                <br>
                <?php if(in_array($lname_len_error, $reg_error_array)) echo $lname_len_error; ?>
                
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
                    if(in_array($em_in_use, $reg_error_array)) echo $em_in_use;
                    else if(in_array($em_invalid_format, $reg_error_array)) echo $em_invalid_format;
                    else if(in_array($em_dont_match, $reg_error_array)) echo $em_dont_match; 
                ?>
                
                <input type="password"  id="reg_password" name="reg_password" placeholder="Password" required>
                <br>
                
                <input type="password" id="reg_password2" name="reg_password2" placeholder="Confirm Password" required>
                <br>
                <?php 
                    if(in_array($password_match_error, $reg_error_array)) echo $password_match_error;
                    if(in_array($password_len_error, $reg_error_array)) echo $password_len_error;
                    if(in_array($password_char_error, $reg_error_array)) echo $password_char_error;
                ?>
                
                <input type="submit" id="register_button" name="register_button" value="Register">
                <br>
                <?php if($reg_success) echo $reg_success; ?>
            </form>
        </div>
    </div>
</body>
</html>