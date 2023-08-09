<?php
include "authenticate.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $content = $_POST["content"];
    $category = $_POST["category"];

    // File upload handling
    $targetDir = "uploads/";
    $fileName = $_FILES["image"]["name"];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow only specific file types
    $allowedTypes = array('jpg', 'jpeg', 'png');
    if (in_array($fileType, $allowedTypes)) {
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);

        // Database insertion code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "educationalchathub";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
// Retrieve form data
$title = $_POST["title"];
$content = mysqli_real_escape_string($conn, $_POST["content"]);
$category = $_POST["category"];

        // Check if the category already exists in the categories table
        $checkCategorySQL = "SELECT category_id FROM categories WHERE type = '$category'";
        $result = $conn->query($checkCategorySQL);

        if ($result->num_rows > 0) {
            // Category already exists, retrieve the category_id
            $row = $result->fetch_assoc();
            $categoryID = $row["category_id"];
        } else {
            // Category does not exist, insert it into the categories table
            $insertCategorySQL = "INSERT INTO categories (type) VALUES ('$category')";
            if ($conn->query($insertCategorySQL) === TRUE) {
                $categoryID = $conn->insert_id;
            } else {
                echo "Error: " . $insertCategorySQL . "<br>" . $conn->error;
                $conn->close();
                exit();
            }
        }

        // Insert the article details into the articles table
        $insertArticleSQL = "INSERT INTO articles (title, content, file_path, publish_date, author_id, category_id) VALUES ('$title', '$content', '$targetFilePath', NOW(), {$_SESSION['user_id']}, $categoryID)";

        if ($conn->query($insertArticleSQL) === TRUE) {
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Article Upload Success</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f7f7f7;
                        text-align: center;
                        padding: 20px;
                    }
            
                    .upload-success {
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 16px;
                    }
            
                    .upload-success:hover {
                        background-color: #45a049;
                    }
                </style>
            </head>
            <body>
                <h1>Article Uploaded Successfully!</h1>
                <p>Congratulations! Your article has been successfully uploaded.</p>
                <button class="upload-success" onclick="window.location.href=\'upload-articles.php\'">Go Back</button>
            </body>
            </html>';
            exit();
        } else {
            echo "Error uploading article: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
    }
}
?>
