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
     * @param mixed $libroCurso
     * 
     * @return [string]
     */
    public function crearLibro($libroCurso) {
        $sql = "INSERT INTO `libroclase` (`IDLIBROCLASES`, `IDEMPLEADO`, `OBSERVACIONEVALUACION`) 
        VALUES (NULL, '$libroCurso->id_libro', '$libroCurso->observaciones')";
        $res = $this->db->execute($sql);
        if ($res) {
            return "Guardado";
        } else {
            return  "error";
        }
    }

    /**
     * @param string $id_libro
     * @param string $id_empleado
     * 
     * @return [array]
     */
    public function obtenerLibroEmpleado($id_libro = "l.IDLIBROCLASES", $id_empleado = "e.IDEMPLEADO") {
        $sql = "SELECT l.IDLIBROCLASES, e.NOMBREEMPLEADO, e.PATERNOEMPLEADO, e.MATERNOEMPLEADO, l.OBSERVACIONEVALUACION 
        FROM `libroclase` AS l JOIN empleado AS e WHERE l.IDLIBROCLASES = $id_libro AND l.IDEMPLEADO = $id_empleado;";
        $res = $this->db->execute($sql);

        foreach ($res as $fila) {
            $salida[] = $fila["IDLIBROCLASES"];
            $salida[] = $fila["NOMBREEMPLEADO"] . " " . $fila["PATERNOEMPLEADO"] . " " . $fila["MATERNOEMPLEADO"];
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
            return "borrado";
        } else {
            return "error";
        }
    }

    /**
     * Edita a un alumno con los valores ingresados
     * 
     * @param Alumno $alumno
     * 
     * @return [string]
     */
    public function editarAlumno($alumno) {

        $sql = "UPDATE `alumno` SET `IDCURSO` = '$alumno->id_curso', `RUNALUMNO` = '$alumno->run',`NOMBREIDALUMNO` = '$alumno->nombre',
        `PATERNOIDALUMNO` = '$alumno->apellido_paterno', `MATERNOIDALUMNO` = '$alumno->apellido_materno', `FECHANACIMIENTOIDALUMNO` = '$alumno->fecha_nacimiento', 
        `EMAILALUMNO` = '$alumno->email', `DIRECCIONALUMNO` = '$alumno->direccion', `CELULARALUMNO` = '$alumno->celular' WHERE `alumno`.`IDALUMNO` = '$alumno->id_alumno'";

        $res = $this->db->execute($sql);
        if ($res) {
            return "Modificado";
        } else {
            return "error";
        }
    }

    /**
     * Obtiene una lista de alumnos, si $idCurso se deja por defecto
     * entonces llama a todos los alumnos, si se cambia a un valor entero
     * llama a los alumnos que pertenezcan a la lista de un curso especifico
     * 
     * @param int $idCurso
     * 
     * @return [array]
     */
    public function obtenerAlumnos($idCurso = 'c.IDCURSO') {
        $sql = "SELECT a.IDALUMNO, c.NIVEL, c.SECCION, a.RUNALUMNO, a.NOMBREIDALUMNO, a.PATERNOIDALUMNO, a.MATERNOIDALUMNO FROM `alumno` AS a JOIN curso AS c WHERE a.IDCURSO = $idCurso;";
        
        $res = $this->db->getAll($sql);
        $datos = array();
        
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDALUMNO"];
            $sub_array[] = $fila["NIVEL"] . " " . $fila["SECCION"];
            $sub_array[] = $fila["RUNALUMNO"];
            $sub_array[] = $fila["NOMBREIDALUMNO"];
            $sub_array[] = $fila["PATERNOIDALUMNO"];
            $sub_array[] = $fila["MATERNOIDALUMNO"];
            $sub_array[] = '<button type="button" name="detalles" id="'.$fila["IDALUMNO"].'" class="btn btn-success btn-sm detalles"><i class="fas fa-info"></i> Detalles</button>';
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDALUMNO"].'" class="btn btn-warning btn-sm editar"><i class="fas fa-user-edit"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDALUMNO"].'" class="btn btn-danger btn-sm borrar"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}
?>