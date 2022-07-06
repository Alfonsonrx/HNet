// Call the dataTables jQuery plugin
$(document).ready(function() {
    // var dataTable = $('#dataTable').DataTable( {
    //     "ajax":{
    //         url: "../controllers/CursoTableController.php?do=getTable",
    //     },
    // });

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
    
    var id_curso = location.search.substring(1);
    var getParams = id_curso.split('=')
    var id_curso = getParams[1]
    $.ajax({
        url:"../controllers/CursoTableController.php?do=obtenerCurso",
        method:"POST",
        data:{id_curso:id_curso},
        dataType:"json",
        success:function(data) {
            console.log(data);
            $("#page-header").text("Curso "+data[3]+" "+data[4]);

            // $('#sala').val(data[5]);
            // $('#id_curso').val(id_curso);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    })
});
