<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kriteria = $_POST['id'];

    // SQL to delete the criteria
    $sql = "DELETE FROM master_kriteria WHERE id_kriteria = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id_kriteria);

    if ($stmt->execute()) {
        header("Location: kriteria.php"); // Redirect to kriteria.php after successful deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
