<header>
    <div>
        <span>WEB POLICIAL</span>
    </div>
    <div>
        <img src="./imagenes/escudo-policia.png" alt="">
    </div>

    <div>
        <?php
        if(isset($_SESSION['dni'])){
            echo $_SESSION['dni'];
        }
        ?>
    </div>

    <?php if(isset($_SESSION['dni'])){ ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="cerrar_sesion" value="CERRAR SESIÓN">
        </form>
    <?php } ?>
</header>