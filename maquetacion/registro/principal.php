<main>
    <a href="./index.php">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
        </svg>
    </a>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div>
            <h1>Registrarse</h1>
            <hr>
        </div>
        <div>
            <p>DNI: </p>
            <input type="text" name="dni" placeholder="Introduce tu dni" <?php mostrar_value('dni') ?>>
        </div>
        <div>
            <p>Nombre: </p>
            <input type="text" name="nombre" placeholder="Introduce tu nombre" <?php mostrar_value('nombre') ?>>
        </div>
        <div>
            <p>Apellidos: </p>
            <input type="text" name="apellidos" placeholder="Introduce tus apellidos" <?php mostrar_value('apellidos') ?>>
        </div>
        <div>
            <p>Fecha de nacimiento: </p>
            <input type="date" name="fecha_nacimiento" placeholder="Introduce tu fecha de nacimiento" <?php mostrar_value('fecha_nacimiento') ?>>
        </div>
        <div>
            <p>Teléfono: </p>
            <input type="text" name="telefono" placeholder="Introduce tu telefono" <?php mostrar_value('telefono') ?>>
        </div>
        <div>
            <p>Email: </p>
            <input type="email" name="email" placeholder="Introduce tu email" <?php mostrar_value('email') ?>>
        </div>
        <div>
            <p>Contraseña: </p>
            <input type="password" name="contrasenia" placeholder="Introduce tu contraseña" <?php mostrar_value('contrasenia') ?>>
        </div>
        <div>
            <p>Repetir Contraseña: </p>
            <input type="password" name="repetir_contrasenia" placeholder="Repite tu contraseña" <?php mostrar_value('repetir_contrasenia') ?>>
        </div>
        <input type="submit" name="registrarse" value="Registrarse"/>
    </form>
</main>