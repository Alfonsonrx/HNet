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

    /**
     * 
     * @param mixed $alumno
     * 
     * @return [type]
     */
    public function crearAlumno($alumno) {
        $sql = "INSERT INTO `alumno` 
        (`IDALUMNO`, `IDCURSO`, `RUNALUMNO`, `NOMBREIDALUMNO`, `PATERNOIDALUMNO`, 
        `MATERNOIDALUMNO`, `FECHANACIMIENTOIDALUMNO`, `EMAILALUMNO`, `DIRECCIONALUMNO`, `CELULARALUMNO`) 
        VALUES (NULL, '$alumno->id_curso', '$alumno->run', '$alumno->nombre', '$alumno->apellido_paterno', 
        '$alumno->apellido_materno', '$alumno->fecha_nacimiento', '$alumno->email', '$alumno->direccion', '$alumno->celular')";
        $res = $this->db->execute($sql);
        if ($res) {
            return "Guardado";
        } else {
            return  "error";
        }
    }

    /**
     * @param mixed $id_alumno
     * 
     * @return [type]
     */
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

            $datos = $salida;
        }
        return $datos;
    }

    /**
     * @param mixed $id_alumno
     * 
     * @return [type]
     */
    public function borrarAlumno($id_alumno) {
        $sql = "DELETE FROM alumno WHERE `alumno`.`IDALUMNO` = '$id_alumno'";
        $res = $this->db->execute($sql);
        if ($res) {
            return "borrado";
        } else {
            return "error";
        }
    }

    /**
     * @param mixed $alumno
     * 
     * @return [type]
     */
    public function editarAlumno($alumno) {
        $sql = "UPDATE `alumno` SET `IDCURSO` = '$alumno->id_curso', `RUNALUMNO` = '$alumno->run',`NOMBREIDALUMNO` = '$alumno->nombre', `PATERNOIDALUMNO` = '$alumno->apellido_paterno', `MATERNOIDALUMNO` = '$alumno->apellido_materno', `FECHANACIMIENTOIDALUMNO` = '$alumno->fecha_nacimiento', `EMAILALUMNO` = '$alumno->email', `DIRECCIONALUMNO` = '$alumno->direccion', `CELULARALUMNO` = '$alumno->celular' WHERE `alumno`.`IDALUMNO` = '$alumno->id_alumno'";
        $res = $this->db->execute($sql);
        if ($res) {
            return "Modificado";
        } else {
            return "error";
        }
    }

    /**
     * @return [type]
     */
    public function obtenerAlumnos() {
        $sql = "SELECT * FROM alumno";
        
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
            $sub_array[] = '<button type="button" name="detalles" id="'.$fila["IDALUMNO"].'" class="btn btn-success btn-xs detalles">detalles</button>';
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDALUMNO"].'" class="btn btn-warning btn-xs editar">Editar</button>';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDALUMNO"].'" class="btn btn-danger btn-xs borrar">Borrar</button>';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}
?>