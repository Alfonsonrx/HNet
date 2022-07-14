$(document).ready(function() {
    $("#btnLogin").on("click",(e) => {
        e.preventDefault();

        let inptRun = $('#inptRun').val();
        let inptPw = $('#inptCon').val();
        let formData = new FormData();

        formData.append("run", inptRun);
        formData.append("password", inptPw);
        
        setTimeout(function () {
            $.ajax({
                url: "../controllers/userController.php?do=login",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(json) {
                if (json['ans']) {
                    setTimeout(function() {
                        window.location.replace('http://localhost/HNet/index.php')
                    }, 200);
                } else {
                    let mensaje = json['message'];
                    $("#alertaModal").modal('show');
                    
                    $("#errorModalLongTitle").text('Error al iniciar sesion');
                    $("#texto_modal_alerta").text(mensaje);
                }
            })
        }, 500);
    })
})