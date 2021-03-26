<nav class="nav-index">
    <h1>POLICIA NACIONAL</h1>
    <hr>
    <ul id="menu">
<?php 
    if(!isset($_SESSION['dni'])) { ?>
        <li><a id="btnLogin" href="./login.php">Iniciar Sesión</a></li>
        <li><a id="btnRegistro" href="./registro.php">Registrarse</a></li>
<?php 
    }else{
?>
        <li><a href="./denuncia.php">Poner denuncia</a></li>
<?php    
    }
?>
            <li><a href="./estadisticas.php">Estadísticas</a></li>
            <li><a href="./nosotros.php">Sobre nosotros</a></li>
            <li><a href="#contacto">Contacto</a></li>
    </ul>
    <hr>
    <div class="presentacion">
        <h3>¿En qué consiste esta página web?</h3>
        <p>Es una aplicación web que nos permite interponer denuncias on-line además de obtener información relacionada con la policía.</p>
        <h3>¿Cómo presentar una denuncia?</h3>
        <p>Hay que seguir los siguientes pasos:</p>
        <ul>
            <li>Registrarse en esta página en caso de que no tengamos una cuenta.</li>
            <li>Una vez tenemos una sesión iniciada, hacer click en la opción "poner denuncia" que aparecerá en el menú.</li>
            <li>Rellenar los datos del formulario (con la posibilidad de subir fotos).</li>
            <li>Enviar la denuncia y esperar.</li>
            <li>Se le enviará un correo cuando su denuncia sea aceptada.</li>
        </ul>
    </div>
</nav>