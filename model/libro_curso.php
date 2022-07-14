<?php 



class LibroCursos {
    private Database $db;
    private string $id_libro;
    private int $id_empleado;
    private string $observaciones;
    
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
     * Esta funcion crea un libro de curso en la base de datos
     * 
     * @param mixed $libroCurso
     * 
     * @return [string]
     */
    public function crearLibro() {
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
     * Con esta funcion podemos traer la informacion que corresponda de un libro
     * especificado con el id_libro
     * 
     * @param string $id_libro
     * @param string $id_empleado
     * 
     * @return [array]
     */
    public function obtenerLibroEmpleado($id_libro = "l.IDLIBROCLASES", $id_empleado = "e.IDEMPLEADO") {
        $sql = "SELECT l.IDLIBROCLASES, e.IDEMPLEADO, e.NOMBREEMPLEADO, e.PATERNOEMPLEADO, e.MATERNOEMPLEADO, l.OBSERVACIONEVALUACION 
        FROM `libroclase` AS l JOIN empleado AS e WHERE l.IDLIBROCLASES = $id_libro AND l.IDEMPLEADO = $id_empleado;";
        $res = $this->db->execute($sql);

        foreach ($res as $fila) {
            $salida[] = $fila["IDLIBROCLASES"];
            $salida[] = $fila["IDEMPLEADO"];
            $salida[] = $fila["NOMBREEMPLEADO"];
            $salida[] = $fila["PATERNOEMPLEADO"];
            $salida[] = $fila["MATERNOEMPLEADO"];
            $salida[] = $fila["OBSERVACIONEVALUACION"];
        }
        return $salida;
    }

    /**
     * Borra a un libro especifico de la lista
     * 
     * @param int $id_libro
     * 
     * @return [string]
     */
    public function borrarLibro(int $id_libro) {
        $sql = "DELETE FROM libroclase WHERE `libroclase`.`IDLIBROCLASES` = '$id_libro'";
        $res = $this->db->execute($sql);
        if ($res) {
            return $res;
        } else {
            return "Ha habido un error";
        }
    }

    /**
     * Edita a un Libro con los valores ingresados
     * 
     * @param Libro $libro
     * 
     * @return [string]
     */
    public function editarLibro() {

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
     * Esta funcion busca la tabla de libros, a la vez con el nombre
     * del profesor jefe designado a ese libro del curso
     * 
     * @return [array]
     */
    public function obtenerLibros() {
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