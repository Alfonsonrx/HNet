<?php
include("../model/horario.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
$id_curso = (isset($_GET['id'])) ? $_GET['id'] : '';

switch ($do) {
    case 'ingresar':
        $horario = new Horario();
        $horario->__set("id_horario", $_POST["id_horario"]);
        $horario->__set("id_curso", $id_curso);
        $horario->__set("id_asignatura", $_POST["id_asignatura"]);
        $horario->__set("id_libro", $_POST["id_libro"]);
        $date = new DateTime($_POST["fecha"]);
        $date = $date->format('Y-m-d');
        $horario->__set("fecha", $date);
        $horario->__set("hora_inicio", $_POST["inicio_asignatura"]);
        $horario->__set("hora_final", $_POST["final_asignatura"]);
        $horario->__set("asistencia_profesor", $_POST["asistencia_profesor"]);
        if($_POST["operacion"] == "Crear") {
            $result = $horario->crearHorario();
        } elseif ($_POST["operacion"] == "Editar") {
            $result = $horario->editarHorario();
        }
        echo $result;
        break;
    case 'getTable':
        $horario = new Horario();
        $result = $horario->obtenerHorarios($id_curso);
        echo json_encode($result);
        break;
    
    case 'borrar':
        $horario = new Horario();
        $result = $horario->borrarHorario($_POST["id_horario"]);
        echo $result;
        break;
    case 'obtenerHorario':
        $horario = new Horario();
        $result = $horario->obtenerHorario($_POST["id_horario"]);
        echo json_encode($result);
        break;
}
?>