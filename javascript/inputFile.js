window.addEventListener('DOMContentLoaded',
    jQuery("input[type=file]").change(function(e){
        var filename = e.currentTarget.files[0].name
        var idname = jQuery(this).attr('id');
        if(e.currentTarget.files.length > 1) {
            jQuery('span.'+idname).next().find('span').html(`${e.currentTarget.files.length} archivos subidos`);
        }else {
            jQuery('span.'+idname).next().find('span').html(filename);
        }
    })
)