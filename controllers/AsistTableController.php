<?php
include("../model/asistencias.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
$id_horario = (isset($_GET['id'])) ? $_GET['id'] : '';

switch ($do) {
    case 'ingresar':
        $asist = new Asistencia();
        $asist->__set("id_alumno", $_POST["id_alumno"]);
        $asist->__set("id_horario", $_POST["id_horario"]);
        $asist->__set("fecha", $_POST["fecha"]);
        $asist->__set("observacion", $_POST["observacion"]);
        $asist->__set("estado_asistencia", $_POST["estado_asistencia"]);
        if($_POST["operacion"] == "Crear") {
            $result = $asist->crearAsistencia();
        } elseif ($_POST["operacion"] == "Editar") {
            $asist->__set("id_asistencia", $_POST["id_asistencia"]);
            $result = $asist->editarAsistencia();
        }
        echo $result;
        break;

    case 'getTable':
        $asist = new Asistencia();
        $result = $asist->obtenerAsistencias($id_horario);
        echo json_encode($result);
        break;

    case 'borrar':
        $asist = new Asistencia();
        $result = $asist->borrarAsistencia($_POST["id_asistencia"]);
        echo $result;
        break;

    case 'obtenerAsistencia':
        $asist = new Asistencia();
        $result = $asist->obtenerAsistencia($_POST["id_asistencia"]);
        echo json_encode($result);
        break;
}
?>