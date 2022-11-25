<?php

    // ========================== Signup Functions ==========================

    // Find duplicate Email
    function signup_LookForEmail($database, $email) {
        // Temperory error return variable
        $results_Tmp;

        // MySQL query to find User with duplicate email
        $query = "SELECT * FROM Citadel_Users WHERE email = '$email'";
        $results = $database->query($query);

        // If any similar email found then ask user to try again
        if ($results->num_rows > 0) {
           $results_Tmp = "Email entered is already used. ";
        }

        return $results_Tmp;
    }

    // Find duplicate Username
    function signup_LookForUsername($database, $username) {
        // Temperory error return variable
        $results_Tmp;

        // MySQL query to find User with duplicate username
        $query = "SELECT * FROM Citadel_Users WHERE username = '$username'";
        $results = $database->query($query);

        // If any similar username found then ask user to try again
        if ($results->num_rows > 0) {
           $results_Tmp = "Username entered is already used. ";
        }

        return $results_Tmp;
    }

    // Insert User
    function signup_InsertUser($database, $email ,$username, $password) {
        // Temperory success return variable
        $wasSuccess;

        // MySQL query to insert User into the table
        $query = "INSERT INTO Citadel_Users (username, email, password) VALUES ('$username', '$email', '$password')";
        $wasSuccess = $database->query($query);

        return $wasSuccess;
    }

    // ========================== Login Functions ==========================

    // Find login errors
    function login_Errors($database, $email) {
        // Temperory error return variable
        $results_Tmp;

        // Find user with the given email
        $query = "SELECT * FROM Citadel_Users WHERE email = '$email'";
        $results = $database->query($query);

        // Organize user data via associate array
        $user_data = $results->fetch_assoc();

        // If email in database exists
        if ($email == $user_data["email"]) {
            $results_Tmp = "Password doesn't match. Please Try Again!";
        }
        // Else user doesn't exists in the database
        else {
            $results_Tmp = "Credentials Incorrect. Please Try Again!";
        }

        return $results_Tmp;
    }

    // Find User to login
    function login_FindUser($database, $email, $password) {
        // Temperory rows found return variable
        $num_rows_found;

        // MySQL query to find user that matches with the given credentials
        $query = "SELECT * FROM Citadel_Users WHERE email = '$email' AND password = '$password'";
        $result = $database->query($query);

        $num_rows_found = $result->num_rows;

        return $num_rows_found;
    }

    // ========================== Loggedinuserdata Functions ==========================

    // Find currently logged-in user
    function loggedinuserdata_data($database, $active_email) {
        // Temperory rows found return variable
        $userData_Tmp;

        // Get logged-in user's : userID and username
        $query = "SELECT uid, username FROM Citadel_Users WHERE email = '$active_email'";
        $result = $database->query($query);

        // Make array out of the results from the query
        $userData_Tmp = $result->fetch_array(MYSQLI_NUM);

        return $userData_Tmp;
    }

    // ========================== viewBook Functions ==========================

    // Find book data of a given book
    function viewBook_findBookDetails($database, $book_id) {
        // Temperory rows found return variable
        $bookData_Tmp;

        // MySQL query to find book related with the book id
        $query = "SELECT uid, title, publishDate, pageCount, isbn, bookSummary, bookCover FROM Citadel_Books WHERE bid = '$book_id'";
        $results = $database->query($query);

        // Organized book data associatively
        $bookData_Tmp = $results->fetch_assoc();

        return $bookData_Tmp;
    }

    // Find author username of the book
    function viewBook_findAuthorUsername($database, $temp_id) {
        // Temperory rows found return variable
        $authorUsername_Tmp;

        // MySQL query to search username from users table based on the uid from the book
        $query = "SELECT username FROM Citadel_Users WHERE uid = '$temp_id'";
        $result = $database->query($query);

        // Make array out of the results from the query
        $authorUsernameArray = $result->fetch_array(MYSQLI_NUM);
        $authorUsername_Tmp = $authorUsernameArray[0];

        return $authorUsername_Tmp;
    }

    // ========================== viewAuthor Functions ==========================

    // Find author username, email related with the book
    function viewAuthor_findAuthorInfo($database, $viewAuthorID) {
        // Temperory rows found return variable
        $authorInfo_Tmp;

        // MySQL query to get author username from author id which was passed from the URL
        $query = "SELECT username, email FROM Citadel_Users WHERE uid = '$viewAuthorID'";
        $result = $database->query($query);

        // Make array out of the results from the query
        $authorInfo_Tmp = $result->fetch_array(MYSQLI_NUM);

        return $authorInfo_Tmp;
    }

    // ========================== deleteBook Functions ==========================

    // Find book cover path related with the book
    function deleteBook_findBookCover($database, $book_id) {
        // Temperory rows found return variable
        $bookCover_Tmp;

        // MySQL query to find book cover path
        $query = "SELECT bookCover FROM Citadel_Books WHERE bid = '$book_id'";
        $result = $database->query($query);

        // Make array out of the results from the query
        $bookCoverArray = $result->fetch_array(MYSQLI_NUM);
        $bookCover_Tmp = $bookCoverArray[0];

        return $bookCover_Tmp;
    }

    // Delete book
    function deleteBook_delete($database, $book_id ,$user_id) {
        // Temperory success return variable
        $wasSuccess;

        // Delete book which is related to the logged in user with the given book id
        $query = "DELETE FROM Citadel_Books WHERE bid = '$book_id' AND uid = '$user_id'";
        $wasSuccess = $database->query($query);

        return $wasSuccess;
    }

    // ========================== adminLogin Functions ==========================

    // Find admin login errors
    function adminlogin_Errors($database, $email) {
        // Temperory error return variable
        $results_Tmp;

        // Find admin with the given email
        $query = "SELECT * FROM Citadel_Admins WHERE email = '$email'";
        $results = $database->query($query);

        // Organize admin data via associate array
        $user_data = $results->fetch_assoc();

        // If email in database exists
        if ($email == $user_data["email"]) {
            $results_Tmp = "Password doesn't match. Please Try Again!";
        }
        // Else admin doesn't exists in the database
        else {
            $results_Tmp = "Credentials Incorrect. Please Try Again!";
        }

        return $results_Tmp;
    }

    // Find admin to login
    function adminlogin_FindUser($database, $email, $password) {
        // Temperory rows found return variable
        $num_rows_found;

        // MySQL query to find admin that matches with the given credentials
        $query = "SELECT * FROM Citadel_Admins WHERE email = '$email' AND password = '$password'";
        $result = $database->query($query);

        $num_rows_found = $result->num_rows;

        return $num_rows_found;
    }

    // ========================== deleteUser Functions ==========================
    
    // Find book covers
    function admin_findBookCovers($database, $user_id) {
        // Temperory success return variable
        $results_Tmp;

        // Delete book which is related to the logged in user with the given book id
        $query = "SELECT bookCover FROM Citadel_Books WHERE uid = '$user_id'";
        $results_Tmp = $database->query($query);

        return $results_Tmp;
    }
    
    // Delete User
    function admin_deleteUser($database, $user_id) {
        // Temperory success return variable
        $wasSuccess;

        // Delete book which is related to the logged in user with the given book id
        $query = "DELETE FROM Citadel_Users WHERE uid = '$user_id'";
        $wasSuccess = $database->query($query);

        return $wasSuccess;
    }

    // Delete All Books
    function admin_deleteBooks($database, $user_id) {
        // Temperory success return variable
        $wasSuccess;

        // Delete all books which is related to the user 
        $query = "DELETE FROM Citadel_Books WHERE uid = '$user_id'";
        $wasSuccess = $database->query($query);

        return $wasSuccess;
    }

    // ========================== addBook Functions ==========================

    // Duplicate BookCover function
    function addBook_findDuplicateBookCover($database, $target) {
        // Temperory error return variable
        $results_Tmp;

        // MySQL query to find User with duplicate BookCover
        $query = "SELECT * FROM Citadel_Books WHERE bookCover = '$target'";
        $results = $database->query($query);

        // If any similar BookCover found then ask user to try again
        if ($results->num_rows > 0) {
            $results_Tmp = "Duplicate bookCover found. ";
        }

        return $results_Tmp;
    }

    // Duplicate ISBN function
    function addBook_findDuplicateISBN($database, $bookISBN) {
        // Temperory error return variable
        $results_Tmp;

        // MySQL query to find book an duplicate ISBN
        $query = "SELECT title, isbn FROM Citadel_Books WHERE isbn = '$bookISBN'";
        $results = $database->query($query);

        // If any similar ISBN book found then ask user to try again
        if ($results->num_rows > 0) {
            $results_Tmp = "ISBN already exists! Please Try Again";
        }

        return $results_Tmp;
    }
?>