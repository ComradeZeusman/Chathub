<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crud';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_error($conn));
}


$sql = "SELECT * FROM employee ";

$result=mysqli_query($conn, $sql);
if ($result) {
    echo " successfully.";
} else {
    echo "Error: ";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>table</title>
  <style>
    
    table{
        border: 2px solid black;
        text-align: center;
        position: absolute;
        color: white;
       
       

    }
    th{
        border: 2px solid black;
        background-color: blueviolet;
       
    }
    td{
        background-color: black;
        border: 2px solid black;
        height: 50px;
        width: 200px;
    }
    </style>
</head>
<body>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="container">
        <table>
        <tr>
            <th>S/N</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>';
        while ($show = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $show['userid'] . '</td>';
            echo '<td>' . $show['first_name'] . '</td>';
            echo '<td>' . $show['last_name'] . '</td>';
            echo '<td>' . $show['city_name'] . '</td>';
            echo '<td>' . $show['email'] . '</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        echo '</table></div>';
    }
    
    ?>
