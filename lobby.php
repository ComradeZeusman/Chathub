<?php
include "authenticate.php";
?>

<!DOCTYPE html>
<html>
<head>
  <link href="CSS/lob.css" rel="stylesheet">
  <title>Select</title>
  <meta http-equiv="refresh" content="300">
</head>
<body>
  <a href="welcome.php">Go Back</a>
  <div class="container">
    <div class="user-profile">
      <?php
      // Retrieve username and gender from the session
      $username = $_SESSION["username"];
      $gender = $_SESSION["gender"];

      // Determine the user icon based on the gender
      $userIcon = "";
      if ($gender === "male") {
        $userIcon = "img/man.png";
      } elseif ($gender === "female") {
        $userIcon = "img/girl.png";
      } else {
        $userIcon = "img/user-icon.png";
      }

      // Display the user icon and welcome message
      echo '<img src="' . $userIcon . '" alt="User Icon">';
      echo '<h2>Welcome, ' . $username . '</h2>';
      ?>
    </div>

    <div class="options">
      <a href="read-article.php">Read Articles</a>
      <a href="upload-articles.php">Upload Articles</a>
      <a href="news.php">Upload News</a>
      <a href="category.php">category</a>
    </div>

    <div class="search-form">
      <form action="results.php" method="GET">
        <input type="text" name="search" placeholder="Search Articles by author, or title" required>
        <button type="submit">Search</button>
      </form>
    </div>

    <h1 class="daily-bulletin">Your Daily News Bulletin</h1>

    <div class="news-section">
      <?php
      $servername = "localhost";
      $username = "root"; 
      $password = ""; 
      $dbname = "educationalchathub";

      // Retrieve news from the database
      $connection = mysqli_connect($servername, $username, $password, $dbname);
      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Fetch a random news record with author information
      $news_query = "SELECT n.*, u.username AS author FROM News n
                     INNER JOIN Users u ON n.author_id = u.user_id
                     ORDER BY RAND() LIMIT 1";
      $news_result = mysqli_query($connection, $news_query);

      // Display the news record
      if ($news_result && mysqli_num_rows($news_result) > 0) {
        $news_row = mysqli_fetch_assoc($news_result);
        echo '<div class="news">';
        echo '<h3>' . $news_row['title'] . '</h3>';
        if (!empty($news_row['file_path'])) {
          $image_height = '400px';
        $image_width = '760x'; 

        echo '<img src="' . $news_row['file_path'] . '" alt="' . $news_row['title'] . '" height="' . $image_height . '" width="' . $image_width . '">';
      } else {
          echo '<h2>No image available for this news.</h2>';
      }
        echo '<p>' . $news_row['content'] . '</p>';
        echo '<p>Author: ' . $news_row['author'] . '</p>';
        echo '<p>Published on: ' . $news_row['publish_date'] . '</p>';
    
    
       
        echo '</div>';
    } else {
        echo '<p>No news available.</p>';
    }
    

      // Close the database connection
      mysqli_close($connection);
      ?>
    </div>

    <div class="countdown-timer">
      <span id="countdown-timer">05:00mins</span> until next news

</div>
  </div>
</body>
</html>