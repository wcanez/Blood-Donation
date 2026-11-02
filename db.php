<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blood_donation_db";

// Connect to MySQL server
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql_db = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql_db);

// Select the database
$conn->select_db($dbname);

// Create admins table if not exists
$sql_admins = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
)";
$conn->query($sql_admins);

// Create donors table if not exists
$sql_donors = "CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    address TEXT NOT NULL,
    blood_group VARCHAR(10) NOT NULL,
    age INT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    donation_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql_donors);

?>
