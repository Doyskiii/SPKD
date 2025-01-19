<?php
include 'db_connection.php';

// Fetch data from kuisioner table
$sql = "SELECT * FROM kuisioner";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKD - Kuisioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #800020;
            --secondary-color: #5e0b08;
            --accent-color: #d7a29e;
            --background-color: #f8f9fa;
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
            padding: 1.5rem;
            border-right: 1px solid #e9ecef;
            height: 100vh;
            box-shadow: 2px 0 8px rgba(0,0,0,0.05);
        }
        
        .sidebar .header {
            padding: 1rem 0;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .sidebar .header img {
            width: 40px;
            height: 40px;
            margin-right: 0.75rem;
        }
        
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
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
        
        .content {
            flex-grow: 1;
            padding: 1.5rem;
        }
        
        .navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 1rem;
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
        }
        
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .navbar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .table-wrapper {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .table-wrapper h2 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-4">
        <img src="assets/logo.png" alt="Logo SPKD" width="50">
        <h4 class="mt-2">SPKD</h4>
        <small>Sistem Penilaian Kinerja Dosen</small>
    </div>
    
    <nav class="nav flex-column">
        <a class="nav-link active" href="dashboard-mahasiswa.html">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link" href="profil-mahasiswa.html">
            <i class="bi bi-person-circle"></i> Profil
        </a>
        <a class="nav-link" href="kuisioner.php">
            <i class="bi bi-clipboard-data"></i> Kuisioner
        </a>
    </nav>
</div>

<div class="content">
    <div class="navbar">
        <div class="user-info">
            <span class="fw-bold">Mahasiswa</span>
            <img src="assets/admin.jpg" alt="User Photo">
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <h2>Daftar Kuisioner</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Kuisioner</th>
                    <th>Semester</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aktif</th>
                    <th>Nama Dosen</th>
                    <th>Nama Mata Kuliah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_kuisioner']}</td>
                                <td>{$row['id_semester']}</td>
                                <td>{$row['tgl_mulai']}</td>
                                <td>{$row['tgl_selesai']}</td>
                                <td>{$row['aktif']}</td>
                                <td>{$row['nama_dosen']}</td>
                                <td>{$row['matkul']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data kuisioner.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
