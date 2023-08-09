<!DOCTYPE html>
<html>
<head>
    <title>User Profile & history</title>
    <link rel="stylesheet" type="text/css" href="CSS/history.css">
</head>
<body>
<a href="welcome.php">Go Back</a>

<?php
include "authenticate.php";

// Connect to the database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete an article
function deleteArticle($conn, $article_id) {
    $sql = "DELETE FROM articles WHERE article_id = '$article_id'";
    return $conn->query($sql);
}

// Function to delete a comment
function deleteComment($conn, $comment_id) {
    $sql = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    return $conn->query($sql);
}

// Function to delete news
function deleteNews($conn, $news_id) {
    $sql = "DELETE FROM news WHERE news_id = '$news_id'";
    return $conn->query($sql);
}

// Check if the form is submitted and process the delete action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["type"]) && isset($_POST["id"])) {
        $type = $_POST["type"];
        $id = $_POST["id"];
        if ($type === "article") {
            deleteArticle($conn, $id);
        } elseif ($type === "comment") {
            deleteComment($conn, $id);
        } elseif ($type === "news") {
            deleteNews($conn, $id);
        }
    }
}

// Get the user ID from the session
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Fetch user information from the database
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        $user_info = $result->fetch_assoc();
        // Display account information
        echo "<div class='container'>";
        echo "<h1>Welcome, {$user_info['fullname']}!</h1>";
        echo "<p>Username: {$user_info['username']}</p>";
        echo "<p>Email: {$user_info['email']}</p>";
        echo "<p>Phone Number: {$user_info['phone_number']}</p>";
        echo "<p>Gender: {$user_info['gender']}</p>";

        // Display user's history (articles, comments, and uploaded news)
        echo "<div class='history-section'>";

        // Fetch articles written by the user
        $sql_articles = "SELECT * FROM articles WHERE author_id = '$user_id'";
        $result_articles = $conn->query($sql_articles);

        if ($result_articles !== false && $result_articles->num_rows > 0) {
            echo "<div class='articles-section'>";
            echo "<h2>Your Articles</h2>";
            while ($article = $result_articles->fetch_assoc()) {
                $publishDate = $article['publish_date'];
                echo "<p>Article Title: {$article['title']} - Publish Date: $publishDate
                      <form method='post'>
                          <input type='hidden' name='type' value='article'>
                          <input type='hidden' name='id' value='{$article['article_id']}'>
                          <input type='submit' value='Delete'>
                      </form>
                      </p>";
                // Display more article details as needed
            }
            echo "</div>"; // Close articles-section
        } else {
            echo "<p class='no-data-message'>No articles found.</p>";
        }

        // Fetch comments made by the user
        $sql_comments = "SELECT c.*, a.title AS article_title FROM comments c 
                         JOIN articles a ON c.article_id = a.article_id
                         WHERE c.user_id = '$user_id'";
        $result_comments = $conn->query($sql_comments);

        if ($result_comments !== false && $result_comments->num_rows > 0) {
            echo "<div class='comments-section'>";
            echo "<h2>Your Comments</h2>";
            while ($comment = $result_comments->fetch_assoc()) {
                $articleTitle = $comment['article_title'];
                echo "<p>Article Title: $articleTitle <br><br>  Comment: {$comment['comment_text']}
                      <form method='post'>
                          <input type='hidden' name='type' value='comment'>
                          <input type='hidden' name='id' value='{$comment['comment_id']}'>
                          <input type='submit' value='Delete'>
                      </form>
                      </p>";
                // Display more comment details as needed
            }
            echo "</div>"; // Close comments-section
        } else {
            echo "<p class='no-data-message'>No comments found.</p>";
        }

        // Fetch news uploaded by the user
        $sql_news = "SELECT * FROM news WHERE author_id = '$user_id'";
        $result_news = $conn->query($sql_news);

        if ($result_news !== false && $result_news->num_rows > 0) {
            echo "<div class='news-section'>";
            echo "<h2>Your Uploaded News</h2>";
            while ($news = $result_news->fetch_assoc()) {
                $publishDate = $news['publish_date'];
                echo "<p>News Title: {$news['title']} - Publish Date: $publishDate
                      <form method='post'>
                          <input type='hidden' name='type' value='news'>
                          <input type='hidden' name='id' value='{$news['news_id']}'>
                          <input type='submit' value='Delete'>
                      </form>
                      </p>";
                // Display more news details as needed
            }
            echo "</div>"; // Close news-section
        } else {
            echo "<p class='no-data-message'>No uploaded news found.</p>";
        }

        echo "</div>"; // Close history-section
        echo "</div>"; // Close container
    } else {
        echo "<p class='error-message'>Error: Unable to fetch user details.</p>";
    }
} else {
    echo "<p class='error-message'>Error: User ID not found in session. Please ensure proper authentication.</p>";
}

$conn->close();
?>

</body>
</html>
