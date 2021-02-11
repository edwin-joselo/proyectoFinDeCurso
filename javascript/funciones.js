window.addEventListener('DOMContentLoaded', setUp);

function setUp() {
    const botonRegistro = document.querySelector('#btnRegistro');
    botonRegistro.addEventListener('click', mostrarFormularioRegistro);
}

function mostrarFormularioRegistro() {

    Swal.fire({
        title: 'Insertar un nuevo usuario',
        html: `
            <form action="" class="formulario-registro" id="formularioRegistro">
                <input type="hidden" value="insertar" name="tipo_operacion"/>
                <label>DNI: </label>
                <input type="text" name="dni" />

                <label>Nombre: </label>
                <input type="text" name="nombre" />

                <label>Apellidos: </label>
                <input type="text" name="apellidos" />

                <label>Fecha de nacimiento: </label>
                <input type="date" name="fecha_nacimiento" />

                <label>Teléfono: </label>
                <input type="text" name="telefono" />

                <label>Email: </label>
                <input type="email" name="email" />

                <label>Contraseña: </label>
                <input type="text" name="contrasenia" />

                <label>Repetir contraseña: </label>
                <input type="text" name="repetir_contrasenia" />

                <label>Foto: </label>
                <input type="file" name="foto" />
            </form>
        `,
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: 'darkred',
        confirmButtonText: 'Aceptar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const datos = document.querySelector('#formularioRegistro');
            console.log(datos);
            const datos_insertar = new FormData(datos);
            var url = './php/operaciones.php';

            try {
                const response = await fetch(url, { method: 'post', body: datos_insertar });
                const data = await response.json();
                console.log(data);
            } catch (e) {
                console.error(e.message);
            }

            // Swal.fire(
            //     'Añadido!',
            //     'Your file has been deleted.',
            //     'success'
            // )
        } else {
            Swal.fire(
                'Cancelado!',
                'Your file has been deleted.',
                'error'
            )
        }
    })
}