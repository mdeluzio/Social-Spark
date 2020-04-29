<?php include '/home2/markdevnucitrus/connection.php'; ?>

<?php 
    
    $fname = ""; //First Name
    $lname = ""; // Last Name
    $em = ""; //Email
    $em2 = ""; //Email 2
    $password = ""; //Password
    $password2 = ""; //Password 2
    $date = ""; //Sign up date
    $error_array = ""; //Holds error messages
    
    if(isset($_POST['register_button'])) {
        
        //Registration form values
        
        //First Name
        $fname = strip_tags($_POST['reg_fname']);
        $fname = str_replace(' ', '', $fname);
        $fname = ucfirst(strtolower($fname));
        
        //Last Name
        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(' ', '', $lname);
        $lname = ucfirst(strtolower($lname));
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
        <input type="text"  id="reg_fname" name="reg_fname" placeholder="First Name" required>
        <br>
        <input type="text" id="reg_lname" name="reg_lname" placeholder="Last Name" required>
        <br>
        <input type="email"  id="reg_email" name="reg_email" placeholder="Email" required>
        <br>
        <input type="email" id="reg_email2" name="reg_email2" placeholder="Confirm Email" required>
        <br>
        <input type="password"  id="reg_password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" id="reg_password2" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" id="register_button" name="register_button" value="Register">
    </form>
    
    
    
    
    
    
    
    
</body>
</html>