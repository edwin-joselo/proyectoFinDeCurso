<main>
    <a href="./menu.php">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
        </svg>
    </a>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <div>
            <h1>Delitos</h1>
            <hr>
        </div>
        <div>
            <?php
            comprobar_table_delitos($conexion);
            ?>
        </div>
        <hr>
        <div>
            <p>Nombre:</p>
            <input type="text" name="nombre">
        </div>
        <input class="pointer" type="submit" name="aniadir_delito" value="Añadir delito"/>
    </form>
</main>