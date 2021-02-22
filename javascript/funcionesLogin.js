window.addEventListener('DOMContentLoaded', setUp);

function setUp() {
    const botonLogin = document.querySelector('#btnLogin');
    botonLogin.addEventListener('click', mostrarFormularioInicio);
}

function mostrarFormularioInicio() {

    Swal.fire({
        title: 'Insertar un nuevo usuario',
        html: `
            <form action="" id="formularioLogin" class="formulario-login">
                <input type="hidden" value="loguear" name="tipo_operacion"/>
                <label>IDENTIFICACIÓN: </label>
                <input type="text" name="usuario"/>

                <label>CONTRASEÑA: </label>
                <input type="password" name="contrasenia" />
            </form>
        `,
        showCancelButton: true,
    
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            const datos = document.querySelector('#formularioLogin');
            const datos_login = new FormData(datos);
            var url = './php/operaciones.php';


            fetch(url, {
                method: 'post',
                body: datos_login
            })
                .then(data => data.json())
                .then(data => {
                    console.log('Exito', data);
                    if(data){
                        Swal.fire({
                            title: 'Recibido',
                            text: 'Comprobando datos...',
                            type: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        })
                        .then(function(){
                            window.location.href = 'principal.php';
                        })
                    }else{
                        exit();
                    }
                })
                .catch((e) => {
                    console.log(e.message)
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