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

    // Query the database to retrieve the user_id of the logged-in user
    $user_query = "SELECT user_id FROM Users WHERE username = '$username'";
    $user_result = mysqli_query($connection, $user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row["user_id"];

        // Query the database to retrieve the role_name of the user
        $role_query = "SELECT role_name FROM Roles WHERE role_id IN 
                       (SELECT role_id FROM Users WHERE user_id = $user_id)";
        $role_result = mysqli_query($connection, $role_query);

        if ($role_result && mysqli_num_rows($role_result) > 0) {
            $role_row = mysqli_fetch_assoc($role_result);
            $user_role = $role_row["role_name"];

            // Check if the user role is either "moderator" or "administrator"
            if ($user_role == 'moderator' || $user_role == 'administrator') {
                // Allow access to the news upload functionality
                echo "Access granted. Only moderators and administrators can upload news.";

                // Handle the news upload logic here
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    // Retrieve the news details from the form
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $publish_date = $_POST["publish_date"];

                    // Retrieve the category details from the form
                    $category = $_POST["category"];

                    // Check if the category already exists in the Categories table
                    $category_query = "SELECT * FROM Categories WHERE type = '$category'";
                    $category_result = mysqli_query($connection, $category_query);

                    if (mysqli_num_rows($category_result) > 0) {
                        // Category already exists, retrieve its category_id
                        $category_row = mysqli_fetch_assoc($category_result);
                        $category_id = $category_row['category_id'];
                    } else {
                        // Category does not exist, insert it into the Categories table
                        $category_insert_query = "INSERT INTO Categories (type) VALUES ('$category')";
                        $category_insert_result = mysqli_query($connection, $category_insert_query);

                        if ($category_insert_result) {
                            // Retrieve the auto-generated category_id
                            $category_id = mysqli_insert_id($connection);
                        } else {
                            // Error occurred while inserting the category
                            echo "Error: " . mysqli_error($connection);
                        }
                    }
        
                    // Handle the image upload
                    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                        $image_name = $_FILES["image"]["name"];
                        $temp_name = $_FILES["image"]["tmp_name"];
                        $image_path = "upload/" . $image_name;
        
                        // Move the uploaded image to the desired location
                        if (move_uploaded_file($temp_name, $image_path)) {
                            // Image upload successful, now insert the news and image path into the News table
                            $insert_query = "INSERT INTO News (title, content, publish_date, author_id, category_id, file_path)
                                             VALUES ('$title', '$content', '$publish_date', $user_id, $category_id, '$image_path')";
                            $insert_result = mysqli_query($connection, $insert_query);
        
                            if ($insert_result) {
                                // News and image uploaded successfully
                                echo "News and Image uploaded successfully.";
                            } else {
                                // Error occurred while uploading news and image
                                echo "Error: " . mysqli_error($connection);
                            }
                        } else {
                            // Error occurred while moving the uploaded image
                            echo "Error: Failed to move the uploaded image.";
                        }
                    } else {
                        // Error occurred during image upload
                        echo "Error: " . $_FILES["image"]["error"];
                    }
                }
                ?>
                <!-- HTML form for news upload -->
                <!DOCTYPE html>
        <html>
        <head>
            <title>News Upload</title>
            <link rel="stylesheet" href="CSS/newz.css">
        </head>
        <body>
            <div class="container">
                <h2>News Upload</h2>

                <form method="POST" action="" enctype="multipart/form-data">
                <label for="title">Title:</label>
            <input type="text" name="title" id="title" required><br>

            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="4" required></textarea><br>

            <label for="publish_date">Publish Date:</label>
            <input type="date" name="publish_date" id="publish_date" required><br>

            <label for="category">Category:</label>
            <input type="text" name="category" id="category" required><br>

                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" accept="image/*" required><br>

                    <input type="submit" value="Upload News and Image">
                </form>
            </div>
        </body>
        </html>

                <?php
            } else {
                // User does not have the necessary role
                echo'<!DOCTYPE html>
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
</html>
';
            }
        } else {
            // Error occurred while retrieving user role information
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        // Error occurred while retrieving user_id
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // User not authenticated
    echo "Please login to upload news.";
}
?>
