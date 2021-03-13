window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {
    document.querySelector('.info-cabecera').addEventListener('click', dirigirLogin);
}

function dirigirLogin(e) {
    window.location.href = "./index.php";
}