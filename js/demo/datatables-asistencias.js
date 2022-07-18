/**
 * Esta funcion comprueba si el campo esta vacio
 * y le agrega una clase warning que permanece por 3 segundos
 * 
 * @param string campo
 * 
 * @return [None]
 */
function campoVacio(campo) {
    if ($(campo).val() == '' || $(campo).text() == '' || $(campo).val() == undefined) {
        $(campo).addClass('border-danger');
        if (!$('#texto_alarma').hasClass(campo)) {
            $(texto_alarma).addClass(campo).insertAfter($(campo).parent());
        }
        setTimeout((e) => {
            $(campo).removeClass('border-danger');
            $('.text-danger').remove();
        }, 3000);
    }
}

var texto_alarma = "<span id='texto_alarma' class='text-danger'>Este campo es obligatorio</span>"

$(document).ready(function() {

    var id_horario = location.search.substring(1);
    var getParams = id_horario.split('=')
    var id_horario = getParams[1]
    
    dataTable = $('#dataTable').DataTable( {
        "ajax":{
            url: "../controllers/AsistTableController.php?do=getTable&id="+id_horario,
        },
        "language": {
            "emptyTable": "Aun no hay almunos inscritos en este horario",
            "lengthMenu": "Mostrando _MENU_ datos",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
            "search":         "Buscar:"
        }
    })

    $(document).on('click', '.alumnos-drop', function() {		
        var id_alumno = $(this).attr("id");
        console.log(id_alumno);
        var nombre_alumno = $(this).text();
        var inpt_alumno = $('#inpt-alumno')
        inpt_alumno.text(id_alumno);
        inpt_alumno.val(nombre_alumno);
    });

    
    $(document).on('click', '#btn-agregar', function(){
        var id_alumno = $('#inpt-alumno').text();
        campoVacio('#inpt-alumno');
        var observacion = $('#observacion').val();
        var id_asistencia = $('#id_asistencia').val();
        var id_horario = $('#id_horario').val();
        var fecha = $('#fecha_horario').val();
        var estado_asistencia = $("input[name='asistencia']:checked").val();
        var operacion_asistencia = $('#operacion_asistencia').val();

        if (id_alumno != '' && estado_asistencia != undefined) {
            $.ajax({
                url:"../controllers/AsistTableController.php?do=ingresar",
                method:"POST",
                data:{
                    id_asistencia:id_asistencia,
                    id_alumno:id_alumno, 
                    id_horario:id_horario,
                    fecha:fecha,
                    observacion:observacion,
                    estado_asistencia:estado_asistencia,
                    operacion:operacion_asistencia,
                },
                success:function(data)
                {   
                    if (data == "1062") {
                        $("#alertaModal").modal('show');
                        $("#texto_modal_alerta").text("Ya existe esta asignatura con el profesor ingresado");
                    } else {
                        dataTable.ajax.reload();
                    }
                }
            });
            setTimeout((e) => {
                dataTable.ajax.reload();

                $('#inpt-alumno').val("");
                $('#inpt-alumno').text("");
                $('#observacion').val("");
                $("input[name='asistencia']:checked").prop('checked', false);
                
                $('#operacion_asistencia').val("Crear");
                $("#btn-agregar").text("Agregar asistencia");
            }, 100);
        } else {
            $("#alertaModal").modal('show');
            $("#texto_modal_alerta").text("Hay campos vacios");
        }
    });
    
    $(document).on('click', '.editar_asistencia', function(){		
        var id_asistencia = $(this).attr("id");		
        $.ajax({
            url:"../controllers/AsistTableController.php?do=obtenerAsistencia",
            method:"POST",
            data:{id_asistencia:id_asistencia},
            dataType:"json",
            success:function(data) {
                console.log(data);	
                $('#id_asistencia').val(data[0]);
                $('#inpt-alumno').text(data[1]);
                $('#inpt-alumno').val(data[2]);
                $('#observacion').val(data[3]);
                $("input[value='"+data[4]+"'").prop('checked', true);
                $("#btn-agregar").text("Editar asistencia");

                $('#operacion_asistencia').val("Editar");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    });

    $(document).on('click', '.borrar_asistencia', function(){
        var id_asistencia = $(this).attr("id");
        if(confirm("Esta seguro de borrar esta asistencia: " + id_asistencia + "?")) {
            $.ajax({
                url:"../controllers/AsistTableController.php?do=borrar",
                method:"POST",
                data:{id_asistencia:id_asistencia},
                success:function(data){
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });
});