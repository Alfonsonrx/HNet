// Call the dataTables jQuery plugin
$(document).ready(function() {
  var dataTable = $('#dataTable').DataTable( {
    "ajax":{
      url: "controllers/tableController.php?do=getTable",
    },
  });

  $(document).on('click', '.editar', function(){		
    var id_usuario = $(this).attr("id");		
    $.ajax({
        url:"obtener_registro.php",
        method:"POST",
        data:{id_usuario:id_usuario},
        dataType:"json",
        success:function(data)
            {
                //console.log(data);				
                $('#modalUsuario').modal('show');
                $('#nombre').val(data.nombre);
                $('#apellidos').val(data.apellidos);
                $('#telefono').val(data.telefono);
                $('#email').val(data.email);
                $('.modal-title').text("Editar Usuario");
                $('#id_usuario').val(id_usuario);
                $('#imagen_subida').html(data.imagen_usuario);
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
            url:"controllers/tableController.php?do=borrar",
            method:"POST",
            data:{id_alumno:id_alumno},
            success:function(data)
            {
                alert(data);
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
