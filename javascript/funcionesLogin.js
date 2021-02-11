window.addEventListener('DOMContentLoaded', setUp);

function setUp() {
    const botonLogin = document.querySelector('#btnLogin');
    botonLogin.addEventListener('click', mostrarFormularioInicio);
}

function mostrarFormularioInicio() {

    Swal.fire({
        title: 'Insertar un nuevo usuario',
        html: `
            <form action="" id="logear" class="formulario-login">
                <input type="hidden" value="logear" name="tipo_operacion"/>
                <label>USUARIO: </label>
                <input type="text" name="usuario"/>

                <label>CONTRASEÑA: </label>
                <input type="password" name="contrasena" />
            </form>
        `,
        showCancelButton: true,
        // confirmButtonColor: 'green',
        // cancelButtonColor: 'darkred',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Aceptado',
                text: 'Iniciando sesión...',
                type: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(function(){
                window.location.href = 'principal.php';
            })
        } else {
            Swal.fire(
                'Cancelado!',
                'Your file has been deleted.',
                'error'
            )
        }
    })
}