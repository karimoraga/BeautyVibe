<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require "conexion.php";
    
    $sql = "SELECT productos.*, categorias.nombre AS nombreCategoria FROM productos INNER JOIN categorias ON productos.categoria = categorias.id";
    $query = $mysqli->query($sql);
    $productos = array();
    while($resultado = $query->fetch_assoc()) {
        $productos[] = $resultado;
    }

    $sql = "SELECT * FROM categorias";
    $query = $mysqli->query($sql);
    $categorias = array();
    while($resultado = $query->fetch_assoc()) {
        $categorias[] = $resultado;
    }
    
    echo json_encode(["productos" => $productos, "categorias" => $categorias]);
?>