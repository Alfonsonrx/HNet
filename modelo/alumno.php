<?php 



class Alumnos {
    private $db;
    private $aID;

    public function __construct(){
        include_once 'Conexion.php';
        $this->db = new Database();
    }

    public function obtenerAlumno($id_alumno) {
        $sql = "SELECT * FROM alumno WHERE IDALUMNO='$id_alumno'";
        $res = $this->db->getAll($sql);
        return $res;
    }

    public function borrarAlumno($id_alumno) {
        $sql = "DELETE FROM alumno WHERE `alumno`.`IDALUMNO` = '$id_alumno'";
        $res = $this->db->execute($sql);
        if ($res) {
            echo "borrado";
        } else {
            echo "error";
        }
    }

    public function obtenerAlumnos() {
        $sql = "SELECT * FROM alumno";
        
        // $sql .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
        
        $res = $this->db->getAll($sql);
        
        $datos = array();
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDALUMNO"];
            $sub_array[] = $fila["IDCURSO"];
            $sub_array[] = $fila["RUNALUMNO"];
            $sub_array[] = $fila["NOMBREIDALUMNO"];
            $sub_array[] = $fila["PATERNOIDALUMNO"];
            $sub_array[] = $fila["MATERNOIDALUMNO"];
            $sub_array[] = $fila["FECHANACIMIENTOIDALUMNO"];
            $sub_array[] = $fila["EMAILALUMNO"];
            $sub_array[] = $fila["DIRECCIONALUMNO"];
            $sub_array[] = $fila["CELULARALUMNO"];
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDALUMNO"].'" class="btn btn-warning btn-xs editar">Editar</button>';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDALUMNO"].'" class="btn btn-danger btn-xs borrar">Borrar</button>';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        echo json_encode($salida);
    }
}
?>