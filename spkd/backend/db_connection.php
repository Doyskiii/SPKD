<?php
$host = 'localhost';
$dbname = 'db_skpd';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
