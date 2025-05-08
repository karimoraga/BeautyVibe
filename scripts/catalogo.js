const categoria = new URLSearchParams(location.search).get('categoria') || '';
document.getElementById('titulo-categoria').innerText = categoria;

const cont = document.getElementById('productos');

fetch('data/productos.json')
  .then(r => r.json())
  .then(data => {
    // Filtrar productos por categoría o marca
    const filt = data.filter(p => p.categoria === categoria || p.marca === categoria);
    
    // Crear el contenido dinámico para cada producto
    filt.forEach(p => {
      const d = document.createElement('div');
      d.className = 'producto';
      d.innerHTML = `
        <img src="${p.imagen}" class="producto-img">
        <h4 class="producto-marca">${p.marca}</h4>
        <h3>${p.nombre}</h3>
        <p>Precio: $${p.precio.toLocaleString()}</p>
        <button class="btn-agregar" data-id="${p.idProducto}">Agregar al carrito</button>
        <button class="btn-wishlist" data-id="${p.idProducto}"> ❤️ </button>
      `;
      cont.appendChild(d);
    });

    // Manejar clic en el botón de agregar a wishlist
    document.querySelectorAll('.btn-agregar').forEach(btn => {
      btn.addEventListener('click', () => {
        const productId = btn.dataset.id;  // Obtener el ID del producto
        fetch('wishlist_action.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: 'product_id=' + productId  // Enviar el ID del producto al servidor
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'added') {
            btn.textContent = 'Añadido a Wishlist';
            btn.disabled = true; // Deshabilitar el botón después de agregar
          } else if (data.status === 'exists') {
            alert('Este producto ya está en tu wishlist');
          }
        })
        .catch(error => console.error('Error al agregar a la wishlist:', error));
      });
    });
  });
