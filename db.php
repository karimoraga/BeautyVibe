<?php
header("Content-Type: application/json"); // Para devolver respuestas en JSON
header("Access-Control-Allow-Origin: *"); // Permitir acceso desde cualquier origen
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$dbname = "egesven";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Obtener productos en el carrito
    if (isset($_GET['usuario_cliente'])) {
        $usuario_cliente = $_GET['usuario_cliente'];
        $sql = "SELECT c.id_carrito, p.nombre_producto, p.precio_producto, c.cantidad 
                FROM Carrito c 
                JOIN Productos p ON c.id_producto = p.id_producto 
                WHERE c.usuario_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        $stmt->close();
    } else {
        echo json_encode(["error" => "Falta el parámetro 'usuario_cliente'"]);
    }
} elseif ($method === 'PUT') {
    // Actualizar cantidad de un producto en el carrito
    $input = json_decode(file_get_contents('php://input'), true);
    $id_carrito = $input['id_carrito'];
    $cantidad = $input['cantidad'];

    $sql = "UPDATE Carrito SET cantidad = ? WHERE id_carrito = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad, $id_carrito);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
    $stmt->close();
} elseif ($method === 'DELETE') {
    // Eliminar producto del carrito
    if (isset($_GET['id_carrito'])) {
        $id_carrito = $_GET['id_carrito'];

        $sql = "DELETE FROM Carrito WHERE id_carrito = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => $conn->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Falta el parámetro 'id_carrito'"]);
    }
}

$conn->close();
?>
