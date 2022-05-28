<?php
include("../modelo/alumno.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
$id_alumno = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'ingresar':
        $al = new Alumnos();
        $al->__set("id_alumno", $_POST["id_alumno"]);
        $al->__set("id_curso", $_POST["id_curso"]);
        $al->__set("run", $_POST["run"]);
        $al->__set("nombre", $_POST["nombre"]);
        $al->__set("apellido_paterno", $_POST["apellido_paterno"]);
        $al->__set("apellido_materno", $_POST["apellido_materno"]);
        $al->__set("fecha_nacimiento", $_POST["fecha_nacimiento"]);
        $al->__set("email", $_POST["email"]);
        $al->__set("direccion", $_POST["direccion"]);
        $al->__set("celular", $_POST["celular"]);
        if($_POST["operacion"] == "Crear") {
            $al->crearAlumno($al);
        } elseif ($_POST["operacion"] == "Editar") {
            $al->editarAlumno($al);
        }
        break;
    case 'getTable':
        $al = new Alumnos();
        $result = $al->obtenerAlumnos();
        echo json_encode($result);
        break;
    case 'borrar':
        $al = new Alumnos();
        $result = $al->borrarAlumno($_POST["id_alumno"]);
        echo $result;
        break;
    case 'obtenerAlumno':
        $al = new Alumnos();
        $result = $al->obtenerAlumno($_POST["id_alumno"]);
        echo json_encode($result);
        break;
}
?>