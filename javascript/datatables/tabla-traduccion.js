window.addEventListener('DOMContentLoaded', (function () {
    $('#example').DataTable({
        language: {
            info: 'Mostrando _START_-_END_ de _TOTAL_ Usuarios',
            lengthMenu: 'Mostrar _MENU_ usuarios por página',
            zeroRecords: 'No se han encontrado registros',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(filtrado de _MAX_ registros totales)',
            search: 'Criterio de búsqueda:',
            paginate: {
                previous: 'Anterior',
                next: 'Siguiente',
                first: 'Primera',
                last: 'Última'
            }
        }
    });
}));