<!DOCTYPE html>
<html>
<head>
  <link href="CSS/reading.css" rel="stylesheet">
  <title>Articles</title>
</head>
<body>
<a href="lobby.php">Go Back</a>
<div class="container">
<?php
include "authenticate.php";

// Retrieve search query from the form submission
$searchQuery = $_GET["search"] ?? "";

// Retrieve articles from the database based on the search query
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query based on the search query
$sql = "SELECT articles.*, users.username FROM articles INNER JOIN users ON articles.author_id = users.user_id WHERE articles.title LIKE '%$searchQuery%' OR users.username LIKE '%$searchQuery%' OR articles.content LIKE '%$searchQuery%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link href="CSS/read.css" rel="stylesheet">
  <title>Search Results</title>
</head>
<body>
  <div class="container">
    <h2>Search Results</h2>
    <?php
    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $content = $row['content'];
            $publishDate = $row['publish_date'];
            $author = $row['username'];
            $imagePath = $row['file_path'];
            $articleId = $row['article_id']; // Get the article ID

            // Display the article details
            echo "<div class='article'>";
            echo "<h3 class='title'>$title</h3>";
            echo "<p class='info'>Published on: $publishDate | Author: $author</p>";
            echo "<img src=\"$imagePath\" alt=\"Article Image\" class=\"image\" style=\"width: 300px; height: 200px;\">";
            echo "<p class='content'>$content</p>";
            echo "<hr>";
// Comment submission handling
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the form submission is from a comment form
    if (isset($_POST["comment"]) && isset($_POST["article_id"])) {
        $comment = $_POST["comment"];
        $articleId = $_POST["article_id"];
        
        // Ensure the user is logged in before allowing comments
        if (isset($_SESSION["user_id"])) {
            $userId = $_SESSION["user_id"];
            $commentDate = date("Y-m-d H:i:s"); // Current date and time
            
            // Insert the comment into the comments table
            $insertCommentSql = "INSERT INTO comments (user_id, article_id, comment_text, comment_date) VALUES ('$userId', '$articleId', '$comment', '$commentDate')";
            $result = $conn->query($insertCommentSql);

            if ($result === TRUE) {
                // The comment was successfully saved in the database
                
                echo "Comment submitted successfully!";
                exit; // Stop further execution of the script to prevent HTML output
            } else {
                // If there was an error while saving the comment, you can handle it here
                //! (e.g., display an error message, log the error, etc.)
                
                echo "Error submitting the comment. Please try again later.";
                exit; // Stop further execution of the script to prevent HTML output
            }
        } else {
            //? User is not logged in
            echo "You must be logged in to submit a comment.";
            exit; // Stop further execution of the script to prevent HTML output
        }
    }
}

            // Retrieve comments for the article from the database
            $commentsSql = "SELECT comments.*, users.username FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.article_id = '$articleId'";
            $commentsResult = $conn->query($commentsSql);

            if ($commentsResult !== false && $commentsResult->num_rows > 0) {
                echo "<h3>Comments</h3>";
                echo "<div id='comments-container-$articleId'>"; // Add a container for comments with unique ID for each article
                while ($commentRow = $commentsResult->fetch_assoc()) {
                    $commentText = $commentRow['comment_text'];
                    $commentUser = $commentRow['username'];
                    $commentDate = $commentRow['comment_date'];
                    echo "<div class='comment'>";
                    echo "<p class='comment-text'>$commentText</p>";
                    echo "<p class='comment-info'>Posted by: $commentUser | Date: $commentDate</p>";
                    echo "</div>";
                }
                echo "</div>"; // Close the comments container
            } else {
                echo "<p>No comments found.</p>";
                echo "<div id='comments-container-$articleId'></div>"; // Add an empty comments container with unique ID for each article
            }

            // Comment form with unique ID for each article
            echo "<form method='POST' class='comment-form' id='comment-form-$articleId'>";
            echo "<input type='hidden' name='article_id' value='$articleId'>";
            echo "<textarea name='comment' rows='3' placeholder='Add a comment...refresh the page if engaged in a conversation and members comments do not appear'></textarea>";
            echo "<button type='submit'>Submit</button>";
            echo "</form>";

            echo "</div>"; // Close the article container
        }
    } else {
        echo "<p>No articles found.</p>";
    }
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Bind the form submission event for each comment form
      $(".comment-form").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        var form = $(this); // Get the form element
        var formData = form.serialize(); // Serialize the form data

        $.ajax({
          type: "POST",
          url: window.location.href, // Use the current URL for form submission
          data: formData,
          success: function (response) {
            // If the comment is successfully submitted, display it in real-time
            var commentText = form.find("textarea[name='comment']").val();
            var commentUser = "<?php echo $_SESSION['username']; ?>"; // Get the currently logged-in user's username
            var commentDate = new Date().toLocaleString(); // Get the current date and time
            var articleId = form.find("input[name='article_id']").val(); // Get the article ID

            var newComment = "<div class='comment'>";
            newComment += "<p class='comment-text'>" + commentText + "</p>";
            newComment += "<p class='comment-info'>Posted by: " + commentUser + " | Date: " + commentDate + "</p>";
            newComment += "</div>";

            $("#comments-container-" + articleId).append(newComment);
            form.find("textarea[name='comment']").val(""); // Clear the comment input after submission
          },
          error: function (xhr, status, error) {
            // Handle the error, if any
            console.log(xhr.responseText);
          }
        });
      });
    });
  </script>
</body>
</html>
