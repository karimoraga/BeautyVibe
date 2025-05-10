const urlObtenerUsuario = 'http://localhost/BEAUTY-VIBE/api/obtenerUsuario.php'
const urlAgregarUsuario = 'http://localhost/BEAUTY-VIBE/api/agregarUsuario.php'
const urlEditarUsuario = 'http://localhost/BEAUTY-VIBE/api/editarUsuario.php'
const urlBorrarUsuario = 'http://localhost/BEAUTY-VIBE/api/borrarUsuario.php'

let listaUsuarios = []

const objUsuario = {
    idUsuario: '',
    nombres: '',
    apellidos: '',
    email: '',
    direccion: '',
    password: '',
    tipo: '',
}

let editando = false

const formulario = document.querySelector('#formulario')

const nombresInput = document.querySelector('#nombres')
const apellidosInput = document.querySelector('#apellidos')
const emailInput = document.querySelector('#email')
const telefonoInput = document.querySelector('#telefono')
const direccionInput = document.querySelector('#direccion')
const passwordInput = document.querySelector('#password')
const adminInput = document.querySelector('#admin')

formulario.addEventListener('submit', validarFormulario)

async function validarFormulario(e) {
    e.preventDefault()

    if([nombresInput.value, apellidosInput.value, emailInput.value, telefonoInput.value, direccionInput.value].includes('')) {
        alert('Todos los campos son obligatorios')
        return
    }

    if(editando) {
        editarUsuario()
        editando = false
    } else {
        objUsuario.nombres = nombresInput.value
        objUsuario.apellidos = apellidosInput.value
        objUsuario.email = emailInput.value
        objUsuario.telefono = telefonoInput.value
        objUsuario.direccion = direccionInput.value
        objUsuario.password = passwordInput.value
        objUsuario.tipo = (adminInput.checked ? "1" : "0");
        agregarUsuario()
    }
}

async function obtenerUsuarios() {

    listaUsuarios = await fetch(urlObtenerUsuario)
    .then(respuesta => respuesta.json())
    .then(datos => datos)
    .catch(error => console.log(error))

    mostrarUsuarios()

}
obtenerUsuarios()

function mostrarUsuarios() {

    const divUsuarios = document.querySelector('.div-productos')

    listaUsuarios.forEach(usuario => {
        const {idUsuario, nombres, apellidos, email, telefono, direccion, tipo} = usuario

        const parrafo = document.createElement('p')

        esAdmin = ((tipo == 1) ? "Admin" : "Normal")

        parrafo.innerHTML = `${idUsuario} - ${nombres} - ${apellidos} - ${email} - ${telefono} - ${direccion} - ${esAdmin}`
        
        parrafo.dataset.id = idUsuario

        const editarBoton = document.createElement('button')
        editarBoton.onclick = () => cargarUsuario(usuario)
        editarBoton.textContent = 'Editar'
        editarBoton.classList.add('btn', 'btn-editar')
        parrafo.append(editarBoton)

        const eliminarBoton = document.createElement('button');
        eliminarBoton.onclick = () => eliminarUsuario(idUsuario);
        eliminarBoton.textContent = 'Eliminar';
        eliminarBoton.classList.add('btn', 'btn-eliminar');
        parrafo.append(eliminarBoton);

        const hr = document.createElement('hr')

        divUsuarios.appendChild(parrafo)
        divUsuarios.appendChild(hr)

    })

}

async function agregarUsuario() {
    const res = await fetch(urlAgregarUsuario,
        {
            method: 'POST',
            body: JSON.stringify(objUsuario)
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

    if(res.msg === 'OK') {
        alert('Se registro exitosamente')
        limpiarHTML()
        obtenerUsuarios()

        formulario.reset()
        limpiarObjeto()
    }
}

async function editarUsuario() {
    objUsuario.nombres = nombresInput.value;
    objUsuario.apellidos = apellidosInput.value;
    objUsuario.email = emailInput.value;
    objUsuario.telefono = telefonoInput.value;
    objUsuario.direccion = direccionInput.value;
    if(passwordInput.value) objUsuario.password = passwordInput.value;
    objUsuario.tipo = (adminInput.checked ? "1" : "0");

    const res = await fetch(urlEditarUsuario,
        {
            method: 'POST',
            body: JSON.stringify(objUsuario)
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

    if(res.msg === 'OK')  {
        alert('Se actualizó correctamente')

        limpiarHTML()
        obtenerUsuarios()
        formulario.reset()

        limpiarObjeto()
    }

    formulario.querySelector('button[type="submit"]').textContent = 'Agregar';

    editando = false

}

async function eliminarUsuario(id) {

    const res = await fetch(urlBorrarUsuario,
        {
            method: 'POST',
            body: JSON.stringify({'idUsuario': id})
        })
        .then(respuesta => respuesta.json())
        .then(data => data)
        .catch(error => alert(error))

        if(res.msg === 'OK') {
            alert('Se borró exitosamente')

            limpiarHTML()
            obtenerUsuarios()
            limpiarObjeto()
        }

}

function cargarUsuario(usuario) {
    const {idUsuario, nombres, apellidos, email, telefono, direccion, tipo} = usuario

    nombresInput.value = nombres
    apellidosInput.value = apellidos
    emailInput.value = email
    telefonoInput.value = telefono
    direccionInput.value = direccion
    adminInput.checked = (tipo == "1");

    objUsuario.idUsuario = idUsuario

    formulario.querySelector('button[type="submit"').textContent = 'Actualizar'
    editando = true
}

function limpiarHTML() {
    const divUsuarios = document.querySelector('.div-productos');
    while(divUsuarios.firstChild) {
        divUsuarios.removeChild(divUsuarios.firstChild)
    }
}

function limpiarObjeto() {
    objUsuario.idUsuario = ''
    objUsuario.nombre = ''
    objUsuario.marca = ''
    objUsuario.descripcion = ''
    objUsuario.precio = 0
    objUsuario.stock = 0
    objUsuario.categoria = ''
}