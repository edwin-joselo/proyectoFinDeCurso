<main>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div>
            <h1>Iniciar sesión</h1>
            <hr>
        </div>
        <div>
            <p>Número de placa:</p>
            <input type="text" name="num_placa" placeholder="Introduce tu placa" <?php mostrar_value('num_placa'); ?>>
        </div>
        <div>
            <p>Contraseña:</p>
            <input type="password" name="contrasenia" placeholder="Introduce tu contraseña">
        </div>
        <input type="submit" name="iniciar_sesion" value="Iniciar Sesión">
    </form>
</main>