<?php
  $operacion = "";

  if(isset($_GET["wishlist"])) {
    $operacion = "wishlist";
  } else if(isset($_GET["carrito"])) {
    $operacion = "carrito";
  }

  if($operacion != "") {
    usercheck();

    $idproducto = intval($_GET[$operacion]);

    $q = $mysqli->prepare("SELECT * FROM $operacion WHERE idUsuario = ? AND idProducto = ?");
    $q->bind_param("ii", $_SESSION["idUsuario"], $idproducto);
    $q->execute();
    $r = $q->get_result();

    if($r->num_rows > 0) {
      echo "<div class=\"msg\">El producto ya está en su $operacion.<br><a href=\"$operacion.php\">Ver $operacion</a></div>";
    } else {
      // Ver cuanto stock hay
      $q = $mysqli->prepare("SELECT stock FROM productos WHERE idProducto = ?");
      $q->bind_param("i", $idproducto);
      $q->execute();
      $r = $q->get_result();

      $stock = $r->fetch_assoc()["stock"];

      // Agregar a la wishlist/carrito
      if($stock > 0 || $operacion == "wishlist") {
        $sql = $mysqli->prepare("INSERT INTO $operacion (idUsuario, idProducto) VALUES (?, ?)");
        $sql->bind_param("ii", $_SESSION["idUsuario"], $idproducto);
        $sql->execute();
        if($mysqli->error) echo $mysqli->error;

        echo "<div class=\"msg\">Producto agregado a su $operacion.<br><a href=\"$operacion.php\">Ver $operacion</a></div>";
      } else {
        echo "<div class=\"msg\">Lo sentimos, no queda stock de este producto.</div>";
      }
    }
  }
?>