'use strict';

// window.addEventListener('DOMContentLoaded', inicializar);

// function inicializar() {
//     document.querySelector('#tButPobla').addEventListener('click', inputPoblacion);
//     const url = 'http://localhost/practica_mapa/web-service/post.php?ccaa';

//     fetch(url)
//         .then(response => response.json())
//         .then(llenarSelectCA)
//         .catch(console.error);
// }


// function llenarSelectCA(comunidades) {
//     const nSelCA = document.querySelector('#tSelCA');

//     const nOptCA = document.createElement('option');
//     nSelCA.addEventListener('change', selectProvincia);
//     nSelCA.appendChild(nOptCA);

//     const nTxtCA = document.createTextNode('--Seleccionar comunidad--');
//     nOptCA.appendChild(nTxtCA);

//     for(const comunidad of comunidades) {
//         const nOptCA = document.createElement('option');
//         nOptCA.setAttribute('value', comunidad.ccaa);
//         nSelCA.addEventListener('change', selectProvincia);
//         nSelCA.appendChild(nOptCA);

//         const nTxtCA = document.createTextNode(comunidad.ccaa);
//         nOptCA.appendChild(nTxtCA);
//     }
// }

// function inputPoblacion() {
//     const valuePobla = document.querySelector('#tInpPobla').value;
//     const cod = 'inpPoblacion='+valuePobla;

//     const url = 'http://localhost/practica_mapa/web-service/post.php?'+cod;

//     fetch(url)
//         .then(response => response.json())
//         .then(llenarSelectPobla)
//         .catch(console.error);
// }

// function selectProvincia(){
//     const valueCA = document.querySelector('#tSelCA').value;
//     const codCA = "ccaa="+valueCA;

//     fetch(`http://localhost/practica_mapa/web-service/post.php?${codCA}`)
//         .then(response => response.json())
//         .then(data => { 
//             const nSelProvi = document.querySelector('#tSelProvincia');
//             const nSelPobla = document.querySelector('#tSelPobla');
//             const nDivCP = document.querySelector('#tDivCP');

//             while(nSelProvi.hasChildNodes()) {
//                 nSelProvi.removeChild(nSelProvi.lastChild);
//             }

//             while(nSelPobla.hasChildNodes()) {
//                 nSelPobla.removeChild(nSelPobla.lastChild);
//             }

//             while(nDivCP.hasChildNodes()) {
//                 nDivCP.removeChild(nDivCP.lastChild);
//             }

//             const nOptProvi = document.createElement('option');
//             nSelProvi.addEventListener('change', selectPoblacion);
//             nSelProvi.appendChild(nOptProvi);

//             const nTxtProvi = document.createTextNode('--Seleccionar provincia--');
//             nOptProvi.appendChild(nTxtProvi);        

//             for(const provincia of data) {
//                 const nOptProvi = document.createElement('option');
//                 nOptProvi.setAttribute('value', provincia.provincia);
//                 nSelProvi.addEventListener('change', selectPoblacion);
//                 nSelProvi.appendChild(nOptProvi);

//                 const nTxtProvi = document.createTextNode(provincia.provincia);
//                 nOptProvi.appendChild(nTxtProvi);
//             }
//         })
//         .catch(console.error);
// }

// function selectPoblacion(){
//     const valueCA = document.querySelector('#tSelCA').value;
//     const valueProvincia = document.querySelector('#tSelProvincia').value;
//     const codCA = `ccaa=${valueCA}`;
//     const codProvincia = `&provincia=${valueProvincia}`;
//     const cod = codCA+codProvincia;

//     fetch(`http://localhost/practica_mapa/web-service/post.php?${cod}`)
//         .then(response => response.json())
//         .then(llenarSelectPobla)
//         .catch(console.error);

// }

// function llenarSelectPobla(data) {
//     const nSelPobla = document.querySelector('#tSelPobla');
//     const nDivCP = document.querySelector('#tDivCP');

//     while(nSelPobla.hasChildNodes()) {
//         nSelPobla.removeChild(nSelPobla.lastChild);
//     }

