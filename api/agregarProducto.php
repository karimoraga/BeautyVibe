<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require "conexion.php";

    $json = file_get_contents("php://input");
    
    $objProducto = json_decode($json);

    $sql = "INSERT INTO productos(id_producto, nombre_producto, precio, stock, categoria) VALUES('$objProducto->nombre', '$objProducto->descripcion', '$objProducto->precio', '$objProducto->stock', '$objProducto->categoria')";
    
    $query = $mysqli->query($sql);

    $jsonRespuesta = array('msg' => 'OK');
    echo json_encode($jsonRespuesta);
