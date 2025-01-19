<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_prodi'])) {
    $id_prodi = $_GET['id_prodi'];
    $sql = "SELECT * FROM master_prodi WHERE id_prodi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_prodi);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No program found.";
        exit();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_prodi = $_POST['id_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    $id_fakultas = $_POST['id_fakultas'];

    // Check for duplicate program name
    $check_sql = "SELECT * FROM master_prodi WHERE nama_prodi = ? AND id_prodi != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $nama_prodi, $id_prodi);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "Error: Program name already exists.";
    } else {
        $sql = "UPDATE master_prodi SET nama_prodi = ?, id_fakultas = ? WHERE id_prodi = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $nama_prodi, $id_fakultas, $id_prodi);

        if ($stmt->execute()) {
            header("Location: program-studi.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $check_stmt->close();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Program Studi</h2>
        <form method="POST" action="">
            <input type="hidden" name="id_prodi" value="<?php echo $row['id_prodi']; ?>">
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?php echo $row['nama_prodi']; ?>" required>
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
                            $selected = ($fakultas['id_fakultas'] == $row['id_fakultas']) ? 'selected' : '';
                            echo "<option value='{$fakultas['id_fakultas']}' {$selected}>{$fakultas['nama_fakultas']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
