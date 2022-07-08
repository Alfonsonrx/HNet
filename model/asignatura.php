<?php

class Asignatura{
    private $db;
    private $mId;
    private $rutTecnico;
    private $fecha;
    private $cajeroID;
    private $monto;
    
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
        $sql = "SELECT * FROM asignatura";
        $res = $this->db->getAll($sql);
        return $res;
    }
    
}
?>