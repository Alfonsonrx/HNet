<?php
class Empleado{
    private $rut;
    private $pw;

    public function __construct(){
        include_once 'conexion.php';
        $this->db = new Database();
    }

    public function __get($key){
        return $this->$key;
    }

    public function __set($key, $value) {
        $this->$key = $value;
    }

    public function iniciarSesion() {
        $sql = "SELECT * FROM usuarios WHERE rut='".$this->rut."' AND password='".$this->pw."'";
        $res = $this->db->consult($sql);
        return $res;
    }
}
?>