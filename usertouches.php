<?php
include "authenticate.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

// Create a database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is authenticated
if ($_SESSION['authenticated']) {
    // Retrieve the logged-in user's username from the session
    $username = $_SESSION["username"];

    // Query the database to retrieve the user's role
    $user_query = "SELECT role_id FROM Users WHERE username = '$username'";
    $user_result = mysqli_query($connection, $user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $role_id = $user_row["role_id"];

        // Query the database to retrieve the role_name of the user
        $role_query = "SELECT role_name FROM Roles WHERE role_id = $role_id";
        $role_result = mysqli_query($connection, $role_query);

        if ($role_result && mysqli_num_rows($role_result) > 0) {
            $role_row = mysqli_fetch_assoc($role_result);
            $user_role = $role_row["role_name"];

            

            // Check if the logged-in user is an administrator to show user management options
            if ($user_role == 'administrator' || $user_role == 'superadministrator') {
                // Handle upgrade and delete actions if the form is submitted
                if (isset($_POST['upgrade_admin'])) {
                    $user_id = $_POST['user_id'];
                    // Perform the database update to upgrade the user to an administrator
                    $update_query = "UPDATE users SET role_id = (SELECT role_id FROM roles WHERE role_name = 'administrator' LIMIT 1) WHERE user_id = $user_id";
                    $update_result = mysqli_query($connection, $update_query);
                    if ($update_result) {
                        echo "User ID $user_id has been upgraded to an administrator.<br>";
                    } else {
                        echo "Failed to upgrade user ID $user_id to an administrator: " . mysqli_error($connection) . "<br>";
                    }
                } elseif (isset($_POST['upgrade_moderator'])) {
                    $user_id = $_POST['user_id'];
                    // Perform the database update to upgrade the user to a moderator
                    $update_query = "UPDATE users SET role_id = (SELECT role_id FROM roles WHERE role_name = 'moderator' LIMIT 1) WHERE user_id = $user_id";
                    $update_result = mysqli_query($connection, $update_query);
                    if ($update_result) {
                        echo "User ID $user_id has been upgraded to a moderator.<br>";
                    } else {
                        echo "Failed to upgrade user ID $user_id to a moderator: " . mysqli_error($connection) . "<br>";
                    }
                } elseif (isset($_POST['delete_user'])) {
                    $user_id = $_POST['user_id'];
                    // Perform the database query to delete the user
                    $delete_query = "DELETE FROM Users WHERE user_id = $user_id";
                    $delete_result = mysqli_query($connection, $delete_query);
                    if ($delete_result) {
                        echo "User ID $user_id has been deleted.<br>";
                    } else {
                        echo "Failed to delete user ID $user_id: " . mysqli_error($connection) . "<br>";
                    }
                }

                // Display the table of all users in the system
echo "<h2>All Users in the System</h2>";
echo "<a href=\"control.php\">Go back</a>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"manage.css\">";

// Add inline styles to the table
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "    <tr>
            <th style='padding: 8px; text-align: left;'>Username</th>
            <th style='padding: 8px; text-align: left;'>Email</th>
            <th style='padding: 8px; text-align: left;'>Full Name</th>
            <th style='padding: 8px; text-align: left;'>Role</th>
            <th style='padding: 8px; text-align: left;'>Actions</th>
        </tr>";

$all_users_query = "SELECT u.user_id, u.username, u.email, u.fullname, r.role_name
                    FROM Users u
                    INNER JOIN Roles r ON u.role_id = r.role_id";
$all_users_result = mysqli_query($connection, $all_users_query);

while ($user_data = mysqli_fetch_assoc($all_users_result)) {
    echo "<tr>
            <td style='padding: 8px;'>{$user_data['username']}</td>
            <td style='padding: 8px;'>{$user_data['email']}</td>
            <td style='padding: 8px;'>{$user_data['fullname']}</td>
            <td style='padding: 8px;'>{$user_data['role_name']}</td>
            <td style='padding: 8px;'>";
    
    if ($user_data['role_name'] !== 'superadministrator') {
        echo "  <form action='' method='post'>
                    <input type='hidden' name='user_id' value='{$user_data['user_id']}'>
                    <input type='submit' name='upgrade_admin' value='Upgrade to Admin'>
                    <input type='submit' name='upgrade_moderator' value='Upgrade to Moderator'>
                    <input type='submit' name='delete_user' value='Delete User'>
                </form>";
    }
    
    echo "  </td>
          </tr>";
}

echo "</table>";


            } else {
                echo '<!DOCTYPE html>
                <html>
                    <head>
                        <link href="CSS/accessdenied.css" rel="stylesheet">
                        <title>Access Denied</title>
                    </head>
                    <body>
                        <div class="container">
                            <div class="access-denied-icon">X</div>
                            <h2>Access Denied</h2>';
                            echo "Logged-in User: $username<br>";
                            echo "Role: $user_role<br><br>";
                            echo '<p>You are not authorized to access this page.</p>
                            <p>You do not have sufficient privileges to manage users.</p>
                            <div class="back-link">
                                <a href="control.php">Back</a>
                            </div>
                        </div>
                    </body>
                </html>';
                
            }
        } else {
            echo "Failed to retrieve user role.";
        }
    } else {
        echo "Failed to retrieve user information.";
    }
} else {
    echo "Access denied. Please log in to access the control panel.";
}

// Close the database connection
mysqli_close($connection);
?>
