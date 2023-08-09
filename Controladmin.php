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

            // Check if the user role is "administrator"
            if ($user_role == 'administrator') {
                // Inline JavaScript function to generate a random password
    echo '<script>
    function generateRandomPassword() {
        var length = 10;
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-";
        var password = "";
        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
        }
        document.getElementById("password").value = password;
    }
  </script>';

// Display the registration form
echo '<!DOCTYPE html>
    <html>
    <head>
      <link href="CSS/styling.css" rel="stylesheet">
      <title>Administrator and Moderator Registration Page</title>
    </head>
    <body>
      <div class="container">
        <h2>Administrator and Moderator Registration Page</h2>
        <form action="registerconn.php" method="POST">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="Enter a username" required>
    
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email"  required>
    
          <label for="password">Password:</label>
          <input type="text" id="password" name="password" placeholder="Enter a password" readonly required>
          <button type="button" onclick="generateRandomPassword()">Generate Random Password</button>
    
          <label for="fullname">Full Name:</label>
          <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
    
          <label for="phone">Phone Number:</label>
          <input type="text" id="phone" name="phone" placeholder="Enter your phone number"required>
    
          <label for="gender">Gender:</label>
          <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
    
          <label for="admin" >Administrator</label>
          <input type="radio" id="admin" name="role_id" value="administrator">
    
          <label for="moderator">Moderator</label>
          <input type="radio" id="moderator" name="role_id" value="moderator">

          <button type="submit">Register</button>
    
          <div class="login-link">
            Account already exists? <a href="welcome.php">Go Back</a>
          </div>
        </form>
      </div>
    </body>
    </html>
    ';
            }

            else{
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
        }
    }
}
            ?>
