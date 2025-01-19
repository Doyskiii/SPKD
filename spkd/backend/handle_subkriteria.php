<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $kode = $_POST['kode'];
    $subkriteria = $_POST['subkriteria'];
    $jenis = $_POST['jenis'];

    // Insert logic for Sub Kriteria
    $sql = "INSERT INTO sub_kriteria (kode, subkriteria, jenis) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $kode, $subkriteria, $jenis);
    $stmt->execute();
    $stmt->close();

    // Redirect or display success message
    header("Location: sub-kriteria.html?success=1");
    exit();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
