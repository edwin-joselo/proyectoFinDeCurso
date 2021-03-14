window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(e) {
    document.querySelector('main>a>svg').addEventListener('mouseover', cambiarColor);
    document.querySelector('main>a>svg').addEventListener('mouseout', quitarColor);

    function cambiarColor(e) {
        document.querySelector('main>a>svg>path').setAttribute('fill', 'rgb(181, 222, 255)')
    }

    function quitarColor(e) {
        document.querySelector('main>a>svg>path').setAttribute('fill', 'white')
    }
}
