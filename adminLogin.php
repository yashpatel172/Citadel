<?php
    session_start();
    
    // Check if there is any current session (To prevent login multiple times)
    if (isset($_SESSION["adminEmail"])) {
        header("location: adminPanel.php");
        die();
    }
    else {
        $errors = array();

        // Check wheather submit-adminlogin button is pressed
        if (isset($_POST["submit-adminlogin"])) {

            include 'includes/dbconnect.php'; // Connect to database
            include 'includes/functions.php'; // DB Operation functions

            // Get email and password from login form
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            // Find user from database
            $total_rows = adminlogin_FindUser($database, $email, $password);

            //If user isn't found from the database 
            if ($total_rows != 1) {
                // Find login errors
                $loginErrorFound = adminlogin_Errors($database, $email);
                if (!empty($loginErrorFound)) {
                    array_push($errors, $loginErrorFound);
                }
            }

            // If user with credentials match a given user and there are no errors
            if ($total_rows == 1 && count($errors) == 0) {
                session_start();
                $_SESSION["adminEmail"] = $email;
                header("location: adminPanel.php");
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,200" />
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Citadel</h2></div>
        <ul class="links" id="links-list">
            <li><a href="index.html">Home</a></li>
        </ul>

        <!-- Responsive Burger -->
        <div id="burger" onclick="burgerFunction()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- ===================================== LOGIN FORM ===================================== -->
    <form action="adminLogin.php" method="post" class="adminlogin-form" id="login_form" enctype="multipart/form-data">
        <!-- Form Title -->
        <h2>Admin Login</h2>

        <!-- Form Signup Link -->
        <p><a href="login.php">Login</a> as a User</p>

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
        <input type="submit" value="Login" name="submit-adminlogin" class="login-button" />
    </form>
    
    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/passwordVisibility.js"></script>
</body>
</html>