<?php

class Asignatura{
    private $db;
    private string $id_asignatura;
    private string $id_empleado;
    private string $nombre_asignatura;
    
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
    
    public function obtenerAsignaturas() {
        $sql = "SELECT a.IDASIGNATURA, a.NOMBREASIGNATURA, i.IDEMPLEADO, e.NOMBREEMPLEADO, e.PATERNOEMPLEADO, e.MATERNOEMPLEADO 
                FROM `asignatura` AS a 
                JOIN `imparte` AS i 
                JOIN `empleado` AS e 
                WHERE a.IDASIGNATURA = i.IDASIGNATURA AND e.IDEMPLEADO = i.IDEMPLEADO;";
        $res = $this->db->getAll($sql);
        return $res;
    }
    
    public function obtenerAsignaturasCurso($id_curso) {
        $sql = "SELECT a.IDASIGNATURA, a.NOMBREASIGNATURA 
                FROM `asignatura` as a 
                JOIN `cursa` as c 
                WHERE a.IDASIGNATURA = c.IDASIGNATURA AND c.IDCURSO = $id_curso;";
        $res = $this->db->getAll($sql);
        return $res;
    }

    public function crearAsignatura() {
        $sql = "INSERT INTO `asignatura` (`IDASIGNATURA`, `NOMBREASIGNATURA`) VALUES (NULL, '$this->nombre_asignatura')";
        $res = $this->db->execute($sql);
        if ($res) {
            if ($res == '1') {
                $sql = "INSERT INTO `imparte` SELECT a.IDASIGNATURA, e.IDEMPLEADO 
                        FROM `asignatura` AS a 
                        JOIN `empleado` AS e 
                        WHERE a.NOMBREASIGNATURA = '$this->nombre_asignatura' AND e.IDEMPLEADO = '$this->id_empleado';";
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
            }else {
                return $res;
            }
        }
        
    }

    public function borrarAsignatura($id_asignatura, $forzar = false) {
        if (!$forzar) {
            $sql = "SELECT `IDASIGNATURA` 
                    FROM `cursa` 
                    WHERE `IDASIGNATURA` = $id_asignatura;";
            $res = $this->db->execute($sql);
            $fila = $res->fetch_assoc();
            if (isset($fila["IDASIGNATURA"])) { 
                return '1451';
            }
        }
        $sql = "DELETE FROM `horario` WHERE `horario`.`IDASIGNATURA` = $id_asignatura;
                DELETE FROM `cursa` WHERE IDASIGNATURA = $id_asignatura;
                DELETE FROM `imparte` WHERE IDASIGNATURA = $id_asignatura;
                DELETE FROM `asignatura` WHERE IDASIGNATURA = $id_asignatura;";
        $res = $this->db->execute($sql, true);

        if ($res) {
            if (!is_numeric($res)) {
                return "Borrado";
            } else {
                return $sql;
            }
        } else {
            return  "error";
        }
    }

    public function obtenerTablaAsignaturas() {
        $sql = "SELECT a.IDASIGNATURA, a.NOMBREASIGNATURA, e.NOMBREEMPLEADO, e.PATERNOEMPLEADO, e.MATERNOEMPLEADO FROM `asignatura` AS a JOIN `imparte` AS i JOIN `empleado` AS e WHERE a.IDASIGNATURA = i.IDASIGNATURA AND i.IDEMPLEADO = e.IDEMPLEADO;";
        $res = $this->db->getAll($sql);
        $datos = array();
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDASIGNATURA"];
            $sub_array[] = $fila["NOMBREASIGNATURA"];
            $sub_array[] = $fila["NOMBREEMPLEADO"]." ".$fila["PATERNOEMPLEADO"]." ".$fila["MATERNOEMPLEADO"];
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDASIGNATURA"].'" class="btn btn-danger btn-sm borrar_asignatura"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;

    }
    
}
?>