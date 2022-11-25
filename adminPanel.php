<?php
    session_start();

    // Check if there is any current session (To for user profile privacy)
    if (!isset($_SESSION["adminEmail"])) {
        header("Location: adminPanel.php");
        exit();
    }
    else {
        include 'includes/dbconnect.php'; // Connect to database
        include 'includes/loggedinuserdata.php'; // Logged-in user information

        // MySQL qeury for find all users in database
        $query = "SELECT uid, username, email from Citadel_Users";
        $results = $database->query($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ===================================== HEADER ===================================== -->
    <nav>
        <div class="logo"><h2>Logged-in as Admin!</h2></div>

        <ul class="links" id="links-list">
            <li class="logout-header"><a href="logoutAdmin.php">Logout</a></li>
        </ul>
    </nav>

    <!-- ===================================== PROFILE BOOKS TABLE ===================================== -->
    <section class="myProfile">
        <h2>Current Users from Database</h2>
        <table> 
            <tr>
                <th>UserID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <br>
            <?
            // Display users profile with all the books related to him
            while($user_details = $results->fetch_assoc()){?>
                <tr>
                    <td><?=$user_details["uid"]?></td>
                    <td><?=$user_details["username"]?></td>
                    <td><?=$user_details["email"]?></td>
                    <td>
                        <button type="submit" title="Delete User" id="delete-<?=$user_details['uid']?>" onclick="location.href = `./deleteUser.php?userID=<?=$user_details['uid']?>`" class="deleteButton"><ion-icon name="trash-outline"></ion-icon></button>
                    </td>
                </tr>
            <?}
            $database->close();
            ?>
        </table>
    </section>

    <?                
            if ($_GET["deleteUserSuccess"] == true)
            {
                echo "<span class='success-editBook'>User and all data associated with him has been deleted Successfully!</span>";
            }
    ?>

    <!-- ===================================== SCRIPTS ===================================== -->
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Javascript header animations -->
    <script src="Javascript/nav-animations.js"></script>
</body>
</html>