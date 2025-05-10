  <?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
   ?>
  <div class="top">
    <img src="imgs/header.png">
    <?php 
    $logged = false;
    $admin = false;
    if(isset($_SESSION["idUsuario"])) {
      echo '<br><small style="color:rgb(255, 144, 181)">Estás logeado como:<b> <em>' . $_SESSION["username"] . '</em></b></small>';
      $logged = true;
    }
    ?>
    <div class="navbar">
      <a href=home.php>Home</a> ❤
      <a href=productos.php>Productos</a> ❤
    <?php if($logged) { ?>
      <a href=wishlist.php>Wishlist</a> ❤
      <a href=carrito.php>Carrito</a> ❤
      <a href=perfil.php>Perfil</a> ❤
      <?php if($_SESSION["admin"]) { ?>
        <a href=admin.php>Panel de Administración</a> ❤
      <?php } ?>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="registro.php">Registro</a> ❤
      <a href="login.php">Login</a>
    <?php } ?>
    </div>
  </div>