function campoVacio(campo, drop = false) {
  if ($(campo).val() == '') {
      $(campo).addClass('border-danger');
      var texto_alarma = "<span id='texto_alarma' class='text-danger'>Este campo es obligatorio</span>"
      
      if (!$('#texto_alarma').hasClass(campo)) {
        if (drop) {
          $(texto_alarma).addClass(campo).insertAfter($(campo).parent());
        } else {
          $(texto_alarma).addClass(campo).insertAfter($(campo));
        }
      }
      setTimeout((e) => {
          $(campo).removeClass('border-danger');
          $('.text-danger').remove();
      }, 3000);
  }
}

function validaEmail(campoEmail) {
  var email = $(campoEmail).val();
  var texto_alarma = "<span id='texto_alarma' class='text-danger'>El email es invalido</span>"

  if (!email.length==0){
    
    var patron = new RegExp('(^[0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$'); 
    // console.log(patron.test(email));
    if (patron.test(email)) {
        return true;
    } 
  } else {
    texto_alarma = "<span id='texto_alarma' class='text-danger'>El campo esta vacio</span>"
  }
  
  $(campoEmail).addClass('border-danger');
  if (!$('#texto_alarma').hasClass(campoEmail)) {
    $(texto_alarma).addClass(campoEmail).insertAfter($(campoEmail));
  }
  setTimeout((e) => {
      $(campoEmail).removeClass('border-danger');
      $('.text-danger').remove();
  }, 3000);
  return false;
}

function validaRut(campoRut) {
  var rut = $(campoRut).val();
  var texto_alarma = "<span id='texto_alarma' class='text-danger'>El rut es invalido</span>"

  if (rut.length==10){
    
    var patron = new RegExp('[0-9]{7}[-]{1}[0-9kK]{1}'); 
    // console.log(patron.test(rut));
    if (patron.test(rut)) {
        return true;
    } 
  } 
  
  $(campoRut).addClass('border-danger');
  if (!$('#texto_alarma').hasClass(campoRut)) {
    $(texto_alarma).addClass(campoRut).insertAfter($(campoRut));
  }
  setTimeout((e) => {
      $(campoRut).removeClass('border-danger');
      $('.text-danger').remove();
  }, 3000);
  return false;
}

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
    cuerpo = rut.slice(0,-1);
    dv = rut.slice(-1).toLowerCase();

    $('#run').val(cuerpo+'-'+dv);
  }

  $(document).on('submit', '#formulario', function(event){
    event.preventDefault();

    var id_empleado = $('#id_empleado').val();
    var run = $('#run').val();
    var val_rut = validaRut('#run');
    var pw = $('#pw').val();
    var email = $('#email').val();
    var val_email = validaEmail('#email');
    var nombre = $('#nombre').val();
    campoVacio('#nombre');
    var apellido_paterno = $('#apellido_paterno').val();
    campoVacio('#apellido_paterno');
    var apellido_materno = $('#apellido_materno').val();
    campoVacio('#apellido_materno');
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var direccion = $('#direccion').val();
    var telefono = $('#telefono').val();
    var celular = $('#celular').val();
    var rol = $('#rol').val();
    campoVacio('#rol', drop = true);
    var jefatura = $('#jefatura');

    if(run != '' && val_rut != '' && val_email != '' && nombre != '' && apellido_paterno != '' && apellido_materno != '' && rol != '') {
      if (jefatura.val() == 'Si') {
        jefatura.val('1');
      } else {
        jefatura.val('0');
      }
      $.ajax({
        url:"../controllers/userController.php?do=ingresar",
        method:'POST',
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          console.log(data);
          if (data == "1062") {
            $("#alertaModal").modal('show');
            $("#texto_modal_alerta").text("Ya existe un empleado con este Run");
          } else {
            $('#formulario')[0].reset();
            $('#modalEmpleado').modal('hide');
            dataTable.ajax.reload();
          }
        }
      });
    } else {
      $("#alertaModal").modal('show');
      $("#errorModalLongTitle").append(' en campos');
      $("#texto_modal_alerta").text("Hay campos vacios o invalidos, revise y vuelva a intentar");
    }
  });

  $(document).on('click', '#botonCrear', function(){
    
    $('#modalEmpleado').modal('show');
    
    $('#formulario')[0].reset()

    $('.modal-title').text("Crear Usuario");
    $('#action').val("Crear");
    $('#operacion').val("Crear");
    
    $('#lbl-pw').removeAttr("hidden");
    $('#pw').removeAttr("hidden");
    $('#br-pw').removeAttr("hidden");

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
                $('#nombre').val(data[2]);
                $('#apellido_paterno').val(data[3]);
                $('#apellido_materno').val(data[4]);
                $('#fecha_nacimiento').val(data[5]);
                $('#email').val(data[6]);
                $('#direccion').val(data[7]);
                $('#telefono').val(data[8]);
                $('#celular').val(data[9]);
                $('#rol').val(data[10]);
                if (data[11] == '1') {
                  $('#jefatura').val('Si');
                } else {
                  $('#jefatura').val('No');
                }
                $('.modal-title').text("Editar Empleado");
                $('#id_empleado').val(id_empleado);
                $('#action').val("Editar");
                $('#operacion').val("Editar");

                $('#lbl-pw').attr("hidden", "true");
                $('#pw').attr("hidden", "true");
                $('#br-pw').attr("hidden", "true");

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
              if (data != "borrado") {
                $("#alertaModal").modal('show');
                $("#errorModalLongTitle").append(' al deshabilitar este registro');
                $("#texto_modal_alerta").text(data);
              }
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
