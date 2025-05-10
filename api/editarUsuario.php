<?php

    $error = "";

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require "conexion.php";
    require "img.php";

    $json = file_get_contents("php://input");

    $objUsuario = json_decode($json);
    
    if($objUsuario->password != "") {
      // Hay una password, actualizarla
      $sql = "UPDATE usuarios SET nombres='$objUsuario->nombres', apellidos='$objUsuario->apellidos', email = '$objUsuario->email', direccion='$objUsuario->direccion', telefono='$objUsuario->telefono', tipo='$objUsuario->tipo', psw='$objUsuario->password' WHERE idUsuario='$objUsuario->idUsuario'";
    } else {
      $sql = "UPDATE usuarios SET nombres='$objUsuario->nombres', apellidos='$objUsuario->apellidos', email = '$objUsuario->email', direccion='$objUsuario->direccion', telefono='$objUsuario->telefono', tipo='$objUsuario->tipo' WHERE idUsuario='$objUsuario->idUsuario'";
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