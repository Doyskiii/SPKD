<?php
include 'db_connection.php';

$sql_kriteria = "SELECT nama_kriteria, nilai FROM master_kriteria"; // Adjusted to match the correct table and fields

$result_kriteria = $conn->query($sql_kriteria);
$kriteria_data = [];
if ($result_kriteria->num_rows > 0) {
    while($row = $result_kriteria->fetch_assoc()) {
        $kriteria_data[] = $row;
    }
} else {
    error_log("No kriteria data found.");
}

$sql_nilai = "
SELECT mk.nama_kriteria, hk.nilai 
FROM master_kriteria mk 
LEFT JOIN hasil_kuisioner hk ON mk.id_kriteria = hk.kode_subkriteria
"; // Adjusted to join the tables correctly

$result_nilai = $conn->query($sql_nilai);
$nilai_data = [];
if ($result_nilai->num_rows > 0) {
    while($row = $result_nilai->fetch_assoc()) {
        $nilai_data[] = $row;
    }
} else {
    error_log("No nilai data found.");
}

// Query for dosen names
$sql_dosen = "SELECT nama_depan, nama_belakang FROM master_dosen"; // Correct table name
$result_dosen = $conn->query($sql_dosen);
$dosen_data = [];
if ($result_dosen->num_rows > 0) {
    while($row = $result_dosen->fetch_assoc()) {
        $dosen_data[] = $row;
    }
} else {
    error_log("No dosen data found.");
}

// Log the fetched data for debugging
error_log("Kriteria Data: " . print_r($kriteria_data, true));
error_log("Nilai Data: " . print_r($nilai_data, true));
error_log("Dosen Data: " . print_r($dosen_data, true));

// Pass the data to kuisioner.php
include 'kuisioner.html'; // Ensure kuisioner.php is set up to receive this data
?>
