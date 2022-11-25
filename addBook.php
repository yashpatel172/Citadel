<?php
    session_start();

    // Check if there is any current session (To prevent user from adding book without logging-in)
    if (isset($_SESSION["email"])) {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        $errors = array();

        // Check wheather submit-addbook button is pressed
        if (isset($_POST["submit-addbook"])) {

            // Get book data from inputs inside addbook form
            $bookTitle = trim($_POST["bookTitle"]);
            $bookPublishDate = trim($_POST["bookPD"]);
            $bookPageCount = trim($_POST["bookPC"]);
            $bookISBN = trim($_POST["bookISBN"]);
            $bookSummary = trim($_POST["bookSummary"]);
            $target = "BookCover_Uploads/";

            if (isset($_FILES["bookCover"])) {
                //=========== Checking duplicate bookCover =========== 
                $target = $target . $_FILES["bookCover"]["name"];

                // Check duplicate cover
                $duplicateCoverFound = addBook_findDuplicateBookCover($database, $target);
                if (!empty($duplicateCoverFound)) {
                    array_push($errors, $duplicateCoverFound);
                } 

                // Find book an duplicate ISBN
                $duplicateISBNFound = addBook_findDuplicateISBN($database, $bookISBN);
                if (!empty($duplicateISBNFound)) {
                    array_push($errors, $duplicateISBNFound);
                }

                if (count($errors) == 0) {
                    if (move_uploaded_file($_FILES["bookCover"]["tmp_name"], $target)) {}

                    // MySQL query to insert book with all the detials inside the book table
                    $query = "INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover) VALUES ('$user_id', '$bookTitle', '$bookPublishDate', '$bookPageCount', '$bookISBN', '$bookSummary', '$target')";         
                    
                    // If query is successfull send user back to his profile else throw an exception
                    if ($database->query($query) === TRUE) {
                        header("location: myProfile.php");
                        $database->close();
                        exit();
                    }
                    else {
                        echo "<span class='error-addBook'>Error: " . $query . " " . $database->error . "</span>";
                    } 
                }
                else {
                    array_unshift($errors, "Error Occured:");

                    // Print all the errors in order via RED pop-up
                    echo "<span class='error-addBook'>";
                    foreach ($errors as $value) { 
                        echo $value . ' ';
                    }
                    echo "</span>";

                    $errors = array();
                }
            }
        }
        $database->close();
    }
    else {
        header("location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
    <script src="Javascript/addBook_validate.js"></script>
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Hello, <?=$usernameActive?>!</h2></div>

        <ul class="links-addBook" id="links-list">
            <li><a href="searchBooks.php">Search Books</a></li>
            <li><a href="myProfile.php">My Books</a></li>
            <li class="logout-header"><a href="logout.php">Logout</a></li>
        </ul>

        <!-- Responsive Burger -->
        <div id="burger" onclick="burgerFunction()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- ===================================== ADD BOOK FORM ===================================== -->
    <form action="addBook.php" method="post" class="addBook-form" id="addBook_form" enctype="multipart/form-data">
        
        <!-- Form Title -->
        <h2>Add Book</h2>

        <!-- ===================================== MAIN BOX ===================================== -->
        <div class="box">
            <!-- Left Box -->
            <div class="left-side">
                <!-- Form Input (BookTitle) -->
                <div class="input-box">            
                    <input type="text" id="title_field" name="bookTitle" placeholder="Book Title" autocomplete="off" />
                    <label id="label_title">Required.</label>
                </div>
                
                <!-- Form Input (PublishDate) -->
                <div class="input-box">            
                    <input type="text" id="pd_field" name="bookPD" placeholder="Publish Date" onfocus="(this.type='date')" />
                    <label id="label_pd">Required.</label>
                </div>
                
                <!-- Form Input (PageCount) -->
                <div class="input-box">
                    <input type="number" id="pc_field" name="bookPC" placeholder="Page Count" autocomplete="off" />
                    <label id="label_pc">Required. Digits only.</label>
                </div>
                
                <!-- Form Input (ISBN) -->
                <div class="input-box">            
                    <input type="number" maxlength="13" id="isbn_field" name="bookISBN" placeholder="ISBN" autocomplete="off" />
                    <label id="label_isbn">Required. ISBN is a 13 digit number.</label>
                </div>

                <!-- Form Input (AddBookButton) -->
                <input type="submit" name="submit-addbook" value="Add Book" class="addBook-button addBook-addbutton" />
                <button class="editBook-form-cancel-button" onclick="location.href=`myProfile.php`">Cancel</button>
            </div>
            
            <!-- Right Box -->
            <div class="right-side">
                <!-- Form Input (BookSummary) -->     
                <div class="input-box">
                    <textarea maxlength="500" id="bs_field" name="bookSummary" placeholder="Book Summary"></textarea>       
                    <label id="label_bs">Required. MAX of 500 characters.</label>
                </div>
                <!-- Form Input (BookSummary) -->     
                <div class="input-box">
                    <input type="file" id="cover_field" accept=".jpg, .jpeg, .png" name="bookCover" style="display:none;" />
                    <label class="file-button-label" style="color: black; text-align: center; width: 39.7%; padding-top: 12px; padding-bottom: 14px; font-size: 0.80rem; margin-top: 5.5%;" for="cover_field">Upload Book Cover</label>
                    
                    <label id="label_cover">300KB or less image size required. No book cover edit allowed.</label>
                </div>
            </div>
        </div>
    </form>

    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
    <script src="Javascript/addBook_validate-r.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>