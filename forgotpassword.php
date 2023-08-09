<?php
// Include PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Your SMTP configuration
$smtp_host = 'smtp.gmail.com';
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Step 2: Generate a unique token (random string)
        $token = bin2hex(random_bytes(10));

        // Step 3: Store the token in the database along with the user's email
        $insert_token_sql = "INSERT INTO password_reset_tokens (email, token) VALUES ('$email', '$token')";
        mysqli_query($connection, $insert_token_sql);

        // Step 4: Compose the password reset email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('educationalchathub@gmail.com', 'Educational Chat Hub');
        $mail->addAddress($email);
        $mail->Subject = 'Password Reset Request';
        $mail->Body = 'A password request was made click the following link to reset your password. if this was not made by you delete this email: http://localhost/reset_password.php?token=' . $token;

        // Step 5: Send the email
        if ($mail->send()) {
            
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
        <p>An email has been sent to your registered email address with instructions to reset your password.</p>
        <a href="index.php" class="button">Go to login</a>
    </div>
</body>
</html>';


        } else {
            echo 'Error sending email: ' . $mail->ErrorInfo;
            $mail->SMTPDebug = 2; // Enable debugging (set to 0 to disable)
        }
    }
}
?>
