<?php
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include "includes/header.php"; ?>
<style>
    body {
        color: #880e4f;
        font-family: Arial, sans-serif;
        background-color: #fff0f6;
    }

    h1, h2, h3 {
        color: #880e4f;
    }

    input[type="text"], input[type="email"] {
        padding: 6px;
        width: 100%;
        border: 1px solid #880e4f;
        border-radius: 4px;
        color: #880e4f;
        background-color: #ffffff;
    }

    input:focus {
        outline: 2px solid #880e4f;
    }

    button {
        background-color: #e75981;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #880e4f;
    }

    .tabla-pedidos {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff5f7;
        color: #880e4f;
    }

    .tabla-pedidos th {
        background-color: #ffc1d6;
        color: #880e4f;
        padding: 8px;
        text-align: left;
    }

    .tabla-pedidos td {
        padding: 8px;
        border-bottom: 1px solid #f8bbd0;
    }

    .tabla-pedidos tr:nth-child(even) {
        background-color: #ffe4ed;
    }

    #mensaje-guardado {
        color: green;
        margin-top: 10px;
        display: none;
    }
    
    .burdeo {
  color: #880e4f;
}
</style>
<?php include "includes/dropdown.php"; ?>
<?php include "includes/navbar.php"; ?>

<div class="box1">
  <h1>Mi Perfil</h1>

  <!-- Datos personales -->
  <div class="datos-usuario">
    <h2>Información Personal</h2>
    <form id="form-perfil">
      <p><strong class="burdeo">Nombres:</strong> <input type="text" id="nombres" name="nombres" required /></p>
      <p><strong class="burdeo">E-mail:</strong> <input type="email" id="email" name="email" required /></p>
      <p><strong class="burdeo">Dirección:</strong> <input type="text" id="direccion" name="direccion" /></p>
      <button type="submit">Guardar Cambios</button>
      <p id="mensaje-guardado">Datos actualizados correctamente ✔</p>
    </form>
  </div>

  <!-- Historial de pedidos -->
  <div class="historial-pedidos">
    <h3>Historial de Pedidos</h3>
    <table class="tabla-pedidos">
      <thead>
        <tr>
          <th>ID Pedido</th>
          <th>Fecha</th>
          <th>Total</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody id="historial"></tbody>
    </table>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Obtener datos del usuario
  fetch('api/get_user_data.php')
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        window.location.href = 'login.php';
      } else {
        console.log(data); // para debug
        document.getElementById('nombres').value = data.nombres || '';
        document.getElementById('email').value = data.email || '';
        document.getElementById('direccion').value = data.direccion || '';

        const tbody = document.getElementById('historial');
        if (!data.historialPedidos || data.historialPedidos.length === 0) {
          tbody.innerHTML = '<tr><td colspan="4">Aún no tienes pedidos registrados.</td></tr>';
        } else {
          let historialHTML = '';
          data.historialPedidos.forEach(pedido => {
            historialHTML += `
              <tr>
                <td>#${pedido.idPedido}</td>
                <td>${pedido.fecha}</td>
                <td>$${pedido.total}</td>
                <td>${pedido.estado || 'Pendiente'}</td>
              </tr>
            `;
          });
          tbody.innerHTML = historialHTML;
        }
      }
    })
    .catch(error => {
      console.error('Error al cargar los datos:', error);
      alert('No se pudieron cargar los datos del perfil.');
    });

  // Guardar cambios del formulario
  document.getElementById('form-perfil').addEventListener('submit', function (e) {
    e.preventDefault();

    const datos = {
      nombres: document.getElementById('nombres').value,
      email: document.getElementById('email').value,
      direccion: document.getElementById('direccion').value
    };

    fetch('api/update_user_data.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datos)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById('mensaje-guardado').style.display = 'block';
      } else {
        alert('Error al guardar los cambios');
      }
    })
    .catch(error => {
      console.error('Error al actualizar:', error);
      alert('No se pudieron guardar los cambios');
    });
  });
});
</script>

<?php include "includes/footer.php"; ?>