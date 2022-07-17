$(document).ready(function() {

    dataTable = $('#asignatura_dataTable').DataTable( {
        "ajax":{
            url: "../controllers/AsignTableController.php?do=getTable",
        },
        "language": {
            "emptyTable": "No existen asignaturas aun",
            "lengthMenu": "Mostrando _MENU_ datos",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
            "search":         "Buscar:"
        }
    })

    $(document).on('click', '.empleado-drop', function(){		
        var id_empleado = $(this).attr("id");
        var nombre_profesor = $(this).text();
        var inpt_profesor = $('#inpt-empleado')
        inpt_profesor.text(id_empleado);
        inpt_profesor.val(nombre_profesor);
    });

    $(document).on('click', '#btn-agregar', function(){
        var id_empleado = $('#inpt-empleado').text();
        var nombre_asign = $('#inpt-asignatura').val();

        if (id_empleado != '' && nombre_asign != '') {
            $.ajax({
                url:"../controllers/AsignTableController.php?do=ingresar",
                method:"POST",
                data:{id_empleado:id_empleado, nombre_asign:nombre_asign},
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
        }
    });

    $(document).on('click', '.borrar_asignatura', function(){
        var id_asignatura = $(this).attr("id");
        if(confirm("Esta seguro de borrar este registro: " + id_asignatura)) {
            $.ajax({
                url:"../controllers/AsignTableController.php?do=borrar",
                method:"POST",
                data:{id_asignatura:id_asignatura},
                success:function(data)
                {   
                    if (data == "1451") {
                        $(".forzar-borrado").attr("id", id_asignatura);
                        $(".forzar-borrado").removeAttr('hidden');

                        $("#alertaModal").modal('show');
                        $("#texto_modal_alerta").text("Esta libro asignatura esta siendo ocupado por uno o mas cursos, desea forzar la eliminacion?"+
                                                    "(esto quitara la asignatura de todos los cursos y tambien sus horarios)");

                    } else {
                        dataTable.ajax.reload();
                    }
                }
            });
        } else {
            return false;	
        }
    });
    
    $('#alertaModal').on('hidden.bs.modal', function () {
        $(".forzar-borrado").removeAttr("id");
        $(".forzar-borrado").attr("hidden", "");
    })

    $(document).on('click', '.forzar-borrado', function(){
        var id_asignatura = $(this).attr("id");
        if(confirm("Esta seguro de forzar el borrado de este registro: " + id_asignatura)) {
            $.ajax({
                url:"../controllers/AsignTableController.php?do=borrarForzado",
                method:"POST",
                data:{id_asignatura:id_asignatura},
                success:function(data)
                {   
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });
});