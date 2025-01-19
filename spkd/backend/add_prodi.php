<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_prodi = $_POST['nama_prodi'];
    $fakultas_id = $_POST['id_fakultas'];

    $sql = "INSERT INTO master_prodi (nama_prodi, id_fakultas) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nama_prodi, $fakultas_id);

    if ($stmt->execute()) {
        header("Location: program-studi.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Program Studi</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
            </div>
            <div class="mb-3">
                <label for="id_fakultas" class="form-label">Fakultas</label>
                <select class="form-select" id="id_fakultas" name="id_fakultas" required>
                    <option value="">Pilih Fakultas</option>
                    <?php
                    $sql = "SELECT * FROM fakultas";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($fakultas = $result->fetch_assoc()) {
                            echo "<option value='{$fakultas['id_fakultas']}'>{$fakultas['nama_fakultas']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
