<?php
    $dbServername = "localhost";
    $dbUsername = "ynp062";
    $dbPassword = "yash123";
    $dbName = "ynp062";

    //=========== Database Connection ===========
    $database = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
    if($database->connect_error)
    {
        die("Connection failed: " . $database->connect_error);
    }
?>