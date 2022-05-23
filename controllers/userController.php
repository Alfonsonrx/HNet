<?php
session_start();
$do = (isset($_GET['do'])) ? $_GET['do'] : '';

switch($do) {
    case 'login':
        $rut = trim($_POST['rut']);
        $pass = trim($_POST['password']);
        
        if($rut === "" || $pass === "") {
            $r["ans"] = false;
            $r["message"] = "Alguno de los campos esta vacio";
        } else {
            require('../modelo/empleado.php');
            $empleado = new Empleado();
            $empleado->__set("rut", $rut);
            $encryptpw = md5($pass);
            $empleado->__set("pw", $encryptpw);

            $resul = $empleado->iniciarSesion();

            if($resul) {
                $_SESSION["empleado"] = array(
                    "auth"=>true,
                    "empId"=>$resul["IDEMPLEADO"],
                    "empRol"=>$resul["ROLEMPLEADO"],
                    "nombre"=>$resul['NOMBREEMPLEADO'],
                    "apellido"=>$resul['PATERNOEMPLEADO'],
                );

                $r["ans"] = true;
                $r["message"] = "Iniciando sesion";
            } else {
                $r["ans"] = false;
                $r["message"] = "Usuario o contraseña incorrecto";
            }
        } 
        echo json_encode($r);
        break;
}
?>