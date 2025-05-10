<?php
session_start();
header('Content-Type: application/json');

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

require 'conexion.php'; // Asegúrate de que este archivo existe y se conecta bien

$username = $_SESSION['username'];

// Verificar conexión
if (!$mysqli) {
    echo json_encode(['error' => 'Error en la conexión a la base de datos']);
    exit();
}

// 1. Obtener datos personales
$sqlUser = "SELECT idUsuario, nombres, email, direccion FROM usuarios WHERE username = ?";
$stmtUser = $mysqli->prepare($sqlUser);
$stmtUser->bind_param("s", $username);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

// Si no se encuentra el usuario
if (!$user) {
    echo json_encode(['error' => 'Usuario no encontrado']);
    exit();
}

$idUsuario = $user['idUsuario'];

// 2. Obtener historial de pedidos
$sqlPedidos = "SELECT idPedido, fecha, total, estado FROM pedidos WHERE idUsuario = ? ORDER BY fecha DESC";
$stmtPedidos = $mysqli->prepare($sqlPedidos);
$stmtPedidos->bind_param("i", $idUsuario);
$stmtPedidos->execute();
$resultPedidos = $stmtPedidos->get_result();

$pedidos = [];
while($row = $resultPedidos->fetch_assoc()) {
    $pedidos[] = $row;
}

// 3. Enviar respuesta como JSON
echo json_encode([
    'nombre' => $user['nombres'] ?? '',
    'correo' => $user['email'] ?? '',
    'direccion' => $user['direccion'] ?? '',
    'historialPedidos' => $pedidos
]);
?>
