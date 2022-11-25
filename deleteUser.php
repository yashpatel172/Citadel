<?php
    session_start();
    
    // Check if there isn't any current session (To prevent user from deleting their book if they are not logged in)
    if (!isset($_SESSION["adminEmail"])){
        header("Location: adminLogin.php");
        exit();
    }
    else 
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/functions.php'; // DB Operation functions

        // Get bookID from the passed URL
        $user_id = $_GET["userID"];
        $successDeleteAllBookCovers = true;

        // Find all books covers function
        $bookCoverPaths = admin_findBookCovers($database, $user_id);

        // Loop through all book covers and delete them all
        while($bookCovers = $bookCoverPaths->fetch_assoc()) {
            if (!unlink($bookCovers["bookCover"])) {
                echo "Error: " . $bookCover . " cannot be deleted due book cover not found.";
                $successDeleteAllBookCovers = false;
            }
        }

        // Delete Books function
        $successDeleteBooks = admin_deleteBooks($database, $user_id);

        // Delete User function
        $successDeleteUser = admin_deleteUser($database, $user_id);

        // IF query is successfull send user back to his profile else throw an exception
        if ($successDeleteAllBookCovers == true && $successDeleteBooks == true && $successDeleteUser == true) {
            header("Location: adminPanel.php?deleteUserSuccess=true");
            $database->close();
            exit();
        }
        else {
            header("Location: adminPanel.php?deleteUserSuccess=false");
            $database->close();
            exit();
        }
        $database->close();
    }
?>