<?php
    session_start();
    
    // Check if there is any current session (To prevent login multiple times)
    if (isset($_SESSION["email"])) {
        header("location: myProfile.php");
        die();
    }
    else {
        $errors = array();

        // Check wheather submit-login button is pressed
        if (isset($_POST["submit-login"])) {

            include 'includes/dbconnect.php'; // Connect to database
            include 'includes/functions.php'; // DB Operation functions

            // MySQL injection prevention doesn't work with University Servers      
            // $email = $database->real_escape_string($_POST['email']);
            // $password = $database->real_escape_string($_POST['password']);

            // Get email and password from login form
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            // Find user from database
            $total_rows = login_FindUser($database, $email, $password);

            //If user isn't found from the database 
            if ($total_rows != 1) {
                // Find login errors
                $loginErrorFound = login_Errors($database, $email);
                if (!empty($loginErrorFound)) {
                    array_push($errors, $loginErrorFound);
                }
            }

            // If user with credentials match a given user and there are no errors
            if ($total_rows == 1 && count($errors) == 0) {
                session_start();
                $_SESSION["email"] = $email;
                header("location: myProfile.php");
                $database->close();
                exit();
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,200" />
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Citadel</h2></div>
        <ul class="links" id="links-list">
            <li><a href="index.html">Home</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>

        <!-- Responsive Burger -->
        <div id="burger" onclick="burgerFunction()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- ===================================== LOGIN FORM ===================================== -->
    <form action="login.php" method="post" class="login-form" id="login_form" enctype="multipart/form-data">
        <!-- Form Title -->
        <h2>Welcome Back</h2>

        <!-- Form Signup Link -->
        <p>Not registered yet? <a href="signup.php">Sign up</a></p>

        <!-- Form Input (Email) -->
        <div class="input-box">            
            <input type="email" id="email_field" name="email" placeholder="Email" autocomplete="off" required />
        </div>
        
        <!-- Form Input (Password) -->
        <div class="input-box">
            <input type="password" id="password_field" name="password" placeholder="Password" autocomplete="off" required />
            <i id="visibilityButton"><span id="pass_icon" class="material-symbols-outlined">visibility</span></i>
        </div>
        
        <!-- Form Input (LoginButton) -->
        <input type="submit" value="Login" name="submit-login" class="login-button" />
    </form>
    
    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
    <script src="Javascript/passwordVisibility.js"></script>
</body>
</html>