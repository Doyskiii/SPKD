<?php
include 'db_connection.php';

// Fetch the profile data
$sql = "SELECT * FROM profil_upm"; // Adjust the query as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<h2>Profil UPM</h2>";
        echo "<p><strong>Nama:</strong> " . $row["nama"] . "</p>";
        echo "<p><strong>Tanggal Lahir:</strong> " . $row["tanggal_lahir"] . "</p>";
        echo "<p><strong>Jenis Kelamin:</strong> " . $row["jenis_kelamin"] . "</p>";
        echo "<p><strong>Alamat:</strong> " . $row["alamat"] . "</p>";
        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
        echo "<p><strong>Kontak:</strong> " . $row["kontak"] . "</p>";
    }
} else {
    echo "No profile data found.";
}

$conn->close();
?>
