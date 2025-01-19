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
    <title>SPKD - Hasil Kuisioner</title>
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
        
        .questionnaire-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .questionnaire-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .questionnaire-header h3 {
            margin: 0;
            color: var(--primary-color);
        }
        
        .questionnaire-list {
            display: grid;
            gap: 1rem;
        }
        
        .questionnaire-item {
            background-color: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.2s ease;
        }
        
        .questionnaire-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .questionnaire-item h4 {
            margin: 0;
            color: var(--primary-color);
        }
        
        .questionnaire-item p {
            margin: 0.25rem 0 0;
            color: #6c757d;
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
    <div class="content">
        <div class="navbar">
            <div class="user-info">
                <span class="fw-bold">Admin</span>
                <img src="assets/admin.jpg" alt="User Photo">
                <a href="logout.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>

        <div class="questionnaire-section">
            <div class="questionnaire-header">
                <h3>Daftar Kuisioner</h3>
                <button class="btn" onclick="window.location.href='add_kuisioner.php'">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Kuisioner
                </button>
            </div>
            <div class="questionnaire-list">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='questionnaire-item'>
                                <h4>{$row['id_kuisioner']} (aktif)</h4>
                                <p>Periode: {$row['tgl_mulai']} s.d. {$row['tgl_selesai']}</p>
                              </div>";
                    }
                } else {
                    echo "<p>Tidak ada data kuisioner.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
