<?php
include 'db_connection.php';

$sql = "SHOW TABLES LIKE 'master_dosen'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "The 'master_dosen' table exists.<br>";


    // Get the structure of the master_dosen table
    $sql = "DESCRIBE master_dosen";

    $result = $conn->query($sql);

    if ($result) {
        echo "Structure of 'users' table:<br>";
        while ($row = $result->fetch_assoc()) {
            echo "Field: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
        }
    } else {
        echo "Error fetching table structure: " . $conn->error;
    }
} else {
    echo "The 'users' table does not exist.";
}

$conn->close();
?>
