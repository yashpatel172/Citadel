<?
    session_start();

    // Only logged-in user can search book data
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
    else 
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information
        
        // Check wheather submit-searchbooks button is pressed
        if (isset($_POST["submit-searchbooks"]))
        {
            // Get book search inputs from searchbooksform
            $bookTitle = trim($_POST["bookTitle"]);
            $bookISBN = trim($_POST["bookISBN"]);
            $authorUsername = trim($_POST["authorUsername"]);
            $bookPublishDate = trim($_POST["bookPD"]);

            // MySQL query for search books data
            $query = "SELECT Citadel_Books.title, Citadel_Books.isbn, Citadel_Users.username, Citadel_Books.bid, Citadel_Books.uid FROM Citadel_Books INNER JOIN Citadel_Users WHERE (Citadel_Books.title LIKE '%$bookTitle%' AND Citadel_Books.isbn LIKE '%$bookISBN%' AND Citadel_Users.username LIKE '%$authorUsername%' AND Citadel_Books.publishDate LIKE '%$bookPublishDate%') AND Citadel_Books.uid = Citadel_Users.uid ORDER BY Citadel_Books.bid ASC";
            $result = $database->query($query);
        }
        $database->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Hello, <?=$usernameActive?>!</h2></div>

        <ul class="links-searchBooks" id="links-list">
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

    <!-- ===================================== SEARCHED BOOKS TABLE ===================================== -->
        <div class="box">
            <div class="left-side">
                <form action="searchBooks.php" method="post" class="searchBooks-form" enctype="multipart/form-data">
                    <!-- Form Title -->
                    <h2>Search Book's</h2>

                    <!-- Form Input (BookTitle) -->
                    <div class="input-box">            
                        <input type="text" name="bookTitle" placeholder="Book Title" autocomplete="off" />
                        <label>Filter Option 1</label>
                    </div>

                    <!-- Form Input (AuthorName) -->
                    <div class="input-box">
                        <input type="text" name="authorUsername" placeholder="Username" autocomplete="off" />
                        <label>Filter Option 2</label>
                    </div>
                    
                    <!-- Form Input (ISBN) -->
                    <div class="input-box">            
                        <input type="number" name="bookISBN" placeholder="ISBN" autocomplete="off" />
                        <label>Filter Option 3</label>
                    </div>
                    
                    <!-- Form Input (PublishDate) -->
                    <div class="input-box">            
                        <input type="text" name="bookPD" placeholder="Publish Date" onfocus="(this.type='date')">
                        <label>Filter Option 4</label>
                    </div>

                    <!-- Form Input (Buttons) -->
                    <input type="submit" name="submit-searchbooks" value="Search" />
                    <input type="reset" value="Reset" />
                </form>
            </div>
        
            <div class="right-side">
                <!-- ===================================== BOOKS TABLE ===================================== -->
                <section class="resultsSection">

                
                <? 
                // Print total number of results found of a book search
                if ($result->num_rows == 0) { ?>
                    <h2>Total Results Found (No Results Found!)</h2>
                <?}
                else{ 
                    $books_found = $result->num_rows; ?>
                    <h2>Total Results Found (<?=$books_found?>)</h2>
                <?}?>

                <table> 
                    <tr>
                        <th>Title</th>
                        <th>ISBN</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?
                    // Show books related with the search in a organized format
                    while($books_data = $result->fetch_assoc()){?>
                    <tr>
                        <td><?=$books_data["title"]?></td>
                        <td><?=$books_data["isbn"]?></td>
                        <td><?=$books_data["username"]?></td>
                        <td>
                            <button type="submit" title="View Book" id="view-<?=$books_data['bid']?>" onclick="location.href = `./viewBook.php?bookID=<?=$books_data['bid']?>`" class="viewButton"><ion-icon name="eye-outline"></ion-icon></button>
                        </td>
                    </tr>
                    <?}?>

                </table>
                </section>
            </div>
        </div>

    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
</body>
</html>