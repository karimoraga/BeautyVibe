<?php
require "api/conexion.php";

function active($c) {
  if(isset($_GET["c"]) && $_GET["c"] == $c) {
    echo "class=\"active\"";
  }
}

$sql = "SELECT id, nombre FROM categorias ORDER BY orden ASC";

$result = $mysqli->query($sql);
if(!$result) die($mysqli->error);

if($result->num_rows > 0) {
  $categorias = $result->fetch_all(MYSQLI_ASSOC);
} else {
  $categorias = [];
}
?>

<div class="dropdown">
  <div class="select">
    <span class="selected">Categorías</span>
    <div class="caret"></div>
  </div>
  <ul class="menu">

    <?php foreach ($categorias as $categoria): ?>
    <li <?= active($categoria["id"]) ?>><a href="productos.php?c=<?= $categoria["id"] ?>"><?= $categoria["nombre"] ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>