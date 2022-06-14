<?php 



class Alumnos {
    private Database $db;
    private int $id_alumno;
    private int $id_curso;
    private string $run;
    private string $nombre;
    private string $apellido_paterno;
    private string $apellido_materno;
    private string $fecha_nacimiento;
    private string $email;
    private string $direccion;
    private string $celular;

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
     * Crea un nuevo alumno ejecutando un script sql con los 
     * datos de la instancia alumnno
     * 
     * @param mixed $alumno
     * 
     * @return [string]
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
     * Obtiene los datos de un alumno especifico
     * 
     * @param int $id_alumno
     * 
     * @return [array]
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
            $salida;
        }
        return $salida;
    }

    /**
     * Borra a un alumno especifico de la lista
     * 
     * @param int $id_alumno
     * 
     * @return [string]
     */
    public function borrarAlumno(int $id_alumno) {
        $sql = "DELETE FROM alumno WHERE `alumno`.`IDALUMNO` = '$id_alumno'";
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