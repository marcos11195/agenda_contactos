<?php
require_once __DIR__ . "/includes/db.php";
$conn = conectarBD();

$id = intval($_GET["id"] ?? 0);
$response = ["success" => false];

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM contactos WHERE contacto_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $response["success"] = true;
    }
    $stmt->close();
}

$conn->close();
header("Content-Type: application/json");
echo json_encode($response);
exit;
