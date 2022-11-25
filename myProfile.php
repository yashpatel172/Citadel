<?php
    session_start();

    // Check if there is any current session (To for user profile privacy)
    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
    else {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        // MySQL qeury for current logged-in user details
        $query = "SELECT Citadel_Books.title, Citadel_Books.isbn, Citadel_Books.pageCount, Citadel_Books.bid, Citadel_Books.uid, Citadel_Users.email FROM Citadel_Books INNER JOIN Citadel_Users ON Citadel_Books.uid = '$user_id' AND Citadel_Books.uid = Citadel_Users.uid ORDER BY bid ASC";
        $results = $database->query($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Hello, <?=$usernameActive?>!</h2></div>

        <ul class="links-myProfile" id="links-list">
            <li><a href="searchBooks.php">Search Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li class="logout-header"><a href="logout.php">Logout</a></li>
        </ul>

        <!-- Responsive Burger -->
        <div id="burger" onclick="burgerFunction()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- ===================================== PROFILE BOOKS TABLE ===================================== -->
    <section class="myProfile">
        <h2>My Book's</h2>
        <p><b>Email:</b> <?=$active_email?></p>
        <table> 
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Page Count</th>
                <th>Actions</th>
            </tr>
            <?
            // Display users profile with all the books related to him
            while($user_details = $results->fetch_assoc()){?>
                <tr>
                    <td><?=$user_details["title"]?></td>
                    <td><?=$user_details["isbn"]?></td>
                    <td><?=$user_details["pageCount"]?></td>
                    <td>
                        <button type="submit" title="View Book" id="view-<?=$user_details['bid']?>" onclick="location.href = `./viewBook.php?bookID=<?=$user_details['bid']?>`" class="viewButton"><ion-icon name="eye-outline"></ion-icon></button>
                        <button type="submit" title="Edit Book" id="edit-<?=$user_details['bid']?>" onclick="location.href = `./editBook.php?bookID=<?=$user_details['bid']?>`" class="editButton"><ion-icon name="create-outline"></ion-icon></button>
                        <button type="submit" title="Delete Book" id="delete-<?=$user_details['bid']?>" onclick="location.href = `./deleteBook.php?bookID=<?=$user_details['bid']?>`" class="deleteButton"><ion-icon name="trash-outline"></ion-icon></button>
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