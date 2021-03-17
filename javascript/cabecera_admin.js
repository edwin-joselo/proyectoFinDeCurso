window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {

    document.querySelector('#cabeceraAdmin').addEventListener('click', dirigirMenu);

    function dirigirMenu() {
        window.location.href = "./menu.php";
    }
}
