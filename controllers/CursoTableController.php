<?php
include("../model/curso.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
$id_curso = (isset($_GET['id'])) ? $_GET['id'] : '';

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
    case 'getAsigTable':
        $curso = new Cursos();

        $sql = "SELECT a.IDASIGNATURA, a.NOMBREASIGNATURA FROM `asignatura` AS a JOIN cursa AS c WHERE a.IDASIGNATURA = c.IDASIGNATURA AND c.IDCURSO = $id_curso;";
        $res = $curso->db->execute($sql);

        foreach ($res as $fila) {
            $salida = array();

            $salida[] = $fila["IDASIGNATURA"];
            $salida[] = $fila["NOMBREASIGNATURA"];
            $salida[] = '<button type="button" name="editar" id="'.$fila["IDASIGNATURA"].'" class="btn btn-warning btn-sm editar"><i class="fas fa-user-edit"></i> Editar</button> ';
            $salida[] = '<button type="button" name="borrar" id="'.$fila["IDASIGNATURA"].'" class="btn btn-danger btn-sm borrar"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $salida;
        }
        $salida = array(
            "data" => $datos
        );
        $result = $salida;
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