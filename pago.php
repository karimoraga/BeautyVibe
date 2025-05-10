<?php
  session_start();
  if(!isset($_SESSION["idUsuario"])) {
    header("Location: login.php?a=1");
    die();
  }
?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php
require "api/conexion.php";

$total = 0;
$sql = <<<EOL
SELECT
  carrito.cantidad AS cantidad,
  productos.precio AS precio
FROM carrito
INNER JOIN productos ON productos.idProducto = carrito.idProducto
WHERE carrito.idUsuario = ?
EOL;

$q = $mysqli->prepare($sql);
if(!$q) die($mysqli->error);

$q->bind_param("i", $_SESSION["idUsuario"]);
$q->execute();
$r = $q->get_result();

while($producto = $r->fetch_assoc()) {
  $total += $producto["precio"] * $producto["cantidad"];
}
?>

<div class="box">
    <h2>Redireccion a pago: 🌸</h2>
    <div class="pagos">
      <p>A continuación serás redireccionad@ a la página de pagos.</p>
      <p>Su total es de:</p>
      <h1>$<?= number_format($total, 0, ",", ".") ?></h1>
      <p>Si está de acuerdo, continúe al pago con el botón Pagar.</p>
    </div>
    <button type="button" class="registerbtn" onclick="window.location.href='portaldepagos.php'">Pagar</button>
    <br>
    <button type="button" class="registerbtn" onclick="window.location.href='carrito.php'">Volver</button>
</div>

<?php include "includes/footer.php"; ?>