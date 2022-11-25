<?php 
    session_start();

    // Destory any kind of session related to current user
    unset($_SESSION["adminEmail"]);
    session_destroy();

    // After session is successfully destroyed move the user back to login page
    header("location: adminLogin.php");
    exit();
?>