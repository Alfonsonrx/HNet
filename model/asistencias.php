<?php

class Asistencia {
    private Database $db;
    private string $id_asistencia;
    private string $id_alumno;
    private string $id_horario;
    private string $fecha;
    private string $observacion;
    private string $estado_asistencia;
    
    /**
     *  Esta funcion instancia el objeto
     */
    public function __construct(){
        include_once 'conexion.php';
        $this->db = new Database();
    }
    /**
     * Funcion para obtener el valor de las variablles
     * de la instancia
     * 
     * @param string $key
     * 
     * @return [keytype]
     */
    public function __get($key){
        return $this->$key;
    }

    /**
     * Asigna valores a las variables de la instancia
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return [null]
     */
    public function __set($key, $value) {
        $this->$key = $value;
    }

    public function crearAsistencia() {
        $sql = "INSERT INTO `asistencia` (`IDASISTENCIA`, `IDALUMNO`, `IDHORARIO`, `FECHAASISTENCIA`, `OBSERVACIONASISTENCIA`, `ESTADOASISTENCIA`) 
        VALUES (NULL, '$this->id_alumno', '$this->id_horario', '$this->fecha', '$this->observacion', '$this->estado_asistencia');";
        $res = $this->db->execute($sql);
        if ($res) {
            if (!$res == "1062") {
                return "Guardado";
            } else {
                return $res;
            }
        } else {
            return  "error";
        }
    }

    public function obtenerAsistencia($id_asistencia) {
        $sql = "SELECT a.IDASISTENCIA, a.IDALUMNO, l.NOMBREIDALUMNO, l.PATERNOIDALUMNO, l.MATERNOIDALUMNO, a.OBSERVACIONASISTENCIA, a.ESTADOASISTENCIA
        FROM `asistencia` AS a JOIN `alumno` AS l WHERE a.IDALUMNO = l.IDALUMNO AND a.IDASISTENCIA='$id_asistencia' LIMIT 1";
        $res = $this->db->execute($sql);
        foreach ($res as $fila) {
            $salida[] = $fila["IDASISTENCIA"];
            $salida[] = $fila["IDALUMNO"];
            $salida[] = $fila["NOMBREIDALUMNO"]." ".$fila["PATERNOIDALUMNO"]." ".$fila["MATERNOIDALUMNO"];
            $salida[] = $fila["OBSERVACIONASISTENCIA"];
            $salida[] = $fila["ESTADOASISTENCIA"];
        }
        return $salida;
    }

    public function borrarAsistencia($id_asistencia) {
        $sql = "DELETE FROM asistencia WHERE `asistencia`.`IDASISTENCIA` = '$id_asistencia';";
        $res = $this->db->execute($sql);
        if ($res) {
            return "borrado";
        } else {
            return "error";
        }
    }

    public function editarAsistencia() {
        $sql = "UPDATE `asistencia` 
                SET `IDALUMNO` = '$this->id_alumno', 
                    `OBSERVACIONASISTENCIA` = '$this->observacion',
                    `ESTADOASISTENCIA` = '$this->estado_asistencia' 
                WHERE `IDASISTENCIA` = '$this->id_asistencia'";

        $res = $this->db->execute($sql);
        if ($res) {
            if (!$res == "1062") {
                return "Modificado";
            } else {
                return $res;
            }
        } else {
            return  "error";
        }
    }

    public function obtenerAsistencias($id_horario) {
        $sql = "SELECT a.IDASISTENCIA, l.NOMBREIDALUMNO, l.PATERNOIDALUMNO, l.MATERNOIDALUMNO, a.OBSERVACIONASISTENCIA, a.ESTADOASISTENCIA
                FROM `asistencia` AS a JOIN `alumno` AS l WHERE a.IDALUMNO = l.IDALUMNO AND IDHORARIO = '$id_horario';";
        $res = $this->db->getAll($sql);
        $datos = array();
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDASISTENCIA"];
            $sub_array[] = $fila["NOMBREIDALUMNO"]." ".$fila["PATERNOIDALUMNO"]." ".$fila["MATERNOIDALUMNO"];
            $sub_array[] = $fila["OBSERVACIONASISTENCIA"];
            $sub_array[] = $fila["ESTADOASISTENCIA"];
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDASISTENCIA"].'" class="btn btn-warning btn-sm editar_asistencia"><i class="fas fa-user-edit"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDASISTENCIA"].'" class="btn btn-danger btn-sm borrar_asistencia"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}

?>