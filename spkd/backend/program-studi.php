<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPKD - Data User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        .form-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .form-section h3 {
            margin: 0 0 1.5rem;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: border-color 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
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
                    <a class="nav-link" href="kriteria.html">Kriteria</a>
                    <a class="nav-link" href="sub-kriteria.html">Sub Kriteria</a>
                    <a class="nav-link" href="fakultas.php">Fakultas</a>
                    <a class="nav-link" href="program-studi.html">Program Studi</a>
                </div>
            </div>
            <a class="nav-link" href="halaman-penilaian.html">
                <i class="bi bi-clipboard-data"></i> Penilaian
            </a>
        </nav>
    </div>

    <?php include 'db_connection.php'; ?>
    <div class="content">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <h4 class="mb-0">Data Program Studi</h4>
                <div class="user-info ms-auto">
                    <a href="login.html" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </nav>

        <div class="form-section mt-4">
            <div class="d-flex justify-content-between mb-3">
                <div class="input-group" style="width: 250px;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search..." aria-label="Search" style="height: 38px;">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                </div>
                <a href="add_prodi.php" class="btn btn-primary">Add New Prodi</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="master_prodiTable">
                    <thead>
                        <tr class="text-center">
                            <th>ID Prodi</th>
                            <th>Program Studi</th>
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT mp.id_prodi, mp.nama_prodi, f.nama_fakultas 
                            FROM master_prodi mp 
                            JOIN fakultas f ON mp.id_fakultas = f.id_fakultas";
                    $result = $conn->query($sql);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='text-center'>
                                        <td>{$row['id_prodi']}</td>
                                        <td>{$row['nama_prodi']}</td>
                                        <td>{$row['nama_fakultas']}</td>
                                        <td>
                                            <a href='update_prodi.php?id={$row['id_prodi']}' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='delete_prodi.php?id={$row['id_prodi']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Error fetching user data</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }
        document.getElementById('searchInput').addEventListener('keyup', debounce(function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#master_prodiTable tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
            });
        }, 300));
    </script>
</body>
</html>
