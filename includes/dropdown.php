<?php
require "api/conexion.php";

function active($c) {
  if(isset($_GET["c"]) && $_GET["c"] == $c) {
    echo "class=\"active\"";
  }
}

$sql = "SELECT id, nombre FROM categorias";

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
    <!--<li class="has-submenu">Maquillaje
      <ul class="submenu">
        <li><a href="subcategoria.html?categoria=Rostro">Rostro</a></li>
        <li><a href="subcategoria.html?categoria=Labios">Labios</a></li>
        <li><a href="subcategoria.html?categoria=Ojos">Ojos</a></li>
        <li><a href="subcategoria.html?categoria=Cejas">Cejas</a></li>
        <li><a href="subcategoria.html?categoria=Accesorios">Accesorios</a></li>
      </ul>
    </li>
    <li class="has-submenu">Skincare
      <ul class="submenu">
        <li><a href="subcategoria.html?categoria=Limpieza">Limpieza</a></li>
        <li><a href="subcategoria.html?categoria=Hidratación">Hidratación</a></li>
        <li><a href="subcategoria.html?categoria=Tratamientos">Tratamientos</a></li>
      </ul>
    </li>
    <li class="has-submenu">Marcas
      <ul class="submenu">
        <li><a href="subcategoria.html?categoria=Anastasia%20Beverly%20Hills">Anastasia Beverly Hills</a></li>
        <li><a href="subcategoria.html?categoria=Charlotte%20Tilbury">Charlotte Tilbury</a></li>
        <li><a href="subcategoria.html?categoria=Fenty%20Beauty">Fenty Beauty</a></li>
        <li><a href="subcategoria.html?categoria=Hourglass">Hourglass</a></li>
        <li><a href="subcategoria.html?categoria=Huda%20Beauty">Huda Beauty</a></li>
        <li><a href="subcategoria.html?categoria=Natasha%20Denona">Natasha Denona</a></li>
        <li><a href="subcategoria.html?categoria=Pat%20McGrath%20Labs">Pat McGrath Labs</a></li>
        <li><a href="subcategoria.html?categoria=Rare%20Beauty">Rare Beauty</a></li>
        <li><a href="subcategoria.html?categoria=The%20Ordinary">The Ordinary</a></li>
      </ul>
    </li>-->
    <?php foreach ($categorias as $categoria): ?>
    <li <?= active($categoria["id"]) ?>><a href="productos.php?c=<?= $categoria["id"] ?>"><?= $categoria["nombre"] ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>