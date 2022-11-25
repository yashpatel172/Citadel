<?php
    session_start();

    // Check if there is any current session (To prevent user from editing book without logging-in)
    if (isset($_SESSION["email"])) {

        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information
        
        $temp_green_success = 0;
        $book_id = $_GET["bookID"]; // Get Book id from the URL
        $errors = array();
        
        // MySQL query find details related to the passed edit book id
        $query = "SELECT title, publishDate, pageCount, isbn, bookSummary FROM Citadel_Books WHERE bid = '$book_id'";
        $results = $database->query($query);

        // Organize book data via associate array
        $book_details = $results->fetch_assoc();

        // Check wheather submit-editbook button is pressed
        if (isset($_POST["submit-editbook"])) {

            // Get book data from inputs inside editbook form
            $bookTitle = trim($_POST["bookTitle"]);
            $bookPublishDate = trim($_POST["bookPD"]);
            $bookPageCount = trim($_POST["bookPC"]);
            $bookISBN = trim($_POST["bookISBN"]);
            $bookSummary = trim($_POST["bookSummary"]);

            // MySQL query to find book an duplicate ISBN
            $query = "SELECT title, isbn FROM Citadel_Books WHERE isbn = '$bookISBN' AND bid != '$book_id'";
            $results = $database->query($query);

            // If every data is same then dont update anything
            if ($book_details["title"] == $bookTitle && $book_details["publishDate"] == $bookPublishDate && $book_details["pageCount"] == $bookPageCount && $book_details["isbn"] == $bookISBN && $book_details["bookSummary"] == $bookSummary) {
                array_push($errors, "Can't update data if everythings same! Please Try Again");
            }
            // If any duplicate ISBN found in the system
            else if ($results->num_rows > 0) {
                array_push($errors, "ISBN already exists! Please Try Again");
            }
            // If isbn is same but other data might be different so update is necessary
            else if ($book_isbn == $book_details["isbn"])
            {
                // MySQL query update book based on the form inputs
                $query = "UPDATE Citadel_Books SET title = '$bookTitle', publishDate = '$bookPublishDate', pageCount = '$bookPageCount', isbn= '$bookISBN', bookSummary = '$bookSummary' WHERE bid = '$book_id'";             

                // If query is successfull put user in the same page else throw an exception
                if ($database->query($query) === TRUE) {
                    $temp_green_success = 1; // If query is successfull set success equals 1 (For success pop-up)
                    header("location: editBook.php?bookID=" . $book_id . "&success=" . $temp_green_success);
                }
                else {
                    echo "<span class='error-addBook'>Error: " . $query . " " . $database->error . "</span>";
                }
            }
            else {
                // MySQL query update book based on the form inputs
                $query = "UPDATE Citadel_Books SET title = '$bookTitle', publishDate = '$bookPublishDate', pageCount = '$bookPageCount', isbn= '$bookISBN', bookSummary = '$bookSummary' WHERE bid = '$book_id'";             

                // If query is successfull put user in the same page else throw an exception
                if ($database->query($query) === TRUE) {
                    $temp_green_success = 1; // If query is successfull set success equals 1 (For success pop-up)
                    header("location: editBook.php?bookID=" . $book_id . "&success=" . $temp_green_success);
                }
                else {
                    echo "<span class='error-addBook'>Error: " . $query . " " . $database->error . "</span>";
                }
            }
            
            // If errors are found
            if (count($errors) != 0)
            {
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
        $database->close();
    }
    else {
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
    <script src="Javascript/editBook_validate.js"></script>
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Hello, <?=$usernameActive?>!</h2></div>

        <ul class="links-editBook" id="links-list">
            <li><a href="searchBooks.php">Search Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
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

    <!-- ===================================== EDIT BOOK FORM ===================================== -->
    <form action="editBook.php?bookID=<?=$book_id?>" method="post" class="editBook-form" id="editBook_form" enctype="multipart/form-data">
        
        <!-- Form Title -->
        <h2>Edit <em><?=$book_details['title']?></em></h2>

        <!-- ===================================== MAIN BOX ===================================== -->
        <div class="box">
            <!-- Left Box -->
            <div class="left-side">
                <!-- Form Input (BookTitle) -->
                <div class="input-box">
                    <input type="text" id="title_field" name="bookTitle" value="<?=$book_details['title']?>" placeholder="Book Title" autocomplete="off" />
                    <label id="label_title">Required.</label>
                </div>
                <!-- Form Input (PublishDate) -->
                <div class="input-box">            
                    <input type="text" id="pd_field" name="bookPD" value="<?=$book_details['publishDate']?>" placeholder="Publish Date" onfocus="(this.type='date')">
                    <label id="label_pd">Required.</label>
                </div>
                
                <!-- Form Input (PageCount) -->
                <div class="input-box">
                    <input type="number" id="pc_field" name="bookPC" value="<?=$book_details['pageCount']?>" placeholder="Page Count" autocomplete="off" />
                    <label id="label_pc">Required. Digits only.</label>
                </div>
                
                <!-- Form Input (ISBN) -->
                <div class="input-box">            
                    <input type="number" id="isbn_field" name="bookISBN" value="<?=$book_details['isbn']?>" placeholder="ISBN" autocomplete="off" />
                    <label id="label_isbn">Required. ISBN is a 13 digit number.</label>
                </div>
                
                <!-- Form Input (EditBookButton) -->
                <input type="submit" name="submit-editbook" value="Edit Book" class="editBook-button editBook-editbutton" />
                <button class="editBook-form-cancel-button" onclick="location.href=`myProfile.php`" type="button">Cancel</button>
            </div>
            
            <!-- Right Box -->
            <div class="right-side">
                <!-- Form Input (BookSummary) -->     
                <div class="input-box">       
                    <textarea maxlength="500" id="bs_field" name="bookSummary" placeholder="Book Summary"><?=$book_details['bookSummary']?></textarea>
                    <label id="label_bs">Required. MAX of 500 characters.</label>
                </div>
            </div>
        </div>
    </form>
    <?                
            if ($_GET["success"] == 1)
            {
                echo "<span class='success-editBook'>Book Updated Successfully!</span>";
            }
    ?>
    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
    <script src="Javascript/editBook_validate-r.js"></script>
</body>
</html>