<?php
  /* Aqui chequeamos si está logeado y si es admin */
  session_start();
  if(!isset($_SESSION["idUsuario"]) || !$_SESSION["admin"]) {
    header("Location: home.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>GESTION DE USUARIOS</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/crud.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
</head>
<body>
  <div class="navbar">
    ❤ <a href="admin.php">Volver</a> ❤
  </div>
    <div class="contenedor">
        <div class="div-formulario">
            <h2>Formulario</h2>

            <form action="#" id="formulario">
                <input type="text" id="nombres" placeholder="Ingresa nombres">
                <input type="text" id="apellidos" placeholder="Ingresa apellidos">
                <input type="text" id="email" placeholder="Ingresa e-mail">
                <input type="text" id="telefono" placeholder="Ingresa teléfono">
                <input type="text" id="direccion" placeholder="Ingresa dirección">
                <input type="password" id="password" placeholder="Ingresa nueva password">
                <label for="img">Es admin:<input type="checkbox" id="admin"></label>
                <button type="submit" id="btnAgregar">Crear</button>
            </form>
        </div>
        <div class="div-listado">
            <h2>Listado Usuarios</h2>
            <div class="div-productos">
                
            </div>
        </div>
    </div>
    <script src="./crudUsuarios.js"></script>
</body>
</html>