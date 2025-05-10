<?php

function usercheck() {
  if (session_status() === PHP_SESSION_NONE) session_start();
  if(!isset($_SESSION["idUsuario"])) {
    header("Location: login.php?a=1");
    die();
  }
}

require "api/conexion.php";

$c = 0;
$categoria_nombre = "Todo";

$sql = <<<EOL
  SELECT idProducto, productos.nombre AS nombre, descripcion, marca, precio, stock, categorias.id AS cid, categorias.nombre AS categoria, img
  FROM productos
  INNER JOIN categorias ON categorias.id = productos.categoria
EOL;

if(isset($_GET["c"])) $c = intval($_GET["c"]);
if($c) $sql .= " WHERE productos.categoria = " . intval($c);

$sql.= " ORDER BY categorias.orden ASC, productos.nombre ASC";

$result = $mysqli->query($sql);
if(!$result) die($mysqli->error);

if ($result->num_rows > 0) {
  $productos = $result->fetch_all(MYSQLI_ASSOC);
  if($c) $categoria_nombre = $productos[0]["categoria"];
} else {
  $productos = [];
  $categoria_nombre = "???";
}
?>
<?php include "includes/header.php"; ?>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/guardarp.php"; ?>
<style>
    .catalogo-container {
        display: flex;
        flex-flow: row wrap;
        align-items: stretch;
        gap: 20px;
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    .producto {
        background-color:rgb(251, 172, 204);
        border-radius: 12px;
        width: 200px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .producto img {
        max-width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
    }

    .producto h3 {
        color: #cc6699;
        font-size: 16px;
        margin: 10px 0 5px;
    }

    .producto h4 {
        font-size: 14px;
        margin: 0 0 5px;
    }

    .producto p {
        color: #555;
        margin-bottom: 10px;
    }

    .producto small {
        display: block;
        height: auto;
    }

    .producto button {
        background-color: #e75981;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        
    }

    .registerbtn {
       {
        margin-top: auto;
        }
      }
    .producto button:hover {
        background-color: #d44872;
    }
</style>

<div class="navbar">
    <h1>Catálogo de Maquillaje</h1>
    <small>Categoría: <?= $categoria_nombre ?></small>
</div>

<div class="catalogo-container">
    <?php foreach ($productos as $producto): ?>
    <div class="producto">
        <a href="producto.php?p=<?= $producto["idProducto"] ?>"><img src="imgs/productos/<?= $producto["img"] ?>"></a>
        <h3><?= $producto["nombre"] ?></h3>
        <h4><?= $producto["marca"] ?></h4>
        <h4><a href="?c=<?= $producto["cid"] ?>"><?= $producto["categoria"] ?></a></h4>
        <small><?= $producto["descripcion"] ?></small>
        <p>$<?= number_format($producto["precio"], 0, ",", ".") ?> CLP</p>
        <p>
          <a class="registerbtn" href="?c=<?= $c ?>&wishlist=<?= $producto["idProducto"] ?>">❤️</a>
          &nbsp;
          <a class="registerbtn" href="?c=<?= $c ?>&carrito=<?= $producto["idProducto"] ?>">🛒</a>
        </p>
    </div>
    <?php endforeach; ?>
</div>

<?php include "includes/footer.php"; ?>