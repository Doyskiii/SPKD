<?php
include 'db_connection.php';

if (isset($_GET['id_fakultas'])) {
    $id_fakultas = $_GET['id_fakultas'];

    // SQL to delete the faculty
    $sql = "DELETE FROM fakultas WHERE id_fakultas = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id_fakultas);

    if ($stmt->execute()) {
        header("Location: fakultas.php"); // Redirect to fakultas.php after successful deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
