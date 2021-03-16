window.addEventListener('DOMContentLoaded', initMap)

function initMap() {
    //Ponemos el mapa
    let centerPosition = { lat: 37.66404630613665, lng: -1.696978364914519 };
    

    let map = new google.maps.Map(
        tagDivMap,
        {
            center: centerPosition,
            scrollwheel: false,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
    );

    //Creamos un marcador
    let markerSchool = new google.maps.Marker({
        position: centerPosition,
        map: map
    });

    let markerTrainStation = new google.maps.Marker({
        position: new google.maps.LatLng(37.672091, -1.696290),
        map: map
    });

    , 
    let panorama = new google.maps.StreetViewPanorama(
        tagDivPanorama,
        {
            position: schoolPosition,
            pov: { heading: 150, pitch: 10 }
        }
    );
}
