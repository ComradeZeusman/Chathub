<?php
session_start(); // Start the PHP session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    

    // Perform login validation and check if the user exists in the database
    $login_sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $conn->query($login_sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            // Successful login
            $_SESSION["username"] = $username; // Store the username in the session
            echo "Login successful!";
            header("Location: welcome.php");
            exit(); // Ensure no code execution after the redirect
        } else {
            // Invalid password
            echo'<!DOCTYPE html>
            <html>
            <head>
              <title>Invalid Password</title>
             <style>

             body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
              }
              
              .container {
                max-width: 400px;
                margin: 200px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
              }
              
              h1 {
                text-align: center;
              }
              
              form {
                display: flex;
                flex-direction: column;
              }
              
              label {
                margin-bottom: 5px;
              }
              
              input[type="password"] {
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
                transition: border-color 0.2s ease-in-out;
              }
              
              input[type="password"]:focus {
                outline: none;
                border-color: #4CAF50;
              }
              
              input.invalid {
                border-color: #FF0000;
              }
              
              button {
                padding: 10px 20px;
                margin-top: 10px;
                font-size: 16px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.2s ease-in-out;
              }
              
              button:hover {
                background-color: #45a049;
              }

             </style>
            </head>
            <body>
              <div class="container">
                <h1>Invalid Password</h1>
                
                  <button type="submit" onclick="redirectToIndex()">Go to Index</button>
              
              </div>
            
              <script>
                function redirectToIndex() {
                  window.location.href = "index.php";
                }
              </script>
            </body>
            </html>
            ';
        }
    } else {
        // Invalid username
        echo'<!DOCTYPE html>
            <html>
            <head>
              <title>Invalid Password</title>
             <style>

             body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
              }
              
              .container {
                max-width: 400px;
                margin: 200px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
              }
              
              h1 {
                text-align: center;
              }
              
              form {
                display: flex;
                flex-direction: column;
              }
              
              label {
                margin-bottom: 5px;
              }
              
              input[type="password"] {
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
                transition: border-color 0.2s ease-in-out;
              }
              
              input[type="password"]:focus {
                outline: none;
                border-color: #4CAF50;
              }
              
              input.invalid {
                border-color: #FF0000;
              }
              
              button {
                padding: 10px 20px;
                margin-top: 10px;
                font-size: 16px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.2s ease-in-out;
              }
              
              button:hover {
                background-color: #45a049;
              }

             </style>
            </head>
            <body>
              <div class="container">
                <h1>Invalid Username</h1>
                
                  <button type="submit" onclick="redirectToIndex()">Go to Index</button>
              
              </div>
            
              <script>
                function redirectToIndex() {
                  window.location.href = "index.php";
                }
              </script>
            </body>
            </html>
            ';
    }
}

$conn->close();
?>
