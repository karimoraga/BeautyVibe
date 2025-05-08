<?php
    $mostrar_form = true;

    if((isset($_GET["a"]))) $msg = "Debe estar logeado para realizar esta acción.";

    // Si el usuario envió el formulario...
    if(!empty($_POST)) {
        // Usaremos la BD así que nos conectamos
        require "api/conexion.php";

        $q = $mysqli->prepare("SELECT * FROM usuarios WHERE username = ? AND psw = ?");
        $q->bind_param("ss", $_POST["username"], $_POST["psw"]);

        $q->execute();
        $r = $q->get_result();

        if($r->num_rows > 0) {
          // El usuario existe, por lo tanto sacamos su información
          $usuario = $r->fetch_assoc();

          session_start();
          $_SESSION["username"] = $usuario["username"];

          if($usuario["tipo"] == "1") {
            $_SESSION["admin"] = true;
            header("Location: admin.php");
          } else {
            $_SESSION["admin"] = false;
            header("Location: home.php");
          }

          die();
        } else {
          // El usuario no existe
          $msg = "Favor verifique sus credenciales.";
        }
    }
?>
  <?php include "includes/header.php"; ?>
  <?php include "includes/dropdown.php"; ?>
  <?php include "includes/navbar.php"; ?>
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
        
    </form>
  </div>
<?php include "includes/footer.php"; ?>