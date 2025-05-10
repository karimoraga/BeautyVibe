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

    $sql = $mysqli->prepare("INSERT INTO usuarios (nombres, apellidos, email, telefono, direccion, psw, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssss",
      $objProducto->nombres,
      $objProducto->apellidos,
      $objProducto->email,
      $objProducto->telefono,
      $objProducto->direccion,
      $objProducto->password,
      $objProducto->tipo,
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
