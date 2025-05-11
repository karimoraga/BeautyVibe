const urlObtenerProducto = 'http://localhost/BEAUTY-VIBE/api/obtenerProducto.php'
const urlAgregarProducto = 'http://localhost/BEAUTY-VIBE/api/agregarProducto.php'
const urlEditarProducto = 'http://localhost/BEAUTY-VIBE/api/editarProducto.php'
const urlBorrarProducto = 'http://localhost/BEAUTY-VIBE/api/borrarProducto.php'

let listaCategorias = []
let listaProductos = []

const objProducto= {
    idProducto: '',
    nombre: '',
    marca: '',
    descripcion: '',
    precio: 0,
    stock: 0,
    categoria: '',
    nombreCategoria: '',
    img: ''
}

let editando = false

const formulario = document.querySelector('#formulario')

const nombreInput = document.querySelector('#nombre')
const marcaInput = document.querySelector('#marca')
const descripcionInput = document.querySelector('#descripcion')
const precioInput = document.querySelector('#precio')
const stockInput = document.querySelector('#stock')
const categoriaInput = document.querySelector('#categoria')
const imgInput = document.querySelector('#img')

formulario.addEventListener('submit', validarFormulario)

const toBase64 = file => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = reject;
});

async function validarFormulario(e) {
    e.preventDefault()

    if([nombreInput.value, descripcionInput.value, precioInput.value, stockInput.value, categoriaInput.value].includes('')) {
        alert('Todos los campos son obligatorios')
        return
    }

    if(editando) {
        editarProducto()
        editando = false
    } else {
        objProducto.nombre = nombreInput.value
        objProducto.marca = marcaInput.value
        objProducto.descripcion = descripcionInput.value
        objProducto.precio = precioInput.value
        objProducto.stock = stockInput.value
        objProducto.categoria = categoriaInput.value
        objProducto.img = (imgInput.files.length) ? await toBase64(imgInput.files[0]) : '';
        agregarProducto()
    }
}

async function obtenerProductos() {
    let resultado = await fetch(urlObtenerProducto)
    .then(respuesta => respuesta.json())
    .then(datos => datos)
    .catch(error => console.log(error))

    listaCategorias = resultado["categorias"];
    listaProductos = resultado["productos"];

    mostrarProductos()

}

function mostrarProductos() {
    const divProductos = document.querySelector('.div-productos')

    listaProductos.forEach(producto => {
        const {idProducto, nombre, marca, descripcion, precio, stock, nombreCategoria, img} = producto

        const parrafo = document.createElement('p')
        parrafo.innerHTML = `${idProducto} - ${nombre} - ${marca} - ${descripcion} - \$${precio} - ${stock} - ${nombreCategoria}`
        if(img != "") {
          parrafo.innerHTML += "<br><img src=\"imgs/productos/" + img + "\"><br>";
        }
        
        parrafo.dataset.id = idProducto

        const editarBoton = document.createElement('button')
        editarBoton.onclick = () => cargarProducto(producto)
        editarBoton.textContent = 'Editar'
        editarBoton.classList.add('btn', 'btn-editar')
        parrafo.append(editarBoton)

        const eliminarBoton = document.createElement('button');
        eliminarBoton.onclick = () => eliminarProducto(idProducto);
        eliminarBoton.textContent = 'Eliminar';
        eliminarBoton.classList.add('btn', 'btn-eliminar');
        parrafo.append(eliminarBoton);

        const hr = document.createElement('hr')

        divProductos.appendChild(parrafo)
        divProductos.appendChild(hr)

    })

    const sel = document.getElementById("categoria");
    sel.innerText = null;

    const opt = document.createElement("option");
    opt.value = '';
    opt.text = "Selecciona categoría";
    sel.add(opt);

    listaCategorias.forEach(categoria => {
        const {id, nombre} = categoria;
        
        const opt = document.createElement("option");
        opt.value = id;
        opt.text = nombre;
        sel.add(opt);
    })

}

async function agregarProducto() {
    const res = await fetch(urlAgregarProducto,
        {
            method: 'POST',
            body: JSON.stringify(objProducto)
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

    if(res.msg === 'OK') {
        alert('Se registro exitosamente')
        limpiarHTML()
        obtenerProductos()

        formulario.reset()
        limpiarObjeto()
    }
}

async function editarProducto() {
    
    objProducto.nombre = nombreInput.value
    objProducto.marca = marcaInput.value
    objProducto.descripcion = descripcionInput.value
    objProducto.precio = precioInput.value
    objProducto.stock = stockInput.value
    objProducto.categoria = categoriaInput.value
    objProducto.img = (imgInput.files.length) ? await toBase64(imgInput.files[0]) : '';

    const res = await fetch(urlEditarProducto,
        {
            method: 'POST',
            body: JSON.stringify(objProducto)
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

    if(res.msg === 'OK')  {
        alert('Se actualizó correctamente')

        limpiarHTML()
        obtenerProductos()
        formulario.reset()

        limpiarObjeto()
    }

    formulario.querySelector('button[type="submit"]').textContent = 'Agregar';

    editando = false

}

async function eliminarProducto(id) {
    const res = await fetch(urlBorrarProducto,
        {
            method: 'POST',
            body: JSON.stringify({'idProducto': id})
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

        if(res.msg === 'OK') {
            alert('Se borró exitosamente')

            limpiarHTML()
            obtenerProductos()
            limpiarObjeto()
        }

}

function cargarProducto(producto) {
    const {idProducto, nombre, marca, descripcion, precio, stock, categoria} = producto

    nombreInput.value = nombre
    marcaInput.value = marca
    descripcionInput.value = descripcion
    precioInput.value = precio
    stockInput.value = stock
    categoriaInput.value = categoria

    objProducto.idProducto = idProducto

    formulario.querySelector('button[type="submit"').textContent = 'Actualizar'
    editando = true
}

function limpiarHTML() {
    const divProductos = document.querySelector('.div-productos');
    while(divProductos.firstChild) {
        divProductos.removeChild(divProductos.firstChild)
    }
}

function limpiarObjeto() {
    objProducto.idProducto = ''
    objProducto.nombre = ''
    objProducto.marca = ''
    objProducto.descripcion = ''
    objProducto.precio = 0
    objProducto.stock = 0
    objProducto.categoria = ''
}

obtenerProductos()