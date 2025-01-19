<?php
include 'db_connection.php';

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connection to the database was successful!";
}
?>
