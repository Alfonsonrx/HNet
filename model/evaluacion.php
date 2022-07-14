<?php 



class LibroCursos {
    private Database $db;
    private string $id_evaluacion;
    private int $id_alumno;
    private int $id_asignatura;
    private string $contenido;
    private string $observacion;
    private string $fecha;
    private string $nota;
    
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

    /**
     * Esta funcion ingresa una nueva evaluacion a la base de datos
     * 
     * @return [string]
     */
    public function crearEvaluacion() {
        $sql = "INSERT INTO `libroclase` (`IDLIBROCLASES`, `IDEMPLEADO`, `OBSERVACIONEVALUACION`) 
        VALUES (NULL, '$this->id_empleado', '$this->observaciones')";
        $res = $this->db->execute($sql);
        if ($res) {
            if (!$res == "1062" or !$res == "1451") {
                return "Guardado";
            } else {
                return $res;
            }
        } else {
            return  "error";
        }
    }

    /**
     * Borra una evaluacion de la tabla en la base de datos
     * 
     * @param int $id_libro
     * 
     * @return [string]
     */
    public function borrarEvaluacion(int $id_libro) {
        $sql = "DELETE FROM libroclase WHERE `libroclase`.`IDLIBROCLASES` = '$id_libro'";
        $res = $this->db->execute($sql);
        if ($res) {
            return $res;
        } else {
            return "Ha habido un error";
        }
    }

    /**
     * Edita los datos de alguna evaluacion
     * 
     * @return [string]
     */
    public function editarEvaluacion() {

        $sql = "UPDATE `libroclase` SET `IDEMPLEADO` = '$this->id_empleado', `OBSERVACIONEVALUACION` = '$this->observaciones' WHERE `libroclase`.`IDLIBROCLASES` = $this->id_libro;";

        $res = $this->db->execute($sql);
        if ($res) {
            if (!$res == "1062" or !$res == "1451") {
                return "Modificado";
            } else {
                return $res;
            }
        } else {
            return  "error";
        }
    }

    /**
     * Lista las evaluaciones para ser utilizados en alguna tabla
     * 
     * @return [array]
     */
    public function obtenerEvaluaciones() {
        $sql = "SELECT l.IDLIBROCLASES, e.IDEMPLEADO, e.NOMBREEMPLEADO, e.PATERNOEMPLEADO, e.MATERNOEMPLEADO, l.OBSERVACIONEVALUACION 
        FROM `libroclase` AS l JOIN empleado AS e WHERE l.IDEMPLEADO = e.IDEMPLEADO;";
        
        $res = $this->db->getAll($sql);
        $datos = array();
        
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDLIBROCLASES"];
            $sub_array[] = $fila["IDEMPLEADO"];
            $sub_array[] = $fila["NOMBREEMPLEADO"]." ".$fila["PATERNOEMPLEADO"]." ".$fila["MATERNOEMPLEADO"];
            $sub_array[] = $fila["OBSERVACIONEVALUACION"];
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDLIBROCLASES"].'" class="btn btn-warning btn-sm editar_libro"><i class="fas fa-minus-circle"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDLIBROCLASES"].'" class="btn btn-danger btn-sm borrar_libro"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}
?>