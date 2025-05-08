  <?php include "includes/header.php"; ?>
  <?php include "includes/navbar.php"; ?>
  <?php
    $mostrar_form = true;

    // Mostrar mensaje
    function msg($texto) {
      echo '<div class="msg">' . $texto . '</div>';
    }

    // Devuelve true si todas las validaciones están bien
    // si no, mostrar mensaje de error y devolver false
    function validar() {
      if($_POST["psw"] != $_POST["psw-repeat"]) {
        msg("La contraseña no es igual.");
        return false;
      }
        
      return true;
    }

    // Obtener valor de POST si es que existe
    function getget($key) {
      if(isset($_POST[$key])) {
        echo $_POST[$key];
      }
    }

    // Si el usuario envió el formulario...
    if(!empty($_POST)) {
      if(validar()) {
        // Insertar en la BD aquí
        // Usaremos la BD así que nos conectamos
        require "api/conexion.php";

        $hoy = date("Y-m-d H:i:s");
        $q = $mysqli->prepare("INSERT INTO usuarios(username, nombres, apellidos, email, telefono, direccion, psw, fecha_registro, tipo) VALUES (?,?,?,?,?,?,?,?,0)");
        $q->bind_param("ssssssss",
          $_POST["username"],
          $_POST["nombres"],
          $_POST["apellidos"],
          $_POST["email"],
          $_POST["telefono"],
          $_POST["direccion"],
          $_POST["psw"],
          $hoy
        );

        $q->execute();

        msg("Registro completo.<br><br><a href=\"login.php\">Volver</a>");
        $mostrar_form = false;
      }
    }
  ?>
  <?php if($mostrar_form) { ?>
  <div class="box">
    <form action="" method="post">
        <h1>Registro</h1>
        <p>Llena los campos para crear una cuenta.</p>

        <br>
        <label for="username">Usuario</label>
        <input type="text" placeholder="Ingresar nombre de usuario" name="username" id="username" value="<?php getget("username"); ?>" required>
        <hr>
      
        <label for="nombres">Nombres</label>
        <input type="text" placeholder="Ingresar nombres" name="nombres" id="nombres" value="<?php getget("nombres"); ?>"required>
        <hr>

        <label for="email">Apellidos</label>
        <input type="text" placeholder="Ingresar apellidos" name="apellidos" id="apellidos" value="<?php getget("apellidos"); ?>"required>
        <hr>

        <label for="email">Email</label>
        <input type="text" placeholder="Ingresar correo" name="email" id="email" value="<?php getget("email"); ?>"required>
        <hr>
    
        <label for="telefono">Telefono</label>
        <input type="text" placeholder="Ingresar numero telefonico" name="telefono" id="telefono" value="<?php getget("telefono"); ?>"required>
        <hr>

        <label for="direccion">Direccion</label>
        <input type="text" placeholder="Ingresar direccion" name="direccion" id="direccion" value="<?php getget("direccion"); ?>"required>
        <hr>

        <label for="psw">Contraseña</label>
        <input type="password" placeholder="Ingresar contraseña" name="psw" id="psw" required>
        <hr>
    
        <label for="psw-repeat">Repetir contraseña</label>
        <input type="password" placeholder="Repetir contraseña" name="psw-repeat" id="psw-repeat" required>
        <hr>
    
        <button type="submit" class="registerbtn" name="submit">Registrarse</button>
        <br>
      <p style="text-align: center;">Ya tienes una cuenta? <a href=login.php>Log in</a>.</p>
    </form> 
    <br>
  </div>
  <?php } ?>
  <?php include "includes/footer.php"; ?>