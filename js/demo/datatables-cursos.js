// Call the dataTables jQuery plugin
$(document).ready(function() {
    var dataTable = $('#dataTable').DataTable( {
        "ajax":{
            url: "../controllers/CursoTableController.php?do=getTable",
        },
    });

    function campoVacio(campo) {
        if ($(campo).val() == '') {
            $(campo).addClass('border-danger');
            if ($(texto_alarma + ' ' + campo).length) {
                $(texto_alarma).addClass(campo).insertAfter(campo);
            }
            setTimeout((e) => {
                $(campo).removeClass('border-danger');
                $('.text-danger').remove();
            }, 3000);
        }
    }

    var texto_alarma = "<span class='text-danger'>Este campo es obligatorio</span>"
    $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        
        var id_curso = $('#id_curso').val();
        campoVacio('#id_libro')
        var id_libro = $('#id_libro').val();
        campoVacio('#anio')
        var anio = $('#anio').val();
        campoVacio('#nivel')
        var nivel = $('#nivel').val();
        campoVacio('#seccion')
        var seccion = $('#seccion').val();
        var sala = $('#sala').val();
        if(id_libro != '' && anio != '' && nivel != '' && seccion != '') {
            $.ajax({
                url:"../controllers/CursoTableController.php?do=ingresar",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data) {
                    console.log(data);
                    $('#formulario')[0].reset();
                    $('#modalCurso').modal('hide');
                    dataTable.ajax.reload();
                } 
            });
        }
    });

    $(document).on('click', '.boton-crear', function(){
        $('#modalCurso').modal('show');
        $('#formulario')[0].reset()
        $('.modal-title').text("Crear Curso");
        $('#action').val("Crear");
        $('#operacion').val("Crear");
    });

    $(document).on('click', '.editar', function(){		
        var id_curso = $(this).attr("id");		
        $.ajax({
            url:"../controllers/CursoTableController.php?do=obtenerCurso",
            method:"POST",
            data:{id_curso:id_curso},
            dataType:"json",
            success:function(data) {
                console.log(data);	
                $('#modalCurso').modal('show');

                $('#id_libro').val(data[1]);
                $('#anio').val(data[2]);
                $('#nivel').val(data[3]);
                $('#seccion').val(data[4]);
                $('#sala').val(data[5]);
                $('.modal-title').text("Editar Curso "+data[3]+" "+data[4]);
                $('#id_curso').val(id_curso);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    });

    $(document).on('click', '.borrar', function(){
        var id_curso = $(this).attr("id");
        if(confirm("Esta seguro de borrar este registro: " + id_curso)) {
            $.ajax({
                url:"../controllers/CursoTableController.php?do=borrar",
                method:"POST",
                data:{id_curso:id_curso},
                success:function(data)
                {
                console.log(data);
                dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });
});
