<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_semester = $_POST['id_semester'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $aktif = $_POST['aktif'];
    $nama_dosen = $_POST['nama_dosen'];
    $matkul = $_POST['matkul'];

    // SQL to insert a new questionnaire entry
    $sql = "INSERT INTO kuisioner (id_semester, tgl_mulai, tgl_selesai, aktif, nama_dosen, matkul) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("isssss", $id_semester, $tgl_mulai, $tgl_selesai, $aktif, $nama_dosen, $matkul);

    if ($stmt->execute()) {
        header("Location: halaman-upm.php"); // Redirect to kuisioner.php after successful addition
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
    <title>SPKD - Tambah Kuisioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Kuisioner Penilaian Kinerja Dosen</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_semester" class="form-label">Semester</label>
                <select class="form-select" id="id_semester" name="id_semester" required>
                    <option value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
            </div>
            <div class="mb-3">
                <label for="matkul" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="matkul" name="matkul" required>
            </div>
            <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
            </div>
            <div class="mb-3">
                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Aktif</label>
                <div>
                    <input type="radio" id="aktif_yes" name="aktif" value="Y" required>
                    <label for="aktif_yes">Ya</label>
                    <input type="radio" id="aktif_no" name="aktif" value="N" required>
                    <label for="aktif_no">Tidak</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kuisioner</button>
            <a href="halaman-upm.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
