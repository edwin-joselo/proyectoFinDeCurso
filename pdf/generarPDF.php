<?php

    session_start();
 
    //incluimos los ficheros con los que trabajamos
    include '../bd/conexion.php';
    include '../bd/consultas.php';
    include '../php/funciones.php';

    //conexion a la base de datos
    $conexion = abrir_conexion_PDO();
    
    //cargamos la libreria donde esta el mpdf
    require_once __DIR__ . './mpdf/vendor/autoload.php';

    //crear un objeto PDF
    $pdf = new \Mpdf\Mpdf();
    
    //titulo del documento que se ve en el navegador
    $pdf->SetTitle("Denuncia");    
    
    //La ruta a mi css con los estilos del pdf
    $stylesheet = file_get_contents('./../css/pdf/estiloPDF.css'); 
    $pdf->WriteHTML($stylesheet,1);
         
    //creamos la cabecera del pdf (aparecera en todas las hojas)
    $cabecera = "<p>Web policial</p>";
    $pdf->SetHTMLHeader($cabecera);     
       
    //creamos el pie del pdf (aparecera en todas las hojas)
    $pie = "<p>Página: {PAGENO} Fecha de impreso: {DATE j-m-Y}</p>";        
    $pdf->SetHTMLFooter($pie);

    $sql = 'SELECT * FROM denuncias_previas 
    INNER JOIN denuncias ON denuncias.cod = denuncias_previas.cod 
    INNER JOIN delitos ON denuncias.delito = delitos.cod 
    INNER JOIN usuarios ON denuncias_previas.dni = usuarios.dni
    WHERE aprobado="si" AND denuncias.cod = '.$_POST['cod_denuncia'];
    $resultado = $conexion->query($sql);   
    //utilizando fetch (array asociativo y numerico)
    if($fila = $resultado->fetch()){
        $cod = $fila[0];
        $delito = $fila[13];
    
    //escribimos codigo en formato HTML
    $pdf->WriteHTML('<h1>Denuncia nº: '.$cod.' </h1>');

    //datos extraidos de la BD
        $pdf->WriteHTML('<p>En esta denuncia, aprobada en la web policical en '.$fila['fecha'].', fue presentada por '.$fila['nombre'].
            ' '.$fila['apellidos'].' de DNI '.$fila['dni'].' y con residencia en '.$fila['comunidad_autonoma'].'. 
            La causa de la denuncia es por '.$delito.', suceso ocurrido en '.$fila['fecha_delito'].'.</p>
            <p>Según el agente encargado de aprobar la denuncia: "'.$fila['descripcion_policia'].'."</p>'
        );
        if(!is_null($fila['foto'])){
            $pdf->WriteHTML('<p>A continuación se muestra la prueba fotográfica presentada por el denunciante: </p>
            <img src="data:image/*;base64,'.$fila['foto'].'" />');
        }
        
        //generamos el fichero pdf
        //$pdf->Output();
        $pdf->Output('denuncia_'.$cod.'.pdf','D');
        //$pdf->Output('ejemplo.pdf','I');
    } 
