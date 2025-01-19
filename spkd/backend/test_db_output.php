<?php
$host = 'localhost';
$dbname = 'db_skpd';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connection successful!<br>";
}

// Check if users table exists
$sql = "SHOW TABLES LIKE 'users'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "The 'users' table exists in the database.";
} else {
    echo "The 'users' table does not exist in the database.";
}

$conn->close();
?>
