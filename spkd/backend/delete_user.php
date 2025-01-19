<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete user
    $sql = "DELETE FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: data-user.php"); // Redirect to data-user.php after successful deletion
        exit();
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
