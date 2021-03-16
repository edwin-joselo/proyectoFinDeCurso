<header>
    <?php if(isset($_SESSION['policia'])){ ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="cerrar_sesion" value="CERRAR SESIÓN">
        </form>
    <?php } ?>
</header>