<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./javascript/sweetalert2.js"></script>
    <link rel="stylesheet" href="./css/sweetalert2.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/movil.css">
    <link rel="stylesheet" href="./css/tablet.css">
    <link rel="stylesheet" href="./css/monitor.css">
    <link rel="stylesheet" href="./css/dark.css">
</head>
<body>
<<<<<<< HEAD
    <button id="btnRegistro">Registro</button>
    <?php
    require_once 'bd/conexion.php';
    require_once 'php/consultasBD.php';
    $sentencia = new consultas();
    $mostrardatos=$sentencia->selectPersonas();
    foreach($mostrardatos as $res){
        echo '<p>'.$res['dni'].'</p>';
        echo '<p>'.$res['nombre'].'</p>';
        echo '<p>'.$res['apellidos'].'</p>';
        echo '<p>'.$res['fecha_nacimiento'].'</p>';
        echo '<p>'.$res['telefono'].'</p>';
    }
    ?>
=======
>>>>>>> ceae30cb30f3699a6e67293a7a688231ba26db12

    <?php
    echo '<div class="cabecera">';
    include_once './maquetacion/cabecera.php';
    include_once './maquetacion/menu.php';
    echo '</div>';
    include_once './maquetacion/principal.php';
    include_once './maquetacion/pie.php';
    ?>

<<<<<<< HEAD
    <script src="./javascript/funciones.js"></script>
    <script src="./javascript/funcionesLogin.js"></script>
=======
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfulz2jpJ3DGJQRHy-cpOjARGoGIUSLY8&callback=initMap">
    </script>
    <!-- <script src="./javascript/js.js"></script> -->
    <script>
        function initMap() {
            //Ponemos el mapa
            let centerPosition = { lat: 37.664289902583164, lng: -1.6965250818394138 };
            let schoolPosition = { lat: 37.664289902583164, lng: -1.6965250818394138 };

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
                position: schoolPosition,
                map: map
            });

            let markerTrainStation = new google.maps.Marker({
                position: new google.maps.LatLng(37.672091, -1.696290),
                map: map
            });

            let panorama = new google.maps.StreetViewPanorama(
                tagDivPanorama,
                {
                    position: schoolPosition,
                    pov: { heading: 150, pitch: 10 }
                }
            );
        }
    </script>
>>>>>>> ceae30cb30f3699a6e67293a7a688231ba26db12
</body>
</html>
