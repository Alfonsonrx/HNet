<?php

class Horario {
    private Database $db;
    private string $id_horario;
    private string $id_curso;
    private string $id_asignatura;
    private string $id_libro;
    private string $fecha;
    private string $hora_inicio;
    private string $hora_final;
    private string $asistencia_profesor;
    
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
     * Crea un nuevo horario que se sube a la base de datos
     * 
     * @return [string]
     */
    public function crearHorario() {
        $sql = "INSERT INTO `horario` 
        (`IDHORARIO`, `IDCURSO`, `IDASIGNATURA`, `IDLIBROCLASES`, `FECHAHORARIO`, `HORAINICIO`, `HORAFIN`, `ASISTENCIAPROFESOR`) 
        VALUES (NULL, '$this->id_curso', '$this->id_asignatura', '$this->id_libro', '$this->fecha', '$this->hora_inicio', '$this->hora_final', '$this->asistencia_profesor')";
        $res = $this->db->execute($sql);
        if ($res) {
            return "Guardado";
        } else {
            return  "error";
        }
    }

    public function obtenerHorario($id_horario) {
        $sql = "SELECT h.IDASIGNATURA, a.NOMBREASIGNATURA, h.FECHAHORARIO, h.HORAINICIO, h.HORAFIN, h.ASISTENCIAPROFESOR
        FROM `horario` AS h 
        JOIN asignatura AS a 
        WHERE h.IDASIGNATURA = a.IDASIGNATURA AND h.IDHORARIO = $id_horario LIMIT 1;";
        $res = $this->db->execute($sql);
        $salida = [];
        
        foreach ($res as $fila) {
            $salida[] = $fila["IDASIGNATURA"];
            $salida[] = $fila["NOMBREASIGNATURA"];
            $salida[] = $fila["FECHAHORARIO"];
            $salida[] = $fila["HORAINICIO"];
            $salida[] = $fila["HORAFIN"];
            $salida[] = $fila["ASISTENCIAPROFESOR"];
        }
        return $salida;
    }

    /**
     * Borra a un horario especifico de la lista
     * 
     * @param string $id_horario
     * 
     * @return [string]
     */
    public function borrarHorario($id_horario) {
        $sql = "DELETE FROM horario WHERE `horario`.`IDHORARIO` = '$id_horario'";
        $res = $this->db->execute($sql);
        if ($res) {
            return "borrado";
        } else {
            return "error";
        }
    }

    /**
     * Edita a un horario con los valores ingresados
     * 
     * @return [string]
     */
    public function editarHorario() {

        $sql = "UPDATE `horario` SET `IDCURSO` = '$this->id_curso', `IDASIGNATURA` = '$this->id_asignatura',`IDLIBROCLASES` = '$this->id_libro',
        `FECHAHORARIO` = '$this->fecha', `HORAINICIO` = '$this->hora_inicio', `HORAFIN` = '$this->hora_final', 
        `ASISTENCIAPROFESOR` = '$this->asistencia_profesor' WHERE `horario`.`IDHORARIO` = '$this->id_horario'";

        $res = $this->db->execute($sql);
        if ($res) {
            return "Modificado";
        } else {
            return "error";
        }
    }

    /**
     * @param string $id_curso
     * 
     * @return [array]
     */
    public function obtenerHorarios($id_curso) {
        $sql = "SELECT c.IDCURSO, h.IDHORARIO, a.NOMBREASIGNATURA, c.IDLIBROCLASES, h.FECHAHORARIO, h.HORAINICIO, h.HORAFIN, h.ASISTENCIAPROFESOR 
                FROM `horario` AS h 
                JOIN `curso` AS c 
                JOIN `asignatura` AS a 
                WHERE h.IDASIGNATURA = a.IDASIGNATURA AND c.IDCURSO = $id_curso AND h.IDCURSO = c.IDCURSO;";
        
        $res = $this->db->getAll($sql);
        $datos = array();
        
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDHORARIO"];
            $sub_array[] = $fila["NOMBREASIGNATURA"];
            $sub_array[] = $fila["IDLIBROCLASES"];
            $sub_array[] = $fila["FECHAHORARIO"];
            $sub_array[] = $fila["HORAINICIO"];
            $sub_array[] = $fila["HORAFIN"];
            $sub_array[] = $fila["ASISTENCIAPROFESOR"];
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDHORARIO"].'" class="btn btn-warning btn-sm editar_horario"><i class="fas fa-user-edit"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDHORARIO"].'" class="btn btn-danger btn-sm borrar_horario"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}

?>