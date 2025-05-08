document.addEventListener('DOMContentLoaded', function() {
    // Simula la carga de datos (normalmente iría a una API)
    fetch('get_user_data.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('nombre').textContent = data.nombre;
        document.getElementById('correo').textContent = data.correo;
        document.getElementById('direccion').textContent = data.direccion;
        
        let historialPedidos = '';
        data.historialPedidos.forEach(pedido => {
            historialPedidos += `
                <tr>
                    <td>#${pedido.id}</td>
                    <td>${pedido.fecha}</td>
                    <td>$${pedido.total}</td>
                    <td>${pedido.estado}</td>
                </tr>
            `;
        });
        document.getElementById('historial').innerHTML = historialPedidos;
    })
    .catch(error => console.error('Error al cargar los datos:', error));
});
