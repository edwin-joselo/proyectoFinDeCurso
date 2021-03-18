'use strict';

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

}