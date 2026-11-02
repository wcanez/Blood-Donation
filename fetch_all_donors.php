
<?php
require_once 'db.php';

header('Content-Type: application/json');

$query = "SELECT * FROM donors ORDER BY created_at DESC";
$result = $conn->query($query);

$donors = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}

echo json_encode($donors);

$conn->close();
?>
