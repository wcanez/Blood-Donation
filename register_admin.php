<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT id FROM admins WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        // Email already registered
        header("Location: login.html?error=email_exists");
        exit;
    }
    $check_stmt->close();
    
    // Insert new admin
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    
    if ($stmt->execute()) {
        header("Location: login.html?success=registered");
    } else {
        header("Location: login.html?error=registration_failed");
    }
    
    $stmt->close();
    $conn->close();
    exit;
} else {
    header("Location: login.html");
    exit;
}
?>
