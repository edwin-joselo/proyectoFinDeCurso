<?php
    session_start();
 
    include '../bd/conexion.php';

    $conexion = abrir_conexion_PDO();
    
    require_once './mpdf/vendor/autoload.php';

    $pdf = new \Mpdf\Mpdf();
    
    $pdf->SetTitle("Denuncia");    
    
    $stylesheet = file_get_contents('./../css/pdf/estiloPDF.css'); 
    $pdf->WriteHTML($stylesheet,1);
         
    $cabecera = "<p>Web policial</p>";
    $pdf->SetHTMLHeader($cabecera);     
       
    $pie = "<p>Fecha de impreso: {DATE j-m-Y}</p>";        
    $pdf->SetHTMLFooter($pie);

    $sql = 'SELECT * FROM denuncias_previas 
            INNER JOIN denuncias ON denuncias.cod = denuncias_previas.cod 
            INNER JOIN delitos ON denuncias.delito = delitos.cod 
            INNER JOIN usuarios ON denuncias_previas.dni = usuarios.dni
            WHERE aprobado="si" AND denuncias.cod = '.$_POST['cod_denuncia'];
    $resultado = $conexion->query($sql);   
    if($fila = $resultado->fetch()){
        $cod = $fila[0];
        $delito = $fila[13];
    
        $pdf->WriteHTML('<h1>Denuncia nº: '.$cod.' </h1>');

        $pdf->WriteHTML('<p>En esta denuncia, aprobada en la web policial en '.$fila['fecha'].', fue presentada por '.$fila['nombre'].
            ' '.$fila['apellidos'].' de DNI '.$fila['dni'].' y con residencia en '.$fila['comunidad_autonoma'].'. 
            La causa de la denuncia es por '.$delito.', suceso ocurrido en '.$fila['fecha_delito'].'.</p>
            <p>Según el agente encargado de aprobar la denuncia: "'.$fila['descripcion_policia'].'."</p>'
        );
        if(!is_null($fila['foto'])){
            $pdf->WriteHTML('<p>A continuación se muestra la prueba fotográfica presentada por el denunciante: </p>
            <img src="data:image/*;base64,'.$fila['foto'].'" />');
        }
        
        $pdf->Output('denuncia_'.$cod.'.pdf','D');
    } 