//     while(nDivCP.hasChildNodes()) {
//         nDivCP.removeChild(nDivCP.lastChild);
//     }

//     const nOptPobla = document.createElement('option');
//     nSelPobla.addEventListener('change', crearRadCP);
//     nSelPobla.appendChild(nOptPobla);

//     const nTxtPobla = document.createTextNode('--Seleccionar poblacion--');
//     nOptPobla.appendChild(nTxtPobla);

//     for(const poblacion of data) {
//         const nOptPobla = document.createElement('option');
//         nOptPobla.setAttribute('value', poblacion.poblacion);
//         nSelPobla.addEventListener('change', crearRadCP);
//         nSelPobla.appendChild(nOptPobla);

//         const nTxtPobla = document.createTextNode(poblacion.poblacion);
//         nOptPobla.appendChild(nTxtPobla);
//     }
// }

// function crearRadCP(e) {

//     const valuePobla = e.currentTarget.value;
//     const cod = `&poblacion=${valuePobla}`;

//     fetch("http://localhost/practica_mapa/web-service/post.php?"+cod)
//         .then(response => response.json())
//         .then(data => { 
//             const nDivCP = document.querySelector('#tDivCP');

//             while(nDivCP.hasChildNodes()) {
//                 nDivCP.removeChild(nDivCP.lastChild);
//             }

//             for(const CP of data) {
//                 const nInpCP = document.createElement('input');
//                 nInpCP.setAttribute('type', 'radio');
//                 nInpCP.setAttribute('name', `cp${valuePobla}`);
//                 nInpCP.setAttribute('id', CP.codigopostal);
//                 nInpCP.addEventListener('change', obtenerDireccion);
//                 nDivCP.appendChild(nInpCP);

//                 const nLblCP = document.createElement('label');
//                 nLblCP.setAttribute('for', CP.codigopostal);
//                 nDivCP.appendChild(nLblCP);

//                 const nTxtCP = document.createTextNode(CP.codigopostal);
//                 nLblCP.appendChild(nTxtCP);

//                 // const nBr = document.createElement('br');
//                 // nDivCP.appendChild(nBr);
//             }
//         })
//         .catch(console.error);    
// }

// function obtenerDireccion(e) {
//     const cp = e.currentTarget.id;
//     const valuePobla = document.querySelector('#tSelPobla').value;
//     const codPobla = `&poblacion=${valuePobla}`;
//     const cod = `cp=${cp}${codPobla}`;
//     const url = `http://localhost/practica_mapa/web-service/post.php?${cod}`;
//     fetch(url)
//         .then(response => response.json())
//         .then(respuesta => {
//             for (const data of respuesta){
//                 let centerPosition = {lat: parseFloat(data.lon), lng: parseFloat(data.lat)};

//                 let map = new google.maps.Map(
//                     tagDivMap,
//                     {
//                         center: centerPosition,
//                         scrollwheel: true,
//                         zoom: 15,
//                         mapTypeId: google.maps.MapTypeId.ROADMAP
//                     }
//                 );

//                 let marker = new google.maps.Marker({
//                     position: centerPosition,
//                     map: map,
//                 });


//                 let panorama = new google.maps.StreetViewPanorama(
//                     tagDivPanorama,
//                     {
//                         position: centerPosition,
//                         pov: {heading: 150, pitch: 10}
//                     }
//                 );

//             }
//         }
//         )
//         .catch(console.error);

// }

function initMap() {
    //Ponemos el mapa
    let centerPosition = { lat: 37.66441, lng: -1.69651 };

    let map = new google.maps.Map(
        tagDivMap,
        {
            center: centerPosition,
            scrollwheel: true,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
    );


    let marker = new google.maps.Marker({
        position: centerPosition,
        map: map,
    });


    // let panorama = new google.maps.StreetViewPanorama(
    //     tagDivPanorama,
    //     {
    //         position: centerPosition,
    //         pov: { heading: 150, pitch: 10 }
    //     }
    // );

}