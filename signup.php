<?php

    // Check wheather submit-signup button is pressed
    if (isset($_POST["submit-signup"]))
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/functions.php'; // DB Operation functions

        // Get username, email and password from signup form
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $errors = array();

        // Check Email
        $emailFound = signup_LookForEmail($database, $email);
        if (!empty($emailFound)) {
            array_push($errors, $emailFound);
        }

        // Check Username
        $usernameFound = signup_LookForUsername($database, $username);
        if (!empty($usernameFound)) {
            array_push($errors, $usernameFound);
        }

        // If errors are not found
        if(count($errors) == 0) {
            // Insert User
            $success = signup_InsertUser($database, $email ,$username, $password);

            // If query is successfull
            if ($success === TRUE) {
                header("location: login.php");
                $database->close();
                exit();
            }
            else {
                echo "<span class='error'>Error: " . $query . " " . $database->error . "</span>";
            }
        }
        else {
            array_unshift($errors, "Error Occured:");
                
            // Print all the errors in order via RED pop-up
            echo "<span class='error'>";
            foreach ($errors as $value) { 
                echo $value . ' ';
            }
            echo "</span>";

            $errors = array();
        }

        $database->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,200" />
    <script src="Javascript/signup_validate.js"></script>
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Citadel</h2></div>
        <ul class="links" id="links-list">
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>

        <!-- Responsive Burger -->
        <div id="burger" onclick="burgerFunction()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- ===================================== SIGNUP FORM ===================================== -->
    <form action="signup.php" method="post" class="signup-form" id="signup_form" enctype="multipart/form-data"> 
        <!-- Form Title -->
        <h2>Get Started</h2>

        <!-- Form Login Link -->
        <p>Already have an account? <a href="login.php">Sign in</a></p>
        
        <!-- Form Input (Username) -->
        <div class="input-box">            
            <input type="text" id="username_field" name="username" placeholder="Username" autocomplete="off" />
            <label id="label_username">Only letters (a-z, A-Z), numbers (0-9) are allowed.</label>
        </div>

        <!-- Form Input (Email) -->
        <div class="input-box">            
            <input type="email" id="email_field" name="email" placeholder="Email" autocomplete="off" />
            <label id="label_email">Max 200 characters without spaces & some special characters.</label>
        </div>
        
        <!-- Form Input (Password) -->
        <div class="input-box">
            <input type="password" id="password_field" name="password" placeholder="Password" autocomplete="off" />
            <i id="visibilityButton1"><span id="pass_icon1" class="material-symbols-outlined">visibility</span></i>
            <label id="label_password">Min 6 characters, atleast one (a-z, A-Z, 0-9, special) are allowed.</label>
        </div>

        <!-- Form Input (ConfirmPassword) -->
        <div class="input-box">            
            <input type="password" id="confirmpassword_field" placeholder="Confirm Password" autocomplete="off" />
            <i id="visibilityButton2"><span id="pass_icon2" class="material-symbols-outlined">visibility</span></i>
            <label id="label_confirmpassword">Enter the same password as before, for verification.</label>
        </div>
        
        <!-- Form Input (SignUpButton) -->
        <input type="submit" value="Sign Up" name="submit-signup" class="signup-button" />
        
        <!-- Form Terms & Conditions -->
        <p class="extra-space">By signing up, you agree to <a href="#">Citadel's Terms and Conditions.</a></p>
    </form>

    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
    <script src="Javascript/signup_validate-r.js"></script>
    <script src="Javascript/passwordVisibility.js"></script>
</body>
</html>