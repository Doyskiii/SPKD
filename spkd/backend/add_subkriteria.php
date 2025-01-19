<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_subkriteria = $_POST['kode_subkriteria'];
    $nama_subkriteria = $_POST['nama_subkriteria'];
    $bobot = $_POST['bobot'];
    $id_kriteria = $_POST['id_kriteria'];

    // SQL to insert a new sub-criteria
    $sql = "INSERT INTO master_subkriteria (kode_subkriteria, nama_subkriteria, bobot, id_kriteria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssdi", $kode_subkriteria, $nama_subkriteria, $bobot, $id_kriteria);

    if ($stmt->execute()) {
        header("Location: sub-kriteria.php"); // Redirect to sub-kriteria.php after successful addition
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKD - Tambah Sub-Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Sub-Kriteria</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kode_subkriteria" class="form-label">Kode Sub-Kriteria</label>
                <input type="text" class="form-control" id="kode_subkriteria" name="kode_subkriteria" required>
            </div>
            <div class="mb-3">
                <label for="nama_subkriteria" class="form-label">Nama Sub-Kriteria</label>
                <input type="text" class="form-control" id="nama_subkriteria" name="nama_subkriteria" required>
            </div>
            <div class="mb-3">
                <label for="bobot" class="form-label">Bobot</label>
                <input type="number" class="form-control" id="bobot" name="bobot" required>
            </div>
            <div class="mb-3">
                <label for="id_kriteria" class="form-label">ID Kriteria</label>
                <input type="number" class="form-control" id="id_kriteria" name="id_kriteria" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Sub-Kriteria</button>
            <a href="sub-kriteria.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
