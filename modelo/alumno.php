<?php 



class Alumnos {
    private $db;
    private $id_alumno;
    private $id_curso;
    private $run;
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $fecha_nacimiento;
    private $email;
    private $direccion;
    private $celular;

    public function __construct(){
        include_once 'Conexion.php';
        $this->db = new Database();
    }
    public function __get($key){
        return $this->$key;
    }

    public function __set($key, $value) {
        $this->$key = $value;
    }

    public function crearAlumno($alumno) {
        $sql = "INSERT INTO `alumno` 
        (`IDALUMNO`, `IDCURSO`, `RUNALUMNO`, `NOMBREIDALUMNO`, `PATERNOIDALUMNO`, 
        `MATERNOIDALUMNO`, `FECHANACIMIENTOIDALUMNO`, `EMAILALUMNO`, `DIRECCIONALUMNO`, `CELULARALUMNO`) 
        VALUES ('$alumno->id_alumno', '$alumno->id_curso', '$alumno->run', '$alumno->nombre', '$alumno->apellido_paterno', 
        '$alumno->apellido_materno', '$alumno->fecha_nacimiento', '$alumno->email', '$alumno->direccion', '$alumno->celular')";
        $res = $this->db->execute($sql);
        if ($res) {
            echo "Guardado";
        } else {
            echo "error";
        }
    }

    public function obtenerAlumno($id_alumno) {
        $sql = "SELECT * FROM `alumno` WHERE IDALUMNO='$id_alumno' LIMIT 1";
        $res = $this->db->execute($sql);

        foreach ($res as $fila) {
            
            $salida[] = $fila["IDALUMNO"];
            $salida[] = $fila["IDCURSO"];
            $salida[] = $fila["RUNALUMNO"];
            $salida[] = $fila["NOMBREIDALUMNO"];
            $salida[] = $fila["PATERNOIDALUMNO"];
            $salida[] = $fila["MATERNOIDALUMNO"];
            $salida[] = $fila["FECHANACIMIENTOIDALUMNO"];
            $salida[] = $fila["EMAILALUMNO"];
            $salida[] = $fila["DIRECCIONALUMNO"];
            $salida[] = $fila["CELULARALUMNO"];

            echo json_encode($salida);
        }
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

    public function editarAlumno($alumno) {
        $sql = "UPDATE `alumno` SET `IDCURSO` = `0`, `RUNALUMNO` = '20236632-8',
        `NOMBREIDALUMNO` = 'Damiann', `PATERNOIDALUMNO` = 'Contreras', `MATERNOIDALUMNO` = 'Orellana', 
        `FECHANACIMIENTOIDALUMNO` = '2015-11-12', `EMAILALUMNO` = 'd@hnet.cl', `DIRECCIONALUMNO` = '123', 
        `CELULARALUMNO` = '1323' WHERE `alumno`.`IDALUMNO` = '$alumno->id_alumno'";
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