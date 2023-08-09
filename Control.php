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

            // Check if the user role is either "moderator" or "administrator"
            if ($user_role == 'administrator' || $user_role == 'superadministrator')  {
                // Display the control panel interface
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"CSS/controlpanel.css\">";
                echo "<h1>Control Panel</h1>";
                echo "<h2>Welcome, $username!</h2>";
                echo "<p>You have the role of $user_role.</p>";

                // Add code for monitoring and deleting user accounts or articles
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

                            // Retrieve articles associated with the user
                            $articlesQuery = "SELECT * FROM Articles WHERE author_id = $userId";
                            $articlesResult = mysqli_query($connection, $articlesQuery);

                            if ($articlesResult && mysqli_num_rows($articlesResult) > 0) {
                                echo "<ul>";
                                while ($articleRow = mysqli_fetch_assoc($articlesResult)) {
                                    $articleId = $articleRow['article_id'];
                                    $articleTitle = $articleRow['title'];
                                    echo "<li>Article ID: $articleId | Title: $articleTitle</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>No articles found for the user.</p>";
                            }

                            // Query to retrieve comments for the user
                            $commentsQuery = "SELECT * FROM Comments WHERE user_id = $userId";
                            $commentsResult = mysqli_query($connection, $commentsQuery);

                            // Display user's comments with delete buttons
                            if ($commentsResult && mysqli_num_rows($commentsResult) > 0) {
                                echo "<h3>User's Comments:</h3>";
                                echo "<ul>";
                                while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
                                    $commentId = $commentRow['comment_id'];
                                    echo "<li>Comment ID: $commentId";

                                    // Check if 'comment_text' key exists in the $commentRow array
                                    if (isset($commentRow['comment_text'])) {
                                        $commentContent = $commentRow['comment_text'];
                                        echo " | Content: $commentContent"; // Display the comment content
                                    } else {
                                        echo " | Content: N/A"; // Display a default message if 'comment_text' is not available
                                    }

                                    echo " <form action=\"control.php\" method=\"POST\">";
                                    echo "<input type=\"hidden\" name=\"delete_comment\" value=\"$commentId\">";
                                    echo "<input type=\"submit\" value=\"Delete Comment\"onclick=\"return confirmAction('Are you sure you want to delete this comment?')\">";
                                    echo "</form>";
                                    echo "</li>";
                                    echo "<script>";
                                    echo " function confirmAction(message) {";
                                    echo "     return confirm(message);";
                                    echo " }";
                                    echo "</script>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>No comments found for the user.</p>";
                            }
                        }
                    } else {
                        echo "<p>No users found for the search term: $searchTerm</p>";
                    }
                }

                if (isset($_POST['delete_user'])) {
                    $userId = $_POST['delete_user'];
                
                    // Get the role of the user to be deleted
                    $getUserRoleQuery = "SELECT role_name FROM Users u
                                         JOIN Roles r ON u.role_id = r.role_id
                                         WHERE u.user_id = $userId";
                    $getUserRoleResult = mysqli_query($connection, $getUserRoleQuery);
                
                    if ($getUserRoleResult) {
                        $userRoleData = mysqli_fetch_assoc($getUserRoleResult);
                        $userRole = $userRoleData['role_name'];
                
                        if ($userRole === "superadministrator") {
                            echo "<p>You cannot delete a superadministrator.</p>";
                        } else {
                            $deleteUserQuery = "DELETE u FROM Users u
                                                JOIN Roles r ON u.role_id = r.role_id
                                                WHERE u.user_id = $userId 
                                                AND (r.role_name = 'administrator' OR r.role_name = 'moderator' OR r.role_name = 'user')";
                
                            $deleteUserResult = mysqli_query($connection, $deleteUserQuery);
                            if ($deleteUserResult) {
                                echo "<p>User deleted successfully.</p>";
                            } else {
                                echo "<p>Error deleting user.</p>";
                            }
                        }
                    } else {
                        echo "<p>Error retrieving user role.</p>";
                    }
                }
                
            
                
                    

                

                // Delete article functionality
                if (isset($_POST['delete_article'])) {
                    $articleToDelete = $_POST['delete_article'];

                    // Delete the article from the database
                    $deleteArticleQuery = "DELETE FROM Articles WHERE article_id = $articleToDelete";
                    $deleteArticleResult = mysqli_query($connection, $deleteArticleQuery);

                    if ($deleteArticleResult) {
                        echo "Article with ID $articleToDelete has been deleted.";
                    } else {
                        echo "Failed to delete article.";
                    }
                }

                // Delete comment functionality
                if (isset($_POST['delete_comment'])) {
                    $commentToDelete = $_POST['delete_comment'];

                    // Delete the comment from the database
                    $deleteCommentQuery = "DELETE FROM Comments WHERE comment_id = $commentToDelete";
                    $deleteCommentResult = mysqli_query($connection, $deleteCommentQuery);

                    if ($deleteCommentResult) {
                        echo "Comment with ID $commentToDelete has been deleted.";
                    } else {
                        echo "Failed to delete comment.";
                    }
                }

                // Display search form
                echo "<h3>Search Users</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"search\" placeholder=\"Search for users\" required>";
                echo "<input type=\"submit\" value=\"Search\">";
                echo "</form>";

                // Display delete user form
                echo "<h3>Delete User</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_user\" placeholder=\"Enter user ID\" required>";
                echo "<input type=\"submit\" value=\"Delete User\"onclick=\"return confirmAction('Are you sure you want to delete this user?')\">";
                echo "</form>";

                // Display delete article form
                echo "<h3>Delete Article</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_article\" placeholder=\"Enter article ID\" required>";
                echo "<input type=\"submit\" value=\"Delete Article\"onclick=\"return confirmAction('Are you sure you want to delete this Article?')\">";
                echo "</form>";

                // Display delete comment form (for demonstration purposes)
                echo "<h3>Delete Comment</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_comment\" placeholder=\"Enter comment ID\" required>";
                echo "<input type=\"submit\" value=\"Delete Comment\"onclick=\"return confirmAction('Are you sure you want to delete this comment')\">";
                echo "</form>";

                 echo "<h3>Manage news</h3>";   
                echo "<form action=\"newscontroll.php\" method=\"POST\">"; 
                echo "<input type=\"submit\" value=\"Manage News\">";
                echo "</form>";

                echo "<h3>Go to user management</h3>";
                echo "<form action=\"usertouches.php\" method=\"POST\">";
                echo "<input type=\"submit\" value=\"User Management\">";
                echo "</form>";

                echo "<h3>Go Back to home</h3>";
                echo "<form action=\"welcome.php\" method=\"POST\">";
                echo "<input type=\"submit\" value=\"Home\">";
                echo "</form>";
                
                echo "<script>";
                echo " function confirmAction(message) {";
                echo "     return confirm(message);";
                echo " }";
                echo "</script>";

               
            } 
             // Check if the user role is either "moderator" or "administrator"
             elseif ($user_role == 'moderator') {
                // Display the control panel interface
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"CSS/controlpanel.css\">";
                echo "<h1>Control Panel</h1>";
                echo "<h2>Welcome, $username!</h2>";
                echo "<p>You have the role of $user_role.</p>";

                // Add code for monitoring and deleting user accounts or articles
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

                            // Retrieve articles associated with the user
                            $articlesQuery = "SELECT * FROM Articles WHERE author_id = $userId";
                            $articlesResult = mysqli_query($connection, $articlesQuery);

                            if ($articlesResult && mysqli_num_rows($articlesResult) > 0) {
                                echo "<ul>";
                                while ($articleRow = mysqli_fetch_assoc($articlesResult)) {
                                    $articleId = $articleRow['article_id'];
                                    $articleTitle = $articleRow['title'];
                                    echo "<li>Article ID: $articleId | Title: $articleTitle</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>No articles found for the user.</p>";
                            }

                            // Query to retrieve comments for the user
                            $commentsQuery = "SELECT * FROM Comments WHERE user_id = $userId";
                            $commentsResult = mysqli_query($connection, $commentsQuery);

                            // Display user's comments with delete buttons
                            if ($commentsResult && mysqli_num_rows($commentsResult) > 0) {
                                echo "<h3>User's Comments:</h3>";
                                echo "<ul>";
                                while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
                                    $commentId = $commentRow['comment_id'];
                                    echo "<li>Comment ID: $commentId";

                                    // Check if 'comment_text' key exists in the $commentRow array
                                    if (isset($commentRow['comment_text'])) {
                                        $commentContent = $commentRow['comment_text'];
                                        echo " | Content: $commentContent"; // Display the comment content
                                    } else {
                                        echo " | Content: N/A"; // Display a default message if 'comment_text' is not available
                                    }

                                    echo " <form action=\"control.php\" method=\"POST\">";
                                    echo "<input type=\"hidden\" name=\"delete_comment\" value=\"$commentId\">";
                                    echo "<input type=\"submit\" value=\"Delete Comment\"onclick=\"return confirmAction('Are you sure you want to delete this comment?')\">";
                                    echo "</form>";
                                    echo "</li>";
                                    echo "<script>";
                                    echo " function confirmAction(message) {";
                                    echo "     return confirm(message);";
                                    echo " }";
                                    echo "</script>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>No comments found for the user.</p>";
                            }
                        }
                    } else {
                        echo "<p>No users found for the search term: $searchTerm</p>";
                    }
                }

                

                // Delete article functionality
                if (isset($_POST['delete_article'])) {
                    $articleToDelete = $_POST['delete_article'];

                    // Delete the article from the database
                    $deleteArticleQuery = "DELETE FROM Articles WHERE article_id = $articleToDelete";
                    $deleteArticleResult = mysqli_query($connection, $deleteArticleQuery);

                    if ($deleteArticleResult) {
                        echo "Article with ID $articleToDelete has been deleted.";
                    } else {
                        echo "Failed to delete article.";
                    }
                }

                // Delete comment functionality
                if (isset($_POST['delete_comment'])) {
                    $commentToDelete = $_POST['delete_comment'];

                    // Delete the comment from the database
                    $deleteCommentQuery = "DELETE FROM Comments WHERE comment_id = $commentToDelete";
                    $deleteCommentResult = mysqli_query($connection, $deleteCommentQuery);

                    if ($deleteCommentResult) {
                        echo "Comment with ID $commentToDelete has been deleted.";
                    } else {
                        echo "Failed to delete comment.";
                    }
                }

                // Display search form
                echo "<h3>Search Users</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"search\" placeholder=\"Search for users\" required>";
                echo "<input type=\"submit\" value=\"Search\">";
                echo "</form>";


                // Display delete article form
                echo "<h3>Delete Article</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_article\" placeholder=\"Enter article ID\" required>";
                echo "<input type=\"submit\" value=\"Delete Article\"onclick=\"return confirmAction('Are you sure you want to delete this Article?')\">";
                echo "</form>";

                // Display delete comment form (for demonstration purposes)
                echo "<h3>Delete Comment</h3>";
                echo "<form action=\"control.php\" method=\"POST\">";
                echo "<input type=\"text\" name=\"delete_comment\" placeholder=\"Enter comment ID\" required>";
                echo "<input type=\"submit\" value=\"Delete Comment\"onclick=\"return confirmAction('Are you sure you want to delete this comment')\">";
                echo "</form>";

                 echo "<h3>Manage news</h3>";   
                echo "<form action=\"newscontroll.php\" method=\"POST\">"; 
                echo "<input type=\"submit\" value=\"Manage News\">";
                echo "</form>";

                echo "<h3>Go to user management</h3>";
                echo "<form action=\"usertouches.php\" method=\"POST\">";
                echo "<input type=\"submit\" value=\"User Management\">";
                echo "</form>";

                echo "<h3>Go Back to home</h3>";
                echo "<form action=\"welcome.php\" method=\"POST\">";
                echo "<input type=\"submit\" value=\"Home\">";
                echo "</form>";
                
                echo "<script>";
                echo " function confirmAction(message) {";
                echo "     return confirm(message);";
                echo " }";
                echo "</script>";

               
            }
            else {
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
