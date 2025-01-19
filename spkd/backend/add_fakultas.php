<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_fakultas = $_POST['fakultas'];

    // SQL to insert a new faculty
    $sql = "INSERT INTO fakultas (id_fakultas) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $nama_fakultas);

    if ($stmt->execute()) {
        header("Location: fakultas.php"); // Redirect to fakultas.html after successful addition
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
    <title>SPKD - Tambah Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Fakultas</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fakultas" class="form-label">Nama Fakultas</label>
                <input type="text" class="form-control" id="fakultas" name="fakultas" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Fakultas</button>
            <a href="fakultas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
