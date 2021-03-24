'use strict';

window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(_) {

    prepararPaises();
}

async function prepararPaises() {

    try {
        const response = await fetch('https://restcountries.eu/rest/v2/all');
        const data = await response.json();
        mostrarPaises(data);
    } catch (e) {
        console.error(e.message);
    }

    function mostrarPaises(paises) {
        const nSelect = document.querySelector('#nSelPaisesResidencia');
        paises.forEach(({ name, translations }) => {
            const nOption = document.createElement('option');
            nOption.setAttribute('value', name);
            nSelect.appendChild(nOption);
            const nText = document.createTextNode(translations.es);
            nOption.appendChild(nText);
        });
    }
}