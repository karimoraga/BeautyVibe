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
    <title>GESTION DE PRODUCTOS</title>
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
                <input type="text" id="nombre" placeholder="Ingresa nombre producto">
                <input type="text" id="marca" placeholder="Ingresa marca producto">
                <input type="text" id="descripcion" placeholder="Ingresa descripcion producto">
                <input type="number" id="precio" placeholder="Ingresa precio producto">
                <input type="number" id="stock" placeholder="Ingresa stock actual del producto">
                <label for="categoria">Categoría:<select id="categoria"></select></label>
                <label for="img">Imagen:<input type="file" id="img" placeholder="Ingresa imagen"></label>
                <button type="submit" id="btnAgregar">Agregar</button>
            </form>
        </div>
        <div class="div-listado">
            <h2>Listado Productos</h2>
            <div class="div-productos">
                
            </div>
        </div>
    </div>

    <script src="./crudProductos.js"></script>
</body>
</html>