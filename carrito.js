// Función para actualizar el total del carrito
function updateTotal() {
    let total = 0;
    const quantities = document.querySelectorAll('.quantity');
    quantities.forEach((input, index) => {
        const quantity = input.value;
        const price = parseFloat(document.getElementById('price' + (index + 1)).innerText.replace('$', ''));
        total += quantity * price;
    });
    document.getElementById('total').innerText = '$' + total.toFixed(3);
}

// Función para eliminar un producto
function removeItem(itemId) {
    const item = document.querySelector('.cart-item:nth-child(' + itemId + ')');
    item.remove();
    updateTotal();
}

// Evento para actualizar el total cuando la cantidad cambie
document.querySelectorAll('.quantity').forEach(input => {
    input.addEventListener('input', updateTotal);
});

// Función para el botón de "Ir a Pago"
function checkout() {
    alert("Redirigiendo al proceso de pago...");
    window.location.href = 'pagos.html'; // Redirige a la página de pagos
}

// Llamada inicial para calcular el total
updateTotal();