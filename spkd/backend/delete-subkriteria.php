<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_subkriteria = $_POST['id'];

    // SQL to delete the sub-criteria
    $sql = "DELETE FROM master_subkriteria WHERE id_subkriteria = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id_subkriteria);

    if ($stmt->execute()) {
        header("Location: sub-kriteria.php"); // Redirect to sub-kriteria.php after successful deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
