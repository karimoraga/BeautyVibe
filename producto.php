<?php
function usercheck() {
  if (session_status() === PHP_SESSION_NONE) session_start();
  if(!isset($_SESSION["idUsuario"])) {
    header("Location: login.php?a=1");
    die();
  }
}

require "api/conexion.php";

$p = 0;

$sql = <<<EOL
  SELECT idProducto, productos.nombre AS nombre, descripcion, marca, precio, stock, categorias.id AS cid, categorias.nombre AS categoria, img
  FROM productos
  INNER JOIN categorias ON categorias.id = productos.categoria
EOL;

if(isset($_GET["p"])) {
  $p = intval($_GET["p"]);
} else {
  die("Se necesita ID de producto.");
}

$sql .= " WHERE idProducto = " . intval($p);

$result = $mysqli->query($sql);
if(!$result) die($mysqli->error);

$producto = $result->fetch_assoc();
if(!$producto) die("No existe el producto.");
?>
<?php include "includes/header.php"; ?>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/guardarp.php"; ?>
<style>
    .catalogo-container {
        display: flex;
        gap: 20px;
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    .producto {
        border-radius: 12px;
        padding: 15px;
    }

    .bg1 {
        background-color:rgb(253, 231, 240);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .bg2 {
        background-color:rgb(251, 172, 204);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        text-align: center;
    }

    .producto img {
        max-width: 100%;
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
    }

    .producto h3 {
        color: #cc6699;
        font-size: 16px;
        margin: 10px 0 5px;
        width: 280px;
    }

    .producto h4 {
        font-size: 14px;
        margin: 0 0 5px;
        width: 280px;
    }

    .producto h4 a {
        color:rgb(53, 37, 51);
    }

    .producto p {
        color: #555;
        margin-bottom: 10px;
        text-align: center;
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

    .producto button:hover {
        background-color: #d44872;
    }

    .producto-container {
      display: flex;
    }

    .producto-container .desc {
      padding-left: 15px;
    }

    .btn { 
      display: block;
      padding: 10px 22px;
      border-radius: 6px;
      border: none;
      color: #fff;
      cursor: pointer;
      background-color: #e75981;
      font-size: 16px; 
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .producto-container small { display: block; width: 280px }
</style>

<div class="navbar">
    <h1>Producto</h1>
</div>

<div class="catalogo-container">
    <div class="producto bg1" style="width:580px">
      <div class="producto-container">
        <div><img src="imgs/productos/<?= $producto["img"] ?>"></div>
        <div class="desc">
          <h3><?= $producto["nombre"] ?></h3>
          <h4><?= $producto["marca"] ?></h4>
          <h4><a href="?c=<?= $producto["cid"] ?>"><?= $producto["categoria"] ?></a></h4>
          <h2>$<?= number_format($producto["precio"], 0, ",", ".") ?> CLP</h2>
          <small><?= $producto["descripcion"] ?></small>
        </div>
      </div>
    </div>
    <div class="producto bg2">
      <p>
        <a class="btn" href="?p=<?= $p ?>&wishlist=<?= $producto["idProducto"] ?>">❤️ Agregar a Wishlist</a>
        <a class="btn" href="?p=<?= $p ?>&carrito=<?= $producto["idProducto"] ?>">🛒 Agregar a Carrito</a>
      </p>
    </div>
</div>

<?php include "includes/footer.php"; ?>