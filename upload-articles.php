<?php
include "authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
  <link href="CSS/upload-articl.css" rel="stylesheet">
  <title>Upload Article</title>
</head>
<body>
<a href="lobby.php">Go Back</a>
  <div class="container">
    <h2>Upload Article</h2>
    <form action="upload-article-process.php" method="POST" enctype="multipart/form-data">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" placeholder="Enter the article title" required>

      <label for="content">Content:</label>
      <textarea id="content" name="content" placeholder="Enter the article content" required></textarea>

      <label for="category">Category:</label>
      <select id="category" name="category" required>
        <option value="sports">Sports</option>
        <option value="health">Health</option>
        <option value="recycling">Recycling</option>
        <option value="social">Social Matters</option>
        <option value="Discover">Discover</option>
       
      </select>

      <label for="image">Upload Image:</label>
      <input type="file" id="image" name="image">

      <button type="submit">Upload</button>
    </form>
  </div>
</body>
</html>
