<?php
    $mostrar_form = true;

    // Si el usuario envió el formulario...
    if(!empty($_POST)) {
        // Usaremos la BD así que nos conectamos
        require "api/conexion.php";

        $q = $mysqli->prepare("SELECT * FROM usuarios WHERE username = ? AND psw = ?");
        $q->bind_param("ss", $_POST["username"], $_POST["psw"]);

        $q->execute();
        $r = $q->get_result();

        if($r->num_rows > 0) {
          session_start();
          $_SESSION["username"] = $_POST["username"];
          header("Location: home.php");
          die();
        } else {
          $msg = "Favor verifique sus credenciales.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>Login</title>
</head>
<body>
  <?php include "includes/header.php"; ?>
  <?php
    // Mostrar mensaje si existe
    if(isset($msg)) {
      echo '<div class="msg">' . $msg . '</div>';
    }
  ?>
  <div class="box">
    <h1>Login</h1>
    <form action="" method="post">
        <p>Ingrese sus credenciales:</p>
        <label for="username">Usuario</label>
        <input type="text" placeholder="Nombre de usuario" name="username" required>
        <hr>

        <label for="password">Contraseña</label>
        <input type="password" placeholder="Contraseña" name="psw" required>
        <hr>
  
        <button type="submit" class="registerbtn" name="submit">Entrar</button>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde consequatur optio, accusamus, eaque ipsam minima nesciunt aliquid excepturi nobis assumenda iste distinctio tempora odio itaque qui quia atque corporis dolorem.</p>
    </form>
  </div>
</body>
</html>