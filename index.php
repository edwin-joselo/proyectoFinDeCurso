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
    <link rel="stylesheet" href="./css/index/monitor.css">
    <link rel="stylesheet" href="./css/dark.css">
</head>
<body>

    <?php
    echo '<div class="cabecera">';
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/index/menu.php';
    echo '</div>';
    include_once './maquetacion/index/principal.php';
    include_once './maquetacion/index/pie.php';
    ?>

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
        }
    </script>
</body>
</html>
