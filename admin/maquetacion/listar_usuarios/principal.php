<main>
    
    <div class="fondo">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
<?php
                listar_usuarios($conexion);
?>              
            </tbody>
            <tfoot>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </tfoot>
        </table>
    </div>
</main>