<?php
include "authenticate.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educationalchathub";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the $selectedCategoryType variable
$selectedCategoryType = '';

// Check if the form is submitted
if (isset($_POST["category"])) {
    $selectedCategoryType = $_POST["category"];

    // Prepare the SQL query to retrieve the category ID based on the selected category type
    $sql = "SELECT category_id FROM Categories WHERE type = '$selectedCategoryType'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a category ID was retrieved
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $selectedCategoryId = $row["category_id"];

        // Prepare the SQL query to retrieve the articles based on the selected category ID
        $sql = "SELECT * FROM Articles WHERE category_id = $selectedCategoryId";

        // Check if a search term is provided
        if (isset($_POST["search"])) {
            $searchTerm = $_POST["search"];
            $sql .= " AND (title LIKE '%$searchTerm%' OR author_id IN (SELECT user_id FROM Users WHERE username LIKE '%$searchTerm%'))";
        }

        // Execute the query
        $result = $conn->query($sql);

        // Check if any rows were returned
        if ($result && $result->num_rows > 0) {
            // Load the external CSS file
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"CSS/catery.css\">";

            // Display the search form
            echo '<a href="category.php">Go Back</a>';
            echo '<form class="search-form" action="" method="POST">
                    <input type="text" name="search" placeholder="Search by title or author in ' . $selectedCategoryType . '">
                    <input type="hidden" name="category" value="' . $selectedCategoryType . '">
                    <button type="submit">Search</button>
                  </form>';

            // Loop through the rows and display the articles
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $publishDate = $row["publish_date"];
                $authorId = $row["author_id"];
                $imagePath = $row["file_path"];
                $content = $row["content"];

                // Retrieve the author's username from the "Users" table
                $authorQuery = "SELECT username FROM Users WHERE user_id = $authorId";
                $authorResult = $conn->query($authorQuery);
                $authorRow = $authorResult->fetch_assoc();
                $authorUsername = $authorRow["username"];

                // Display the article details
                echo "<div class=\"article\">";
                echo "<h2 class=\"title\">$title</h2>";
                echo "<p class=\"info\">Published on: $publishDate | Author: $authorUsername</p>";
                echo "<img src=\"$imagePath\" alt=\"Article Image\" class=\"image\" style=\"width: 300px; height: 200px;\">";
                echo "<h2>POST:</h2>";
                echo "<p class=\"content\">$content</p>";
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "No articles found for the selected category.";
        }
    } else {
        echo "No category found for the selected category type.";
    }
} else {
    // Display the category selection form
    echo '<!DOCTYPE html>
            <html>
            <head>
              <title>Select category</title>
              <link rel="stylesheet" type="text/css" href="CSS/catery.css">
            </head>
            <body>
              <div class="container">
                <h1>Categories</h1>

                <form action="" method="POST">
                  <label for="category">Category:</label>
                  <select id="category" name="category" required>
                    <option value="sports">Sports</option>
                    <option value="health">Health</option>
                    <option value="recycling">Recycling</option>
                    <option value="social">Social Matters</option>
                    <option value="Discover">Discover</option>
                  </select>
                  <br>
                  <input type="submit" value="Submit">
                </form>

                
              </div>

            </body>
            </html>';
}

// Close the connection
$conn->close();
?>
