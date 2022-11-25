<?php
    include 'functions.php'; // DB Operation functions

    // Store active user email in a variable
    $active_email = $_SESSION["email"];

    // Find active user data
    $userData = loggedinuserdata_data($database, $active_email);

    // initialize user variables from associative data
    $user_id = $userData[0];
    $usernameActive = $userData[1];
?>