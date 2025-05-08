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
    
    if($objProducto->img != "") {
      // Hay una imagen, actualizarla
      $filename = manejarImagen($objProducto->img);
      if(!$filename) $error = "Problema al subir imagen.";

      $sql = "UPDATE productos SET nombre='$objProducto->nombre', descripcion = '$objProducto->descripcion', precio='$objProducto->precio', stock='$objProducto->stock', categoria='$objProducto->categoria', img='$filename' WHERE idProducto='$objProducto->idProducto'";        
    } else {
      $sql = "UPDATE productos SET nombre='$objProducto->nombre', descripcion = '$objProducto->descripcion', precio='$objProducto->precio', stock='$objProducto->stock', categoria='$objProducto->categoria'  WHERE idProducto='$objProducto->idProducto'";
    }
    
    $query = $mysqli->query($sql);

    if($error != "") {
      $jsonRespuesta = array('msg' => 'Error', 'detalle' => $error);
    } else if($mysqli->error != "") {
      $jsonRespuesta = array('msg' => 'Error', 'detalle' => $mysqli->error);
    } else {
      $jsonRespuesta = array('msg' => 'OK', 'detalle' => "");
    }
    
    echo json_encode($jsonRespuesta);

?>