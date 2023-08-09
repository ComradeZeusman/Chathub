<?php
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
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $role_name = $_POST["role_id"];

    // Validate and sanitize form data 
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $phone = mysqli_real_escape_string($conn, $phone);
    $gender = mysqli_real_escape_string($conn, $gender);
    // Hashing the password for improved security
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exist in the database
    $existing_user_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $existing_user_result = $conn->query($existing_user_query);
    
    if ($existing_user_result->num_rows > 0) {
        // User already exists
        echo "User already exists. Please choose a different username or email.";
    } else {
        // Insert role_name into the roles table
        $insert_role_sql = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        if ($conn->query($insert_role_sql) === TRUE) {
            // Retrieve the generated role_id
            $role_id = $conn->insert_id;

            // Insert user data into the users table
            $insert_user_sql = "INSERT INTO users (username, email, password, fullname, phone_number, gender, role_id) VALUES ('$username', '$email', '$password_hash', '$fullname', '$phone', '$gender', '$role_id')";
            if ($conn->query($insert_user_sql) === TRUE) {
                echo '
                <!DOCTYPE html>
                <html>
                <head>
                    <link href="CSS/styling.css" rel="stylesheet">
                    <title>Successful Connection</title>
                </head>
                <body>
                    <div class="container">
                        <h2>Registration Successful!</h2>
                        <p>Congratulations, your registration was successful. You can now login using your credentials.</p>
                        <div class="center-link">
                            <a href="index.php">Click here to login</a>
                        </div>
                    </div>
                </body>
                </html>
                
            ';

                exit();
            } else {
                echo "Error: " . $insert_user_sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $insert_role_sql . "<br>" . $conn->error;
        }
    }
}
?>
