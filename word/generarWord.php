<?php

require_once '../bd/conexion.php';
require_once './vendor/phpoffice/phpword/bootstrap.php';

function setImageValue($search, $replace)
    {
        // Sanity check
        if (!file_exists($replace))
        {
            return;
        }

        // Delete current image
        $this->zipClass->deleteName('word/media/' . $search);

        // Add a new one
        $this->zipClass->addFile($replace, 'word/media/' . $search);
    }

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->getSettings()->setUpdateFields(true);

$section = $phpWord->addSection();

$header = $section->addHeader();
$header->addText(
    'Web policial',
    array('name' => 'Times New Roman', 'size' => 12, 'bold' => true) 
);

$footer = $section->addFooter();
$footer->addText(
    'Fecha de impreso: '.date('j-m-o')
);

$phpWord->getSettings()->setEvenAndOddHeaders(true);

//CONEXIÓN
$conexion = abrir_conexion_PDO();
$sql = 'SELECT * FROM denuncias_previas 
        INNER JOIN denuncias ON denuncias.cod = denuncias_previas.cod 
        INNER JOIN delitos ON denuncias.delito = delitos.cod 
        INNER JOIN usuarios ON denuncias_previas.dni = usuarios.dni
        WHERE aprobado="si" AND denuncias.cod = '.$_POST['cod_denuncia'];
$resultado = $conexion->query($sql);
if($fila = $resultado->fetch()){
    $cod = $fila[0];
    $delito = $fila[13];

    $section->addText(
        'Denuncia nº: '.$cod,
        array('name' => 'Times New Roman', 'size' => 30, 'bold' => true)
    );

    $section->addText(
        'En esta denuncia, aprobada en la web policial en '.$fila['fecha'].', fue presentada por '.$fila['nombre'].
            ' '.$fila['apellidos'].' de DNI '.$fila['dni'].' y con residencia en '.$fila['comunidad_autonoma'].'. La causa de la denuncia es por '.$delito.', suceso ocurrido en '.$fila['fecha_delito'].'.',
        array('name' => 'Times New Roman', 'size' => 12)
    );

    $fontStyleName = 'oneUserDefinedStyle';
    $phpWord->addFontStyle(
        $fontStyleName,
        array('name' => 'Times New Roman', 'size' => 12, 'color' => '1B2232')
    );

    $section->addText(
        'Según el agente encargado de aprobar la denuncia: "'.$fila['descripcion_policia'].'."',
        $fontStyleName
    );

    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="denuncia_'.$cod.'.doc"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
}
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("php://output");

?>