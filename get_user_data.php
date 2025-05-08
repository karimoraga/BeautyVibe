<?php
session_start();  // Iniciar sesión para obtener datos del usuario

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

require 'config/db.php';  // Incluir la conexión a la base de datos

$userId = $_SESSION['username'];  // Obtener el nombre de usuario desde la sesión

// Consultar los datos del usuario
$sqlUser = "SELECT nombre, correo, direccion FROM usuarios WHERE username = ?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("s", $userId);  // Usamos 's' porque el username es una cadena
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

// Consultar el historial de pedidos
$sqlPedidos = "SELECT id_pedido, fecha, total, estado FROM pedidos WHERE id_usuario = (SELECT id FROM usuarios WHERE username = ?) ORDER BY fecha DESC";
$stmtPedidos = $conn->prepare($sqlPedidos);
$stmtPedidos->bind_param("s", $userId);
$stmtPedidos->execute();
$resultPedidos = $stmtPedidos->get_result();

// Organizar los datos
$pedidos = [];
while($pedido = $resultPedidos->fetch_assoc()) {
    $pedidos[] = $pedido;
}

// Responder con los datos en formato JSON
echo json_encode([
    'nombre' => $user['nombre'],
    'correo' => $user['correo'],
    'direccion' => $user['direccion'],
    'historialPedidos' => $pedidos
]);
?>
