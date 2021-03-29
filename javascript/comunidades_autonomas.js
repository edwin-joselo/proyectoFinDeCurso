'use strict';

window.addEventListener('DOMContentLoaded', iniciar);

function iniciar(_) {

    prepararPaises();
}

async function prepararPaises() {

    try {
        const response = await fetch('https://public.opendatasoft.com/api/records/1.0/search/?dataset=provincias-espanolas&q=&sort=provincia&facet=ccaa&facet=provincia');
        const data = await response.json();
        mostrarPaises(data.facet_groups[0].facets);
    } catch (e) {
        console.error(e.message);
    }

    function mostrarPaises(comunidades) {
        const nSelect = document.querySelector('#nSelComunidadAutonoma');
        comunidades.forEach(({ name }) => {
            const nOption = document.createElement('option');
            nOption.setAttribute('value', name);
            nSelect.appendChild(nOption);
            const nText = document.createTextNode(name);
            nOption.appendChild(nText);
        });
    }
}