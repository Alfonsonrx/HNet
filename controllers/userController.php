<?php
session_start();
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
require('../model/empleado.php');
$empleado = new Empleado();

switch($do) {
    case 'login':
        $run = trim($_POST['run']);
        $pass = trim($_POST['password']);
        
        if($run === "" || $pass === "") {
            $r["ans"] = false;
            $r["message"] = "Alguno de los campos esta vacio";
        } else {
            $empleado->__set("run", $run);
            $encryptpw = crypt($pass, 'st');
            $empleado->__set("pw", $encryptpw);

            $resul = $empleado->iniciarSesion();

            if($resul) {
                $_SESSION["auth"] = "true";

                $_SESSION["empleado"] = array(
                    "empId"=>$resul["IDEMPLEADO"],
                    "empRol"=>$resul["ROLEMPLEADO"],
                    "nombre"=>$resul['NOMBREEMPLEADO'],
                    "apellido"=>$resul['PATERNOEMPLEADO'],
                );
                $empleado->__set("id_empleado", $resul['IDEMPLEADO']);

                if ($resul["ROLEMPLEADO"] == 'Profesor/a'){
                    $jef = $empleado->jefatura();
                    $_SESSION["empleado"]["curso_jef"] = $jef['IDCURSO'];
                } else {
                    $_SESSION["empleado"]["curso_jef"] = 0;
                }

                $r["ans"] = true;
                $r["message"] = "Iniciando sesion";
            } else {
                $r["ans"] = false;
                $r["message"] = "Usuario o contraseña incorrecto ";
            }
        } 
        echo json_encode($r);
        break;
    
    case 'logout':

        if(isset($_SESSION["auth"]) || $_SESSION["auth"] == "true"){
            $_SESSION["auth"] = "false";
            session_destroy();
        }
        
        $r["ans"] = true;
        $r["message"] = "Cerrando sesion";
        echo json_encode($r);
        break;

    case 'ingresar':
        $empleado->__set("id_empleado", $_POST["id_empleado"]);
        $empleado->__set("run", $_POST["run"]);
        $empleado->__set("pw", crypt($_POST["pw"], 'st'));

        $empleado->__set("email", $_POST["email"]);
        $empleado->__set("nombre", $_POST["nombre"]);
        $empleado->__set("apellido_paterno", $_POST["apellido_paterno"]);
        $empleado->__set("apellido_materno", $_POST["apellido_materno"]);
        $empleado->__set("fecha_nacimiento", $_POST["fecha_nacimiento"]);
        $empleado->__set("direccion", $_POST["direccion"]);
        $empleado->__set("telefono", $_POST["telefono"]);
        $empleado->__set("celular", $_POST["celular"]);
        $empleado->__set("rol", $_POST["rol"]);
        $empleado->__set("jefatura", intval($_POST["jefatura"]));

        if($_POST["operacion"] == "Crear") {
            $result = $empleado->crearEmpleado();
        } elseif ($_POST["operacion"] == "Editar") {
            $result = $empleado->editarEmpleado();
        }
        echo $result;
        break;
    case 'getTable':
        $result = $empleado->obtenerEmpleados();
        echo json_encode($result);
        break;
    
    case 'borrar':
        if ($_POST["id_empleado"] == $_SESSION["empleado"]["empId"]) {
            $result = "No se puede eliminar el usuario que se esta ocupando";
        } else {
            $result = $empleado->borrarEmpleado($_POST["id_empleado"]);
        }
        echo $result;
        break;
    case 'obtenerEmpleado':
        $result = $empleado->obtenerEmpleado($_POST["id_empleado"]);
        echo json_encode($result);
        break;
}
?>