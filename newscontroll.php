<?php
include "authenticate.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

$authenticated = false;
if ($_SESSION['authenticated']) {
    $authenticated = true;
}

if ($authenticated) {
    // Create a database connection
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the logged-in user's username from the session
    $username = $_SESSION["username"];

    // Query the database to retrieve the user_id and role_id of the logged-in user
    $user_query = "SELECT user_id, role_id FROM Users WHERE username = '$username'";
    $user_result = mysqli_query($connection, $user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row["user_id"];
        $role_id = $user_row["role_id"];

        // Query the database to retrieve the role_name of the user
        $role_query = "SELECT role_name FROM Roles WHERE role_id = $role_id";
        $role_result = mysqli_query($connection, $role_query);

        if ($role_result && mysqli_num_rows($role_result) > 0) {
            $role_row = mysqli_fetch_assoc($role_result);
            $user_role = $role_row["role_name"];

            //? Check if the user role is either "moderator" or "administrator"
            if ( $user_role == 'administrator') {
                // Display the control panel interface
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"CSS/controlpanel.css\">";
                echo "<h1>Control Panel</h1>";
                echo "<h2>Welcome, $username!</h2>";
                echo "<p>You have the role of $user_role.</p>";

            //!search
                if (isset($_POST['search'])) {
                    $searchTerm = $_POST['search'];

                    // Search for the user based on the provided search term
                    $searchUserQuery = "SELECT * FROM Users WHERE username LIKE '%$searchTerm%'";
                    $searchUserResult = mysqli_query($connection, $searchUserQuery);

                    if ($searchUserResult && mysqli_num_rows($searchUserResult) > 0) {
                        echo "<h3>Search Results - Users</h3>";
                        while ($userRow = mysqli_fetch_assoc($searchUserResult)) {
                            $userId = $userRow['user_id'];
                            $username = $userRow['username'];
                            $email = $userRow['email'];

                            echo "<p>User ID: $userId | Username: $username | Email: $email</p>";

                          
                            // Retrieve news associated with the user
                            $newsQuery = "SELECT * FROM news WHERE author_id = $userId";
                            $newsResult = mysqli_query($connection, $newsQuery);

                            if ($newsResult && mysqli_num_rows($newsResult) > 0) {
                                echo "<ul>";
                                while ($newsRow = mysqli_fetch_assoc($newsResult)) {
                                    $newsId = $newsRow['news_id'];
                                    $newsTitle = $newsRow['title'];
                                    echo "<li>News ID: $newsId | Title: $newsTitle</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>No news found for the user.</p>";
                            }
                            
                        }
                    }
                }
                //Delete news functionality
                if (isset($_POST['delete_news'])) {
                    $newsToDelete = $_POST['delete_news'];

                    // Delete the news from the database
                    $deleteNewsQuery = "DELETE FROM news WHERE news_id = $newsToDelete";
                    $deleteNewsResult = mysqli_query($connection, $deleteNewsQuery);

                    if ($deleteNewsResult) {
                        echo "News with ID $newsToDelete has been deleted.";
                    } else {
                        echo "Failed to delete news.Not enough privileges.";
                    }

                }
                else {
                    echo "<p>No users found  with that search term or have reached end of content .</p>";
                }

                // Delete user functionality
                if (isset($_POST['delete_user'])) {
                    $userToDelete = $_POST['delete_user'];

                    // Delete the user from the database
                    $deleteUserQuery = "DELETE FROM Users WHERE user_id = $userToDelete";
                    $deleteUserResult = mysqli_query($connection, $deleteUserQuery);

                    if ($deleteUserResult) {
                        echo "User with ID $userToDelete has been deleted.";
                    } else {
                        echo "Failed to delete user.Not enough privileges.";
                    }
                }


                // Display search form
                echo "<h3>Search Users</h3>";
                echo "<form action=\"newscontroll.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"search\" placeholder=\"Search for users\" required>";
                echo "<input type=\"submit\" value=\"Search\">";
                echo "</form>";
                //Display delete news form
                echo "<h3>Delete News</h3>";
                echo "<form action=\"newscontroll.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_news\" placeholder=\"Enter news ID\" required>";
                echo "<input type=\"submit\" value=\"Delete News\" onclick=\"return confirmAction('Are you sure you want to delete this news?')\">";
                echo "</form>";
                // Display delete user form
                echo "<h3>Delete User</h3>";
                echo "<form action=\"newscontroll.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_user\" placeholder=\"Enter user ID\" required>";
                echo "<input type=\"submit\" value=\"Delete User\" onclick=\"return confirmAction('Are you sure you want to delete this user?')\">";
                echo "</form>";


                echo "<a href=\"welcome.php\">Go to back to home</a><br>";
                echo "<a href=\"control.php\">Go back</a>";

                echo "<script>";
                echo " function confirmAction(message) {";
                echo "     return confirm(message);";
                echo " }";
                echo "</script>";

             } else {
                echo '<!DOCTYPE html>
                <html>
                <head>
                    <link href="CSS/accessdenied.css" rel="stylesheet">
                    <title>Access Denied</title>
                </head>
                <body>
                    <div class="container">
                        <div class="access-denied-icon">X</div>
                        <h2>Access Denied</h2>
                        <p>You are not authorized to access this page.</p>
                        <div class="back-link">
                            <a href="welcome.php">Go Back to Home</a>
                        </div>
                    </div>
                </body>
                </html>';
            }
        } else {
            echo "Failed to retrieve user role.";
        }
    } else {
        echo "Failed to retrieve user information.";
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo "Access denied. Please log in to access the control panel.";
}
?>
