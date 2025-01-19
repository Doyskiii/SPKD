<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // SQL to update user
    $sql = "UPDATE users SET nama = ?, username = ?, role = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $username, $role, $id);

    if ($stmt->execute()) {
        header("Location: data-user.php"); // Redirect to data-user.php after successful update
        exit();
    } else {
        echo "Error updating user: " . $stmt->error;
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
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update User</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="Mahasiswa" <?php echo ($user['role'] == 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                    <option value="Dosen" <?php echo ($user['role'] == 'Dosen') ? 'selected' : ''; ?>>Dosen</option>
                    <option value="Rektor" <?php echo ($user['role'] == 'Rektor') ? 'selected' : ''; ?>>Rektor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</body>
</html>
