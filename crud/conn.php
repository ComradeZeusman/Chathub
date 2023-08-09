<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crud';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_error($conn));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname =  $_POST["first_name"];
    $lastname =  $_POST["last_name"];
    $city_name = $_POST["city_name"];
    $email = $_POST["email"];
    $password = bin2hex(random_bytes(8));
    $hashedpassword=  password_hash($password, PASSWORD_DEFAULT);


    $insert = "INSERT INTO employee (first_name, last_name, city_name, email, password)
               VALUES ('$firstname', '$lastname', '$city_name', '$email','$hashedpassword')";

    if (mysqli_query($conn, $insert)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
