<?php
    $error = "";

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require "conexion.php";
    require "img.php";

    $json = file_get_contents("php://input");
    $objProducto = json_decode($json);
    
    $filename = manejarImagen($objProducto->img);
    if(!$filename) $error = "Problema al subir imagen.";

    $sql = $mysqli->prepare("INSERT INTO productos (nombre, marca, descripcion, precio, stock, categoria, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssiiss",
      $objProducto->nombre,
      $objProducto->marca,
      $objProducto->descripcion,
      $objProducto->precio,
      $objProducto->stock,
      $objProducto->categoria,
      $filename
    );
    
    $sql->execute();

    if($error != "") {
      $jsonRespuesta = array('msg' => 'Error', 'detalle' => $error);
    } else if($mysqli->error != "") {
      $jsonRespuesta = array('msg' => 'Error', 'detalle' => $mysqli->error);
    } else {
      $jsonRespuesta = array('msg' => 'OK', 'detalle' => "");
    }

    echo json_encode($jsonRespuesta);
