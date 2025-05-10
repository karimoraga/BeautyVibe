<?php include "includes/header.php"; ?>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php
  require "api/conexion.php";

$sql = "SELECT idProducto, img FROM productos ORDER BY RAND() LIMIT 3";
$result = $mysqli->query($sql);
if(!$result) die($mysqli->error);

$productos = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];

?>
  <div class="box">
    <h1>Bienvenid@:</h1>
    <p>Bienvenido a Beauty❤Vibe, tienda on-line de maquillaje y cuidado personal.
      Te invitamos a registrarte, revisar nuestro catálogo y disfrutar nuestros productos!</p>

<h2>Productos Destacados</h2>
<p>Sombras:</p>

<div class="slideshow-container">
  <?php foreach ($productos as $producto): ?>
  <div class="slideshome">
    <img src="imgs/productos/<?= $producto["img"] ?>">
  </div>
  <?php endforeach; ?>
</div>
<br>
<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slideshome");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); 
}
</script>
</div>
<?php include "includes/footer.php"; ?>