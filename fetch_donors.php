<?php
require_once 'db.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? '';

if (empty($id) || !ctype_digit($id)) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

$donors = [];

while ($row = $result->fetch_assoc()) {
    $donors[] = $row;
}

echo json_encode($donors);

$stmt->close();
?>