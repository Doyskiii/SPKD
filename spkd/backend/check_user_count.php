<?php
include 'db_connection.php';

// SQL to count users
$sql = "SELECT COUNT(*) as user_count FROM users";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

$row = $result->fetch_assoc();

echo "Total users in the database: " . $row['user_count'];

$conn->close();
?>
