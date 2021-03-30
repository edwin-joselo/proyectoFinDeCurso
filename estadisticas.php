<?php 
    session_start();

    require_once './bd/conexion.php';
    require_once './bd/consultas.php';
    require_once './php/funciones.php';

    $conexion = abrir_conexion_PDO();

    if(isset($_POST['cerrar_sesion'])){
        unset($_SESSION['dni']);
    }

    $errores = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./admin/css/denuncias/monitor.css">
    <link rel="stylesheet" href="./css/denuncia/monitor.css">
</head>
<body>

    <?php 

        $datos_queso = datos_grafica_queso_ccaa($conexion);

        include_once './maquetacion/index/cabecera.php'; 
        include_once './maquetacion/estadisticas/principal.php';
        include_once './maquetacion/index/pie.php';
    ?>

    <script src="./javascript/login.js"></script>
    <script src="./javascript/cabecera_usuario.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(pintarGraficaQueso);
        google.charts.setOnLoadCallback(pintarGraficaColumnas);

        function pintarGraficaQueso() {
            var cargarDatos = <?php echo json_encode($datos_queso); ?>

            var data = google.visualization.arrayToDataTable(cargarDatos);

            var options = {
                backgroundColor: '#7a9ad8',
                title: 'Denuncias por CCAA',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('graficaQueso'));
            chart.draw(data, options);
        }
        
        function pintarGraficaColumnas() {
            var data = new google.visualization.arrayToDataTable([
                ['delito', 'numero' , { role: "style" } ],    
                <?php
                    datos_grafica_columnas_delitos($conexion);
                ?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { 
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" 
                },
                2]);

            var options = {
                backgroundColor: '#7a9ad8',
                title: "Delitos",
                width: 900,
                height: 300,
                bar: {groupWidth: "90%"},
                legend: { position: "none" },
                vAxis: {
                    title: 'Cantidad'
                },
                hAxis: {
                    title: 'Tipo'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('graficaColumnas'));
            chart.draw(view, options);
        }
        
    </script>
</body>
</html>