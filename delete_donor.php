<?php
session_start();
require_once 'db.php';

// Check auth
if (!isset($_COOKIE['blood_bank_session']) && !isset($_SESSION['loggedin'])) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = isset($data['id']) ? (int)$data['id'] : 0;
    
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "DB Error"]);
        }
        $stmt->close();
    }
}
$conn->close();
?>
