
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<script>
  function pagar(banco) {
    if(confirm("¿Deseas pagar con " + banco + "?")) {
      window.location.href = "pago.php?confirmar=" + banco;
    }
  }
</script>
<div class="box">
<h1>Bienvenid@:</h1>
<p>Bienvenido a Beauty❤Vibe, tienda on-line de maquillaje y cuidado personal. Te invitamos a registrarte, revisar nuestro catálogo y disfrutar nuestros productos!</p>
<table>
  <thead>
    <tr>
      <th colspan="2">Medios de pago</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Banco de Chile</td>
      <td><a href="#" onclick="pagar('Banco Chile')"><img src="imgs/chile.jpg" alt="Banco Chile"></a></td>
    </tr>
    <tr>
      <td>Banco Santander</td>
      <td><a href="#" onclick="pagar('Banco Santander')"><img src="imgs/santander.jpg" alt="Banco Santander"></a></td>
    </tr>
    <tr>
      <td>GetNet</td>
      <td><a href="#" onclick="pagar('GetNet')"><img src="imgs/getnet.png" alt="GetNet"></a></td>
    </tr>
    <tr>
      <td>Webpay</td>
      <td><a href="#" onclick="pagar('Webpay')"><img src="imgs/webpay.jpg" alt="Webpay"></a></td>
    </tr>
  </tbody>
</table>
</div>
<?php include "includes/footer.php"; ?>