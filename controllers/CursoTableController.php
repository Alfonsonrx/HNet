<?php
include("../model/curso.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'ingresar':
        $curso = new Cursos();
        $curso->__set("id_alumno", $_POST["id_alumno"]);
        $curso->__set("id_curso", $_POST["id_curso"]);
        $curso->__set("run", $_POST["run"]);
        $curso->__set("nombre", $_POST["nombre"]);
        $curso->__set("apellido_paterno", $_POST["apellido_paterno"]);
        $curso->__set("apellido_materno", $_POST["apellido_materno"]);
        $curso->__set("fecha_nacimiento", $_POST["fecha_nacimiento"]);
        $curso->__set("email", $_POST["email"]);
        $curso->__set("direccion", $_POST["direccion"]);
        $curso->__set("celular", $_POST["celular"]);
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