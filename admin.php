<?php
  /* Aqui chequeamos si está logeado y si es admin */
  session_start();
  if(!isset($_SESSION["idUsuario"]) || !$_SESSION["admin"]) {
    header("Location: home.php");
    die();
  }
?>
  <?php include "includes/header.php"; ?>
  <?php include "includes/navbar.php"; ?>
</div>
<div class="box">
  <h1>Bienvenido al panel de Administracion</h1>
  <p>Acá podrá acceder al menú para administrar los productos y usuarios</p>
  <hr>
  <p><a href="CrudProductos.html" class="registerbtn">Administración de Productos</a></p>
  <hr>
  <p><a href="CrudUsuarios.html" class="registerbtn">Administración de Usuarios</a></p>
</div>
<?php include "includes/footer.php"; ?>