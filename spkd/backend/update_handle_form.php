<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];

        switch ($formType) {
            case 'register':
                // Handle user registration form submission
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];

                // Validate password confirmation
                if ($password !== $confirmPassword) {
                    echo "Passwords do not match.";
                    exit;
                }

                // Insert user data into the users table
                $sql = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                $stmt->bind_param("sss", $nama, $email, $hashedPassword);

                if ($stmt->execute()) {
                    echo "Registration successful!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
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
