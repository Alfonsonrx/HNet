$(document).ready(function() {
    $("#btnLogin").on("click",(e) => {
        e.preventDefault();

        let inptRut = $('#inptRut').val();
        let inptPw = $('#inptCon').val();
        let formData = new FormData();

        formData.append("rut", inptRut);
        formData.append("password", inptPw);
        
        setTimeout(function () {
            $.ajax({
                url: "controllers/userController.php?do=login",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(json) {
                if (json['ans']) {
                    document.cookie ='auth='+true;
                    setTimeout(function() {
                        window.location.replace('http://localhost/HNet/index.php')
                    }, 1000);
                } else {
                    let mensaje = json['message'];
                    alert(mensaje);
                }
            })
        }, 500);
    }) 
})