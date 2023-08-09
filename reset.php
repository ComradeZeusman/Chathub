<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

// Step 1: Create a connection to the database
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
  
// Step 3: Handle the POST request for password reset
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Step 4: Update the user's password in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";

    
    mysqli_query($connection, $update_sql);

    // Step 5: Delete the used token from the database
    $delete_sql = "DELETE FROM password_reset_tokens WHERE token = '$token'";
    mysqli_query($connection, $delete_sql);

   
    exit();
}
else{
    echo "error";
}
?>
