<?php
session_start();
include 'db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'Admin') {
                header('Location: halaman-upm.php');
            } elseif ($user['role'] === 'Mahasiswa') {
                header('Location: dashboard-mahasiswa.html');
            } elseif ($user['role'] === 'Dosen') {
                header('Location: dashboard-dosen.html');
            } elseif ($user['role'] === 'Rektor') {
                header('Location: dashboard-rektor.html');
            } else {
                header('Location: dashboard.php'); // Fallback for other roles
            }
            exit();
        } else {
            // Password is incorrect
            header("Location: /spkd/index.html?error=wrong_password");
            exit();
        }
    } else {
        // Username does not exist
        header("Location: /spkd/index.html?error=user_not_found");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login SPKD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php 
                        if ($_GET['error'] === 'wrong_password') {
                            echo "Password salah.";
                        } elseif ($_GET['error'] === 'user_not_found') {
                            echo "Username tidak ditemukan.";
                        } else {
                            echo "Username atau password salah.";
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['registration']) && $_GET['registration'] === 'success'): ?>
                    <div class="alert alert-success">User berhasil dibuat!</div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
