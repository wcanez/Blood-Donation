<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST['donor_id'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $blood_group = $_POST['bloodGroup'] ?? '';
    $age = $_POST['age'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $donation_date = $_POST['date'] ?? '';

    if (
        empty($id) || empty($name) || empty($address) ||
        empty($blood_group) || empty($age) ||
        empty($phone) || empty($donation_date)
    ) {
        die("Please fill in all fields.");
    }

    $stmt = $conn->prepare(
        "UPDATE donors SET
            name = ?,
            address = ?,
            blood_group = ?,
            age = ?,
            phone = ?,
            donation_date = ?
         WHERE id = ?"
    );

    $stmt->bind_param(
        "sssissi",
        $name,
        $address,
        $blood_group,
        $age,
        $phone,
        $donation_date,
        $id
    );

   if ($stmt->execute()) {

    header("Location: register_donor.html?updated=1&id=" . $id);
    exit();

    } else {
     echo "Update failed: " . $stmt->error;
   }

    $stmt->close();
    $conn->close();
}
?>