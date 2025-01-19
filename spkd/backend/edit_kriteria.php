<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kriteria = $_POST['id'];
    $nama_kriteria = $_POST['kriteria'];
    $jenis = $_POST['jenis'];

    // SQL to update the criteria
    $sql = "UPDATE master_kriteria SET nama_kriteria = ?, jenis = ? WHERE id_kriteria = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssi", $nama_kriteria, $jenis, $id_kriteria);

    if ($stmt->execute()) {
        header("Location: kriteria.php"); // Redirect to kriteria.php after successful update
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Fetch existing criteria data
    $id_kriteria = $_GET['id'];
    $sql = "SELECT * FROM master_kriteria WHERE id_kriteria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_kriteria);
    $stmt->execute();
    $result = $stmt->get_result();
    $criteria = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKD - Edit Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Kriteria</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $criteria['id_kriteria']; ?>">
            <div class="mb-3">
                <label for="kriteria" class="form-label">Nama Kriteria</label>
                <input type="text" class="form-control" id="kriteria" name="kriteria" value="<?php echo $criteria['nama_kriteria']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option value="Mahasiswa" <?php echo ($criteria['jenis'] == 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                    <option value="Dosen" <?php echo ($criteria['jenis'] == 'Dosen') ? 'selected' : ''; ?>>Dosen</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Kriteria</button>
            <a href="kriteria.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
