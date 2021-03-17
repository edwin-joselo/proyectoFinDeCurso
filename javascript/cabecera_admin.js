window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {

    document.querySelector('#spanCabeceraAdmin').addEventListener('click', dirigirMenu);

    function dirigirMenu() {
        window.location.href = "./menu.php";
    }
}
