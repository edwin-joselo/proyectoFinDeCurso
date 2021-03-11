window.addEventListener('DOMContentLoaded', iniciar, 
    jQuery("input[type=file]").change(function(e){
        var filename = e.currentTarget.files[0].name
        var idname = jQuery(this).attr('id');
        if(e.currentTarget.files.length > 1) {
            jQuery('span.'+idname).next().find('span').html(`${e.currentTarget.files.length} archivos subidos`);
        }else {
            jQuery('span.'+idname).next().find('span').html(filename);
        }
    })
);

function iniciar(e) {
    document.querySelector('main>a>svg').addEventListener('mouseover', cambiarColor);
    document.querySelector('main>a>svg').addEventListener('mouseout', quitarColor);

    function cambiarColor(e) {
        document.querySelector('main>a>svg>path').setAttribute('fill', 'rgb(181, 222, 255)')
    }

    function quitarColor(e) {
        document.querySelector('main>a>svg>path').setAttribute('fill', 'white')
    }
}
