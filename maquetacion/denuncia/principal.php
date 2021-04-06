<main>
    <a href="./index.php">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
        </svg>
    </a>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <div>
            <h1>Poner denuncia</h1>
            <hr>
        </div>
        <div>
            <p>Fecha del delito: </p>
            <input type="date" name="fecha_delito" <?php mostrar_value('fecha_delito') ?>>
        </div>
        <div>
            <p>Descripción: </p>
            <textarea name="textarea" rows="20" cols="50" placeholder="Describa lo sucedido" ><?php mostrar_text_area('textarea') ?></textarea>
        </div>
        <div>
            <p>Pruebas fotográficas (opcional): </p>
            <span class="inputfile">
                <input type="hidden" value="" name="foto" id="outputHidden">
                <input type="file" name="inputfile" id="inputfile" accept="image/*" onchange="ResizeImage()" />
            </span>
            <label for="inputfile">
                <span>Elige un archivo</span> 
            </label>
        </div>
        <input class="pointer" type="submit" name="enviar_denuncia" value="Enviar"/>
    </form>
</main>