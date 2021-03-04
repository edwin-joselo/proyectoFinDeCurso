<?php
    session_start();

    if (isset($_POST['cerrar'])){
        session_unset();
        header("Location: index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pagina principal</h1>
    <?php
        echo $_SESSION['usuario'];
    ?>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" >
            <input type="submit" name="cerrar" value="ELIMINAR SESION"/>
    </form>
    
</body>
</html>