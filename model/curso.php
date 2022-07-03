<?php 



class Cursos {
    private Database $db;
    private int $id_curso;
    private int $id_libro;
    private int $anio;
    private int $nivel;
    private int $seccion;
    private int $n_sala;

    
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
     * @param mixed $curso
     * 
     * @return [string]
     */
    public function crearCurso($curso) {
        $sql = "INSERT INTO `curso` (`IDCURSO`, `IDLIBROCLASES`, `ANIO`, `NIVEL`, `SECCION`, `SALA`) 
        VALUES (NULL, '$curso->id_libro', '$curso->anio', '$curso->nivel', '$curso->seccion', '$curso->n_sala')";
        $res = $this->db->execute($sql);
        if ($res) {
            return "Guardado";
        } else {
            return  "error";
        }
    }

    /**
     * Obtiene los datos de un curso especifico
     * 
     * @param int $id_curso
     * 
     * @return [array]
     */
    public function obtenerCurso($id_curso) {
        $sql = "SELECT * FROM `curso` WHERE IDCURSO='$id_curso' LIMIT 1";
        $res = $this->db->execute($sql);

        foreach ($res as $fila) {
            $salida[] = $fila["IDCURSO"];
            $salida[] = $fila["IDLIBROCLASES"];
            $salida[] = $fila["ANIO"];
            $salida[] = $fila["NIVEL"];
            $salida[] = $fila["SECCION"];
            $salida[] = $fila["SALA"];
        }
        return $salida;
    }

    /**
     * Borra a un curso especifico de la lista
     * 
     * @param int $id_curso
     * 
     * @return [string]
     */
    public function borrarCurso(int $id_curso) {
        $sql = "DELETE FROM curso WHERE `curso`.`IDCURSO` = '$id_curso'";
        $res = $this->db->execute($sql);
        if ($res) {
            return "borrado";
        } else {
            return "error";
        }
    }

    /**
     * @param mixed $alumno
     * 
     * @return [type]
     */
    public function editarCurso($curso) {

        $sql = "UPDATE `curso` SET `IDLIBROCLASES` = '$curso->id_libro', `ANIO` = '$curso->anio',`NIVEL` = '$curso->nivel',
        `SECCION` = '$curso->seccion', `SALA` = '$curso->n_sala' WHERE `curso`.`IDCURSO` = '$curso->id_curso'";

        $res = $this->db->execute($sql);
        if ($res) {
            return "Modificado";
        } else {
            return "error";
        }
    }

    /**
     * @return [array]
     */
    public function obtenerCursos() {
        $sql = "SELECT * FROM `curso`;";
        
        $res = $this->db->getAll($sql);
        $datos = array();
        
        foreach($res as $fila){
        
            $sub_array = array();
            $sub_array[] = $fila["IDCURSO"];
            $sub_array[] = $fila["IDLIBROCLASES"];
            $sub_array[] = $fila["ANIO"];
            $sub_array[] = $fila["NIVEL"];
            $sub_array[] = $fila["SECCION"];
            $sub_array[] = $fila["SALA"];
            $sub_array[] = '<button type="button" name="editar" id="'.$fila["IDCURSO"].'" class="btn btn-warning btn-sm editar"><i class="fas fa-user-edit"></i> Editar</button> ';
            $sub_array[] = '<button type="button" name="borrar" id="'.$fila["IDCURSO"].'" class="btn btn-danger btn-sm borrar"><i class="fas fa-minus-circle"></i> Borrar</button> ';
            $datos[] = $sub_array;
        }
        
        $salida = array(
            "data" => $datos
        );
        return $salida;
    }
}
