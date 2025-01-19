<?php
include 'db_connection.php';

// Fetch master dosen data
$master_dosen = fetch_master_dosen(); // Assuming this function exists

// Fetch master kriteria data
$kriteria_data = fetch_master_kriteria(); // Assuming this function exists

// Check if data is fetched successfully
if ($master_dosen && $kriteria_data) {
    echo "<h2>Data Dosen</h2>";
    if (count($master_dosen) > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Nama Dosen</th></tr></thead><tbody>";
        foreach ($master_dosen as $dosen) {
            echo "<tr><td>{$master_dosen['id']}</td><td>{$master_dosen['nama_depan']} {$master_dosen['nama_belakang']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Tidak ada data dosen.</p>";
    }

    echo "<h2>Data Kriteria</h2>";
    if (count($kriteria_data) > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Nama Kriteria</th></tr></thead><tbody>";
        foreach ($kriteria_data as $kriteria) {
            echo "<tr><td>{$kriteria['id']}</td><td>{$kriteria['nama_kriteria']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Tidak ada data kriteria.</p>";
    }
} else {
    echo "<p>Gagal mengambil data dari database.</p>";
}
?>
