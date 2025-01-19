<?php
// Simulate form submission for registration
$data = [
    'form_type' => 'register',
    'nama' => 'Test User',
    'email' => 'testuser@example.com',
    'password' => 'password123',
    'confirm_password' => 'password123'
];

// Initialize cURL session
$ch = curl_init('http://localhost/spkd/backend/handle_form.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Execute the request
$response = curl_exec($ch);
curl_close($ch);

// Output the response
echo $response;
?>
