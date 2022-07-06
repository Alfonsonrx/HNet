$(document).ready(function() {
    var id_curso = location.search.substring(1);
    var getParams = id_curso.split('=')
    var id_curso = getParams[1]
    $.ajax({
        url:"../controllers/CursoTableController.php?do=obtenerCurso",
        method:"POST",
        data:{id_curso:id_curso},
        dataType:"json",
        success:function(data) {
            $("#lbl-idcurso").val(data[0]);
            $("#lbl-idlibro").append(""+data[1]);

            $.ajax({
                url:"../controllers/LibroTableController.php?do=obtenerLibroEmpleado",
                method:"POST",
                data:{id_libro:data[1]},
                dataType:"json",
                success:function(data) {
                    $("#lbl-profesor").append(""+data[1]);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            
            $("#lbl-anio").append(""+data[2]);
            $("#page-header").append(data[3]+" "+data[4]);
            $("#lbl-sala").append(""+data[5]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    })

    A_dataTable = $('#alumnos_dataTable').DataTable( {
        "ajax":{
            url: "../controllers/AlumnoTableController.php?do=getTable&id="+id_curso,
        },
    })
    
    Asig_dataTable = $('#asignatura_dataTable').DataTable( {
        "ajax":{
            url: "../controllers/CursoTableController.php?do=getAsigTable&id="+id_curso,
        },
    })

    $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        setTimeout((e) => {
            $('#alumnos_dataTable').DataTable().ajax.reload();
        }, 100);
    });

    // function campoVacio(campo) {
    //     if ($(campo).val() == '') {
    //         $(campo).addClass('border-danger');
    //         if ($(texto_alarma + ' ' + campo).length) {
    //             $(texto_alarma).addClass(campo).insertAfter(campo);
    //         }
    //         setTimeout((e) => {
    //             $(campo).removeClass('border-danger');
    //             $('.text-danger').remove();
    //         }, 3000);
    //     }
    // }

    var texto_alarma = "<span class='text-danger'>Este campo es obligatorio</span>"
    
    
    
});
