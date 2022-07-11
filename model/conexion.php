<?php
class Database{
    private mysqli $db;
    private $sentence;
    
    /**
     * Instancia la base de datos
     */
    public function __construct() {
        $host = 'localhost';
        $u = 'root';
        $pw = '';
        $database = 'hnet_database';
        $this->db = new mysqli($host, $u, $pw, $database);
        $this->sentence = $this->db->stmt_init();
    }

    /**
     * Obtiene toda la lista generada por el script sql
     * 
     * @param string $sql
     * 
     * @return [list]
     */
    public function getAll($sql) {
        if ($this->sentence->prepare($sql)) {
            $lista = $this->db->query($sql);
            return $lista->fetch_all(MYSQLI_ASSOC);
            $this->sentence->close();
        }
        $this->db->close();
        return null;
    }

    /**
     * Genera una consulta de una fila por el script sql
     * 
     * @param string $sql
     * 
     * @return [list]
     */
    public function consult($sql) {
        if ($this->sentence->prepare($sql)) {
            $lista = $this->db->query($sql);
            // $this->sentence->close();
            return $lista->fetch_assoc();
        }

        // $this->db->close();

        return null;
    }
    
    /**
     * Ejecuta el script sql para hacer un cambio en la tabla
     * el valor quq retorna es un integer binario que devuelve si 
     * se cambio bien o si hubo un error
     * 
     * @param string $sql
     * 
     * @return [int]
     */
    public function execute($sql) {
        $res = $this->db->query($sql);
        $this->db->close();
        return $res;
    }
}
?>