<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Clear any existing output
    ob_clean();

    // Display a simple message or any desired content
    echo'<!DOCTYPE html>
    <html>
    <head>
        <link href="CSS/pleaselogin.css" rel="stylesheet">
        <title>Access Denied</title>
    </head>
    <body>
        <div class="container">
            <div class="access-denied-icon">X</div>
            <h2>Access Denied</h2>
            <p>You are not logged in.</p>
            <div class="back-link">
                <a href="index.php">Go Back to Login</a>
            </div>
        </div>
    </body>
    </html>
    ';

    // Stop further script execution
    exit();
}

// Database retrieval code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $sql = "SELECT user_id, gender, role_id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["gender"] = $row["gender"]; // Set the "gender" in the session
        $_SESSION["user_id"] = $row["user_id"]; // Set the "user_id" in the session
        $_SESSION["role_id"] = $row["role_id"]; // Set the "role_id" in the session
        $_SESSION['authenticated'] = true; // Set the "authenticated" flag
    } else {
        echo "Error: Unable to fetch user details.";
    }
} else {
    echo "Error: User ID not found in session. Please ensure proper authentication.";
}

$conn->close();
?>
