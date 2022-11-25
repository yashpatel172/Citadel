<?php
    session_start();

    // Only logged-in user can view author
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
    else 
    {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        $viewAuthorID = $_GET["authorID"]; // Get author id from the URL

        // Find author info function
        $username_get = viewAuthor_findAuthorInfo($database, $viewAuthorID);
        $author_username = $username_get[0];
        $author_email = $username_get[1];

        // MySQL query to get all data of the author and his books
        $getDataQuery = "SELECT Citadel_Users.username, Citadel_Books.title, Citadel_Books.isbn, Citadel_Books.pageCount, Citadel_Books.bid, Citadel_Books.uid FROM Citadel_Books INNER JOIN Citadel_Users ON Citadel_Books.uid = '$viewAuthorID' AND Citadel_Books.uid = Citadel_Users.uid ORDER BY bid ASC";
        $resultList = $database->query($getDataQuery);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Author</title>
    <link rel="stylesheet" href="style.css">
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

    <!-- ===================================== BOOKS TABLE ===================================== -->
    <section class="viewAuthor">
        <h2>Book's from <?=$author_username?></h2>
        <p><b>Contact me at:</b> <?=$author_email?></p>
        <table> 
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Page Count</th>
                <th>Actions</th>
            </tr>
            <?while($row = $resultList->fetch_assoc()){?>
                <tr>
                    <td><?=$row["title"]?></td>
                    <td><?=$row["isbn"]?></td>
                    <td><?=$row["pageCount"]?></td>
                    <td>
                        <button title="View Book" type="submit" id="view-<?=$row['bid']?>" onclick="location.href = `./viewBook.php?bookID=<?=$row['bid']?>`" class="viewButton"><ion-icon name="eye-outline"></ion-icon></button>
                    </td>
                </tr>
            <?}
            $database->close();
            ?>
        </table>
    </section>
    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
</body>
</html>