/**
     * Esta funcion determina si un campo input esta vacio y le agrega 
     * una clase wargning para que el usuario sepa
     * 
     * @param string campo
     * 
     * @return [none]
     */
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

$(document).ready(function() {
    /**
     * Inicio de la ventana curso, con todos sus datos
     */
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
            $("#texto-idlibro").append(data[1]);

            $.ajax({
                url:"../controllers/LibroTableController.php?do=obtenerLibroEmpleado",
                method:"POST",
                data:{id_libro:data[1]},
                dataType:"json",
                success:function(data) {
                    $("#lbl-profesor").append(data[1]);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            
            $("#lbl-anio").append(""+data[2]);
            $("#page-header").append(data[3]+" "+data[4]);
            $('title').text(data[3]+" "+data[4]+" - HNet")

            $("#lbl-sala").append(""+data[5]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    })
    
    /**
     * Primera pestaña de curso, alumnos
     */

    A_dataTable = $('#alumnos_dataTable').DataTable( {
        "ajax":{
            url: "../controllers/AlumnoTableController.php?do=getTable&id="+id_curso,
        },
        "language": {
            "emptyTable": "Aun no hay almunos inscritos en este curso",
            "lengthMenu": "Mostrando _MENU_ datos",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
            "search":         "Buscar:"
        }
    })

    $('#alumnos-tab').on('click', function(e) {
        
        $('#alumnos_dataTable').DataTable().destroy();
        $('#asignatura_dataTable').DataTable().destroy();
        $('#horario_dataTable').DataTable().destroy();

        A_dataTable = $('#alumnos_dataTable').DataTable( {
            "ajax":{
                url: "../controllers/AlumnoTableController.php?do=getTable&id="+id_curso,
            },
            "language": {
                "emptyTable": "Aun no hay almunos inscritos en este curso",
                "lengthMenu": "Mostrando _MENU_ datos",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
                "search":         "Buscar:"
            }
        })

    })

    $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        setTimeout((e) => {
            $('#alumnos_dataTable').DataTable().ajax.reload();
        }, 100);
    });

    /**
     * Segunda pestaña de curso, asignaturas
     */

    $('#asignatura-tab').on('click', function(e) {

        $('#alumnos_dataTable').DataTable().destroy();
        $('#asignatura_dataTable').DataTable().destroy();
        $('#horario_dataTable').DataTable().destroy();

        Asig_dataTable = $('#asignatura_dataTable').DataTable( {
            "ajax":{
                url: "../controllers/CursoTableController.php?do=getAsigTable&id="+id_curso,
            },
            "language": {
                "emptyTable": "Este curso no tiene asignaturas aun",
                "lengthMenu": "Mostrando _MENU_ datos",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
                "search":         "Buscar:"
            }
        })

    })

    /**
     * Tercera pestaña de curso, horarios
     */

    $('#horario-tab').on('click', function(e) {

        $('#alumnos_dataTable').DataTable().destroy();
        $('#asignatura_dataTable').DataTable().destroy();
        $('#horario_dataTable').DataTable().destroy();

        Horario_dataTable = $('#horario_dataTable').DataTable( {
            "ajax":{
                url: "../controllers/HorarioTableController.php?do=getTable&id="+id_curso,
            },
            "language": {
                "emptyTable": "Este curso no tiene horarios inscritos aun",
                "lengthMenu": "Mostrando _MENU_ datos",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
                "search":         "Buscar:"
            }
        })

    })

    
    $(document).on('click', '.asignatura_horario', function(){		
        var id_asignatura = $(this).attr("id");
        var nombre_asign = $(this).text();
        var inpt_asig = $('#inpt-asignatura_horario')
        inpt_asig.text(id_asignatura);
        inpt_asig.val(nombre_asign);
    });

    $(document).on('click', '.asignatura_tabla', function(){		
        var id_asignatura = $(this).attr("id");
        var nombre_asign = $(this).text();
        var inpt_asig = $('#inpt-asignatura')
        inpt_asig.text(id_asignatura);
        inpt_asig.val(nombre_asign);
    });

    $(document).on('click', '#btn-agregar', function() {

        var id_horario = $('#id_horario').val();
        var id_asignatura = $('#inpt-asignatura_horario').text();
        var id_libro = $('#texto-idlibro').text();
        var fecha = $('#fecha-asignatura').val();
        var inicio_asignatura = $('#inicio-asignatura').val();
        var final_asignatura = $('#final-asignatura').val();
        var asistencia_profesor = $("input[name='asistencia']:checked").val();
        var operacion_horario = $('#operacion_horario').val();
        if(id_asignatura != '' && id_libro != '' && fecha != '' && inicio_asignatura != '' && final_asignatura != '') {
            $.ajax({
                url:"../controllers/HorarioTableController.php?do=ingresar&id="+id_curso,
                type:'POST',
                dataType:'json',
                data: {
                    'id_horario': id_horario,
                    'id_asignatura': id_asignatura,
                    'id_libro': id_libro,
                    'fecha': fecha,
                    'inicio_asignatura': inicio_asignatura,
                    'final_asignatura': final_asignatura,
                    'asistencia_profesor': asistencia_profesor,
                    'operacion_horario': operacion_horario,
                },
                success:function(data) {

                }
            });
            setTimeout((e) => {
                $('#inpt-asignatura_horario').val("");
                $('#inpt-asignatura_horario').val("");
                $('#fecha-asignatura').val("");
                $('#inicio-asignatura').val("");
                $('#final-asignatura').val("");
                $("input[name='asistencia']:checked").prop('checked', false);

                $('#operacion_horario').val("Crear");
            }, 100);
            Horario_dataTable.ajax.reload();
        }
        else {
            alert("Algunos campos son obligatorios");
        }
    });

    $(document).on('click', '.borrar_horario', function(){
        var id_horario = $(this).attr("id");
        if(confirm("Esta seguro de borrar este registro: " + id_horario)) {
            $.ajax({
                url:"../controllers/HorarioTableController.php?do=borrar",
                method:"POST",
                data:{id_horario:id_horario},
                success:function(data) {
                    console.log(data);
                    Horario_dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });
    
    $(document).on('click', '.borrar_asignatura', function(){
        var id_asignatura = $(this).attr("id");
        if(confirm("Esta seguro de borrar esta asignatura?: " + id_asignatura)) {
            $.ajax({
                url:"../controllers/CursoTableController.php?do=quitarAsignatura",
                method:"POST",
                data:{id_asignatura:id_asignatura},
                success:function(data) {
                    console.log(data);
                    Horario_dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });

    $(document).on('click', '.editar_horario', function(){		
        var id_horario = $(this).attr("id");

        $.ajax({
            url:"../controllers/HorarioTableController.php?do=obtenerHorario",
            method:"POST",
            data:{id_horario:id_horario},
            dataType:"json",
            success:function(data) {
                $('#inpt-asignatura_horario').text(data[0]);
                $('#inpt-asignatura_horario').val(data[1]);
                $('#fecha-asignatura').val(data[2]);
                $('#inicio-asignatura').val(data[3]);
                $('#final-asignatura').val(data[4]);
                $("input[value='"+data[5]+"'").prop('checked', true);;
                $('#id_horario').val(id_horario);
                $('#operacion_horario').val("Editar");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    });

    
    
    

    var texto_alarma = "<span class='text-danger'>Este campo es obligatorio</span>"

});
