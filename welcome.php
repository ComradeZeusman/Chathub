<?php
include "authenticate.php";

// Logout functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Education Chat Hub</title>
  <link rel="stylesheet" type="text/css" href="css/welcomee.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to Education Chat Hub</h1>
    <div class="image-slider">
      <div class="slider-image active">
        <img src="img/1.jpg" height="500px" width="1000px" alt="Image 1">
        <p class="slider-caption">Through the Educational ChatHub, users can explore a diverse range of topics, stay informed about important educational updates.</p>
      </div>
      <div class="slider-image">
        <img src="img/2.jpg" height="500px" width="1000px" alt="Image 2">
        <p class="slider-caption">With a strong emphasis on collaboration and knowledge-sharing, the Educational ChatHub aims to empower individuals.</p>
      </div>
      <div class="slider-image">
        <img src="img/3.jpg" height="500px" width="1000px" alt="Image 3">
        <p class="slider-caption">By leveraging the power of web technologies, the Educational ChatHub strives to bridge the gap in access to education.</p>
      </div>
    </div>
    <p>The Educational ChatHub is an innovative online platform designed to promote educational engagement and community development. It serves as a central hub for individuals seeking educational information, fostering learning opportunities, and encouraging meaningful discussions within the community.</p>
    <a href="lobby.php" class="btn">Get Started</a>
    <a href="Control.php" class="btn">Control Panel</a>
    <a href="history.php" class="btn">User account & history</a>
    <a href="Controladmin.php" class="btn">Register as moderator or admin</a><br><br>
    <form method="POST" action="">
      <button type="submit" class="btn" name="logout" style="color: red;">Logout</button>
    </form>
  </div>
</body>
</html>
