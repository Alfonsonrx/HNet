<?php
include("../modelo/alumno.php");
$do = (isset($_GET['do'])) ? $_GET['do'] : '';
$id_alumno = (isset($_GET['do'])) ? $_GET['do'] : '';

switch ($do) {
    case 'getTable':
        $al = new Alumnos();
        $al->obtenerAlumnos();
        break;
    case 'borrar':
        $al = new Alumnos();
        $al->borrarAlumno($_POST["id_alumno"]);
        break;
}
?>