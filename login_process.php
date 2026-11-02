<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id, email, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Password is correct, start a session
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_email'] = $admin['email'];
            
            // Set a cookie for the frontend JS to know we are logged in
            setcookie("blood_bank_session", "true", time() + 3600, "/");
            
            // Redirect to list page
            header("Location: list.html");
            exit;
        } else {
            // Invalid password
            header("Location: login.html?error=invalid_credentials");
            exit;
        }
    } else {
        // Invalid email
        header("Location: login.html?error=invalid_credentials");
        exit;
    }
} else {
    header("Location: login.html");
    exit;
}
?>
