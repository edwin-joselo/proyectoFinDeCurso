window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {

    document.querySelector('#spanCabeceraUsuario').addEventListener('click', dirigirLogin);

    function dirigirLogin() {
        window.location.href = "./index.php";
    }
}


