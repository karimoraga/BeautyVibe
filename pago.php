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
$realizado = false;
$banco = null;

if(isset($_GET['confirmar'])) {
  $realizado = true;
  $banco = $_GET['confirmar'];
}

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

if($realizado) {
  // El pago fue realizado
  // Guardamos en el historial de compras
  $sql = "INSERT INTO pedidos (idUsuario, fecha, estado, total) VALUES (?, NOW(), 'Confirmado', ?)";

  $q = $mysqli->prepare($sql);
  if(!$q) die($mysqli->error);

  $q->bind_param("ii", $_SESSION["idUsuario"], $total);
  $q->execute();
  if($mysqli->error) echo $myqsli->error;

  // Vaciamos el carro
  $sql = "DELETE FROM carrito WHERE idUsuario = ?";

  $q = $mysqli->prepare($sql);
  if(!$q) die($mysqli->error);

  $q->bind_param("i", $_SESSION["idUsuario"]);
  $q->execute();
  if($mysqli->error) echo $myqsli->error;
}
?>

<div class="box">
  <?php if(!$realizado) { ?>
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
  <?php } else { ?>
    <h2>Pago realizado 🌸</h2>
    <div class="pagos">    
      <p>Su pago por su pedido ha sido realizado:</p>
      <table>
        <tr><td>Total:</td><td>$<?= number_format($total, 0, ",", ".") ?></td></tr>
        <tr><td>Método de pago:</td><td><?= $banco ?></td></tr>
        <tr><td>Número de transacción:</td><td>HF3493840</td></tr>
      </table>
      <p>¡Gracias por comprar con nosotros!</p>
    </div>
  <?php } ?>
</div>
<?php include "includes/footer.php"; ?>