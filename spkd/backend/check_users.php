<?php
include 'db_connection.php';

// SQL to select all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID User: " . $row["id_user"]. " - Name: " . $row["nama"]. " - Username: " . $row["username"]. " - Role: " . $row["role"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
