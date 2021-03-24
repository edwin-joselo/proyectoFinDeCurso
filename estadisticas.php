<?php
//incluimos el fichero con el que trabajamos con la BD
    include "./bd/conexion.php";
        
    //Funcion para obtener en un array los datos de la BD de un 'valor' en concreto
    //se utiliza para los graficos de Google Chart
    function datos_grafica(){    
        //conexion a la base de datos
        $conexion = abrir_conexion_PDO();
        //Consultamos los datos
        $sql = "SELECT * FROM denuncias_previas";
        $resultado = $conexion->query($sql);
        $i = 0;
        while($fila = $resultado->fetch()){
            $datos[$i] = array((int)$fila['0'], $fila['1'], $fila['2'], $fila['3']);
            $i++;
        }
        
        return $datos;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global/global.css">
    <link rel="stylesheet" href="./css/global/monitor.css">
    <link rel="stylesheet" href="./css/login/monitor.css">
    <link rel="stylesheet" href="./css/nosotros/monitor.css">
</head>
<body>

<?php
    include_once './maquetacion/index/cabecera.php';
    include_once './maquetacion/estadisticas/principal.php';
          

    //llamada a la funcion que obtiene los datos
    $datos = datos_grafica(); 
?>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>        
    <script type="text/javascript">

    //Inicializar los graficos de Google
    google.charts.load('current', {'packages':['table']});

    //Llamada a la funcion que va a crear el grafico "miPrimerGrafico"
    google.charts.setOnLoadCallback(miPrimerGrafico);

    //funcion para crear el grafico "miPrimerGrafico"
    function miPrimerGrafico() {
        //variable que almacena los datos extraidos de la BD en formato array
        var cargarDatos = <?php echo json_encode($datos); ?>;
        //crearmos los datos que vamos a visualizar de Array a formato Tabla
        var data = new google.visualization.arrayToDataTable(cargarDatos);

        var table = new google.visualization.Table(document.getElementById('miPrimerGrafico'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }
    </script> -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            
            //Cargar los gráficos y el paquete del núclero de gráficos
            google.charts.load('current', {
                'packages':['geochart'],
                'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
            });
            
            //Llamada del callback para pintar los gráficos
            google.charts.setOnLoadCallback(miPrimerGrafico);
            
            
            function miPrimerGrafico() {
                var data = google.visualization.arrayToDataTable([
                    ['Country', 'Popularity'],
                    ['Germany', 200],
                    ['United States', 300],
                    ['Brazil', 400],
                    ['Canada', 500],
                    ['France', 600],
                    ['RU', 700],
                    ['Benin', 10000]
                ]);

                var options = {};
                var chart = new google.visualization.GeoChart(document.getElementById('miPrimerGrafico'));
                chart.draw(data, options);
            }
    </script>
    
</body>
</html>