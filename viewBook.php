<?php
    session_start();

    // Only logged-in user can view book
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
    else 
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        $book_id = $_GET["bookID"]; // Get Book id from the URL

        // Get book data function
        $row_bookDetails_result = viewBook_findBookDetails($database, $book_id);
        $temp_id = $row_bookDetails_result["uid"];

        // Get author username function
        $author_username = viewBook_findAuthorUsername($database, $temp_id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$row_bookDetails_result["title"]?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Hello, <?=$usernameActive?>!</h2></div>

        <ul class="links-viewBook" id="links-list">
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

    <!-- ===================================== VIEW BOOK ===================================== -->
    <div class="viewBook-data">
        <h2><?=$row_bookDetails_result["title"]?></h2>

        <div class="box">
            <div class="left-side">
                <img src="<?=$row_bookDetails_result["bookCover"]?>" alt="Placeholder">
                <?
                // Create book author button-link based on logged-in user or other users
                if($user_id == $row_bookDetails_result["uid"]){?>
                    <button class="viewBook-viewAuthor-button" onclick="location.href=`myProfile.php`" type="button">My Profile</button>
                <?}
                else{?>
                    <button class="viewBook-viewAuthor-button" onclick="location.href=`viewAuthor.php?authorID=<?=$row_bookDetails_result['uid']?>`" type="button">View Author</button>
                <?}?>
            </div>
        
            <div class="right-side">
                <div class="viewBook-additionalData">
                    <div class="viewBook-specificData">
                        <h3>Author: </h3><p><?=$author_username?></p>
                    </div>
                    <div class="viewBook-specificData">
                        <h3>Publish Date: </h3><p><?=$row_bookDetails_result["publishDate"]?></p>
                    </div>
                    <div class="viewBook-specificData">
                        <h3>Page Count: </h3><p><?=$row_bookDetails_result["pageCount"]?></p>
                    </div>
                    <div class="viewBook-specificData">
                        <h3>ISBN: </h3><p><?=$row_bookDetails_result["isbn"]?></p>
                    </div>
                    <div class="viewBook-specificData">
                        <h3>Summary: </h3><p><?=$row_bookDetails_result["bookSummary"]?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?$database->close();?>
    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
</body>
</html>