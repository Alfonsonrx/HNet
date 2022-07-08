<?php
class Empleado{
    private Database $db;
    private string $id_empleado;
    private string $run;
    private string $pw;
    private string $email;
    private string $nombre;
    private string $apellido_paterno;
    private string $apellido_materno;
    private string $fecha_nacimiento;
    private string $direccion;
    private string $telefono;
    private string $celular;
    private string $rol;
    private int $jefatura;

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
     * Asgiana valores a una variable de la instancia
     * 
     * @param mixed $key
     * @param mixed $value
     * 
     * @return [null]
     */
    public function __set($key, $value) {
        $this->$key = $value;
    }

    /**
     * 
     * 
     * @return [type]
     */
    public function iniciarSesion() {
        $sql = "SELECT * FROM empleado WHERE RUNEMPLEADO='".$this->run."' AND PASSWORD='".$this->pw."'";
        $res = $this->db->consult($sql);
        return $res;
    }

    /**
     * Crea un nuevo empleado ejecutando un script sql con los 
     * datos de la instancia alumnno
     * 
     * @return [string]
     */
    public function crearEmpleado() {
        $sql = "INSERT INTO `empleado` 
        (`IDEMPLEADO`, `RUNEMPLEADO`, `PASSWORD`, `EMAILEMPLEADO`, `NOMBREEMPLEADO`, `PATERNOEMPLEADO`,
        `MATERNOEMPLEADO`, `FECHANACIMIENTOEMPLEADO`, `DIRECCIONEMPLEADO`, `TELEFONOEMPLEADO`, `CELULAREMPLEADO`,
        `ROLEMPLEADO`, `PROFESORJEFE`) 
        VALUES (NULL, '$this->run', '$this->pw', '$this->email', '$this->nombre', '$this->apellido_paterno', 
        '$this->apellido_materno', '$this->fecha_nacimiento', '$this->direccion', '$this->telefono', '$this->celular', 
        '$this->rol', '$this->jefatura')";  
        $res = $this->db->execute($sql);
        if ($res) {
            return "Guardado";
        } else {
            return  "Error";
        }
    }

    /**
     * Se obtiene un empleado especifico segun su id
     * 
     * @param mixed $id_empleado
     * 
     * @return [array]
     */
    public function obtenerEmpleado($id_empleado) {
        $sql = "SELECT * FROM `empleado` WHERE IDEMPLEADO='$id_empleado' LIMIT 1";
        $res = $this->db->execute($sql);

        foreach ($res as $fila) {
            $salida[] = $fila["IDEMPLEADO"];
            $salida[] = $fila["RUNEMPLEADO"];
            $salida[] = $fila["PASSWORD"];
            $salida[] = $fila["NOMBREEMPLEADO"];
            $salida[] = $fila["PATERNOEMPLEADO"];
            $salida[] = $fila["MATERNOEMPLEADO"];
            $salida[] = $fila["FECHANACIMIENTOEMPLEADO"];
            $salida[] = $fila["EMAILEMPLEADO"];
            $salida[] = $fila["DIRECCIONEMPLEADO"];
            $salida[] = $fila["TELEFONOEMPLEADO"];
            $salida[] = $fila["CELULAREMPLEADO"];
            $salida[] = $fila["ROLEMPLEADO"];
            $salida[] = $fila["PROFESORJEFE"];
        }
        return $salida;
    }


    /**
     * Esta funcion borra un empleado que este registrado en la base de datos
     * 
     * @param int $id_empleado
     * 
     * @return [string]
     */
    public function borrarEmpleado(int $id_empleado) {
        $sql = "DELETE FROM empleado WHERE `empleado`.`IDEMPLEADO` = '$id_empleado'";
        $res = $this->db->execute($sql);
        if ($res) {
            return "borrado";
        } else {
            return "error";
        }
    }
    
    
    /**
     * Este metodo modifica los datos de algun empleado especifico en la base de datos
     * 
     * @param mixed $empleado
     * 
     * @return [string]
     */
    public function editarEmpleado() {

        $sql = "UPDATE `empleado` SET `RUNEMPLEADO` = '$this->run',`PASSWORD` = '$this->pw', `EMAILEMPLEADO` = '$this->email', `NOMBREEMPLEADO` = '$this->nombre', 
        `PATERNOEMPLEADO` = '$this->apellido_paterno', `MATERNOEMPLEADO` = '$this->apellido_materno', `FECHANACIMIENTOEMPLEADO` = '$this->fecha_nacimiento', 
        `DIRECCIONEMPLEADO` = '$this->direccion', `TELEFONOEMPLEADO` = '$this->telefono', `CELULAREMPLEADO` = '$this->celular', 
        `ROLEMPLEADO` = '$this->rol', `PROFESORJEFE` = '$this->jefatura'  
        WHERE `empleado`.`IDEMPLEADO` = '$this->id_empleado'";

        $res = $this->db->execute($sql);
        if ($res) {
            return "Modificado";
        } else {
            return "error";
        }
    }

    /**
     * Obtendra todos los empleados de la tabla en la base de datos
     * 
     * @return [array]
     */
    public function obtenerEmpleados() {
        $sql = "SELECT * FROM `empleado`;";
        
        $res = $this->db->getAll($sql);
        $datos = array();
        
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDEMPLEADO"];
            $sub_array[] = $fila["RUNEMPLEADO"];
            $sub_array[] = $fila["NOMBREEMPLEADO"];
            $sub_array[] = $fila["PATERNOEMPLEADO"];
            $sub_array[] = $fila["MATERNOEMPLEADO"];
            $sub_array[] = $fila["ROLEMPLEADO"];
            $sub_array[] = '<button type="button" name="detalles" id="'.$fila["IDEMPLEADO"].'" class="btn btn-success btn-sm detalles"><i class="fas fa-info"></i> Detalles</button>';
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDEMPLEADO"].'" class="btn btn-warning btn-sm editar_empleado"><i class="fas fa-user-edit"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDEMPLEADO"].'" class="btn btn-danger btn-sm borrar_empleado"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}
?>