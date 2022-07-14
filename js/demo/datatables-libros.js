$(document).ready(function() {

    var dataTable = $('#libros_dataTable').DataTable( {
        "ajax":{
            url: "../controllers/LibroTableController.php?do=getTable",
        },
        "language": {
            "lengthMenu": "Mostrando _MENU_ datos",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ datos",
            "search":         "Buscar:"
        }
    });

    $(document).on('click', '.empleado-drop', function(){		
        var id_empleado = $(this).attr("id");
        var nombre_profesor = $(this).text();
        var inpt_profesor = $('#inpt-empleado')
        inpt_profesor.text(id_empleado);
        inpt_profesor.val(nombre_profesor);
    });

    $(document).on('click', '#btn-agregar-libro', function() {

        var id_libro = $('#id_libro').val();
        var id_empleado = $('#inpt-empleado').text();
        var observacion_libro = $('#observacion-libro').val();
        var operacion_libro = $('#operacion_libro').val();

        if(id_empleado != '') {
            $.ajax({
                url:"../controllers/LibroTableController.php?do=ingresar",
                type:'POST',
                dataType:'json',
                data: {'id_libro': id_libro,'id_empleado': id_empleado,'observacion': observacion_libro,'operacion': operacion_libro},
                success:function(data) {
                    console.log(data);
                    if (data == "1062") {
                        $("#alertaModal").modal('show');
                        $("#texto_modal_alerta").text("Este profesor ya tiene jefatura designada");
                    } else if (data == "1451") {
                        $("#alertaModal").modal('show');
                        $("#texto_modal_alerta").text("No puedes editar un id de profesor mientras el libro sea utilizado");
                    } 
                }
            });
            setTimeout((e) => {
                dataTable.ajax.reload();

                $('#id_libro').val("");
                $('#inpt-empleado').val("");
                $('#inpt-empleado').text("");
                $('#observacion-libro').val("");

                $('#operacion_libro').val("Crear");
                $("#btn-agregar-libro").text("Ingresar nuevo libro")
            }, 100);
        }
        else {
            alert("Algunos campos son obligatorios");
        }
    });

    $(document).on('click', '.borrar_libro', function(){
        var id_libro = $(this).attr("id");
        if(confirm("Esta seguro de borrar este registro: " + id_libro)) {
            $.ajax({
                url:"../controllers/LibroTableController.php?do=borrar",
                method:"POST",
                data:{id_libro:id_libro},
                success:function(data){
                    if (data == "1451") {
                        $("#alertaModal").modal('show');
                        $("#texto_modal_alerta").text("Este libro esta siendo ocupado por un curso, reintentelo luego de modificar los datos");
                    }
                    console.log(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;	
        }
    });
    
    $(document).on('click', '.editar_libro', function(){
        var id_libro = $(this).attr("id");
        $.ajax({
            url:"../controllers/LibroTableController.php?do=obtenerLibroEmpleado",
            method:"POST",
            data:{id_libro:id_libro},
            dataType:"json",
            success:function(data){
                $("#id_libro").val(data[0])
                $("#inpt-empleado").text(data[1])
                $("#inpt-empleado").val(data[2]+" "+data[3]+" "+data[4])
                $("#observacion-libro").val(data[5])
                $("#operacion_libro").val("Editar")
                $("#btn-agregar-libro").text("Editar Libro")
                // console.log(data);
            }
        });
    });
});