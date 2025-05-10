<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['idUsuario'])) {
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit();
}

require 'conexion.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombres'];
$correo = $data['email'];
$direccion = $data['direccion'];
$idUsuario = $_SESSION['idUsuario'];

$sql = "UPDATE usuarios SET nombres = ?, email = ?, direccion = ? WHERE idUsuario = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss", $nombre, $correo, $direccion, $idUsuario);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
