<?php
include("../model/curso.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'ingresar':
        $curso = new Cursos();
        $curso->__set("id_curso", $_POST["id_curso"]);
        $curso->__set("id_libro", $_POST["id_libro"]);
        $date = new DateTime($_POST["anio"]);
        $date = $date->format('Y-m-d');
        $curso->__set("anio", $date);
        $curso->__set("nivel", $_POST["nivel"]);
        $curso->__set("seccion", $_POST["seccion"]);
        $curso->__set("n_sala", $_POST["sala"]);
        if($_POST["operacion"] == "Crear") {
            $result = $curso->crearCurso($curso);
        } elseif ($_POST["operacion"] == "Editar") {
            $result = $curso->editarCurso($curso);
        }
        echo $result;
        break;
    case 'getTable':
        $curso = new Cursos();
        $result = $curso->obtenerCursos();
        echo json_encode($result);
        break;
    
    case 'borrar':
        $curso = new Cursos();
        $result = $curso->borrarCurso($_POST["id_curso"]);
        echo $result;
        break;
    case 'obtenerCurso':
        $curso = new Cursos();
        $result = $curso->obtenerCurso($_POST["id_curso"]);
        echo json_encode($result);
        break;
}
?>