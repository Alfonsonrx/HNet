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
                        window.location.replace('http://localhost/HNet/views/tabla_cursos.php')
                    }, 1000);
                } else {
                    let mensaje = json['message'];
                    alert(mensaje);
                }
            })
        }, 500);
    }) 
})