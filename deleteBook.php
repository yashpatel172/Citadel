<?php
    session_start();
    
    // Check if there isn't any current session (To prevent user from deleting their book if they are not logged in)
    if (!isset($_SESSION["email"])){
        header("Location: login.php");
        exit();
    }
    else 
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        // Get bookID from the passed URL
        $book_id = $_GET["bookID"];

        // Find book cover path function
        $bookCoverPath = deleteBook_findBookCover($database, $book_id);

        // Delete book function
        $success = deleteBook_delete($database, $book_id ,$user_id);

        // IF query is successfull send user back to his profile else throw an exception
        if ($success === TRUE) {
            // Delete user book cover. If unsuccessfull print an error
            if (!unlink($bookCoverPath)) {
                echo "Error: Book cover cannot be deleted due book cover not found.";
            }
            header("Location: myProfile.php");
            $database->close();
            exit();
        }
        else {
            echo "<span class='error'>Error: " . $query . " " . $database->error . "</span>";
        }
        $database->close();
    }
?>