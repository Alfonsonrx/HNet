$(document).on('click', '.drop-rol', function(){		
    var nombre_asign = $(this).text();
    var inpt_rol = $('#rol')
    inpt_rol.val(nombre_asign);
});