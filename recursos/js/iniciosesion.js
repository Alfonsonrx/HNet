$(document).ready(function() {
    $("#btnLogin").click((e) => {
        e.preventDefault();

        document.cookie ='auth='+true;
    }) 
})