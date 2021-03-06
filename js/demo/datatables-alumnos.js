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
      url: "../controllers/AlumnoTableController.php?do=getTable",
    },
    "language": {
      "lengthMenu": "Mostrando _MENU_ datos",
      "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
      },
      "info": "Mostrando _START_ a _END_ de _TOTAL_ datos",
      "search": "Buscar:"
    }
  });
  
  $(document).on('click', '.drop-curso', function(){		
    var id_curso = $(this).attr("id");
    var nombre_curso = $(this).text();
    var inpt_cur = $('.id_curso')
    inpt_cur.text(id_curso);
    inpt_cur.val(nombre_curso);
  });

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
    
    var id_curso = $('.id_curso').text();
    
    var run = $('#run').val();
    var val_rut = validaRut('#run');
    var nombre = $('#nombre').val();
    campoVacio('#nombre');
    var email = $('#email').val();
    var val_email = validaEmail('#email');

    if(id_curso != '' && val_rut != '-' && nombre != '' && val_email != '') {
      $('.id_curso').val($('.id_curso').text());
      var formData = new FormData(this);

      $.ajax({
        url:"../controllers/AlumnoTableController.php?do=ingresar",
        method:'POST',
        data: formData,
        contentType:false,
        processData:false,
        success:function(data)
        {
          $('#formulario')[0].reset();
          $('#modalAlumno').modal('hide');
          if (data == "1062") {
            $("#alertaModal").modal('show');
            $("#texto_modal_alerta").text("Ya existe un alumno con este Run");
          } else {
            dataTable.ajax.reload();
          }
        }
      });
    }
    else {
      $("#alertaModal").modal('show');
      $("#texto_modal_alerta").text("Hay campos vacios o invalidos");
    }
  });

  $(document).on('click', '.boton-crear', function(){
    $('#modalAlumno').modal('show');

    $('#formulario')[0].reset()
    
    $('.modal-ingresar-title').text("Crear Usuario");
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
          data.forEach( function(item, i) { 
            if (item == '' || item == '0') data[i] = "No se encuentra en registros"; 
          });

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
          $('#det_direccion').text(data[8]);
          $('#det_celular').text(data[9]);
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
                // console.log(data);	
                $('#modalAlumno').modal('show');

                $('.id_curso').text(data[1]);

                $.ajax({
                  url:"../controllers/CursoTableController.php?do=obtenerCurso",
                  method:"POST",
                  data:{id_curso:data[1]},
                  dataType:"json",

                  success:function(data){
                    // console.log(data);
                    $('.id_curso').val(data[3]+" "+data[4]);
                  }
                })

                $('#run').val(data[2]);
                $('#nombre').val(data[3]);
                $('#apellido_paterno').val(data[4]);
                $('#apellido_materno').val(data[5]);
                $('#fecha_nacimiento').val(data[6]);
                $('#email').val(data[7]);
                $('#direccion').val(data[8]);
                $('#celular').val(data[9]);
                $('.modal-ingresar-title').text("Editar Alumno "+data[0]);
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
