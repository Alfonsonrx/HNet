<?php
include("../model/libro_curso.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'ingresar':
        $libro_curso = new LibroCursos();
        $libro_curso->__set("id_libro", $_POST["id_libro"]);
        $libro_curso->__set("id_empleado", $_POST["id_empleado"]);
        $libro_curso->__set("observaciones", $_POST["observacion"]);
        if($_POST["operacion"] == "Crear") {
            $result = $libro_curso->crearLibro();
            echo $result;
        } elseif ($_POST["operacion"] == "Editar") {
            $result = $libro_curso->editarLibro();
            echo $result;
        }
        break;

    case 'getTable':
        $libroCurso = new LibroCursos();
        $result = $libroCurso->obtenerLibros();
        echo json_encode($result);
        break;
    
    case 'borrar':
        $curso = new LibroCursos();
        $result = $curso->borrarLibro($_POST["id_libro"]);
        echo $result;
        break;

    case 'obtenerLibroEmpleado':
        $libroCurso = new LibroCursos();
        if (isset($_POST["id_libro"]) and $_POST["id_libro"] != '') {
            $result = $libroCurso->obtenerLibroEmpleado($id_libro = $_POST["id_libro"]);
        } else if (isset($_POST["id_empleado"])) {
            $result = $libroCurso->obtenerLibroEmpleado($id_empleado = $_POST["id_empleado"]);
        }
        echo json_encode($result);
        break;
}
?>