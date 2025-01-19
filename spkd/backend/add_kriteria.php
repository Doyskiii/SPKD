<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kriteria = $_POST['kriteria'];
    $jenis = $_POST['jenis'];

    // SQL to insert a new criteria
    $sql = "INSERT INTO master_kriteria (nama_kriteria, jenis) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $nama_kriteria, $jenis);

    if ($stmt->execute()) {
        header("Location: kriteria.php"); // Redirect to kriteria.php after successful addition
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
    <title>SPKD - Tambah Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Kriteria</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kriteria" class="form-label">Nama Kriteria</label>
                <input type="text" class="form-control" id="kriteria" name="kriteria" required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
            <a href="kriteria.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
