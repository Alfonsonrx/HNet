// Call the dataTables jQuery plugin
$(document).ready(function() {
    var dataTable = $('#dataTable').DataTable( {
        "ajax":{
            url: "../controllers/CursoTableController.php?do=getTable",
        },
    });
$(document).on('submit', '#formulario', function(event){
    event.preventDefault();
    
    var id_curso = $('#id_curso').val();
    var id_libro = $('#run').val();
    var anio = $('#anio').val();
    var nombre = $('#nombre').val();
    var apellido_paterno = $('#apellido_paterno').val();
    var apellido_materno = $('#apellido_materno').val();
    if(id_curso != '' && nombre != '' && email != '') {
        $.ajax({
            url:"../controllers/AlumnoTableController.php?do=ingresar",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
            console.log(data);
            $('#formulario')[0].reset();
            $('#modalCurso').modal('hide');
            dataTable.ajax.reload();
            } 
        });
    }
    else {
        alert("Algunos campos son obligatorios");
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
        url:"../controllers/AlumnoTableController.php?do=obtenerAlumno",
        method:"POST",
        data:{id_curso:id_curso},
        dataType:"json",
        success:function(data)
            {
                console.log(data);	
                $('#modalCurso').modal('show');

                $('#id_curso').val(data[1]);
                $('#run').val(data[2]);
                $('#nombre').val(data[3]);
                $('#apellido_paterno').val(data[4]);
                $('#apellido_materno').val(data[5]);
                $('#fecha_nacimiento').val(data[6]);
                $('#email').val(data[7]);
                $('#direccion').val(data[8]);
                $('#celular').val(data[9]);
                $('.modal-title').text("Editar Alumno "+data[0]);
                $('#id_alumno').val(id_alumno);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        })
});

$(document).on('click', '.borrar', function(){
    var id_alumno = $(this).attr("id");
    if(confirm("Esta seguro de borrar este registro: " + id_alumno))
    {
        $.ajax({
            url:"../controllers/AlumnoTableController.php?do=borrar",
            method:"POST",
            data:{id_alumno:id_alumno},
            success:function(data)
            {
            console.log(data);
            dataTable.ajax.reload();
            }
        });
    }
    else
    {
        return false;	
    }
});
});
