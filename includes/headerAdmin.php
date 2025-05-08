<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beauty❤Vibe</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico"> 
</head>
<div class=headerbb>
        <img src="imgs/header.png" style="width:50%">
    </div>

  <?php session_start(); ?>
  <div class="top">
    <?php 
    $logged = false;
    if(isset($_SESSION["username"])) {
      echo '<br><small style="color:rgb(255, 142, 180)">Estás logeado como:<b> <em>' . $_SESSION["username"] . '</em></b></small>';
      $logged = true;
    }
    ?>
    <small></small>
    <div class="navbar">
      <a href=perfil.php>Perfil</a> ❤
      <a href=home.php>Home</a> ❤
      <a href=productos.php>Productos</a> ❤
      <a href=crudproductos.html>Panel de Administración</a> ❤
    <?php if($logged) { ?>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="registroadm.php">Registro</a> ❤
      <a href="loginadm.php">Login</a>
    <?php } ?>
    </div>
  </div>