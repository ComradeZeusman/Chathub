<?php
include "authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat Hub</title>
  <link href="CSS/chat.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>

  </style>
</head>
<body>
  <div class="container">
    <h2>Chat Hub</h2>
    <div class="chat-window">
      <!-- Chat window content, will add when necessary --> 
    </div>
    <div class="input-container">
      <input type="text" placeholder="Type your message...">
      <button type="submit">Send</button>
    </div>
    <div class="sharing-icons">
      <button><i class="fas fa-image"></i></button>
      <button><i class="fas fa-file"></i></button>
      <button><i class="fas fa-video"></i></button>
    </div>
  </div>
</body>
</html>
