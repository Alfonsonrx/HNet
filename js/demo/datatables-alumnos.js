// Call the dataTables jQuery plugin
$(document).ready(function() {
  var dataTable = $('#dataTable').DataTable( {
    "ajax":{
      url: "../controllers/AlumnoTableController.php?do=getTable",
    },
  });
  
  $(document).on('submit', '#formulario', function(event){
    event.preventDefault();
    
    var id_curso = $('#id_curso').val();
    var run = $('#run').val();
    var nombre = $('#nombre').val();
    var apellido_paterno = $('#apellido_paterno').val();
    var apellido_materno = $('#apellido_materno').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var email = $('#email').val();
    var direccion = $('#direccion').val();
    var celular = $('#celular').val();
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
          $('#modalAlumno').modal('hide');
          dataTable.ajax.reload();
        }
      });
    }
    else {
        alert("Algunos campos son obligatorios");
    }
  });

  $(document).on('click', '.boton-crear', function(){
    $('#modalAlumno').modal('show');

    $('#formulario')[0].reset()
    
    $('.modal-title').text("Crear Usuario");
    $('#action').val("Crear");
    $('#operacion').val("Crear");
  });
  
  $(document).on('click', '.detalles', function(){		
    var id_alumno = $(this).attr("id");		
    $.ajax({
      url:"../controllers/AlumnoTableController.php?do=obtenerAlumno",
      method:"POST",
      data:{id_alumno:id_alumno},
      dataType:"json",
      success:function(data)
        {
          // console.log(data);	
          $('#modalDetalleAlumno').modal('show');

          $.ajax({
            url:"../controllers/CursoTableController.php?do=obtenerCurso",
              method:"POST",
              data:{id_curso:data[1]},
              dataType:"json",
              success:function(data){
                $('#det_id_curso').text(`${data[3]} ${data[4]}`);
              },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
              }
          })
          
          $('#det_run').text(data[2]);
          $('#det_fecha_nacimiento').text(data[6]);
          $('#det_email').text(data[7]);
          if (data[8] == ''){
            $('#det_direccion').text("No se encuentra en registros");
          } else{
            $('#det_direccion').text(data[8]);
          }
          if (data[9] == '0'){
            $('#det_celular').text("No se encuentra en registros");
          } else{
            $('#det_celular').text(data[9]);
          }
          $('.modalDetalle-title').text(`${data[3]} ${data[4]} ${data[5]}`);
          $('#det_id_alumno').val(id_alumno);
        },
          error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    })
  });
  
  $(document).on('click', '.editar_alumno', function(){		
    var id_alumno = $(this).attr("id");		
    $.ajax({
        url:"../controllers/AlumnoTableController.php?do=obtenerAlumno",
        method:"POST",
        data:{id_alumno:id_alumno},
        dataType:"json",
        success:function(data)
            { 
                console.log(data);	
                $('#modalAlumno').modal('show');

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
  
  $(document).on('click', '.borrar_alumno', function(){
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
