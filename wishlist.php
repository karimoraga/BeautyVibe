<?php include "includes/header.php"; ?>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require "api/conexion.php";

if(isset($_GET["quitar"])) {
  // Quitar del wishlist
  $idproducto = intval($_GET["quitar"]);

  $q = $mysqli->prepare("DELETE FROM wishlist WHERE idUsuario = ? AND idProducto = ?");
  $q->bind_param("ii", $_SESSION["idUsuario"], $idproducto);
  $q->execute();
  
  echo '<div class="msg">El producto ha sido quitado de la wishlist.</div>';
}

$sql = <<<EOL
  SELECT wishlist.idProducto AS idProducto, productos.nombre AS nombre, productos.marca AS marca, productos.precio AS precio
  FROM wishlist
  INNER JOIN productos ON productos.idProducto = wishlist.idProducto
  WHERE wishlist.idUsuario = ?
EOL;

$q = $mysqli->prepare($sql);
$q->bind_param("i", $_SESSION["idUsuario"]);
$q->execute();
$r = $q->get_result();

if($r->num_rows > 0) {
  $productos = $r->fetch_all(MYSQLI_ASSOC);
} else {
  $productos = [];
}
?>
<div class="wishlist-container">
    <h2>Mi Wishlist 🌸</h2>
    <table class="wishlist-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Quitar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["marca"] ?></td>
                <td>$<?= number_format($producto["precio"], 0, ",", ".") ?></td>
                <td><a href="?quitar=<?= $producto["idProducto"] ?>">Quitar</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button" class="registerbtn" onclick="window.location.href='carrito.php'">Carrito</button>
    
</div>

</body>
</html>