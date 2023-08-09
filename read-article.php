<!DOCTYPE html>
<html>
<head>
  <link href="CSS/reading.css" rel="stylesheet">
  <title>Articles</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Add your CSS styles here */
  </style>
</head>
<body>
<a href="lobby.php">Go Back</a>
<div class="container">
  <?php
  include "authenticate.php";

  // Retrieve articles from the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "educationalchathub";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve the total number of articles in the database
  $totalArticlesSql = "SELECT COUNT(*) as total FROM articles";
  $totalResult = $conn->query($totalArticlesSql);
  $totalArticles = $totalResult->fetch_assoc()['total'];

  // Generate a random index to fetch a random article
  $randomIndex = rand(0, $totalArticles - 1);

  // Retrieve a random article from the database
  $randomArticleSql = "SELECT articles.*, users.username 
                       FROM articles 
                       INNER JOIN users ON articles.author_id = users.user_id
                       LIMIT 1 OFFSET $randomIndex";
  $result = $conn->query($randomArticleSql);

  if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $title = $row['title'];
      $content = $row['content'];
      $publishDate = $row['publish_date'];
      $author = $row['username'];
      $imagePath = $row['file_path'];

      // Display the random article details
      echo "<div class=\"article\">";
      echo "<h2 class=\"title\">$title</h2>";
      echo "<p class=\"info\">Published on: $publishDate | Author: $author</p>";
      echo "<img src=\"$imagePath\" alt=\"Article Image\" class=\"image\" style=\"width: 300px; height: 200px;\">";
      echo "<h2>POST:</h2>";
      echo "<p class=\"content\">$content</p>";
      echo "<hr>";

      // Retrieve comments for the article from the database
      $articleId = $row['article_id'];
      $commentsSql = "SELECT comments.*, users.username FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.article_id = '$articleId'";
      $commentsResult = $conn->query($commentsSql);

      if ($commentsResult !== false && $commentsResult->num_rows > 0) {
        echo "<h3>Comments</h3>";
        echo "<div id='comments-container'>"; // Add a container for comments
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
        echo "<div id='comments-container'></div>"; // Add an empty comments container
      }

      // Comment form
      echo "<form method='POST' class='comment-form'>";
      echo "<input type='hidden' name='article_id' value='" . $row['article_id'] . "'>";
      echo "<textarea name='comment' rows='3' placeholder='Add a comment...'></textarea>";
      echo "<button type='submit'>Submit</button>";
      echo "</form>";

      // Process comment submission
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = $_POST['comment'];
        $articleId = $_POST['article_id'];
        $userId = $_SESSION['user_id'];

        // Insert the comment into the database
        $insertCommentSql = "INSERT INTO comments (article_id, user_id, comment_text) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertCommentSql);
        $stmt->bind_param("iis", $articleId, $userId, $comment);

        if ($stmt->execute()) {
          // If the comment is successfully submitted, display it in real-time
          $commentUser = $_SESSION['username'];
          $commentDate = date("Y-m-d H:i:s"); // Get the current date and time in a format compatible with MySQL

          echo "<div class='comment'>";
          echo "<p class='comment-text'>$comment</p>";
          echo "<p class='comment-info'>Posted by: $commentUser | Date: $commentDate</p>";
          echo "</div>";
        } else {
          echo "<p>Error submitting the comment: " . $stmt->error . "</p>";
        }

        $stmt->close();
      }

      echo "</div>"; // Close the article container
    }
  } else {
    echo "<p>No articles found.</p>";
  }
  ?>
</div>
<button id="next-page-button">Next Page</button>
<script>
  $(document).ready(function () {
    // Bind the "Next Page" button click event
    $("#next-page-button").click(function () {
      // Reload the page to fetch another random article
      location.reload();
    });

    // Bind the form submission event
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

          var newComment = "<div class='comment'>";
          newComment += "<p class='comment-text'>" + commentText + "</p>";
          newComment += "<p class='comment-info'>Posted by: " + commentUser + " | Date: " + commentDate + "</p>";
          newComment += "</div>";

          $("#comments-container").append(newComment);
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
