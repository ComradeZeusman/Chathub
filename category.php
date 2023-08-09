<?php
include "authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link href="CSS/categories.css" rel="stylesheet">
  <title>Select category</title>
</head>
<body>
  <h1>View articles by category</h1>

  <a href="lobby.php">Go Back</a>
  
  <form action="categoryselect.php" method="POST">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
      <option value="sports">Sports</option>
      <option value="health">Health</option>
      <option value="recycling">Recycling</option>
      <option value="social">Social Matters</option>
      <option value="Discover">Discover</option>
    </select>
    <br>
    <input type="submit" value="Submit">
  </form>
  
</body>
</html>
