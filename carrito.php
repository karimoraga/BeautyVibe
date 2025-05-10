<?php include "includes/header.php"; ?>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require "api/conexion.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach($_POST as $k => $v) {
    if(substr($k, 0, 1) == "c") {
      $idproducto = intval(substr($k, 1));
      $nuevacantidad = intval($v);

      if($nuevacantidad < 1) {
        $q = $mysqli->prepare("DELETE FROM carrito WHERE idUsuario = ? AND idProducto = ?");
        $q->bind_param("ii", $_SESSION["idUsuario"], $idproducto);
        $q->execute();
      } else {
        $q = $mysqli->prepare("UPDATE carrito SET cantidad = ? WHERE idUsuario = ? AND idProducto = ?");
        $q->bind_param("iii", $nuevacantidad, $_SESSION["idUsuario"], $idproducto);
        $q->execute();
      }
    }
  }
  echo '<div class="msg">El carro ha sido actualizado.</div>';
}

$sql = <<<EOL
  SELECT
    carrito.idProducto AS idProducto,
    carrito.cantidad AS cantidad,
    productos.nombre AS nombre,
    productos.marca AS marca,
    productos.precio AS precio
  FROM carrito
  INNER JOIN productos ON productos.idProducto = carrito.idProducto
  WHERE carrito.idUsuario = ?
EOL;

$q = $mysqli->prepare($sql);
$q->bind_param("i", $_SESSION["idUsuario"]);
$q->execute();
$r = $q->get_result();
$productos = ($r->num_rows > 0) ? $r->fetch_all(MYSQLI_ASSOC) : [];

$total = 0;
?>
<script>
  const productos_en_carro = <?= $r->num_rows ?>;

  function quitar(pid) {
    const selector = "c" + pid;
    document.forms[0][selector].value = 0;
    document.forms[0].submit();
  }

  function pagar() {
    if(productos_en_carro > 0) {
      window.location.href='pago.php';
    } else {
      alert("No hay productos en su carro.");
    }
  }
</script>
<div class="wishlist-container">
    <h2>Tu carro de compras 💝</h2>
    <form method="post" action="">
    <table class="wishlist-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><a href="producto.php?p=<?= $producto["idProducto"] ?>"><?= $producto["nombre"] ?></a></td>
                <td><?= $producto["marca"] ?></td>
                <td>$<?= number_format($producto["precio"], 0, ",", ".") ?></td>
                <td><input name="c<?= $producto["idProducto"] ?>" type="number" min="0" value="<?= $producto["cantidad"] ?>" size="3"></td>
                <td>$<?= number_format($producto["precio"] * $producto["cantidad"], 0, ",", ".") ?> </td>
                <td><button type="button" onclick="quitar(<?= $producto["idProducto"] ?>)"> 🗑 </button></td>
                <?php $total += $producto["precio"] * $producto["cantidad"] ?>
            </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="6" class="total">Total: $<?= number_format($total, 0, ",", ".") ?></td>
        </tr>
        </tbody>
    </table>
    <input type="submit" class="registerbtn" name="actualizar" value="Actualizar carro">
    <br>
    <button type="button" class="registerbtn" onclick="pagar()">Pago</button>
    </form>
</div>

</body>
</html>