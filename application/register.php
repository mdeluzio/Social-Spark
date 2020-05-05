<?php 
    include '/home2/markdevnucitrus/connection.php';
    include 'includes/form_handlers/register_handler.php'
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social Spark!</title>
</head>
<body>
    
    <!--Login Form -->
    <form action="register.php" method="POST" class="login_form">
        <input type="email" name="log_email" id="log_email" placeholder="Email address">
        <br>
        <input type="password" name="log_password" id="log_password" placeholder="Password">
        <br>
        
        <input type="submit" id="login_button" name="login_button" value="Login">
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