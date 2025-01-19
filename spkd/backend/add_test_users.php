<?php
include 'db_connection.php';

// SQL to insert test users
$sql = "INSERT INTO users (nama, username, role) VALUES 
        ('Test User 1', 'testuser1', 'admin'),
        ('Test User 2', 'testuser2', 'user')";

if ($conn->query($sql) === TRUE) {
    echo "Test users added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
