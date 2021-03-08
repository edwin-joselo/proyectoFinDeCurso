window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {
    document.querySelector('main>svg').addEventListener('mouseover', cambiarColor);
    document.querySelector('main>svg').addEventListener('mouseout', quitarColor);
    document.querySelector('main>svg').addEventListener('click', volverIndex);

    function cambiarColor(e) {
        document.querySelector('main>svg>path').setAttribute('fill', 'rgb(181, 222, 255)')
    }

    function quitarColor(e) {
        document.querySelector('main>svg>path').setAttribute('fill', 'white')
    }

    function volverIndex(e) {
        window.location = './index.php';
    }
}


