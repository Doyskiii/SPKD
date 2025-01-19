<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_fakultas'])) {
    $id_fakultas = $_GET['id_fakultas'];
    if (empty($id_fakultas)) {
        echo "No faculty ID provided.";
        exit();
    }
    $sql = "SELECT * FROM fakultas WHERE id_fakultas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_fakultas);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No faculty found.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_fakultas = $_POST['id_fakultas'];
    $nama_fakultas = $_POST['nama_fakultas'];

    $sql = "UPDATE fakultas SET nama_fakultas = ? WHERE id_fakultas = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nama_fakultas, $id_fakultas);

    if ($stmt->execute()) {
        header("Location: fakultas.php");
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
    <title>Update Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Fakultas</h2>
        <form method="POST" action="">
            <input type="hidden" name="id_fakultas" value="<?php echo $row['id_fakultas']; ?>">
            <div class="mb-3">
                <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" value="<?php echo $row['nama_fakultas']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
