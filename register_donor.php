
<?php

session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check login session
    if (!isset($_COOKIE['blood_bank_session']) && !isset($_SESSION['loggedin'])) {
        header("Location: login.html?error=unauthorized");
        exit();
    }

    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $bloodGroup = trim($_POST['bloodGroup'] ?? '');
    $age = (int) ($_POST['age'] ?? 0);
    $phone = trim($_POST['phone'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if (empty($name) || empty($address) || empty($bloodGroup) ||
        empty($age) || empty($phone) || empty($date)) {

        header("Location: register_donor.html?error=missing_fields");
        exit();
    }

    $stmt = $conn->prepare(
        "INSERT INTO donors
        (name, address, blood_group, age, phone, donation_date)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssiss",
        $name,
        $address,
        $bloodGroup,
        $age,
        $phone,
        $date
    );

    if ($stmt->execute()) {

        $donor_id = $conn->insert_id;

        header("Location: register_donor.html?success=1&id=" . $donor_id);
        exit();

    } else {
        header("Location: register_donor.html?error=db_error");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: register_donor.html");
    exit();
}

?>
