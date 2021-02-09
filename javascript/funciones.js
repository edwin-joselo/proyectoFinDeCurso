window.addEventListener('DOMContentLoaded', setUp);

function setUp() {
    const botonRegistro = document.querySelector('#btnRegistro');
    botonRegistro.addEventListener('click', mostrarFormularioRegistro);
}

function mostrarFormularioRegistro() {

    Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Cool'
    });
}