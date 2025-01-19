<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKD - Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #800020; /* Primary color */
            --secondary-color: #5e0b08; /* Secondary color */
            --background-color: #f8f9fa; /* Background color */
            --accent-color: #d7a29e;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--background-color);
            min-height: 100vh;
            display: flex;
            margin: 0;
        }

        .sidebar {
            width: 280px;
            background-color: white;
            padding: 1.5rem; /* Adjusted padding */
            border-right: 1px solid #e9ecef;
            height: 100vh;
            box-shadow: 2px 0 8px rgba(0,0,0,0.05);
        }

        .sidebar .header {
            padding: 1rem 0;
            margin-bottom: 1.5rem; /* Adjusted margin */
            border-bottom: 1px solid #e9ecef;
        }

        .sidebar .header img {
            width: 40px;
            height: 40px;
            margin-right: 0.75rem;
        }

        .main-content {
            flex-grow: 1;
            padding: 1.5rem; /* Adjust width to fill the remaining space */
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem; /* Adjusted padding */
            margin: 0.25rem 0;
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(128, 0, 32, 0.05);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background-color: rgba(128, 0, 32, 0.1);
            font-weight: 500;
        }

        .sidebar .nav-link i {
            width: 24px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="assets/logo.png" alt="Logo SPKD" width="50">
            <h4 class="mt-2">SPKD</h4>
            <small>Sistem Penilaian Kinerja Dosen</small>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link active" href="profil-upm.html">
                <i class="bi bi-person-circle"></i> Profil
            </a>
            <a class="nav-link" href="halaman-upm.php">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link" href="data-user.php">
                <i class="bi bi-people"></i> User
            </a>
            <a class="nav-link" data-bs-toggle="collapse" href="#dataMaster" role="button" aria-expanded="false" aria-controls="dataMaster">
                <i class="bi bi-file-earmark-text me-2"></i>Data Master
            </a>
            <div class="collapse" id="dataMaster">
                <div class="nav flex-column ms-3">
                    <a class="nav-link" href="kriteria.php">Kriteria</a>
                    <a class="nav-link" href="sub-kriteria.php">Sub Kriteria</a>
                    <a class="nav-link" href="fakultas.php">Fakultas</a>
                    <a class="nav-link" href="program-studi.php">Program Studi</a>
                </div>
            </div>
            <a class="nav-link" href="halaman-penilaian.html">
                <i class="bi bi-clipboard-data"></i> Penilaian
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="form-group">
                    <h4 class="mb-0">Kriteria</h4>
                </div>
                <div>
                    <a href="logout.php" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="container-fluid mt-4">
            <div class="input-group mb-3" style="float: right; width: 250px;">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" style="height: 38px;">
                <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
            <a href="add_kriteria.php" class="btn btn-primary">Add New Kriteria</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch existing criteria from the database
                    $sql = "SELECT * FROM master_kriteria"; // Adjust the query as needed
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id_kriteria']}</td>
                                    <td>{$row['nama_kriteria']}</td>
                                    <td>{$row['jenis']}</td>
                                    <td class='actions'>
                                        <a href='edit_kriteria.php?id={$row['id_kriteria']}' class='btn btn-warning'>Edit</a>
                                        <form action='delete_kriteria.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id_kriteria']}'>
                                            <button type='submit' class='btn btn-danger'>Hapus</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
