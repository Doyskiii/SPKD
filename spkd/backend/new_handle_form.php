<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $kriteria = $_POST['kriteria'];
    $jenis = $_POST['jenis'];

    // Validate input
    if (!empty($kriteria) && !empty($jenis)) {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO master_kriteria (nama_kriteria, jenis) VALUES (?, ?)");
        $stmt->bind_param("ss", $kriteria, $jenis);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Kriteria dan jenis tidak boleh kosong.";
    }
}

// Close the database connection
$conn->close();
?>
