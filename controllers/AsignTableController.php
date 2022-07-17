<?php
include("../model/asignatura.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'ingresar':
        $asign = new Asignatura();
        $asign->__set("id_empleado", $_POST["id_empleado"]);
        $asign->__set("nombre_asignatura", $_POST["nombre_asign"]);
        $result = $asign->crearAsignatura();
        echo $result;
        break;
    
    case 'ingresarACurso':
        $asign = new Asignatura();
        $result = $asign->agregarAcurso($_POST["id_asignatura"], $_POST["id_curso"]);
        echo $result;
        break;

    case 'getTable':
        $asign = new Asignatura();
        $result = $asign->obtenerTablaAsignaturas();
        echo json_encode($result);
        break;

    case 'borrar':
        $asign = new Asignatura();
        $result = $asign->borrarAsignatura($_POST["id_asignatura"]);
        echo $result;
        break;

    case 'borrarForzado':
        $asign = new Asignatura();
        $result = $asign->borrarAsignatura($_POST["id_asignatura"], $forzar = true);
        echo $result;
        break;
}
?>