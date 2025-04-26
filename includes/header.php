  <?php session_start(); ?>
  <div class="top">
    <img src="imgs/header.jpg">
    <?php 
    $logged = false;
    if(isset($_SESSION["username"])) {
      echo "<br><small>Estás logeado como <em>" . $_SESSION["username"] . " </em></small>";
      $logged = true;
    }
    ?>
    <small></small>
    <div class="navbar">
      <a href=home.php>Home</a> ❤
      <a href=maquillaje.php>Maquillaje</a> ❤
      <a href="#Skincare">Skincare</a> ❤
      <a href="#Wishlist">Wishlist</a> ❤
    <?php if($logged) { ?>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="registro.php">Registro</a> ❤
      <a href="login.php">Login</a>
    <?php } ?>
    </div>
  </div>