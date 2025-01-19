<?php
include 'db_connection.php';

// SQL to select all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>List of Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_user']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['role']}</td>
                                <td>
                                    <a href='update_user.php?id={$row['id_user']}' class='btn btn-warning'>Edit</a>
                                    <a href='delete_user.php?id={$row['id_user']}' class='btn btn-danger'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="create_user.php" class="btn btn-primary">Add New User</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
