<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];

        switch ($formType) {
            case 'profil_kaprodi':
                // Handle Profil Kaprodi form submission
                $nama_depan = $_POST['nama'];
                $nama_belakang = $_POST['nama_belakang'];
                $tgl_lahir = $_POST['tanggal-lahir'];
                $jk = $_POST['jenis_kelamin'];
                $alamat = $_POST['alamat'];
                $no_telp = $_POST['no_telp'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $query = "INSERT INTO profil_kaprodi (nama_depan, nama_belakang , tanggal_lahir, jenis_kelamin, alamat, no_telp, email, password) VALUES    
                ('".$nama_depan."', '".$nama_belakang."', '".$tgl_lahir."', '".$jk."', '".$alamat."', '".$no_telp."', '".$email."', '".$password."')";
                $kontak = $_POST['kontak'];

                // Insert or update logic for Profil Kaprodi
                $sql = "INSERT INTO profil_kaprodi (nama, tanggal_lahir, jenis_kelamin, alamat, kontak) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $nama_depan, $nama_belakang, $tgl_lahir, $jk, $email, $alamat, $kontak);
                $stmt->execute();
                $stmt->close();
                break;

case 'profil_upm':
    // Handle Profil UPM form submission
    $nama_depan = $_POST['nama'];
    $nama_belakang = $_POST['nama_belakang']; // Assuming this field is added to the form
    $tanggalLahir = $_POST['tanggal-lahir'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $kontak = $_POST['kontak'];
    $password = $_POST['password']; // Assuming this field is added to the form

    // Insert or update logic for tb_profil
    $sql = "INSERT INTO tb_profil (nama_depan, nama_belakang, tanggal_lahir, jenis_kelamin, alamat, email, kontak, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            tanggal_lahir = ?, jenis_kelamin = ?, alamat = ?, email = ?, kontak = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $nama_depan, $nama_belakang, $tanggalLahir, $jenisKelamin, $alamat, $email, $kontak, $password, $tanggalLahir, $jenisKelamin, $alamat, $email, $kontak);
    $stmt->execute();
    $stmt->close();

                break;

            case 'profil_dosen':
                // Handle Profil Dosen form submission
                // Similar logic as above for Profil Dosen
                break;

            case 'register':
                // Handle user registration form submission
                $nama = $_POST['nama'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                // Insert user data into the users table
                $sql = "INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                $stmt->bind_param("ssss", $nama, $username, $hashedPassword, $role);
                $stmt->execute();
                $stmt->close();

                // Redirect to login page with success message
                header("Location: ../index.html?registration=success");
                exit();
                break;

            case 'kuisioner':
                // Handle Kuisioner form submission
                $title = $_POST['title'];
                $description = $_POST['description'];

                // Validate input data
                if (!empty($title) && !empty($description)) {
                    // Prepare SQL statement to insert data into the kuisioner table
                    $sql = "INSERT INTO kuisioner (title, description) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $title, $description);

                    if ($stmt->execute()) {
                        echo "Kuisioner berhasil ditambahkan!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Semua field harus diisi!";
                }
                break;

            default:
                echo "Unknown form type.";
                break;
        }
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
