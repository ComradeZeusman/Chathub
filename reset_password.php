<?php
// Include PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Your SMTP configuration
$smtp_host = 'smtp.gmail.com'; // Fixed the SMTP host
$smtp_port = 587; // Adjust the port accordingly
$smtp_username = 'educationchathub@gmail.com';
$smtp_password = 'qdmpvyrannleukiq';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

// Step 1: Create a connection to the database
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Step 2: Check if the token exists in the database and retrieve the email
    $sql = "SELECT email, token FROM password_reset_tokens WHERE token = '$token'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $token_from_db = trim($row['token']); // Retrieve the token from the database and trim any white spaces

        if ($token === $token_from_db) {
            // Token is valid, show the password reset form
            ?>
           <!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            
            
        }

        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        .container {
          
            margin: 150px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555555;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Password Reset</h1>
    <div class="container">
    <form action="" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <button type="submit">Reset Password</button>
    </form>
    </div>
</body>
</html>

            <?php
        } else {
            // Tokens do not match, show an error message or redirect to the password reset request page
            echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            text-align: center;
        }
        p {
            color: #555555;
            text-align: center;
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>Invalid token(this may happen if they was an error in generating a token). Please request a new password reset.</p>
        <a href="forgot.php" class="button">Resend request</a>
    </div>
</body>
</html>';
        }
    } else {
        // Token is invalid or not found in the database, show an error message or redirect to the password reset request page
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    background-color: #f2f2f2;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #333333;
                    text-align: center;
                }
                p {
                    color: #555555;
                    text-align: center;
                    margin-top: 30px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    background-color: #007bff;
                    color: #ffffff;
                    border-radius: 5px;
                    margin-top: 20px;
                }
                .button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Password Reset</h1>
                <p>Invalid token(this may happen if they was an error in generating a token). Please request a new password reset.</p>
                <a href="forgot.php" class="button">Resend request</a>
            </div>
        </body>
        </html>';
    }
}

// Step 3: Handle the POST request for password reset
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    $token = $_POST['token'];
    $email = $_POST['email'];

    //check if the email exists in the database
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email_from_db = trim($row['email']);
          // update user password
         $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
          
          $sql = "UPDATE Users SET password='$hashed_password' WHERE email='$email'";
          $result = mysqli_query($connection, $sql);
          
          if ($result) {
            // Password updated successfully, delete the token from the database
            
            $sql = "DELETE FROM password_reset_tokens WHERE token = '$token'";
            $result = mysqli_query($connection, $sql);

            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Password Updated</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f2f2f2;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }
            
                    .message-container {
                        background-color: #ffffff;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        border-radius: 5px;
                        padding: 20px;
                        max-width: 400px;
                        width: 100%;
                        text-align: center;
                    }
            
                    .success-message {
                        color: #4CAF50;
                        font-size: 24px;
                        margin-bottom: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="message-container">
                    <p class="success-message">Password updated successfully</p>
                </div>
            </body>
            </html>';
          }
          else {
                      echo "error updating password";
                    }
                }
}
?>
