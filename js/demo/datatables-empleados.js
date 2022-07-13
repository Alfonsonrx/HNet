// Call the dataTables jQuery plugin
$(document).ready(function() {
  var dataTable = $('#dataTable').DataTable( {
    "ajax":{
      url: "../controllers/userController.php?do=getTable",
    },
    "language": {
        "emptyTable": "Este curso no tiene asignaturas aun",
        "infoEmpty": "Mostrando 0 de 0 datos",
        "lengthMenu": "Mostrando _MENU_ datos",
        "paginate": {
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
    }
  });
  // el '#' hace referencia a la clase
  $('#run').on('input',updaterut);

  function updaterut(e) {
    var rut = $('#run').val().replace('.','').replace(',','').replace('-','');
    rut = rut.replace('-','');
    cuerpo = rut.slice(0,-1);
    dv = rut.slice(-1).toUpperCase();

    $('#run').val(cuerpo+'-'+dv);
  }

  $(document).on('submit', '#formulario', function(event){
    event.preventDefault();

    var id_empleado = $('#id_empleado').val();
    var run = $('#run').val();
    var pw = $('#pw').val();
    var email = $('#email').val();
    var nombre = $('#nombre').val();
    var apellido_paterno = $('#apellido_paterno').val();
    var apellido_materno = $('#apellido_materno').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var direccion = $('#direccion').val();
    var telefono = $('#telefono').val();
    var celular = $('#celular').val();
    var rol = $('#rol').val();
    var jefatura = $('#jefatura');

    if(run != '' && pw != '' && nombre != '' && rol != '') {
      if (jefatura.val() == 'Si') {
        jefatura.val('1');
      } else {
        jefatura.val('0');
      }
      $.ajax({
        url:"../controllers/userController.php?do=ingresar",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          // console.log(data);
          $('#formulario')[0].reset();
          $('#modalEmpleado').modal('hide');
          dataTable.ajax.reload();
        }
      });
      
    }
    else {
        alert("Algunos campos son obligatorios");
    }
  });

  $(document).on('click', '#botonCrear', function(){
    
    $('#modalEmpleado').modal('show');
    
    $('#formulario')[0].reset()

    $('.modal-title').text("Crear Usuario");
    $('#action').val("Crear");
    $('#operacion').val("Crear");
  });

  $(document).on('click', '.detalles', function(){		
    var id_empleado = $(this).attr("id");		
    $.ajax({
      url:"../controllers/userController.php?do=obtenerEmpleado",
      method:"POST",
      data:{id_empleado:id_empleado},
      dataType:"json",
      success:function(data)
        {
          // console.log(data);	
          data.forEach( function(item, i) { 
            if (item == '') data[i] = "No se encuentra en registros";
          });
          $('#modalDetalleEmpleado').modal('show');

          $('#det_run').text(data[1]);
          $('#det_fecha_nacimiento').text(data[6]);
          $('#det_email').text(data[7]);
          $('#det_direccion').text(data[8]);
          $('#det_telefono').text(data[9]);
          $('#det_celular').text(data[10]);
          $('#det_rol').text(data[11]);
          $('#det_jefatura').text(data[12]);
          $('.modalDetalle-title').text(`${data[3]} ${data[4]} ${data[5]}`);
          $('#det_id_empleado').val(id_empleado);
        },
          error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    })
  });

  
  $(document).on('click', '.editar_empleado', function(){		
    var id_empleado = $(this).attr("id");		
    $.ajax({
        url:"../controllers/userController.php?do=obtenerEmpleado",
        method:"POST",
        data:{id_empleado:id_empleado},
        dataType:"json",
        success:function(data)
            {
                // console.log(data);	
                $('#modalEmpleado').modal('show');

                $('#run').val(data[1]);
                // $('#pw').val(data[2]);
                $('#nombre').val(data[3]);
                $('#apellido_paterno').val(data[4]);
                $('#apellido_materno').val(data[5]);
                $('#fecha_nacimiento').val(data[6]);
                $('#email').val(data[7]);
                $('#direccion').val(data[8]);
                $('#telefono').val(data[9]);
                $('#celular').val(data[10]);
                $('#rol').val(data[11]);
                if (data[12] == '1') {
                  $('#jefatura').val('Si');
                } else {
                  $('#jefatura').val('No');
                }
                $('.modal-title').text("Editar Empleado");
                $('#id_empleado').val(id_empleado);
                $('#action').val("Editar");
                $('#operacion').val("Editar");
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        })
  });

  $(document).on('click', '#drop-rol', function(){		
    var nombre_rol = $(this).text();
    $('#rol').val(nombre_rol);
  });

  $(document).on('click', '#drop-jef', function(){		
    var opcion_jef = $(this).text();
    $('#jefatura').val(opcion_jef);
  });

  $(document).on('click', '.borrar_empleado', function(){
    var id_empleado = $(this).attr("id");
    if(confirm("Esta seguro de borrar este registro: " + id_empleado))
    {
        $.ajax({
            url:"../controllers/userController.php?do=borrar",
            method:"POST",
            data:{id_empleado:id_empleado},
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
